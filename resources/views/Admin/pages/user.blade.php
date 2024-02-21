@extends('Admin.layouts.MasterLayout')

@section('title')
    <title> Người dùng </title>
@endsection

@section('content')
    <!-- Chen trang nguoi dung -->
    <div class="user">
        <div class="userFrame">
            <!-- Trang nguoi dung -->
            <div class="head">
                <h2> Người dùng </h2>
                <a href="{{ route('admin.user.createShow') }}" class="btn btn-primary btn-sm active" role="button" aria-pressed="true"> Thêm Người dùng </a>
            </div>
            <div class="body">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"> Id </th>
                            <th scope="col"> Số điện thoại </th>
                            <th scope="col"> Tên người dùng </th>
                            <th scope="col"> Giới tính </th>
                            <th scope="col"> Email </th>
                            <th scope="col"> Ngày sinh </th>
                            <th scope="col"> Địa chỉ </th>
                            <th scope="col"> Quyền </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nguoidungList as $key => $value)   
                            <tr class="table-row" data-href="{{ route('admin.user.updateShow', $value->id) }}">
                                <td>
                                    {{ $value->id }}
                                </td>
                                <td>
                                    {{ $value->phone }}
                                </td>
                                <td>
                                    {{ $value->user_name }}
                                </td>
                                <td>
                                    {{ $value->gender }}
                                </td>
                                <td>
                                    {{ $value->email }}
                                </td>
                                <td>
                                    {{ date("d-m-Y", strtotime($value->birthday)) }}
                                </td>
                                <td class="w-25">
                                    {{ $value->address.', '.$phuong->getWardName($value->phuong_id).', '.
                                    $huyen->getDistrictName($value->huyen_id).', '.$tinh->getProvinceName($value->tinh_id) }}
                                </td>
                                <td>
                                    @if ($value->role == 0)
                                        Admin
                                    @elseif ($value->role == 1)
                                        Khách hàng
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="page">
                @if (isset($nguoidungList) && count($nguoidungList) > 0)
                    {{ $nguoidungList->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection