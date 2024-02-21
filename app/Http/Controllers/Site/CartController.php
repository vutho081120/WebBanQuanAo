<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\ProductModel;
use App\Models\Cart;
use App\Models\ProvinceModel;
use App\Models\CategoryModel;

class CartController extends Controller
{
    public function index()
    {
        $danhmuc = new CategoryModel();
        $tinh = new ProvinceModel();

        $categories = $danhmuc::with('children')->where('parent_id', 0)->get();
        $tinhList = $tinh::all();

        return view( 'Site.pages.cart', compact('categories', 'tinhList'));
    }

    public function addCart(Request $request)
    {
        $sanpham = new ProductModel();
        $sanphamItem = $sanpham::find($request->productIdHidden);
        $flag = false;

        if(strpos($request->colorSize, "Trắng") !== false){
            $white = unserialize($sanphamItem->white);
            if ($white[$request->colorSize] - $request->qty > 0) {
                $flag = true;
            }
        }elseif (strpos($request->colorSize, "Đen") !== false) {
            $black = unserialize($sanphamItem->black);
            if ($black[$request->colorSize] - $request->qty > 0) {
                $flag = true;
            }
        }elseif (strpos($request->colorSize, "Xanh") !== false) {
            $blue = unserialize($sanphamItem->blue);
            if ($blue[$request->colorSize] - $request->qty > 0) {
                $flag = true;
            }
        }elseif (strpos($request->colorSize, "Vàng") !== false) {
            $yellow = unserialize($sanphamItem->yellow);
            if ($yellow[$request->colorSize] - $request->qty > 0) {
                $flag = true;
            }
        }

        if ($flag) {
            $productId = $request->productIdHidden;
            $quantity = $request->qty;
            $colorSize = $request->colorSize;
            $product = $sanpham->getProductById($productId);
            
            if($product != null){
                $oldCart = Session('Cart') ? Session::get('Cart') : null;
                $newCart = new Cart($oldCart);
                $newCart->addCart($product, $productId, $colorSize, $quantity);
                $request->session()->put('Cart', $newCart);
            }
            //dd(Session('Cart'));
            return redirect()->back()->with('status', 'Thêm sản phẩm thành công');
        } else {
            return redirect()->back()->with('error', 'Số lượng sản phẩm không đủ');
        }   
    }

    public function deleteItemCart(Request $request){
        $productId = $request->productIdHidden;
        $oldCart = Session('Cart') ? Session::get('Cart'): null;
        $newCart = new Cart($oldCart);
        $newCart->deleteItemCart($productId);
        if(Count( $newCart->products) > 0 ){
            $request->Session()->put('Cart', $newCart);
        }
        else{
            $request->Session()->forget('Cart');
        }

        return redirect()->route('site.cart.index')->with('status', 'Xóa sản phẩm thành công');
    }

    public function updateItemCart(Request $request){
        $sanpham = new ProductModel();
        $sanphamItem = $sanpham::find($request->productIdHidden);
        $flag = false;

        if(strpos($request->colorSize, "Trắng") !== false){
            $white = unserialize($sanphamItem->white);
            if ($white[$request->colorSize] - $request->qty > 0) {
                $flag = true;
            }
        }elseif (strpos($request->colorSize, "Đen") !== false) {
            $black = unserialize($sanphamItem->black);
            if ($black[$request->colorSize] - $request->qty > 0) {
                $flag = true;
            }
        }elseif (strpos($request->colorSize, "Xanh") !== false) {
            $blue = unserialize($sanphamItem->blue);
            if ($blue[$request->colorSize] - $request->qty > 0) {
                $flag = true;
            }
        }elseif (strpos($request->colorSize, "Vàng") !== false) {
            $yellow = unserialize($sanphamItem->yellow);
            if ($yellow[$request->colorSize] - $request->qty > 0) {
                $flag = true;
            }
        }

        if ($flag) {
            $productId = $request->productIdHidden;
            $quantity = $request->qty;
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->updateItemCart($productId, $quantity);
            $request->Session()->put('Cart', $newCart);
    
            return redirect()->route('site.cart.index')->with('status', 'Cập nhật sản phẩm thành công');
        } else {
            return redirect()->route('site.cart.index')->with('error', 'Số lượng sản phẩm không đủ');
        }
    }
}
