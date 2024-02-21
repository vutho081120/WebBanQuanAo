@extends('Admin.layouts.MasterLayout')

@section('title')
    <title> Hóa đơn </title>
@endsection

@section('content')
    <!-- Chen trang hoa don -->
    <div class="bill">
        <div class="billFrame">
            <!-- Trang hoa don -->
            <div class="head">
                <h2> Hóa đơn </h2>
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
                                <tr class="table-row" data-href="{{ route('admin.bill.updateShow', $value->id) }}">
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
                                        {{ number_format($value->total_price, 0,",",".") }} đ
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
                                    <td colspan="7">Chưa có hóa đơn</td>
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