<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ProvinceModel;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $danhmuc = new CategoryModel();
        $sanpham = new ProductModel();
        $tinh = new ProvinceModel();

        $tinhList = $tinh::all();
        $categories = $danhmuc->getCategory();

        if ($request->key == "") {
            $key = "";
            return view( 'Site.pages.search', compact('categories', 'key','tinhList') );
        }else {
            $key = $request->key;

            if (isset($_GET['sort_by'])) {
                $sort_by = $_GET['sort_by'];
                if ($sort_by == 'giam_dan') {
                    $sanPhamTimKiem = $sanpham::where('product_name', 'like', '%'.$key.'%')->orderBy('price', 'DESC')->paginate(8)->appends(request()->query());
                }elseif ($sort_by == 'tang_dan') {
                    $sanPhamTimKiem = $sanpham::where('product_name', 'like', '%'.$key.'%')->orderBy('price', 'ASC')->paginate(8)->appends(request()->query());
                }
            }else {
                $sanPhamTimKiem = $sanpham::where('product_name', 'like', '%'.$key.'%')->orderBy('id', 'ASC')->paginate(8);
            }

            return view( 'Site.pages.search', compact('categories', 'key','sanPhamTimKiem', 'tinhList') );
        }
    }
}