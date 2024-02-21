<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ProvinceModel;

class ProductController extends Controller
{
    public function index($id)
    {
        $danhmuc = new CategoryModel();
        $sanpham = new ProductModel();
        $tinh = new ProvinceModel();

        $categories = $danhmuc->getCategory();
        $sanPhamChiTiet = $sanpham->getProductById( $id );
        $sanPhamLienQuan = $sanpham->getProductByCategoryId($sanPhamChiTiet->danhmuc_id, $id);
        $tinhList = $tinh::all();

        return view( 'Site.pages.product', compact('categories', 'sanPhamChiTiet', 'tinhList', 'sanPhamLienQuan') );
    }
}
