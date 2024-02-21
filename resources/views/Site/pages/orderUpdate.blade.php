@extends('Site.layouts.EmptyLayout')

@section('title')
    <title> Đơn hàng chi tiết </title>
@endsection

@section('content')
    <!-- Chen trang cap nhat hoa don -->
    <div class="orderUpdate">
        <div class="orderUpdateFrame">
            <!-- Trang cap nhat hoa don -->
            <div class="head">
                <h2> Hóa đơn chi tiết </h2>
            </div>
            <div class="body">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col"> Thông tin khách hàng </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-row" data-href="">
                            <td class="w-25">
                                Thông tin người đặt hàng
                            </td>
                            <td>
                                {{ $nguoidungItem->user_name }}
                            </td>
                        </tr>
                        <tr class="table-row" data-href="">
                            <td class="w-25">
                                Số điện thoại người đặt hàng
                            </td>
                            <td>
                                {{ $nguoidungItem->phone }}
                            </td>
                        </tr>
                        <tr class="table-row" data-href="">
                            <td class="w-25">
                                Thông tin người nhận hàng
                            </td>
                            <td>
                                {{ $hoadonItem->recipien_name }}
                            </td>
                        </tr>
                        <tr class="table-row" data-href="">
                            <td class="w-25">
                                Số điện thoại
                            </td>
                            <td>
                                {{ $hoadonItem->phone }}
                            </td>
                        </tr>
                        <tr class="table-row" data-href="">
                            <td class="w-25">
                                Địa chỉ giao hàng
                            </td>
                            <td>
                                {{ $hoadonItem->address }}
                            </td>
                        </tr>
                        <tr class="table-row" data-href="">
                            <td class="w-25">
                                Ghi chú
                            </td>
                            <td>
                                {{ $hoadonItem->note }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col"> Danh sách sản phẩm </th>
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
                        @foreach ($hoadonchitietList as $key => $value)
                            <tr class="table-row" data-href="">
                                <td class="w-25">
                                    {{ $key+1 }}
                                </td>
                                <td>
                                    {{ $value->product_name }}
                                </td>
                                <td>
                                    {{ $value->colorSize }}
                                </td>
                                <td>
                                    {{ $value->quantity }}
                                </td>
                                <td>
                                    {{ number_format($value->close_price, 0,",",".") }} đ
                                </td>
                                <td>
                                    {{ number_format($value->close_price*$value->quantity, 0,",",".") }} đ
                                </td>
                            </tr>
                        @endforeach
                        <tr class="table-row" data-href="">
                            <td class="w-25" colspan="5">
                                Tổng tiền
                            </td>
                            <td>
                                {{ number_format($hoadonItem->total_price, 0,",",".") }} đ
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <form action="{{ route('site.order.update', $hoadonItem->id) }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label> Trạng thái đơn hàng </label>
                        <input class="form-control" type="text" name="status" value="{{ $hoadonItem->status }}" readonly>
                    </div>

                    <div class="form-group d-flex justify-content-between">
                        <a href="{{ route('site.order.index', $nguoidungItem->id) }}" class="btn btn-secondary">Quay lại</a>
                        @if ($hoadonItem->status == "Đang giao hàng")
                            <button type="submit" class="btn btn-primary">Đã nhận hàng</button>
                        @endif
                    </div>
                </form>
            </div> 
        </div>
    </div>
@endsection