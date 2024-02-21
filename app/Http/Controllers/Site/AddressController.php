<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Models\AddressModel;
use App\Models\DistrictModel;
use App\Models\WardModel;
use App\Models\ProvinceModel;

class AddressController extends Controller
{
    public function index()
    {
        $diachi = new AddressModel();
        $tinh = new ProvinceModel();
        $huyen = new DistrictModel();
        $phuong = new WardModel();
        
        $diachiList = $diachi::where('nguoidung_id', '=', Auth::user()->id)->paginate(10);

        return view('Site.pages.address', compact('diachiList', 'tinh', 'huyen', 'phuong'));
    }

    public function createShow()
    {
        $tinh = new ProvinceModel();

        $tinhList = $tinh::all();

        return view('Site.pages.addressCreate', compact('tinhList'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'recipien_name'=>'required|min:3',
            'province'=>'required',
            'district'=>'required',
            'ward'=>'required',
            'address'=>'required|min:3',
        ],[
            'phone.required'=>'Bạn chưa nhập số điện thoại',
            'phone.regex'=>'Bạn nhập sai định dạng số điện thoại',
            'phone.min'=>'Số điện thoại có ít nhất 10 ký tự',
            'recipien_name.required'=>'Bạn chưa nhập họ và tên',
            'recipien_name.min'=>'Họ và tên phải có ít nhất 3 kí tự',
            'address.required'=>'Bạn chưa nhập địa chỉ',
            'address.min'=>'Địa chỉ phải có ít nhất 3 kí tự',
        ]);
    
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        $diachiItem = new AddressModel();
        $diachiItem->nguoidung_id = Auth::user()->id;
        $diachiItem->recipien_name = $request->recipien_name;
        $diachiItem->phone = $request->phone;
        $diachiItem->tinh_id = $request->province;
        $diachiItem->huyen_id = $request->district;
        $diachiItem->phuong_id = $request->ward;
        $diachiItem->address = $request->address;
        $diachiItem->save();
        return redirect()->back()->with('status', 'Bạn đã thêm địa chỉ thành công');
    }

    public function updateShow($id)
    {
        $diachi = new AddressModel();
        $tinh = new ProvinceModel();
        $huyen = new DistrictModel();
        $phuong = new WardModel();

        $diachiItem = $diachi::find($id);
        $tinhList = $tinh::all();

        return view('Site.pages.addressUpdate', compact('diachiItem', 'tinhList', 'huyen', 'phuong'));
    }

    public function update(Request $request, $id)
    {
        $diachi = new AddressModel();
        $diachiItem = $diachi::find($id);

        $validator = Validator::make($request->all(),[
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'recipien_name'=>'required|min:3',
            'province'=>'required',
            'district'=>'required',
            'ward'=>'required',
            'address'=>'required|min:3',
        ],[
            'phone.required'=>'Bạn chưa nhập số điện thoại',
            'phone.regex'=>'Bạn nhập sai định dạng số điện thoại',
            'phone.min'=>'Số điện thoại có ít nhất 10 ký tự',
            'recipien_name.required'=>'Bạn chưa nhập họ và tên',
            'recipien_name.min'=>'Họ và tên phải có ít nhất 3 kí tự',
            'address.required'=>'Bạn chưa nhập tên người dùng',
            'address.min'=>'Tên người dùng phải có ít nhất 3 kí tự',
        ]);
    
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $diachiItem->recipien_name = $request->recipien_name;
        $diachiItem->phone = $request->phone;
        $diachiItem->tinh_id = $request->province;
        $diachiItem->huyen_id = $request->district;
        $diachiItem->phuong_id = $request->ward;
        $diachiItem->address = $request->address;
        $diachiItem->save();
        
        return redirect('dia-chi/cap-nhat/'.$diachiItem->id)->with('status', 'Cập nhật thành công');
    }

    public function delete($id)
    {
        $diachi = new AddressModel();
        $diachiItem = $diachi::find($id);
        $diachiItem->delete();

        return redirect('dia-chi')->with('status', 'Xóa thành công');
    }

    public function select(Request $request, $id)
    {
        $diachi = new AddressModel();
        $newAddress = $diachi::find($id);
        $request->session()->put('Address', $newAddress);

        return redirect('thanh-toan')->with('status', 'Thay đổi địa chỉ thành công');
    }

    public function deleteSelect()
    {
        Session::forget('Address');

        return redirect('thanh-toan')->with('status', 'Thay đổi địa chỉ thành công');
    }

    public function district(Request $request)
    {
        $huyen = new DistrictModel();
        $huyenList = $huyen::where('province_id', $request->provinceId)->get();

        $htmlOption = '';
        foreach($huyenList as $value) {
            $htmlOption .= "<option value='".$value->id."'>".$value->district_name."</option>";
        }

        return $htmlOption;
    }

    public function ward(Request $request)
    {
        $phuong = new WardModel();
        $phuongList = $phuong::where('district_id', $request->districtId)->get();

        $htmlOption = '';
        foreach($phuongList as $value) {
            $htmlOption .= "<option value='".$value->id."'>".$value->ward_name."</option>";
        }

        return $htmlOption;
    }
}
