<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ProvinceModel;

class HomeController extends Controller
{
    public function index()
    {
        $danhmuc = new CategoryModel();
        $sanpham = new ProductModel();
        $tinh = new ProvinceModel();
        
        $categories = $danhmuc::with('children')->where('parent_id', 0)->get();
        $sanPhamNoiBat = $sanpham::orderBy('sold', 'DESC')->limit(10)->get();
        $sanPhamGoiY = $sanpham::limit(9)->get();
        $tinhList = $tinh::all();

        return view( 'Site.pages.home', compact('categories', 'sanPhamNoiBat', 'tinhList', 'sanPhamGoiY'));
    }
}