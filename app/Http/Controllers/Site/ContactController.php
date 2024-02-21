<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CategoryModel;
use App\Models\ProvinceModel;

class ContactController extends Controller
{
    public function index()
    {
        $danhmuc = new CategoryModel();
        $tinh = new ProvinceModel();

        $tinhList = $tinh::all();
        $categories = $danhmuc::with('children')->where('parent_id', 0)->get();

        return view( 'Site.pages.contact', compact('categories', 'tinhList'));
    }
}
