<?php

namespace App\Http\Controllers;

use App\pemilikw;
use Illuminate\Support\Facades\Auth;
use App\dinas;
use Illuminate\Http\Request;

class login extends Controller
{
    function masuk(Request $kiriman){
    	$data1= pemilikw::where('username', $kiriman->username)->where('password_pemilik', $kiriman->password_pemilik)->get();

    	$data2= dinas::where('username', $kiriman->username)->where('password', $kiriman->password)->get();

    	if(count($data1)>0){
    		//berhasil login untuk pemilik
    		Auth::guard('pemilikw')->LoginUsingId($data1[0]['id_pemilik']);
    		return redirect('/pemilikw');

    	}else if(count($data2)>0){
    		//berhasil login untuk dinas
    		Auth::guard('dinas')->LoginUsingId($data2[0]['id']);
    		return redirect('/dinas');
    	}else{
    		//gagal login
    		return "login gagal";
    	}

    }

    function keluar(){
    	if(Auth::guard('pemilikw')->check()){
    		Auth::guard('pemilikw')->logout();

    	}else if(Auth::guard('dinas')->check()){
    		Auth::guard('dinas')->logout();

    	}
    	return redirect('/masuk');
    }
}