@extends('Site.layouts.EmptyLayout')

@section('title')
    <title> Thêm địa chỉ </title>
@endsection

@section('content')
    <!-- Chen trang them dia chi -->
    <div class="addressCreate">
        <div class="addressCreateFrame">
            <!-- Trang dia chi -->
            <div class="head">
                <h2>  Thêm địa chỉ </h2>
            </div>
            <div class="body">
                <div class="col-md-6">
                    <form action="{{ route('site.address.create') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label> Tên người nhận </label>
                            <input type="text" class="form-control" name="recipien_name" id="" placeholder="Nhập tên người nhận">
                        </div>
                        @if ($errors->has('recipien_name'))
                            <span class="alert" style="color: red"> {{ $errors->first('recipien_name') }} </span>
                        @endif
        
                        <div class="form-group">
                            <label> Số điện thoại </label>
                            <input type="text" class="form-control" name="phone" id="" placeholder="Nhập số điện thoại">
                        </div>
                        @if ($errors->has('phone'))
                            <span class="alert" style="color: red"> {{ $errors->first('phone') }} </span>
                        @endif

                        <div class=" form-group">
                            <div class="row g-0">
                                <div class="form-group col-lg-4">
                                    <label class=" control-label" for="province">
                                        Tỉnh thành @if ($errors->has('province')) <span class="" style="color: red">*</span> @endif
                                    </label>
                                    <select class="form-control" id="province" name="province">
                                        <option value="">---Chọn---</option>
                                        @foreach ($tinhList as $value)
                                            <option value="{{ $value->id }}">{{ $value->province_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label class=" control-label" for="district">
                                        Quận huyện @if ($errors->has('district')) <span class="" style="color: red">*</span> @endif
                                    </label>
                                    <select class=" form-control" id="district" name="district">
                                        <option value="">---Chọn---</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label class=" control-label" for="ward">
                                        Phường xã @if ($errors->has('ward')) <span class="" style="color: red">*</span> @endif
                                    </label>
                                    <select class="  form-control" id="ward" name="ward">
                                        <option value="">---Chọn---</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-6 control-label" for="address">Địa chỉ cụ thể</label>
                            <input class="form-control" id="address" name="address" placeholder="Số nhà, ngõ, đường" title="" type="text" />
                        </div>
                        @if ($errors->has('address'))
                            <span class="alert" style="color: red">{{ $errors->first('address') }} </span>
                        @endif

                        <div class="form-group d-flex justify-content-between">
                            <a href="{{ route('site.address.index') }}" class="btn btn-secondary">Hủy</a>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection