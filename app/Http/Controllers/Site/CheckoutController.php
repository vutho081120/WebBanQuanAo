<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Models\BillModel;
use App\Models\BillDetailModel;
use App\Models\AddressModel;
use App\Models\DistrictModel;
use App\Models\WardModel;
use App\Models\ProvinceModel;

class CheckoutController extends Controller
{
    public function index()
    {
        $diachi = new AddressModel();
        $tinh = new ProvinceModel();
        $huyen = new DistrictModel();
        $phuong = new WardModel();

        $diachiList = $diachi::where('nguoidung_id', Auth::user()->id)->get();
        return view( 'Site.pages.checkout', compact('diachiList', 'tinh', 'huyen', 'phuong'));
    }

    public function checkout(Request $request) {
        $cart = Session::get('Cart');

        $bill = new BillModel();
        $bill->nguoidung_id = Auth::user()->id;
        $bill->recipien_name =  $request->nameHidden;
        $bill->address = $request->addressHidden;
        $bill->phone = $request->phoneHidden;
        $bill->total_price = $cart->totalPrice;
        $bill->payment = $request->payment;
        $bill->note = $request->note ? $request->note : "NULL";
        $bill->save();
        
        foreach ($cart->products as $key => $value) {
            $bill_detail = new BillDetailModel();
            $bill_detail->hoadon_id = $bill->id;
            $bill_detail->sanpham_id = $key;
            $bill_detail->colorSize = $value['mausacSize'];
            $bill_detail->quantity = $value['soluongmua'];
            $bill_detail->close_price = $value['gia'];
            $bill_detail->save();
        }

        Session::forget('Cart');
        Session::forget('Address');
        return redirect('don-hang/'.$bill->nguoidung_id)->with('status','Đặt hàng thành công');
    }
}
