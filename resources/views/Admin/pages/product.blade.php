@extends('Admin.layouts.MasterLayout')

@section('title')
    <title> Sản phẩm </title>
@endsection

@section('content')
    <!-- Chen trang san pham -->
    <div class="product">
        <div class="productFrame">
            <!-- Trang san pham -->
            <div class="head">
                <h2> Sản phẩm </h2>
                <a href="{{ route('admin.product.createShow') }}" class="btn btn-primary btn-sm active" role="button" aria-pressed="true"> Thêm sản phẩm </a>
            </div>
            <div class="body">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"> Ảnh </th>
                            <th scope="col">Mã sản phẩm</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Số lượng tồn</th>
                            <th scope="col">Đã bán</th>
                            <th scope="col">Giá bán</th>
                            <th scope="col">Giá giảm</th>
                            <th scope="col">Chất liệu</th>
                            <th scope="col">Thương hiệu</th>
                            <th scope="col">Nhà cung cấp</th>
                            <th scope="col">Sản xuất tại</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Danh mục</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sanphamList as $key => $value)   
                            <tr class="table-row" data-href="{{ route('admin.product.updateShow', $value->id) }}">
                                <td>
                                    <img src="{{ asset('images/Site/product/'.$value->product_img.'') }}" class="img-fluid img-thumbnail" alt="">
                                </td>
                                <td>
                                    {{ $value->product_id }}
                                </td>
                                <td>
                                    {{ $value->product_name }}
                                </td>
                                <td>
                                    {{ $value->amount }}
                                </td>
                                <td>
                                    {{ $value->sold }}
                                </td>
                                <td>
                                    {{ number_format($value->price, 0,",",".") }} đ
                                </td>
                                <td>
                                    @if ($value->sale_price != 0)
                                        {{ number_format($value->sale_price, 0,",",".") }} đ
                                    @endif
                                </td>
                                <td>
                                    {{ $value->material }}
                                </td>
                                <td>
                                    {{ $value->brand }}
                                </td>
                                <td>
                                    {{ $value->suppiler }}
                                </td>
                                <td>
                                    {{ $value->made_in }}
                                </td>
                                <td class="w-25">
                                    {{ $value->description }}
                                </td>
                                <td>
                                   {{ $value->category_name }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="page">
                @if (isset($sanphamList) && count($sanphamList) > 0)
                    {{ $sanphamList->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection