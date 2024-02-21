<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\ProductModel;
use App\Models\BillModel;
use App\Models\BillDetailModel;

class BillController extends Controller
{
    public function index()
    {
        $hoadon = new BillModel();

        $hoadonList = $hoadon::join('nguoidung', 'nguoidung.id', 'hoadon.nguoidung_id')
                    ->select('hoadon.*', 'nguoidung.user_name')
                    ->paginate(10);

        return view('Admin.pages.bill', compact('hoadonList'));
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
        
        return view('Admin.pages.billUpdate', compact('hoadonItem', 'nguoidungItem', 'hoadonchitietList'));
    }

    public function update(Request $request, $id)
    {
        $hoadon = new BillModel();
        $hoadonItem = $hoadon::find($id);

        if ($request->status == "Đang giao hàng") {
            $hoadonchitiet = new BillDetailModel();
            $sanpham = new ProductModel();

            $hoadonchitietList = $hoadonchitiet::where('hoadon_id', $hoadonItem->id)->get();
            
            foreach ($hoadonchitietList as $value) {
                $sanphamItem = $sanpham::where('id', $value->sanpham_id)->first();
                $sanphamItem->amount = $sanphamItem->amount - $value->quantity;
                
                if(strpos($value->colorSize, "Trắng") !== false){
                    $white = unserialize($sanphamItem->white);
                    $white[$value->colorSize] -= $value->quantity;
                    $sanphamItem->white = serialize($white);
                }elseif (strpos($value->colorSize, "Đen") !== false) {
                    $black = unserialize($sanphamItem->black);
                    $black[$value->colorSize] -= $value->quantity;
                    $sanphamItem->black = serialize($black);
                }elseif (strpos($value->colorSize, "Xanh") !== false) {
                    $blue = unserialize($sanphamItem->blue);
                    $blue[$value->colorSize] -= $value->quantity;
                    $sanphamItem->blue = serialize($blue);
                }elseif (strpos($value->colorSize, "Vàng") !== false) {
                    $yellow = unserialize($sanphamItem->yellow);
                    $yellow[$value->colorSize] -= $value->quantity;
                    $sanphamItem->yellow = serialize($yellow);
                }
                
                $sanphamItem->save();
            }
        }elseif ($request->status == "Giao hàng thành công") {
            $hoadonchitiet = new BillDetailModel();
            $sanpham = new ProductModel();
            
            $hoadonchitietList = $hoadonchitiet::where('hoadon_id', $hoadonItem->id)->get();
            
            foreach ($hoadonchitietList as $value) {
                $sanphamItem = $sanpham::where('id', $value->sanpham_id)->first();
                $sanphamItem->sold = $sanphamItem->sold + $value->quantity;
                $sanphamItem->save();
            }
    
            $hoadonItem->status = "Giao hàng thành công";
            $hoadonItem->save();
        }elseif ($request->status == "Giao hàng thất bại" || $request->status == "Hủy đơn hàng") {
            $hoadonchitiet = new BillDetailModel();
            $sanpham = new ProductModel();

            $hoadonchitietList = $hoadonchitiet::where('hoadon_id', $hoadonItem->id)->get();
            
            foreach ($hoadonchitietList as $value) {
                $sanphamItem = $sanpham::where('id', $value->sanpham_id)->first();
                $sanphamItem->amount = $sanphamItem->amount + $value->quantity;

                if(strpos($value->colorSize, "Trắng") !== false){
                    $white = unserialize($sanphamItem->white);
                    $white[$value->colorSize] += $value->quantity;
                    $sanphamItem->white = serialize($white);
                }elseif (strpos($value->colorSize, "Đen") !== false) {
                    $black = unserialize($sanphamItem->black);
                    $black[$value->colorSize] += $value->quantity;
                    $sanphamItem->black = serialize($black);
                }elseif (strpos($value->colorSize, "Xanh") !== false) {
                    $blue = unserialize($sanphamItem->blue);
                    $blue[$value->colorSize] += $value->quantity;
                    $sanphamItem->blue = serialize($blue);
                }elseif (strpos($value->colorSize, "Vàng") !== false) {
                    $yellow = unserialize($sanphamItem->yellow);
                    $yellow[$value->colorSize] += $value->quantity;
                    $sanphamItem->yellow = serialize($yellow);
                }

                $sanphamItem->save();
            }
        }

        $hoadonItem->status = $request->status;
        $hoadonItem->save();
        
        return redirect('admin/hoa-don/cap-nhat/'.$hoadonItem->id)->with('status', 'Cập nhật trạng thái thành công');
    }

    public function delete($id)
    {
        $hoadon = new BillModel();
        $hoadonchitiet = new BillDetailModel();

        $hoadonchitietList = $hoadonchitiet::where('hoadon_id', '=', $id);
        $hoadonchitietList->delete();

        $hoadonItem = $hoadon::find($id);
        $hoadonItem->delete();

        return redirect('admin/hoa-don')->with('status', 'Xóa thành công');
    }
}
