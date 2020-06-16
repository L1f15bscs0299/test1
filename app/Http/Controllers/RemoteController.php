<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class RemoteController extends Controller
{
    public function remote(){
    	$directory = "../remoteshell/data.txt";
    	$strings = File::get($directory);
  		$lines = explode("\n", $strings);
  		$result = array_unique($lines);
  		$data=array();
  		$i=0;
  		foreach($result as $line)
  		{
  			if($line == '')
      	{
          		unset($line);
      	}
  		  else
        {
   				$data[$i]=$line;
   				$i++;	
  			}
  		}
      return view('remote', compact('data'));
    }
   public function store(Request $request)
   {
      $ip=$request->ip;
      $username=$request->name;
      $directory = "../remoteshell/data.txt";
      $strings = File::get($directory);
      $lines = explode("\n", $strings);
      $result = array_unique($lines);
      $data=array();
      $i=0;
      foreach($result as $line)
      {
        if($line == '')
        {
          unset($line);
        }
        else
        {
          $data[$i]=$line;
          $temp = explode(":", $data[$i]);
          if (sizeof($temp)==2)
          {
              if ($temp[0]===$ip)
              {
                $data[$i]=$data[$i].":".date("h-i-s").":Online"."\n";
              }
              else
              {
                $data[$i]=$data[$i].":".date("h-i-s").":Offline"."\n";
              }
          }
          else
          {
              $temp = explode(":", $data[$i]);
              if ($temp[0]===$ip)
              {
                $temp[3]='Online';
                $data[$i]=$temp[0].":".$temp[1].":".date("h-i-s").":".$temp[3]."\n";
              }
              else
              {
                 // $temp[2]='Offline';
                 $data[$i]=$temp[0].":".$temp[1].":".$temp[2].":".$temp[3]."\n";
              }
          }
          $i++;   
        }
      }
      $directory = "../remoteshell/data.txt";
      File::put($directory, $data);
      $port=rand(1,65535);
      $data=$ip."\n".$username."\n".$port;
      $directory = "../remoteshell/command.txt";
      File::put($directory, $data);
      echo $port;
   }
  public function store_ip(Request $request)
    {
        $ip_file = fopen('../common_files/email-ips.txt', 'a');
        fwrite($ip_file,$request->input('add_white_list_ip')  . "\n");
        fclose($ip_file);
        return redirect()->back()->with("message", "IP added successfully!");
    }

  public function destroy_ip(Request $request)
    {
        $contents = file_get_contents('../common_files/email-ips.txt');
        $contents = str_replace($request->input('select_ip')."\n", '', $contents);
        file_put_contents('../common_files/email-ips.txt', $contents);
        return redirect()->back()->with("message", "IP deleted successfully!");
    }
   public function update()
   {
      $currentDate=date('h-i-s');
      $dateTemp=explode("-", $currentDate);
      $livedate=$dateTemp;
      $chour=$livedate[0];
      $cmin=$livedate[1];

      $directory = "../remoteshell/data.txt";
      $strings = File::get($directory);
      $lines = explode("\n", $strings);
      $result = array_unique($lines);
      $data=array();
      $i=0;
      foreach($result as $line)
      {
        if($line == '')
        {
          unset($line);
        }
        else
        {
          $data[$i]=$line;

          $temp = explode(":", $data[$i]);
          $data_check=explode("-", $temp[2]);
          $hours=$data_check[0];
          $minutes=$data_check[1];
          $reshour=$chour-$hours;
          $resmin=$cmin-$minutes;
          if ($resmin<0)
          {
            $resmin=$resmin*-1;
          }
          if ($reshour>=0 || $resmin>=2)
          {
              $data[$i]=$temp[0].":".$temp[1].":".$temp[2].":"."Offline"."\n";
          }
          else
          {
              $data[$i]=$temp[0].":".$temp[1].":".$temp[2].":"."Online"."\n";
          }
          

          $i++;    
        }
      }
      $directory = "../remoteshell/data.txt";
      File::put($directory, $data);
      echo "checked";
   }
}
