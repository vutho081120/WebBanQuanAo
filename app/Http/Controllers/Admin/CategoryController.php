<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\BillModel;
use App\Models\BillDetailModel;

class CategoryController extends Controller
{
    private $htmlSelect;

    public function __construct() {
        $this->htmlSelect = '';
    }

    public function index()
    {
        $danhmuc = new CategoryModel();
        $danhmucList = $danhmuc->latest()->paginate(10);

        return view('Admin.pages.category', compact('danhmucList'));
    }

    public function createShow()
    {
        $htmlOption = $this->categoryRecusive("");
        return view('Admin.pages.categoryCreate', compact('htmlOption'));
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

    public function create(Request $request) {
        $validator = Validator::make($request->all(),[
            'category_name'=>'required|min:3',
        ],[
            'category_name.required'=>'Bạn chưa nhập tên danh mục',
            'category_name.min'=>'Tên danh mục phải có ít nhất 3 kí tự',
        ]);
    
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category = CategoryModel::where('category_name', $request->category_name)->first();
        if(!$category){
            $newCategory = new CategoryModel();
            $newCategory->category_name = $request->category_name;
            $newCategory->parent_id = $request->parent_id;
            $newCategory->slug = Str::slug($request->category_name);
            $newCategory->save();
            return redirect()->back()->with('status', 'Bạn đã tạo danh mục thành công');
        }
        else {
            return redirect()->back();
        }
    }

    public function updateShow($id)
    {
        $danhmuc = new CategoryModel();
        $danhmucItem = $danhmuc::find($id);
        $htmlOption = $this->categoryRecusive($danhmucItem->parent_id);
        
        return view('Admin.pages.categoryUpdate', compact('htmlOption', 'danhmucItem'));
    }

    public function update(Request $request, $id)
    {
        $danhmuc = new CategoryModel();
        $danhmucItem = $danhmuc::find($id);

        $validator = Validator::make($request->all(),[
            'category_name'=>'required|min:3',
        ],[
            'category_name.required'=>'Bạn chưa nhập tên danh mục',
            'category_name.min'=>'Tên danh mục phải có ít nhất 3 kí tự',
        ]);
    
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $danhmucItem->category_name = $request->category_name;
        $danhmucItem->parent_id = $request->parent_id;
        $danhmucItem->save();
        
        return redirect('admin/danh-muc/cap-nhat/'.$id)->with('status', 'Cập nhật thành công');
    }

    public function delete($id)
    {
        $danhmuc = new CategoryModel();
        $danhmucItem = $danhmuc::find($id);
        
        $sanpham = new ProductModel();
        $sanphamCheck = $sanpham::where('danhmuc_id', $id)->get();
        $danhmucCheck = $danhmuc::where('parent_id', $id)->get();

        if (isset($danhmucCheck) && count($danhmucCheck) > 0) {
            return redirect('admin/danh-muc/cap-nhat/'.$id)->with('error', 'Bạn chưa xóa danh mục con chứa danh mục');
        }elseif (isset($sanphamCheck) && count($sanphamCheck) > 0) {
            return redirect('admin/danh-muc/cap-nhat/'.$id)->with('error', 'Bạn chưa xóa sản phẩm chứa danh mục');
        }else {
            $danhmucItem->delete();
            return redirect('admin/danh-muc')->with('status', 'Xóa thành công');
        }
    }
}
