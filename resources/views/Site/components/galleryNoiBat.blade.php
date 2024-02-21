<!-- slide san pham noi bat -->

<div class="titleNoiBat">
    <p> Sản phẩm nổi bật </p>
</div>

<div class="slider" id="galleryNoiBat">
    <ul>
        @foreach ($sanPhamNoiBat as $value)
            <li>
                <a href='{{route('site.product.index', $value->id)}}'>
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
            </li>
        @endforeach
    </ul>
    <div class="button">
        <i class="fas fa-angle-right fa-2x" id="nextNB"></i>
        <i class="fas fa-angle-left fa-2x" id="backNB"></i>
        <ul class="dots">
            
        </ul>
    </div>
</div>
<!-- bi loi vi khi goi the dom ko duoc init phia sau neu dung dang query phai khai bao script phia duoi the dom hoac dat trang thai script async domload xong mới dùng được hàm-->
<script type="text/javascript" src="{{ asset('js/Site/galleryHorizontal.js') }}"></script>
<script>
    var optionNoiBat = {ele:'#galleryNoiBat', limit: 4, btnNext: '#nextNB', btnBack: '#backNB', widthNext: -1200, widthLech: 49};

    var galleryNoiBat = new slide(optionNoiBat);
</script>
