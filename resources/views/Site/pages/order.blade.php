@extends('Site.layouts.EmptyLayout')

@section('title')
    <title> Đơn Hàng </title>
@endsection

@section('content')
    <!-- Don hang -->
    <div class="order">
        <!-- Chen trang don hang -->
        <div class="orderFrame">
            <!-- Trang don hang -->
            <div class="head">
                <h2> Đơn hàng </h2>
                <a href="{{ route('site.home.index') }}" class="btn btn-primary btn-sm active" role="button" aria-pressed="true"> Quay lại trang chủ </a>
            </div>
            <div class="body">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"> Mã hóa đơn </th>
                            <th scope="col"> Người dùng </th>
                            <th scope="col"> Người nhận </th>
                            <th scope="col"> Tổng tiền </th>
                            <th scope="col"> Hình thức </th>
                            <th scope="col"> Trạng thái </th>
                            <th scope="col"> Ghi Chú </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($hoadonList) && count($hoadonList) > 0)
                            @foreach ($hoadonList as $key => $value)
                                <tr class="table-row" data-href="{{ route('site.order.updateShow', $value->id) }}">
                                    <td class="w-25">
                                        {{ $value->id }}
                                    </td>
                                    <td>
                                        {{ $value->user_name }}
                                    </td>
                                    <td>
                                        {{ $value->recipien_name }}
                                    </td>
                                    <td>
                                        {{ number_format($value->total_price) }} đ
                                    </td>
                                    <td>
                                        {{ $value->payment }}
                                    </td>
                                    <td>
                                        {{ $value->status }}
                                    </td>
                                    <td>
                                    {{ $value->note }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7"> Chưa có đơn hàng nào được đặt </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="page">
                @if (isset($hoadonList) && count($hoadonList) > 0)
                    {{ $hoadonList->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection