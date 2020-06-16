<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Templates\TemplateInterface;
use Illuminate\Support\Facades\File;




class IptablerulesController extends Controller
{
    protected $template;

    public function __construct(TemplateInterface $template){
        $this->template = $template;
    }

    public function view(){
        // $templates = $this->template->show();
        // return $templates;


        $templates = [];
        $final_template = [];
          if ($template_directory = opendir('../templates')){
            while (($read_template_directory = readdir($template_directory)) !== false){
              if ($read_template_directory != "." && $read_template_directory != "..") {
                $templates[] = $read_template_directory;
              }
            }
            closedir($template_directory);
          }

          foreach ($templates as $template){
              $final_template[] = pathinfo($template, PATHINFO_FILENAME);
            }
            
            
        return view('iptable', compact('final_template'));
    }

    public function save(Request $request){
        // return $request;
            // return $request;
        // return $request;

        $template_name = $request->template_name;
        // $check_file = Storage::get($template_name.'.sh');
        // if(count($check_file) > 0){
        //     alert()->error('File already Exsists');
        //     return redirect()->back();
        // }
        //return $template_name;
        $chain = $request->chain;
        // return count($chain);
        $comments = $request->comments;
        $source_ip = $request->source_ip;
        $destination_ip = $request->destination_ip;
        $source_port = $request->source_port;
        $destination_port = $request->destination_port;
        $protocol = $request->protocol;
        $flag = $request->flag;
        $actions = $request->actions;
        
        Storage::delete($template_name.'.txt');
            for($i = 0; $i < count($chain); $i++){
                
                $data = array(
                'chain' => $chain[$i],
                'comments' => $comments[$i],
                'source_ip' => $source_ip[$i],
                'destination_ip' => $destination_ip[$i],
                'source_port' => $source_port[$i],
                'destination_port' => $destination_port[$i],
                'protocol' => $protocol[$i],
                'flag' => $flag[$i],
                'actions' => $actions[$i]
                );
                // return $data;

                $write_data = $data['chain'].'|'.$data['comments'].'|'.$data['source_ip'].'|'.$data['destination_ip'].'|'.$data['source_port'].'|'.$data['destination_port'].'|'.$data['protocol'].'|'.$data['flag'].'|'.$data['actions'];

                // return $write_data;
                try{  

                   Storage::append($template_name.'.txt', $write_data);

                    // 
                    // return redirect()->back();
                   
                }
                catch (\Exception $e) {
                    alert()->error('Error !!!');
                    return redirect()->back();
                    dd($e);
             }


        
            }
            alert()->success('Template Created');
            return redirect()->back();
        
    }

    public function show(Request $request){
        // return $request;
        // $id = $request->id;
        $temp = $request['new_name'].'.txt';
        // $file_check = Storage::get($temp);
        // return $file_check;
        // return $request;

        // if(count($file_check) > 0){
        //     alert()->error('File already Exsists');
        //     return redirect()->back();
        // }
        // return $request;
        // $temp_change = $this->template->show_one($request);
        // return $temp_change;
        // return count($temp);
        // if(count($temp_change > 0)){
            Storage::move($request['old_name'].'.txt', $request['new_name'].'.txt');
            alert()->success('Template Renamed');
            return redirect()->back();
        // }
    }

    public function delete_template(Request $request){
        // return $request;
        $name = $request['id'];
        
        $check = Storage::delete($name.'.txt');

        if($check){
            alert()->success('Deleted');
            return redirect()->back();
        }else{
            alert()->error('Error: Not Deleted');
            return redirect()->back();
        }
        
    }

    public function view_template(Request $request){
         $file_name = $request['name'].'.txt';
        $data = Storage::get($request['name'].'.txt');

        return $data;
    }

    public function rules_update(Request $request){

        $file_name = $request['file_name'].'.txt';
        Storage::delete($file_name);

        for($i = 0; $i < count($request['data']); $i++){
            $write_data = $request['data'][$i];
            Storage::append($file_name, $write_data);
        }
        // alert()->success('File updated');
        return count($request['data']);


        return $result;
    }



}
