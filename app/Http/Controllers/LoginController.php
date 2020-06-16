<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class LoginController extends Controller
{
	public function index()
	{
		session_start();
		if (isset($_SESSION['logged_in_user'])) {
            return redirect()->to('/manageiptables');
		}
		
		return view('login');
	}

    public function loginuser(Request $request)
    {
		$validated_data = $request->validate([
            'user_name' => ['bail', 'required', 'alpha', 'max:255'],
            'password' => ['bail', 'required', 'max:255'],
		]);
		
		$user_name = $validated_data['user_name'];
		$hashed_password = hash('sha512', $validated_data['password']);
		
		if (DB::table('users')->where([
			['name', '=', $user_name],
			['password', '=', $hashed_password]
		])->exists()) {
			session_start();
			$_SESSION["logged_in_user"] = $user_name;

			function readFileData($path){
				if(file_exists($path) == 1){
					$file = fopen($path, 'r');
					$data=[];
					while (($line = fgets($file, 4096)) !== false) {
						$data[] = $line;
					}
					if (!feof($file)) {
						$error = "Error: unexpected fgets() fail\n";
					}
					fclose($file);
					return $data;
				}else{
					return false;
				}
			}
	
			function removeLines($file){
				if(!empty($file)){
					foreach($file as $index => $line){
						$file[$index] = str_replace("\n","",$file[$index]);
					}
				}
				return $file;
			}
			
			$data = readFileData('../common_files/email-ips.txt');
			$whitelist_ips = removeLines($data);
			$remote_address = $_SERVER["REMOTE_ADDR"];
	
			if (in_array($remote_address, $whitelist_ips)) {
				return redirect()->route('login')->with('logged_in',"Logged in!");
			} else {
				function generateRandomString($length = 6) {
					$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+~<>{[}]\|:/?';
					$charactersLength = strlen($characters);
					$randomString = '';
					for ($i = 0; $i < $length; $i++) {
						$randomString .= $characters[rand(0, $charactersLength - 1)];
					}
					return $randomString;
				}
				$random_code = generateRandomString();
	
				$user = DB::table('users')->where([
					['name', '=', $user_name],
					['password', '=', $hashed_password]
				])->first();
				$user_email = $user->email;

				$data = array(
					'name' => $user_name,
					'code' => $random_code
				);
				Mail::to($user_email)->send(new OtpMail($data));

				return redirect()->route('login')->with('send_otp',"Check your inbox for otp!");
			}
		} else {
    		return redirect()->route('login')->with('info',"Invalid username or password!");
		}
	}
	
	public function logout()
	{
		session_start();
		unset($_SESSION['logged_in_user']);
		return redirect()->route('login')->with('logged_out',"Logged out!");
	}
}
