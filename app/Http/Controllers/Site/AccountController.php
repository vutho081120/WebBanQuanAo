<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Models\User;
use App\Models\DistrictModel;
use App\Models\WardModel;
use App\Models\ProvinceModel;

class AccountController extends Controller
{
    public function updateShow($id)
    {
        $nguoidung = new User();
        $tinh = new ProvinceModel();
        $huyen = new DistrictModel();
        $phuong = new WardModel();

        $nguoidungItem = $nguoidung::find($id);
        $tinhList = $tinh::all();

        return view('Site.pages.accountUpdate', compact('nguoidungItem', 'tinhList', 'huyen', 'phuong'));
    }

    public function update(Request $request, $id)
    {
        $nguoidung = new User();
        $nguoidungItem = $nguoidung::find($id);

        $validator = Validator::make($request->all(),[
            'user_name'=>'required|min:3',
            'province'=>'required',
            'district'=>'required',
            'ward'=>'required',
            'address'=>'required|min:3',
            'email'=>'required|email',
        ],[
            'user_name.required'=>'Bạn chưa nhập họ và tên',
            'user_name.min'=>'Họ và tên phải có ít nhất 3 kí tự',
            'address.required'=>'Bạn chưa nhập địa chỉ',
            'address.min'=>'Địa chỉ phải có ít nhất 3 kí tự',
            'email.required'=>'Bạn chưa nhập email',
            'email.email'=>'Bạn nhập sai định dạng email',
        ]);
    
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $nguoidungItem->user_name = $request->user_name;
        $nguoidungItem->birthday = Carbon::parse($request->birthday)->format('Y-m-d');
        $nguoidungItem->gender = $request->gender;
        $nguoidungItem->tinh_id = $request->province;
        $nguoidungItem->huyen_id = $request->district;
        $nguoidungItem->phuong_id = $request->ward;
        $nguoidungItem->address = $request->address;
        $nguoidungItem->email = $request->email;
        $nguoidungItem->save();
        
        return redirect('tai-khoan/cap-nhat/'.$nguoidungItem->id)->with('status', 'Cập nhật thành công');
    }

    public function updatePassword(Request $request, $id)
    {
        $nguoidung = new User();
        $nguoidungItem = $nguoidung::find($id);

        $validator = Validator::make($request->all(),[
            'updatePassword'=>'required|min:3|max:32',
        ],[
            'updatePassword.required'=>'Bạn chưa nhập mật khẩu',
            'updatePassword.min'=>'Mật khẩu phải có ít nhất 3 kí tự',
            'updatePassword.max'=>'Mật khẩu chỉ được tối đa 32 kí tự',
        ]);
    
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $nguoidungItem->password = $request->updatePassword;
        $nguoidungItem->save();

        return redirect('tai-khoan/cap-nhat/'.$nguoidungItem->id)->with('status', 'Đổi mật khẩu thành công');
    }
}
