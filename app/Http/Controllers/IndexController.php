<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class IndexController extends Controller
{
    public function allservers()
    {
    	$directory = "../iptables/allservers.txt";
 
    	$data = File::get($directory);
    	$files = explode("\n", $data);
    	array_multisort($files);
    	//dd($files);

    	$data= array();
    	$i = 0;
    	foreach($files as $file){
    		if($file == '')
    		{
    			unset($file);
    		}else{
    			// print_r($file);
    		$name= explode("|", $file);
    		
    		
    		$directory = "../results/".$name[0].".txt";
    	 	//dd($directory);
    		$filedata = File::get($directory);
    		$file=explode ("\n", $filedata);
    		
    			$data[$i]=$file;
    			$i++;
    		}
       		
    	}
    	//sort($data);
    	//dd ($data);
    	$inputdata=array();
    	$outputdata=array();
    	$forwarddata=array();
    	$r=0;
    	foreach($data as $chain) {
    	
    	 $size=sizeof($chain);
    	
        $OUTPUT=$chain;
// input chain
        $split = array_search('OUTPUT', $OUTPUT);
        $putput=array_slice($OUTPUT, 1, $split-1);

        $inputdata[$r]=$putput;
// output chain
        $split1 = array_search('FORWARD', $OUTPUT);
        $temp1= array_slice($OUTPUT, $split,$split1);
        $split1 = array_search('FORWARD', $temp1);
        $output1 = array_slice($temp1 ,1,$split1-1);
        $outputdata[$r]=$output1;
// Forward chain 
        $temp = array_slice($OUTPUT, $split1+1,$size);
        $split2 = array_search('FORWARD', $temp);
        $output2 = array_slice($temp, $split2+1,$size);
        $forwarddata[$r]=$output2;

        $r++;
   	
    }
      //dd($forwarddata);

    	return view('manageiptables', compact('files', 'inputdata', 'outputdata', 'forwarddata' ));
    }

    public function addrule(Request $request)
    {
    	$server=$request->input('server');
    	$chain=$request->input('chain');

    	$no = $request->input('no');
			if($no == ""){
				$no=2;
			}
		$comment = $request->input('comment');
		$source_ip = $request->input('source_ip');
		$destination_ip = $request->input('destination_ip');
		$source_port = $request->input('source_port');
		$destination_port = $request->input('destination_port');
		$protocol = $request->input('protocol');
		$flags = $request->input('flags');
		$action = $request->input('action');
		$add= $request->input('add');
		$data=$server."\n".$chain."\n".$no."\n".$comment."\n".$source_ip."\n".$destination_ip."\n".$source_port."\n".$destination_port."\n".$protocol."\n".$flags."\n".$action."\n".$add;
	
		File::put('../bashscripts/feedtoupdate.txt', $data);

		echo "inserted";
	}




 public function OrderData(Request $request){ 
        
        $directory = "../results/".$request->filename.".txt";
    	 //dd($directory);
    	$data = File::get($directory);
    	$files = explode("\n", $data);
    	
    			return $files;
    		}
    	
    public function delete(Request $request)
    {
    	$delete=$request->datadelete;
    	$data=explode(" ", $delete);
    	$directory = "../bashscripts/";
    	
    	try {
    		$bash_run = passthru("bash ".$directory."deleterule.sh".$data[0]." ".$data[1]." ".$data[2]);

  		} 
  		catch (\Exception $e) {
       		dd($e);
  		}
    	echo "deleted";
    }	
    
 	public function defaultpolicy(Request $request)
    {
    	$default=$request->defaultpolicy;
    	$data1=explode(" ", $default);
    	$action=$request->action;
    	$directory = "../bashscripts/";
    	
    	try {
    		$bash_run = passthru("bash ".$directory."update_default_policy.sh".$data1[0]." ".$data1[1]." ".$action);

  		} 
  		catch (\Exception $e) {
       		dd($e);
  		}
    	echo "default";
    }	
        
	public function checkip(Request $request)
	{
		$ip = $request->ip;
		if(filter_var($ip,FILTER_VALIDATE_IP,FILTER_FLAG_IPV4)) 
		{
			  echo("valid");
			} else {
			  echo("not a valid IP address");
			}
	}



}
