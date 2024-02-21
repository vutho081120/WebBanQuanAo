@extends('Site.layouts.EmptyLayout')

@section('title')
    <title> Địa Chỉ </title>
@endsection

@section('content')
    <!-- Dia chi -->
    <div class="address">
        <!-- Chen trang dia chi -->
        <div class="addressFrame">
            <!-- Trang dia chi -->
            <div class="head d-flex justify-content-between">
                <h2 class="mr-auto p-2"> Địa chỉ </h2>
                <div>
                    <a href="{{ route('site.home.index') }}" class="btn btn-secondary btn-sm active" role="button" aria-pressed="true"> Quay lại trang chủ </a>
                    <a href="{{ route('site.address.createShow') }}" class="btn btn-primary btn-sm active" role="button" aria-pressed="true"> Thêm địa chỉ </a>
                </div>
            </div>
            <div class="body">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"> Người nhận </th>
                            <th scope="col"> Số điện thoại </th>
                            <th scope="col"> Địa chỉ </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($diachiList) && count($diachiList) > 0)
                            @foreach ($diachiList as $key => $value)
                                <tr class="table-row" data-href="{{ route('site.address.updateShow', $value->id) }}">
                                    <td class="w-25">
                                        {{ $value->recipien_name }}
                                    </td>
                                    <td>
                                        {{ $value->phone }}
                                    </td>
                                    <td>
                                        {{ $value->address.', '.$phuong->getWardName($value->phuong_id).', '.
                                        $huyen->getDistrictName($value->huyen_id).', '.$tinh->getProvinceName($value->tinh_id) }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7"> Chưa có địa chỉ phụ nào </td>
                            </tr>    
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="page">
                @if (isset($diachiList) && count($diachiList) > 0)
                    {{ $diachiList->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection