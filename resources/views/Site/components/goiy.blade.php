<!-- Goi y -->

<div class="container" data-aos="fade-up">
    <!-- start  slides -->
    <div class="row">
        <!-- ======= Property Grid ======= -->
        <div class="col-sm-9 col-md-9 col-lg-9">
            <div class="container">
                <section class="property-grid grid">
                    <div class="row">
                        <div class="property-content-top col-md-12 ">
                            <div class="title row">
                                <span> Gợi ý hôm nay </span>
                            </div>
                        </div>
                        
                        <div class="property-content-body col-md-12 " id="demo">
                            <div class="row">
                                <div class="listItem">
                                    @if (isset($sanPhamGoiY) && count($sanPhamGoiY) > 0)
                                        @foreach ($sanPhamGoiY as $key => $value )
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
                                    @endif
                            </div>
                        </div>  
                    </div>
                </section>
            </div>

        </div>
        <!-- End Property Grid Single-->

        <!-- rcm Property Search Section -->
        <div class="col-sm-3  col-md-3 col-lg-3">
            <div class="box">
                <div class="row">
                    <div class="product-list">
                        <div class="col-md-12">
                            <div class="event card" style="width: 16rem;">
                                <div class="card-body">
                                    <span> Sự kiện </span>
                                </div>
                            </div>
                        </div>
                        @if (isset($sanPhamGoiY) && count($sanPhamGoiY) > 0)
                            @foreach ($sanPhamGoiY as $key => $value )
                                <a href="{{ route('site.product.index', $value->id) }}">
                                    <div class="col-md-12">
                                        <div class="card d-flex flex-row" style="width: 16rem;margin: 10px;">
                                            <div class='eventProductImg w-25'>
                                                <img src="{{ asset('images/Site/product/'.$value->product_img.'') }}" class="img-thumbnail">
                                            </div>
                                            <div class='productContent w-75' style="padding: 6px;">
                                                <div class='content'>
                                                    <span> {{ $value->product_name }} </span>
                                                </div>
                                                @if( $value->sale_price !=0 )
                                                    <div class='itemTop'>
                                                        <span class='price' style="text-decoration: line-through;"> {{ number_format($value->price, 0,",",".") }} đ</span>
                                                    </div>
                                                    <div class='sale'>
                                                        <span class='priceSale' style="color: red;"> {{ number_format($value->sale_price, 0,",",".") }} đ</span>
                                                    </div>
                                                @else
                                                    <div class='itemTop'>
                                                        <span class='priceNotSale'> {{ number_format($value->price, 0,",",".") }} đ</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--rcm  End Property Search Section -->
    </div>

</div>