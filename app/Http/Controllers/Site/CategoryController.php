<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ProvinceModel;

class CategoryController extends Controller
{
    private $danhmucIdArray;

    public function __construct() {
        $this->danhmucIdArray = [];
    }

    public function getChildIdArray($id) {
        $danhmuc = new CategoryModel();
        $danhmucList = $danhmuc->getCategoryAll();
        foreach ($danhmucList as $value) {
            if ($value->parent_id == $id){
                $this->danhmucIdArray[] = $value->id;
                $this->getChildIdArray($value->id);
            }
        }
  
        return $this->danhmucIdArray;
    }
 
    public function index($slug)
    {
        $danhmuc = new CategoryModel();
        $sanpham = new ProductModel();
        $tinh = new ProvinceModel();

        $tinhList = $tinh::all();
        $categories = $danhmuc->getCategory();
        $loaiSanPham = $danhmuc->getCategoryType( $slug );
        $danhmucIdArray = $this->getChildIdArray($loaiSanPham->id);
        $danhmucIdArray[] = $loaiSanPham->id;

        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'giam_dan') {
                $sanPhamTheoLoai = $sanpham::whereIn('danhmuc_id', $danhmucIdArray)->orderBy('price', 'DESC')->paginate(8)->appends(request()->query());
            }elseif ($sort_by == 'tang_dan') {
                $sanPhamTheoLoai = $sanpham::whereIn('danhmuc_id', $danhmucIdArray)->orderBy('price', 'ASC')->paginate(8)->appends(request()->query());
            }
        }else {
            $sanPhamTheoLoai = $sanpham::whereIn('danhmuc_id', $danhmucIdArray)->orderBy('id', 'ASC')->paginate(8);
        }

        return view( 'Site.pages.category', compact('categories', 'loaiSanPham', 'sanPhamTheoLoai', 'tinhList') );
    }
}
