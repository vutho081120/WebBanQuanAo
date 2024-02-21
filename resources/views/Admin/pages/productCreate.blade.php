@extends('Admin.layouts.MasterLayout')

@section('title')
    <title> Thêm sản phẩm </title>
@endsection

@section('content')
    <!-- Chen trang them san pham -->
    <div class="productCreate">
        <div class="productCreateFrame">
            <!-- Trang them san pham -->
            <div class="head">
                <h1>  Thêm sản phẩm </h1>
            </div>
            <div class="body">
                <section class="h-100 bg-secondary">
                    <form action="{{ route('admin.product.create') }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="container h-100" style="max-width: 1240px">
                            <div class="row d-flex justify-content-center align-items-center ">
                                <div class="col-12 bg-white">
                                    <div class="row g-0">
                                        <div class="col-lg-6">
                                            <div class="row g-0">
                                                <div class="form-group col-lg-12">
                                                    <label class="col-md-12 control-label" for="product_image">Ảnh</label>
                                                    <div class="col-md-12"><input type="file" class="form-contol-file" name="product_image"></div>
                                                </div>
                                                @if ($errors->has('product_image'))
                                                    <span class="alert" style="color: red"> {{ $errors->first('product_image') }} </span>
                                                @endif

                                                <div class="form-group col-lg-12">
                                                    <label class="col-md-12 control-label" for="product_id">Mã sản phẩm</label>
                                                    <div class="col-md-12"><input class="form-control" id="product_id" name="product_id" placeholder="Nhập mã sản phẩm" title="" type="text"></div>
                                                </div>
                                                @if ($errors->has('product_id'))
                                                    <span class="alert" style="color: red"> {{ $errors->first('product_id') }} </span>
                                                @endif
    
                                                <div class="form-group col-lg-12">
                                                    <label class="col-md-12 control-label" for="product_name">Tên sản phẩm</label>
                                                    <div class="col-md-12"><input class="form-control" id="product_name" name="product_name" placeholder="Nhập tên sản phẩm" title="" type="text"></div>
                                                </div>
                                                @if ($errors->has('product_name'))
                                                    <span class="alert" style="color: red"> {{ $errors->first('product_name') }} </span>
                                                @endif

                                                <div class="form-group col-lg-12">
                                                    <label class="col-md-12 control-label" for="price">Giá sản phẩm</label>
                                                    <div class="col-md-12"><input class="form-control" id="price" name="price" placeholder="Nhập giá sản phẩm" title="" type="text"></div>
                                                </div>
                                                @if ($errors->has('price'))
                                                    <span class="alert" style="color: red"> {{ $errors->first('price') }} </span>
                                                @endif

                                                <div class="form-group col-lg-12">
                                                    <label class="col-md-12 control-label" for="sale_price">Giá khuyến mãi</label>
                                                    <div class="col-md-12"><input class="form-control" id="sale_price" name="sale_price" placeholder="Nhập giá khuyến mãi sản phẩm" value="0" type="text"></div>
                                                </div>
                                                @if ($errors->has('sale_price'))
                                                    <span class="alert" style="color: red"> {{ $errors->first('sale_price') }} </span>
                                                @endif

                                                <div class=" form-group col-lg-12">
                                                    <label class="col-md-6 control-label">Màu trắng</label>
                                                    <div class="form-group col-lg-12 d-flex">
                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>S:</span><input type="number" class="form-control" min="0" value="0" name="white_s" placeholder="S" style="width:70px">
                                                        </div>
                        
                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>M:</span><input type="number" class="form-control" min="0" value="0" name="white_m" placeholder="M" style="width:70px">
                                                        </div>
                                                        
                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>L:</span><input type="number" class="form-control" min="0" value="0" name="white_l" placeholder="L" style="width:70px">
                                                        </div>

                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>XL:</span><input type="number" class="form-control" min="0" value="0" name="white_xl" placeholder="XL" style="width:70px">
                                                        </div>

                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>XXL:</span><input type="number" class="form-control" min="0" value="0" name="white_xxl" placeholder="XXL" style="width:70px">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class=" form-group col-lg-12">
                                                    <label class="col-md-6 control-label">Màu đen</label>
                                                    <div class="form-group col-lg-12 d-flex">
                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>S:</span><input type="number" class="form-control" min="0" value="0" name="black_s" placeholder="S" style="width:70px">
                                                        </div>
                        
                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>M:</span><input type="number" class="form-control" min="0" value="0" name="black_m" placeholder="M" style="width:70px">
                                                        </div>
                                                        
                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>L:</span><input type="number" class="form-control" min="0" value="0" name="black_l" placeholder="L" style="width:70px">
                                                        </div>

                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>XL:</span><input type="number" class="form-control" min="0" value="0" name="black_xl" placeholder="XL" style="width:70px">
                                                        </div>

                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>XXL:</span><input type="number" class="form-control" min="0" value="0" name="black_xxl" placeholder="XXL" style="width:70px">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class=" form-group col-lg-12">
                                                    <label class="col-md-6 control-label">Màu xanh</label>
                                                    <div class="form-group col-lg-12 d-flex">
                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>S:</span><input type="number" class="form-control" min="0" value="0" name="blue_s" placeholder="S" style="width:70px">
                                                        </div>
                        
                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>M:</span><input type="number" class="form-control" min="0" value="0" name="blue_m" placeholder="M" style="width:70px">
                                                        </div>
                                                        
                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>L:</span><input type="number" class="form-control" min="0" value="0" name="blue_l" placeholder="L" style="width:70px">
                                                        </div>
    
                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>XL:</span><input type="number" class="form-control" min="0" value="0" name="blue_xl" placeholder="XL" style="width:70px">
                                                        </div>
    
                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>XXL:</span><input type="number" class="form-control" min="0" value="0" name="blue_xxl" placeholder="XXL" style="width:70px">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class=" form-group col-lg-12">
                                                    <label class="col-md-6 control-label">Màu vàng</label>
                                                    <div class="form-group col-lg-12 d-flex">
                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>S:</span><input type="number" class="form-control" min="0" value="0" name="yellow_s" placeholder="S" style="width:70px">
                                                        </div>
                        
                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>M:</span><input type="number" class="form-control" min="0" value="0" name="yellow_m" placeholder="M" style="width:70px">
                                                        </div>
                                                        
                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>L:</span><input type="number" class="form-control" min="0" value="0" name="yellow_l" placeholder="L" style="width:70px">
                                                        </div>
    
                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>XL:</span><input type="number" class="form-control" min="0" value="0" name="yellow_xl" placeholder="XL" style="width:70px">
                                                        </div>
    
                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>XXL:</span><input type="number" class="form-control" min="0" value="0" name="yellow_xxl" placeholder="XXL" style="width:70px">
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- <div class=" form-group col-lg-12">
                                                    <label class="col-md-6 control-label">Kích cỡ</label>
                                                    <div class="form-group col-lg-12 d-flex">
                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>38:</span><input type="number" class="form-control" min="0" value="0" name="size_38" placeholder="size" style="width:70px">
                                                        </div>
                        
                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>39:</span><input type="number" class="form-control" min="0" value="0" name="size_39" placeholder="size" style="width:70px">
                                                        </div>
                                                        
                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>40:</span><input type="number" class="form-control" min="0" value="0" name="size_40" placeholder="size" style="width:70px">
                                                        </div>
    
                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>41:</span><input type="number" class="form-control" min="0" value="0" name="size_41" placeholder="size" style="width:70px">
                                                        </div>
    
                                                        <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                                            <span>42:</span><input type="number" class="form-control" min="0" value="0" name="size_42" placeholder="size" style="width:70px">
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
    
                                        <div class="col-lg-6">
                                            <div class="row g-0">
                                                <div class="form-group col-lg-12">
                                                    <label class="col-md-12 control-label" for="styles">Phong cách</label>
                                                    <div class="col-md-12"><select class="form-control style" name="styles[]" multiple="multiple">
                                                        
                                                    </select></div>
                                                </div>
                                                @if ($errors->has('styles'))
                                                    <span class="alert" style="color: red"> {{ $errors->first('styles') }} </span>
                                                @endif

                                                <div class="form-group col-lg-12">
                                                    <label class="col-md-12 control-label" for="seasons">Mùa</label>
                                                    <div class="col-md-12"><select class="form-control season" name="seasons[]" multiple="multiple">
                                                        
                                                    </select></div>
                                                </div>
                                                @if ($errors->has('seasons'))
                                                    <span class="alert" style="color: red"> {{ $errors->first('seasons') }} </span>
                                                @endif

                                                <div class="form-group">
                                                    <label class="col-md-6 control-label">Chất liệu</label>
                                                    <div class="col-md-12"><input class="form-control" id="material" name="material" placeholder="Nhập chất liệu" title="" type="text" /></div>
                                                </div>
                                                @if ($errors->has('material'))
                                                    <span class="alert" style="color: red">{{ $errors->first('material') }} </span>
                                                @endif
                                                
                                                <div class="form-group">
                                                    <label class="col-md-6 control-label">Thương hiệu</label>
                                                    <div class="col-md-12"><input class="form-control" id="brand" name="brand" placeholder="Nhập thương hiệu" title="" type="text" /></div>
                                                </div>
                                                @if ($errors->has('brand'))
                                                    <span class="alert" style="color: red">{{ $errors->first('brand') }} </span>
                                                @endif

                                                <div class="form-group">
                                                    <label class="col-md-6 control-label">Nhà cung cấp</label>
                                                    <div class="col-md-12"><input class="form-control" id="suppiler" name="suppiler" placeholder="Nhập nhà cung cấp" title="" type="text" /></div>
                                                </div>
                                                @if ($errors->has('suppiler'))
                                                    <span class="alert" style="color: red">{{ $errors->first('suppiler') }} </span>
                                                @endif

                                                <div class="form-group">
                                                    <label class="col-md-6 control-label">Sản xuất tại</label>
                                                    <div class="col-md-12"><input class="form-control" id="made_in" name="made_in" placeholder="Nhập nơi sản xuất" title="" type="text" /></div>
                                                </div>
                                                @if ($errors->has('made_in'))
                                                    <span class="alert" style="color: red">{{ $errors->first('made_in') }} </span>
                                                @endif

                                                <div class="form-group">
                                                    <label class="col-md-6 control-label">Mô tả</label>
                                                    <div class="col-md-12"><input class="form-control" id="description" name="description" placeholder="Nhập mô tả sản phẩm" title="" type="text" /></div>
                                                </div>
                                                @if ($errors->has('description'))
                                                    <span class="alert" style="color: red">{{ $errors->first('description') }} </span>
                                                @endif

                                                <div class="form-group">
                                                    <label class="col-md-6 control-label"> Danh mục sản phẩm </label>
                                                    <div class="col-md-12"><select class="form-control category_select2" name="category" id="" aria-label="Default select example">
                                                        {!! $htmlOption !!}
                                                    </select></div>
                                                </div>
                        
                                                <div class="form-group">
                                                    <div class="col-md-12 d-flex justify-content-between">
                                                        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Hủy</a>
                                                        <button type="submit" class="btn btn-primary">Thêm</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection