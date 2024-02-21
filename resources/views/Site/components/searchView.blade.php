<!-- Tim kiem -->

<div class="categoryView">

    <div class="top">

        <div class="title">
            <h1>
                @if ($key != "")
                    Kết quả tìm kiếm "{{ $key }}"
                @endif
            </h1>
        </div>

        <div class="sapxep">
            <form>
                <select size="1" id="sort" name="sort">
                    <option value="{{Request::url()}}?sort_by=none">Sắp xếp</option>
                    <option value="{{Request::url()}}?sort_by=giam_dan">Giá: cao đến thấp</option>
                    <option value="{{Request::url()}}?sort_by=tang_dan">Giá: thấp đến cao</option>
                </select>
            </form>
        </div>
    </div>

    <div class="listItem">
        @if (isset($sanPhamTimKiem) && count($sanPhamTimKiem) > 0)
            @foreach ($sanPhamTimKiem as $key => $value )
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
                <h2 style="padding-left: 16px"> Không tìm thấy sản phẩm </h2>
            </div>
        @endif
    </div>

    <div class="page">
        @if (isset($sanPhamTimKiem) && count($sanPhamTimKiem) > 0)
            {{ $sanPhamTimKiem->appends(request()->all())->links() }}
        @endif
    </div>

</div>