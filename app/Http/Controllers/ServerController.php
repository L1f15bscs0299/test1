<?php

namespace App\Http\Controllers;
use App\Repositories\Server\ServerInterface;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ServerController extends Controller
{
  protected $server;

  public function construct(ServerInterface $server){
    $this->server = $server;
  }

  public function view(){
      $file = "../iptables/.id_rsa.pub";
      $key = File::get($file);
      return $key;
    }

    public function add(Request $request){
      $data = $request->all();
      $directory = "../bashscripts/";

      try {
        passthru("sudo bash ".$directory."configurenew.sh ".$data['server_name']." ".$data['server_ip']);
        // dd("bash ".$directory."configurenew.sh ".$data['server_name']." ".$data['server_ip']);
        alert()->success('Server Added Successfully');

      } 
      catch (\Exception $e) {
          dd($e);
      }

      return redirect()->back();

    }
}
