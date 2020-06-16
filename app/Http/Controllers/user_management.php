<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use app\User;

class user_management extends Controller
{
    public function user_management()
    {

    	$users = DB::select('select * from users');
    	// dd($users);
    	return view('user_management', ['users'=>$users]);
    }
    public function insert(Request $request){
		$name = $request->input('name');
		$name = strtolower($name);
		$email = $request->input('email');
		$password = $request->input('password');
		$password = hash('sha512', $password);
		$users = DB::select('select * from users where email=?',[$email]);
		if(!empty($users))
		{
			DB::update('update users set name = ? ,password = ? where email = ?',[$name,$password,$email]);
			echo "updateded";
		}
		else{
			$data=array('name'=>$name,'password'=>$password ,'email'=>$email);
			DB::table('users')->insert($data);
			echo "inserted";
		}		
	}
	public function delete($email){
		DB::delete('delete from users where email = ?',[$email]);
		echo "deleted";
	}
}
