<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\ProductModel;
use App\Models\BillModel;

class HomeController extends Controller
{
    public function index()
    {
        $hoadon = new BillModel();

        $totalBills = $hoadon::where('status', "Đã nhận hàng")->count();
        $totalRevenue = $hoadon::where('status', "Đã nhận hàng")->sum('total_price');
        $todayBills = $hoadon::where('status', "Đã nhận hàng")->whereDate('created_at', Carbon::today())->count();
        $todayRevenue = $hoadon::where('status', "Đã nhận hàng")->whereDate('created_at', Carbon::today())->sum('total_price');

        return view('Admin.pages.home', compact('totalBills', 'totalRevenue', 'todayBills', 'todayRevenue'));
    }
}
