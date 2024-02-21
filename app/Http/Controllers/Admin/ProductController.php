<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\BillModel;
use App\Models\BillDetailModel;

class ProductController extends Controller
{
    private $htmlSelect;
    private $parentLink;

    public function __construct() {
        $this->htmlSelect = '';
        $this->parentLink = '';
    }

    public function index()
    {
        $sanpham = new ProductModel();

        $sanphamList = $sanpham::join('danhmuc', 'danhmuc.id', 'sanpham.danhmuc_id')
                        ->select('sanpham.*', 'danhmuc.category_name')
                        ->paginate(5);

        return view('Admin.pages.product', compact('sanphamList'));
    }

    public function categoryRecusive($parentId ,$id = 0, $text = '') {
        $danhmuc = new CategoryModel();
        $danhmucList = $danhmuc->getCategoryAll();
        foreach ($danhmucList as $value) {
            if ($value->parent_id == $id){
                if(!empty($parentId) && $parentId == $value->id ) {
                    $this->htmlSelect .= "<option selected value='".$value->id."'>" . $text . $value->category_name . "</option>";
                }else {
                    $this->htmlSelect .= "<option value='".$value->id."'>" . $text . $value->category_name . "</option>";
                }
                
                $this->categoryRecusive($parentId ,$value->id, $text . '---');
            }
        }

        return $this->htmlSelect;
    }

