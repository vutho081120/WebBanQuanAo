<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }
	
	public function logout() {
		Auth::logout();
		Session::forget('Cart');
		Session::forget('Address');
		return redirect('trang-chu')->with('status', 'Đăng xuất thành công');
	}
}
