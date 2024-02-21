<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'phoneLogin'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'passwordLogin'=>'required|min:3|max:32',
        ],[
            'phoneLogin.required'=>'Bạn chưa nhập số điện thoại',
            'phoneLogin.regex'=>'Bạn nhập sai định dạng số điện thoại',
            'phoneLogin.min'=>'Số điện thoại có ít nhất 10 ký tự',
            'passwordLogin.required'=>'Bạn chưa nhập mật khẩu',
            'passwordLogin.min'=>'Mật khẩu phải có ít nhất 3 kí tự',
            'passwordLogin.max'=>'Mật khẩu chỉ được tối đa 32 kí tự',
        ]);
    
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput ();
        }

        if(Auth::attempt(['phone' => $request->phoneLogin, 'password' => $request->passwordLogin], $request->remember)){
            if (Auth::user()->role == 1){
                return redirect()->back()->with('status', 'Đăng nhập thành công');
            }
            elseif (Auth::user()->role == 0) {
                return redirect('admin/trang-chu')->with('status', 'Đăng nhập thành công');
            }
        }

        return redirect('trang-chu')->with('error', 'Đăng nhập thất bại');
    }
}