    public function createShow()
    {
        $htmlOption = $this->categoryRecusive("");

        return view('Admin.pages.productCreate', compact('htmlOption'));
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(),[
            'product_image'=>'required|mimes:jpeg,jpg,png,gif',
            'product_id'=>'required|min:3',
            'product_name'=>'required|min:3',
            'price' =>'required|numeric|min:3',
            'sale_price' =>'required|numeric',
            'material' =>'required|min:3',
            'brand' =>'required|min:3',
            'suppiler' =>'required|min:3',
            'made_in' =>'required|min:3',
            'description' =>'required|min:3',
        ],[
            'product_image.required'=>'Bạn chưa chọn ảnh',
            'product_image.mimes'=>'Bạn chọn không phải file ảnh',
            'product_id.required'=>'Bạn chưa nhập mã sản phẩm',
            'product_id.min'=>'Mã sản phẩm phải có ít nhất 3 kí tự',
            'product_name.required'=>'Bạn chưa nhập tên sản phẩm',
            'product_name.min'=>'Tên danh mục phải có ít nhất 3 kí tự',
            'price.required'=>'Bạn chưa nhập giá sản phẩm',
            'price.numeric'=>'Bạn nhập sai định dạng giá sản phẩm',
            'price.min'=>'Giá sản phẩm phải có ít nhất 3 kí tự',
            'sale_price.required'=>'Bạn chưa nhập giá khuyến mãi',
            'sale_price.numeric'=>'Bạn nhập sai định dạng giá khuyến mãi',
            'material.required'=>'Bạn chưa nhập chất liệu sản phẩm',
            'material.min'=>'Chất liệu phải có ít nhất 3 kí tự',
            'brand.required'=>'Bạn chưa nhập thương hiệu sản phẩm',
            'brand.min'=>'Thương hiệu phải có ít nhất 3 kí tự',
            'suppiler.required'=>'Bạn chưa nhập nhà cung cấp sản phẩm',
            'suppiler.min'=>'Nhà cung cấp phải có ít nhất 3 kí tự',
            'made_in.required'=>'Bạn chưa nhập nơi sản xuất sản phẩm',
            'made_in.min'=>'Nơi sản xuất phải có ít nhất 3 kí tự',
            'description.required'=>'Bạn chưa nhập thương hiệu sản phẩm',
            'description.min'=>'Thương hiệu phải có ít nhất 3 kí tự',
        ]);
    
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $product = ProductModel::where('product_id', $request->product_id)->first();
        if(!$product){
            $style = '';
            $season = '';
            foreach ($request->styles as $styleItem) {
                $style .= $styleItem.';';
            }
            foreach ($request->seasons as $seasonItem) {
                $season .= $seasonItem.';';
            }

            $white = array("Trắng S" => $request->white_s,
                        "Trắng M" => $request->white_m, 
                        "Trắng L" => $request->white_l,
                        "Trắng XL" => $request->white_xl,
                        "Trắng XXL" => $request->white_xxl);
            
            $black = array("Đen S" => $request->black_s,
                        "Đen M" => $request->black_m, 
                        "Đen L" => $request->black_l,
                        "Đen XL" => $request->black_xl,
                        "Đen XXL" => $request->black_xxl);

            $blue = array("Xanh S" => $request->blue_s,
                        "Xanh M" => $request->blue_m, 
                        "Xanh L" => $request->blue_l,
                        "Xanh XL" => $request->blue_xl,
                        "Xanh XXL" => $request->blue_xxl);

            $yellow = array("Vàng S" => $request->yellow_s,
                        "Vàng M" => $request->yellow_m, 
                        "Vàng L" => $request->yellow_l,
                        "Vàng XL" => $request->yellow_xl,
                        "Vàng XXL" => $request->yellow_xxl);

            $newProduct = new ProductModel();
            $imgName = $request->product_image->getClientOriginalName();
            $request->product_image->move('images/Site/product', $imgName);
            $newProduct->product_img = $imgName;
            $newProduct->product_id = $request->product_id;
            $newProduct->product_name = $request->product_name;
            $newProduct->white = serialize($white);
            $newProduct->black = serialize($black);
            $newProduct->blue = serialize($blue);
            $newProduct->yellow = serialize($yellow);
            $newProduct->style = rtrim($style, ';');
            $newProduct->season = rtrim($season, ';');
            $newProduct->amount = $request->white_s+$request->white_m+$request->white_l+$request->white_xl+$request->white_xxl
                                +$request->black_s+$request->black_m+$request->black_l+$request->black_xl+$request->black_xxl
                                +$request->blue_s+$request->blue_m+$request->blue_l+$request->blue_xl+$request->blue_xxl
                                +$request->yellow_s+$request->yellow_m+$request->yellow_l+$request->yellow_xl+$request->yellow_xxl;
            $newProduct->price = $request->price;
            $newProduct->sale_price = $request->sale_price;
            $newProduct->material = $request->material;
            $newProduct->brand = $request->brand;
            $newProduct->suppiler = $request->suppiler;
            $newProduct->made_in = $request->made_in;
            $newProduct->description = $request->description;
            $newProduct->danhmuc_id = $request->category;
            $newProduct->save();
            return redirect()->back()->with('status', 'Bạn đã tạo sản phẩm thành công');
        }
        else {
            return redirect()->back()->with('error', 'Sản phẩm đã có trong danh sách');
        }
    }

    public function updateShow($id)
    {
        $sanpham = new ProductModel();
        $sanphamItem = $sanpham::find($id);
        $danhmucId = explode(";", $sanphamItem->danhmuc_id)[0];
        $danhmuc = new CategoryModel();
        $htmlOption = $this->categoryRecusive($danhmucId);

        return view('Admin.pages.productUpdate', compact('htmlOption', 'sanphamItem'));
    }

    public function update(Request $request, $id)
    {
        $sanpham = new ProductModel();
        $sanphamItem = $sanpham::find($id);

        $validator = Validator::make($request->all(),[
            'product_image'=>'mimes:jpeg,jpg,png,gif',
            'product_id'=>'required|min:3',
            'product_name'=>'required|min:3',
            'price' =>'required|numeric|min:3',
            'sale_price' =>'required|numeric',
            'material' =>'required|min:3',
            'brand' =>'required|min:3',
            'suppiler' =>'required|min:3',
            'made_in' =>'required|min:3',
            'description' =>'required|min:3',
        ],[
            'product_image.mimes'=>'Bạn chọn không phải file ảnh',
            'product_id.required'=>'Bạn chưa nhập mã sản phẩm',
            'product_id.min'=>'Mã sản phẩm phải có ít nhất 3 kí tự',
            'product_name.required'=>'Bạn chưa nhập tên sản phẩm',
            'product_name.min'=>'Tên danh mục phải có ít nhất 3 kí tự',
            'price.required'=>'Bạn chưa nhập giá sản phẩm',
            'price.numeric'=>'Bạn nhập sai định dạng giá sản phẩm',
            'price.min'=>'Giá sản phẩm phải có ít nhất 3 kí tự',
            'sale_price.required'=>'Bạn chưa nhập giá khuyến mãi',
            'sale_price.numeric'=>'Bạn nhập sai định dạng giá khuyến mãi',
            'material.required'=>'Bạn chưa nhập chất liệu sản phẩm',
            'material.min'=>'Chất liệu phải có ít nhất 3 kí tự',
            'brand.required'=>'Bạn chưa nhập thương hiệu sản phẩm',
            'brand.min'=>'Thương hiệu phải có ít nhất 3 kí tự',
            'suppiler.required'=>'Bạn chưa nhập nhà cung cấp sản phẩm',
            'suppiler.min'=>'Nhà cung cấp phải có ít nhất 3 kí tự',
            'made_in.required'=>'Bạn chưa nhập nơi sản xuất sản phẩm',
            'made_in.min'=>'Nơi sản xuất phải có ít nhất 3 kí tự',
            'description.required'=>'Bạn chưa nhập thương hiệu sản phẩm',
            'description.min'=>'Thương hiệu phải có ít nhất 3 kí tự',
        ]);
    
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $style = '';
        $season = '';
        foreach ($request->styles as $styleItem) {
            $style .= $styleItem.';';
        }
        foreach ($request->seasons as $seasonItem) {
            $season .= $seasonItem.';';
        }

        $white = array("Trắng S" => $request->white_s,
                    "Trắng M" => $request->white_m, 
                    "Trắng L" => $request->white_l,
                    "Trắng XL" => $request->white_xl,
                    "Trắng XXL" => $request->white_xxl);
        
        $black = array("Đen S" => $request->black_s,
                    "Đen M" => $request->black_m, 
                    "Đen L" => $request->black_l,
                    "Đen XL" => $request->black_xl,
                    "Đen XXL" => $request->black_xxl);

        $blue = array("Xanh S" => $request->blue_s,
                    "Xanh M" => $request->blue_m, 
                    "Xanh L" => $request->blue_l,
                    "Xanh XL" => $request->blue_xl,
                    "Xanh XXL" => $request->blue_xxl);

        $yellow = array("Vàng S" => $request->yellow_s,
                    "Vàng M" => $request->yellow_m, 
                    "Vàng L" => $request->yellow_l,
                    "Vàng XL" => $request->yellow_xl,
                    "Vàng XXL" => $request->yellow_xxl);

        if(isset($request->product_image)) {
            $imgName = $request->product_image->getClientOriginalName();
            $request->product_image->move('images/Site/product', $imgName);
            $sanphamItem->product_img = $imgName;
        }
        
        $sanphamItem->product_id = $request->product_id;
        $sanphamItem->product_name = $request->product_name;
        $sanphamItem->white = serialize($white);
        $sanphamItem->black = serialize($black);
        $sanphamItem->blue = serialize($blue);
        $sanphamItem->yellow = serialize($yellow);
        $sanphamItem->style = rtrim($style, ';');
        $sanphamItem->season = rtrim($season, ';');
        $sanphamItem->amount = $request->white_s+$request->white_m+$request->white_l+$request->white_xl+$request->white_xxl
                            +$request->black_s+$request->black_m+$request->black_l+$request->black_xl+$request->black_xxl
                            +$request->blue_s+$request->blue_m+$request->blue_l+$request->blue_xl+$request->blue_xxl
                            +$request->yellow_s+$request->yellow_m+$request->yellow_l+$request->yellow_xl+$request->yellow_xxl;
        $sanphamItem->price = $request->price;
        $sanphamItem->sale_price = $request->sale_price;
        $sanphamItem->material = $request->material;
        $sanphamItem->brand = $request->brand;
        $sanphamItem->suppiler = $request->suppiler;
        $sanphamItem->made_in = $request->made_in;
        $sanphamItem->description = $request->description;
        $sanphamItem->danhmuc_id = $request->category;
        $sanphamItem->save();
        
        return redirect('admin/san-pham/cap-nhat/'.$sanphamItem->id)->with('status', 'Cập nhật thành công');
    }

    public function delete($id)
    {
        $sanpham = new ProductModel();
        $sanphamItem = $sanpham::find($id);

        $hoadonchitiet = new BillDetailModel();
        $hoadonchitietCheck = $hoadonchitiet::where('sanpham_id', $id)->get();

        if (isset($hoadonchitietCheck) && count($hoadonchitietCheck) > 0) {
            return redirect('admin/san-pham/cap-nhat/'.$id)->with('error', 'Bạn chưa xóa hóa đơn chứa sản phẩm');
        }else {
            $sanphamItem->delete();
            return redirect('admin/san-pham')->with('status', 'Xóa thành công');
        }
       
    }
}
