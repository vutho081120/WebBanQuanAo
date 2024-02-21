@extends('Admin.layouts.MasterLayout')

@section('title')
    <title> Hóa đơn chi tiết </title>
@endsection

@section('content')
    <!-- Chen trang cap nhat hoa don -->
    <div class="billUpdate">
        <div class="billUpdateFrame">
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
                                Địa chỉ giao hàng
                            </td>
                            <td>
                                {{ $hoadonItem->address }}
                            </td>
                        </tr>
                        <tr class="table-row" data-href="">
                            <td class="w-25">
                                Số điện thoại người nhận hàng
                            </td>
                            <td>
                                {{ $hoadonItem->phone }}
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
                            <td class="w-25" colspan="4">
                                Tổng tiền
                            </td>
                            <td>
                                {{ number_format($hoadonItem->total_price, 0,",",".") }} đ
                            </td>
                        </tr>
                    </tbody>
                </table>
                <form action="{{ route('admin.bill.update', $hoadonItem->id) }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label> Cập nhật trạng thái đơn hàng </label>
                        <select class="form-control" name="status" id="" aria-label="Default select example">
                            <option value="Chưa xử lý" @if ($hoadonItem->status == "Chưa xử lý") selected @endif> Chưa xử lý </option>
                            <option value="Xác nhận đơn hàng" @if ($hoadonItem->status == "Xác nhận đơn hàng") selected @endif> Xác nhận đơn hàng </option>
                            <option value="Đang giao hàng" @if ($hoadonItem->status == "Đang giao hàng") selected @endif> Đang giao hàng </option>
                            <option value="Giao hàng thành công" @if ($hoadonItem->status == "Giao hàng thành công") selected @endif> Giao hàng thành công </option>
                            <option value="Giao hàng thất bại" @if ($hoadonItem->status == "Giao hàng thất bại") selected @endif> Giao hàng thất bại </option>
                            <option value="Hủy đơn hàng" @if ($hoadonItem->status == "Hủy đơn hàng") selected @endif> Hủy đơn hàng </option>
                        </select>
                    </div>
    
                    <div class="form-group d-flex justify-content-between">
                        <a href="{{ route('admin.bill.index') }}" class="btn btn-secondary">Hủy</a>
                        <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger">Xóa hóa đơn</a>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div> 
        </div>
    </div>

    <div class="deleteHidden">
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn xóa hóa đơn này?</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p> Thao tác này sẽ xóa hóa đơn và hóa đơn chi tiết này của bạn. Thao tác này không thể khôi phục. </p> 
                </div>
                <div class="modal-footer">
                    <a href="{{ route('admin.bill.delete', $hoadonItem->id) }}" class="btn btn-danger">Xóa</a>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection