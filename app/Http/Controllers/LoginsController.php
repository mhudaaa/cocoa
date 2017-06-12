<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class LoginsController extends Controller{

	public function setLogin(Request $request){
		$username = $request->username;
		$password = $request->password;

		$user = ['admin', 'penguji'];
		$pass = ['admin', 'penguji'];

		if ($username == $user[0]) {
			if ($pass[0] == $password) {
				$request->session()->put('user', $user[0]);
				return redirect('/admin/dashboard');
			} else{
				return redirect('/')->with('message', 'Password salah');
			}
		}elseif ($username == $user[1]) {
			if ($pass[1] == $password) {
				$request->session()->put('user', $user[1]);
				return redirect('/penguji/dashboard');
			}else{
				return redirect('/')->with('message', 'Password salah');
			}
		}else{
			return redirect('/')->with('message', 'Username salah');
		}
	}

	public function setLogout(){
		return redirect('/');
	}
}