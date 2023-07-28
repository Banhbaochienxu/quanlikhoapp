<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\userRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function index(){

        return view('logins.login');
    }

    public function postLogin(Request $request){

        $rule =[
            'name'      => 'required',
            'pwd'       => 'required|min:3|max:32'
        ];
        $mesage = [
            'name.required'         => 'Tài khoản không được trống',
            'pwd.required'          => 'Mật khẩu không được để trống',
            'pwd.min'               => 'Mật khẩu phải có ít nhất 3 kí tự',
            'pwd.max'               => 'Mật khẩu không quá 32 kí tự'
        ];

        $request->validate($rule,$mesage);

        $remember = $request->remember;

        if(Auth::attempt(['email' => $request->email, 'password' => $request->pwd],$remember)){
            
            return redirect()->route('product.index');
        }
        else{
            return redirect()->route('login')->with('msg','Đăng nhập không thành công')->with('status','danger');
        }
    }

    public function logout(){
        
        Auth::logout();
        return redirect()->route('login');
    }

    public function thongtinuser(){       
        $display = "block";
        $popupTitle = "Thông tin tài khoản";
        $displayPopup = "thongtinuser";
        return view('trangchu', compact('display','displayPopup','popupTitle'));
    }
    public function updateUser(){       
        $display = "block";
        $popupTitle = "Cập nhật mật khẩu";
        $displayPopup = "thongtinuser";
        return view('trangchu', compact('display','displayPopup','popupTitle'));
    }
}