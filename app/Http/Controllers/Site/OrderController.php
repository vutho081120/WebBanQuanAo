<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BillModel;
use App\Models\BillDetailModel;
use App\Models\ProductModel;
use App\Models\User;

class OrderController extends Controller
{
    public function index($id)
    {
        $hoadon = new BillModel();

        $hoadonList = $hoadon::join('nguoidung', 'nguoidung.id', 'hoadon.nguoidung_id')
                    ->select('hoadon.*', 'nguoidung.user_name')
                    ->where('nguoidung_id', '=', $id)
                    ->paginate(10);
        
        return view('Site.pages.order', compact('hoadonList'));
    }

    public function updateShow($id)
    {
        $hoadon = new BillModel();
        $hoadonItem = $hoadon::find($id);

        $nguoidung = new User();
        $nguoidungItem = $nguoidung::find($hoadonItem->nguoidung_id);

        $hoadonchitiet = new BillDetailModel();
        $hoadonchitietList = $hoadonchitiet::join('sanpham', 'sanpham.id', 'hoadonchitiet.sanpham_id')
                        ->select('hoadonchitiet.*', 'sanpham.product_name')
                        ->where('hoadon_id', '=', $id)
                        ->get();
        
        return view('Site.pages.orderUpdate', compact('hoadonItem', 'nguoidungItem', 'hoadonchitietList'));
    }

    public function update($id)
    {
        $hoadon = new BillModel();
        $hoadonchitiet = new BillDetailModel();
        $sanpham = new ProductModel();
        $hoadonItem = $hoadon::find($id);
        $hoadonchitietList = $hoadonchitiet::where('hoadon_id', $hoadonItem->id)->get();
        
        foreach ($hoadonchitietList as $value) {
            $sanphamItem = $sanpham::where('id', $value->sanpham_id)->first();
            $sanphamItem->sold = $sanphamItem->sold + $value->quantity;
            $sanphamItem->save();
        }

        $hoadonItem->status = "Giao hàng thành công";
        $hoadonItem->save();
        
        return redirect('don-hang/cap-nhat/'.$hoadonItem->id)->with('status', 'Cập nhật trạng thái thành công');
    }
}
