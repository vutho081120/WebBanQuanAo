@extends('Site.layouts.EmptyLayout')

@section('title')
    <title> Cập nhật địa chỉ </title>
@endsection

@section('content')
    <!-- Chen trang cap nhat dia chi -->
    <div class="addressUpdate">
        <div class="addressUpdateFrame">
            <!-- Trang cap nhat dia chi -->
            <div class="head">
                <h2>  Cập nhật địa chỉ </h2>
            </div>
            <div class="body">
                <div class="col-md-6">
                    <form action="{{ route('site.address.update', $diachiItem->id) }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label> Tên người nhận </label>
                            <input type="text" class="form-control" name="recipien_name" id="" placeholder="Nhập tên người nhận"
                            value="{{ $diachiItem->recipien_name }}">
                        </div>
                        @if ($errors->has('recipien_name'))
                            <span class="alert" style="color: red"> {{ $errors->first('recipien_name') }} </span>
                        @endif
        
                        <div class="form-group">
                            <label> Số điện thoại </label>
                            <input type="text" class="form-control" name="phone" id="" placeholder="Nhập số điện thoại"
                            value="{{ $diachiItem->phone }}">
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
                                        @foreach ($tinhList as $value)
                                            @if ($value->id == $diachiItem->tinh_id)
                                                <option value="{{ $value->id }}"  selected>{{ $value->province_name }}</option>
                                            @else
                                                <option value="{{ $value->id }}">{{ $value->province_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label class=" control-label" for="district">
                                        Quận huyện @if ($errors->has('district')) <span class="" style="color: red">*</span> @endif
                                    </label>
                                    <select class="form-control" id="district" name="district">
                                        @foreach ($huyen->getDistrict($diachiItem->huyen_id) as $value)
                                            @if ($value->id == $diachiItem->huyen_id)
                                                <option value="{{ $value->id }}"  selected>{{ $value->district_name }}</option>
                                            @else
                                                <option value="{{ $value->id }}">{{ $value->district_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label class=" control-label" for="ward">
                                        Phường xã @if ($errors->has('ward')) <span class="" style="color: red">*</span> @endif
                                    </label>
                                    <select class="form-control" id="ward" name="ward">
                                        @foreach ($phuong->getWard($diachiItem->phuong_id) as $value)
                                            @if ($value->id == $diachiItem->phuong_id)
                                                <option value="{{ $value->id }}"  selected>{{ $value->ward_name }}</option>
                                            @else
                                                <option value="{{ $value->id }}">{{ $value->ward_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="address">Địa chỉ cụ thể</label>
                            <input class="form-control" id="address" name="address" placeholder="Số nhà, ngõ, đường" value="{{ $diachiItem->address }}" type="text" />
                        </div>
                        @if ($errors->has('address'))
                            <span class="alert" style="color: red">{{ $errors->first('address') }} </span>
                        @endif

                        <div class="form-group d-flex justify-content-between">
                            <a href="{{ route('site.address.index', $diachiItem->nguoidung_id) }}" class="btn btn-secondary">Hủy</a>
                            <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger">Xóa địa chỉ</a>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="deleteHidden">
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn xóa địa chỉ này?</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p> Thao tác này sẽ xóa địa chỉ của bạn. Thao tác này không thể khôi phục. </p> 
                </div>
                <div class="modal-footer">
                    <a href="{{ route('site.address.delete', $diachiItem->id) }}" class="btn btn-danger">Xóa</a>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection