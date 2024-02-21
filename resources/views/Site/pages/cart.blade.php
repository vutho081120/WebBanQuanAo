@extends('Site.layouts.MasterLayout')

@section('title')
    <title> Giỏ Hàng </title>
@endsection

@section('content')
    <!-- Gio hang -->
    <div class="cart">
        <!-- Chen trang gio hang -->
        <div class="cartFrame">
            <div class="title">
                <span> Giỏ Hàng </span>
            </div>
            
            @if (Session::has("Cart") != null)
                <div class="content">
                    <table class="tableData">
                        <tr>
                            <th> STT </th>
                            <th> Tên sản phẩm </th>
                            <th> Màu sắc và Size </th>
                            <th> Đơn giá </th>
                            <th> Số lượng </th>
                            <th > Thành tiền </th>
                            <th> Xóa </th>
                        </tr>
                    
                        @php $stt = 1 @endphp
                        @foreach(Session::get('Cart')->products as $item)
                            <tr>
                                <td class='cotSTT'> {{ $stt++ }} </td>
                                <td class='cotTenSanPham'> {{ $item['sanpham']['product_name'] }} </td>
                                <td class='cotMausacSize'> {{ $item['mausacSize'] }} </td>
                                <td class='cotGia'> {{ number_format($item['gia'], 0,",",".") }} đ </td>
                                <td class='cotSoLuong'>
                                    <form action="{{ route('site.cart.updateItemCart') }}" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="colorSize" value="{{ $item['mausacSize'] }}">
                                        <input type="hidden" name="productIdHidden" value="{{ $item['sanpham']['id'] }}">
                                        <input type="number" name="qty" min="1" value="{{ $item['soluongmua'] }}" style="width:5em; padding-left: 6px;">
                                        <button type="submit" name="capnhat" value="capnhat"> <i class="far fa-save"></i> </button>
                                    </form> 
                                </td>
                                <td class='cotThanhTien'> {{ number_format($item['thanhtien'], 0,",",".") }} đ </td>
                                <td class= 'cotXoa'>
                                    <form action="{{ route('site.cart.deleteItemCart') }}" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="productIdHidden" value="{{ $item['sanpham']['id'] }}">
                                        <button type="submit" name="xoa" value="xoa"> <i class='fas fa-trash-alt'></i> </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5" class="tong">Tổng cộng</td>
                            <td class="cotTongTien"> {{ number_format(Session::get('Cart')->totalPrice, 0,",",".") }} đ </td>
                        </tr>    
                    </table>
                    
                    <div class="button">
    
                        <div class="btnBack">
                            <a href=" {{ route('site.home.index') }} "> Tiếp tục mua hàng </a>
                        </div>
                        
                        <div class="btnThanhToan">
                            <a href=" {{ route('site.checkout.index') }} "> Thanh Toán </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="content">
                    <h1> Chưa có sản phẩm trong giỏ hàng </h1>
                    <div class="button">
                        <div class="btnBack">
                            <a href=" {{ route('site.home.index') }} "> Tiếp tục mua hàng </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection