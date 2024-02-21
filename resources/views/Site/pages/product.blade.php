@extends('Site.layouts.MasterLayout')

@section('title')
    <title>Chi tiết sản phẩm</title>
@endsection

@section('content')
    <!-- Product -->
    <div class="product">
        <!-- Chen product -->
        <div class="productFrame">
            <div class="container" data-aos="fade-up">
                <!-- ======= Property Grid ======= -->
                <section class="property-grid grid">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="product-img d-flex justify-content-center">
                                    <img class="img-thumbnail" src="{{ asset('images/Site/product/'.$sanPhamChiTiet->product_img.'') }}" alt="">
                                </div>
                            </div>
    
                            <div class="product-detail col-lg-6 ">
                                <h3>{{ $sanPhamChiTiet->product_name }}</h3>
                                <p> <b>Mã sản phẩm: </b> {{ $sanPhamChiTiet->product_id }}</p>

                                @if( $sanPhamChiTiet->sale_price !=0 )
                                    <div class='itemTop'>
                                        <b>Giá: </b> <span class='price'> {{ number_format($sanPhamChiTiet->price, 0,",",".") }} đ</span>
                                        <span class='priceSale' style="color: red;"> {{ number_format($sanPhamChiTiet->sale_price, 0,",",".") }} đ</span>
                                    </div>
                                @else
                                    <div class='itemTop'>
                                        <span class='priceNotSale'> <b>Giá: </b> {{ number_format($sanPhamChiTiet->price, 0,",",".") }} đ</span>
                                    </div>
                                @endif

                                <br>
                                <form action="{{ route('site.cart.addCart') }}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <b>Màu sắc Size: </b> <select name="colorSize" id="" style="padding: 6px;">
                                                    @php
                                                        $white = unserialize($sanPhamChiTiet->white);
                                                        $black = unserialize($sanPhamChiTiet->black);
                                                        $blue = unserialize($sanPhamChiTiet->blue);
                                                        $yellow = unserialize($sanPhamChiTiet->yellow);
                                                    @endphp
                                                    @foreach ($white as $key => $value)
                                                        @if ($value > 0)
                                                            <option value="{{ $key }}" style="text-transform: uppercase;"> {{ $key }} </option>
                                                        @endif
                                                    @endforeach
                                                    @foreach ($black as $key => $value)
                                                        @if ($value > 0)
                                                            <option value="{{ $key }}" style="text-transform: uppercase;"> {{ $key }} </option>
                                                        @endif
                                                    @endforeach
                                                    @foreach ($blue as $key => $value)
                                                        @if ($value > 0)
                                                            <option value="{{ $key }}" style="text-transform: uppercase;"> {{ $key }} </option>
                                                        @endif
                                                    @endforeach
                                                    @foreach ($yellow as $key => $value)
                                                        @if ($value > 0)
                                                            <option value="{{ $key }}" style="text-transform: uppercase;"> {{ $key }} </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                    <br><br>
                                    <b>Số lượng: </b> <input type="number" name="qty" min="1" value="1">
                                    <input type="hidden" name="productIdHidden" value="{{ $sanPhamChiTiet->id }}">
                                    @if(Auth::check())
                                        <div class="btnThemVaoGioHang">
                                            <button type="submit"> Thêm vào giỏ hàng </button>
                                        </div>
                                    @else
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">
                                            <div class="btnThemVaoGioHang">
                                                <button type=""> Thêm vào giỏ hàng </button>
                                            </div>
                                        </a>
                                    @endif
                                </form>
                            </div>

                        </div>
                </section>

                <section class="property-grid-detail" style="margin-top: 20px; border: solid 1px;">
                    <div>
                        <b>THÔNG TIN CHI TIẾT SẢN PHẨM</b>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Thuộc tính</th>
                                <th>Chi tiết</th>
        
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Xuất xứ</td>
                                <td>{{ $sanPhamChiTiet->made_in }}</td>
        
                            </tr>
                            <tr>
                                <td>Thương hiệu</td>
                                <td>{{ $sanPhamChiTiet->brand }}</td>
        
                            </tr>
                            <tr>
                                <td>Nhà cung cấp</td>
                                <td>{{ $sanPhamChiTiet->suppiler }}</td>
                            </tr>
                            <tr>
                                <td>Chất liệu</td>
                                <td>{{ $sanPhamChiTiet->material }}</td>
                            </tr>
                            <tr>
                                <td>Mô tả</td>
                                <td>{{ $sanPhamChiTiet->description }}</td>
                            </tr>
                        </tbody>
                    </table>
                </section>
        
                <section class="property-grid-relation">
                    <div class="title">
                        <b> SẢN PHẨM LIÊN QUAN </b>
                    </div>
                    <div class="listItem">
                        @if (isset($sanPhamLienQuan) && count($sanPhamLienQuan) > 0)
                            @foreach ($sanPhamLienQuan as $key => $value )
                                <a href="{{ route('site.product.index', $value->id) }}">
                                    <div class='item'>
                                        <div class='productImg'>
                                            <img src="{{ asset('images/Site/product/'.$value->product_img.'') }}" alt="">
                                        </div>
                                        <div class='productContent'>
                                            @if( $value->sale_price !=0 )
                                                <div class='itemTop'>
                                                    <p class='codeTitle'> {{ $value->product_id }} </p>
                                                    <span class='price'> {{ number_format($value->price, 0,",",".") }} đ</span>
                                                </div>
                                                <div class='sale'>
                                                    <span class='priceSale' style="color: red;"> {{ number_format($value->sale_price, 0,",",".") }} đ</span>
                                                </div>
                                            @else
                                                <div class='itemTop'>
                                                    <p class='codeTitle'> {{ $value->product_id }} </p>
                                                    <span class='priceNotSale'> {{ number_format($value->price, 0,",",".") }} đ</span>
                                                </div>
                                            @endif
                                            <div class='content'>
                                                <span> {{ $value->product_name }} </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach  
                        @else
                            <div>
                                <h2 style="padding-left: 16px"> Chưa có sản phẩm </h2>
                            </div>
                        @endif   
                    </div>
                </section>
                <!-- End Property Grid Single-->
            </div>
        </div>
    </div>
@endsection
