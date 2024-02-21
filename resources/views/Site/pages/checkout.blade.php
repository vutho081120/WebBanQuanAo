@extends('Site.layouts.EmptyLayout')

@section('title')
    <title> Thanh Toán </title>
@endsection

@section('content')
    <!-- Thanh toan -->
    <div class="checkout d-flex justify-content-between">
        <!-- Chen trang thanh toan -->
        <div class="checkoutLeftFrame">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" colspan="2"> Danh sách sản phẩm </th>
                    </tr>
                    <tr>
                        <th scope="col"> STT </th>
                        <th scope="col"> Tên sản phẩm </th>
                        <th scope="col"> Màu sắc và Size </th>
                        <th scope="col"> Số lượng </th>
                        <th scope="col"> Giá tiền </th>
                        <th scope="col"> Thành tiền </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $stt = 1;
                    @endphp
                    @foreach (Session::get('Cart')->products as $key => $value)
                        <tr class="table-row" data-href="">
                            <td>
                               {{ $stt++ }}
                            </td>
                            <td class="w-25">
                               {{ $value['sanpham']['product_name'] }}
                            </td>
                            <td>
                                {{ $value['mausacSize'] }}
                            </td>
                            <td>
                                {{ $value['soluongmua'] }}
                            </td>
                            <td>
                                {{ number_format($value['gia'], 0,",",".") }} đ
                            </td>
                            <td>
                                {{ number_format($value['gia']*$value['soluongmua'], 0,",",".") }} đ
                            </td>
                        </tr>
                    @endforeach
                    <tr class="table-row" data-href="">
                        <td class="w-25" colspan="5">
                            Tổng tiền
                        </td>
                        <td>
                            {{ number_format(Session::get('Cart')->totalPrice, 0,",",".") }} đ
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="checkoutRightFrame">
            <div class="title">
                <h2> Thông tin đặt hàng </h2>	
            </div>
            
            <form action="{{ route('site.checkout.checkout') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-md-12">
                    <div class="form-group d-flex justify-content-between">
                        <label for="exampleFormControlSelect1"> Địa chỉ giao hàng </label>
                        <a class="btn btn-primary" href="{{ route('site.address.deleteSelect') }}" role="button"> Mặc định </a>
                        <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#addressModal" role="button"> Thay đổi </a>
                    </div>
                    <div class="form-group">
                        @if (Session::has("Address") != null)
                            @php $address = Session::get('Address')->address.', '.$phuong->getWardName(Session::get('Address')->phuong_id).', '.
                            $huyen->getDistrictName(Session::get('Address')->huyen_id).', '.$tinh->getProvinceName(Session::get('Address')->tinh_id) @endphp
                            <p>Tên người nhận: {{ Session::get('Address')->recipien_name }} </p>
                            <p>Địa chỉ: {{ $address }} </p>
                            <p> Số điện thoại: {{ Session::get('Address')->phone }} </p>
                            <input type="hidden" name="nameHidden" value="{{ Session::get('Address')->recipien_name }}">
                            <input type="hidden" name="addressHidden" value="{{ $address }}">
                            <input type="hidden" name="phoneHidden" value="{{ Session::get('Address')->phone }}">
                        @else
                            @php $address = Auth::user()->address.', '.$phuong->getWardName(Auth::user()->phuong_id).', '.
                            $huyen->getDistrictName(Auth::user()->huyen_id).', '.$tinh->getProvinceName(Auth::user()->tinh_id) @endphp
                            <p>Tên người nhận: {{ Auth::user()->user_name }} </p>
                            <p>Địa chỉ: {{ $address }} </p>
                            <p> Số điện thoại: {{ Auth::user()->phone }} </p>
                            <input type="hidden" name="nameHidden" value="{{ Auth::user()->user_name }}">
                            <input type="hidden" name="addressHidden" value="{{ $address }}">
                            <input type="hidden" name="phoneHidden" value="{{ Auth::user()->phone }}">
                        @endif
                    </div>
                </div>
    
                <div class="hinhthuc">
                    <p> Hình thức thanh toán: </p>
                    <input type="radio" name="payment" value="Tiền mặt" checked> Thanh toán bằng tiền mặt <br>
                    <input type="radio" name="payment" value="Thẻ ngân hàng"> Thanh toán bằng thẻ ngân hàng
                </div>

                <div class="form-group col-md-12">
                    <p> Ghi chú: </p>
                    <input type="text" name="note" class="form-control">
                </div>
    
                <div class="button">

                    <div class="btnDatHang">
                        <button type="submit"> Đặt hàng </button>
                    </div> 
    
                    <div class="back">
                        <div class="btnBack">
                            <a href="{{ route('site.home.index') }}"> Tiếp tục mua hàng </a>
                        </div>
    
                        <div class="btnGioHang">
                            <a href="{{ route('site.cart.index') }}"> Quay lại giỏ hàng </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="addressHidden">
            @include("Site.components.addressSelect")
        </div>
    </div>
@endsection



