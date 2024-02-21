<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class SignupController extends Controller
{
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'phoneSignup'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'passwordSignup'=>'required|min:3|max:32',
            'nameSignup'=>'required|min:3',
            'province'=>'required',
            'district'=>'required',
            'ward'=>'required',
            'addressSignup'=>'required|min:3',
            'emailSignup'=>'required|email',
        ],[
            'phoneSignup.required'=>'Bạn chưa nhập số điện thoại',
            'phoneSignup.regex'=>'Bạn nhập sai định dạng số điện thoại',
            'phoneSignup.min'=>'Số điện thoại có ít nhất 10 ký tự',
            'passwordSignup.required'=>'Bạn chưa nhập mật khẩu',
            'passwordSignup.min'=>'Mật khẩu phải có ít nhất 3 kí tự',
            'passwordSignup.max'=>'Mật khẩu chỉ được tối đa 32 kí tự',
            'nameSignup.required'=>'Bạn chưa nhập họ và tên',
            'nameSignup.min'=>'Họ và tên phải có ít nhất 3 kí tự',
            // 'province.required'=>'Bạn chưa chọn tỉnh',
            // 'district.required'=>'Bạn chưa chọn huyện',
            // 'ward.required'=>'Bạn chưa chọn phường, xã',
            'addressSignup.required'=>'Bạn chưa nhập địa chỉ',
            'addressSignup.min'=>'Địa chỉ phải có ít nhất 3 kí tự',
            'emailSignup.required'=>'Bạn chưa nhập email',
            'emailSignup.email'=>'Bạn nhập sai định dạng email',
        ]);
    
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('phone', $request->phoneSignup)->first();
        if(!$user){
            $newUser = new User();
            $newUser->phone = $request->phoneSignup;
            $newUser->password = $request->passwordSignup;
            $newUser->birthday = Carbon::parse($request->birthdaySignup)->format('Y-m-d');
            $newUser->gender = $request->genderSignup;
            $newUser->email = $request->emailSignup;
            $newUser->user_name = $request->nameSignup;
            $newUser->tinh_id = $request->province;
            $newUser->huyen_id = $request->district;
            $newUser->phuong_id = $request->ward;
            $newUser->address = $request->addressSignup;
            $newUser->role = 1;
            $newUser->save();
            return redirect()->back()->with('status', 'Bạn đã tạo tài khoản thành công , mời bạn đăng nhập');
        }
        else {
            return redirect()->back()->with('error', 'Số điện thoại đã tồn tại , mời bạn đăng nhập');
        }
    }
}