<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Models\User;
use App\Models\BillModel;
use App\Models\DistrictModel;
use App\Models\WardModel;
use App\Models\ProvinceModel;

class UserController extends Controller
{
    public function index()
    {
        $nguoidung = new User();
        $tinh = new ProvinceModel();
        $huyen = new DistrictModel();
        $phuong = new WardModel();

        $nguoidungList = $nguoidung->paginate(10);
        
        return view('Admin.pages.user', compact('nguoidungList', 'tinh', 'huyen', 'phuong'));
    }

    public function createShow()
    {
        $tinh = new ProvinceModel();

        $tinhList = $tinh::all();

        return view('Admin.pages.userCreate', compact('tinhList'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'password'=>'required|min:3|max:32',
            'user_name'=>'required|min:3',
            'province'=>'required',
            'district'=>'required',
            'ward'=>'required',
            'address'=>'required|min:3',
            'email'=>'required|email',
        ],[
            'phone.required'=>'Bạn chưa nhập số điện thoại',
            'phone.regex'=>'Bạn nhập sai định dạng số điện thoại',
            'phone.min'=>'Số điện thoại có ít nhất 10 ký tự',
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'Mật khẩu phải có ít nhất 3 kí tự',
            'password.max'=>'Mật khẩu chỉ được tối đa 32 kí tự',
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
    
        $user = User::where('phone', $request->phone)->first();
        if(!$user){
            $nguoidungItem = new User();
            $nguoidungItem->phone = $request->phone;
            $nguoidungItem->password = $request->password;
            $nguoidungItem->user_name = $request->user_name;
            $nguoidungItem->role = $request->role;
            $nguoidungItem->birthday = Carbon::parse($request->birthday)->format('Y-m-d');
            $nguoidungItem->gender = $request->gender;
            $nguoidungItem->tinh_id = $request->province;
            $nguoidungItem->huyen_id = $request->district;
            $nguoidungItem->phuong_id = $request->ward;
            $nguoidungItem->address = $request->address;
            $nguoidungItem->email = $request->email;
            $nguoidungItem->save();
            return redirect()->back()->with('status', 'Bạn đã thêm người dùng thành công');
        }
        else {
            return redirect()->back()->with('error', 'Số điện thoại đã tồn tại , mời bạn đăng nhập');
        }
    }

    public function updateShow($id)
    {
        $nguoidung = new User();
        $tinh = new ProvinceModel();
        $huyen = new DistrictModel();
        $phuong = new WardModel();
        
        $nguoidungItem = $nguoidung::find($id);
        $tinhList = $tinh::all();

        return view('Admin.pages.userUpdate', compact('nguoidungItem', 'tinhList', 'huyen', 'phuong'));
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
        $nguoidungItem->role = $request->role;
        $nguoidungItem->birthday = Carbon::parse($request->birthday)->format('Y-m-d');
        $nguoidungItem->gender = $request->gender;
        $nguoidungItem->tinh_id = $request->province;
        $nguoidungItem->huyen_id = $request->district;
        $nguoidungItem->phuong_id = $request->ward;
        $nguoidungItem->address = $request->address;
        $nguoidungItem->email = $request->email;
        $nguoidungItem->save();
        
        return redirect('admin/nguoi-dung/cap-nhat/'.$nguoidungItem->id)->with('status', 'Cập nhật thành công');
    }

    public function delete($id)
    {
        $nguoidung = new User();
        $nguoidungItem = $nguoidung::find($id);
        $hoadon = new BillModel();
        $hoadonCheck = $hoadon::where('nguoidung_id', $id)->get();

        if (isset($hoadonCheck) && count($hoadonCheck) > 0) {
            return redirect('admin/nguoi-dung/cap-nhat/'.$id)->with('error', 'Bạn chưa xóa hóa đơn chứa người dùng');
        }else {
            $nguoidungItem->delete();
            return redirect('admin/nguoi-dung')->with('status', 'Xóa thành công');
        }
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

        return redirect('admin/nguoi-dung/cap-nhat/'.$nguoidungItem->id)->with('status', 'Đổi mật khẩu thành công');
    }
}
