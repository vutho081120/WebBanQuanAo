@extends('Admin.layouts.MasterLayout')

@section('title')
    <title> Cập nhật người dùng </title>
@endsection

@section('content')
    <!-- Chen trang cap nhat nguoi dung -->
    <div class="userUpdate">
        <div class="userUpdateFrame">
            <!-- Trang cap nhat nguoi dung -->
            <div class="head">
                <h1>  Cập nhật người dùng </h1>
            </div>
            <div class="body">
                <section class="h-100 bg-secondary">
                    <form action="{{ route('admin.user.update', $nguoidungItem->id) }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="container h-100" style="max-width: 1240px">
                            <div class="row d-flex justify-content-center align-items-center ">
                                <div class="col-12 bg-white">
                                    <div class="row g-0">
                                        <div class="col-lg-6">
                                            <div class="row g-0">
                                                <div class="form-group col-lg-12">
                                                    <label class="col-md-12 control-label" for="user_name">Họ và tên</label>
                                                    <div class="col-md-12"><input class="form-control" id="user_name" name="user_name" placeholder="Nhập tên của bạn" title="" type="text"
                                                        value="{{ $nguoidungItem->user_name }}"></div>
                                                </div>
                                                @if ($errors->has('user_name'))
                                                    <span class="alert" style="color: red"> {{ $errors->first('name') }} </span>
                                                @endif
    
                                                <div class="form-group col-lg-12">
                                                    <label for="date" class="col-md-6 control-label" for="datepicker">Ngày sinh</label>
                                                    <div class="col-md-12">
                                                        <div class="input-group date" id="datepicker">
                                                            <input type="text" class="form-control" id="date" name="birthday" 
                                                                value="{{ date("d-m-Y", strtotime($nguoidungItem->birthday)) }}" readonly>
                                                            <span class="input-group-append">
                                                                <span class="input-group-text bg-light d-block">
                                                                    <i class="fa fa-calendar"></i>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <div class="form-group col-lg-12">
                                                    <label class="col-md-4 control-label">Giới tính</label>
                                                    <div class="row px-5">
                                                        <div class="form-check col-lg-4">
                                                            <input class="form-check-input" type="radio" name="gender" id="male_gender" value="Nam" 
                                                            @if ($nguoidungItem->gender == "Nam")
                                                                checked
                                                            @endif>
                                                            <label class="form-check-label" for="male_gender"> Nam </label>
                                                        </div>
                                                        <div class="form-check col-lg-4">
                                                            <input class="form-check-input" type="radio" name="gender" id="female_gender" value="Nữ"
                                                            @if ($nguoidungItem->gender == "Nữ")
                                                                checked
                                                            @endif>
                                                            <label class="form-check-label" for="female_gender"> Nữ </label>
                                                        </div>
                                                        <div class="form-check col-lg-4">
                                                            <input class="form-check-input" type="radio" name="gender" id="other_gender" value="Khác"
                                                            @if ($nguoidungItem->gender == "Khác")
                                                                checked
                                                            @endif>
                                                            <label class="form-check-label" for="other_gender"> Khác </label>
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <div class=" form-group col-lg-12">
                                                    <div class="row g-0 col-md-12">
                                                        <div class="form-group col-lg-4">
                                                            <label class=" control-label" for="province">
                                                                Tỉnh thành @if ($errors->has('province')) <span class="" style="color: red">*</span> @endif
                                                            </label>
                                                            <select class="form-control" id="province" name="province">
                                                                @foreach ($tinhList as $value)
                                                                    @if ($value->id == $nguoidungItem->tinh_id)
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
                                                                @foreach ($huyen->getDistrict($nguoidungItem->huyen_id) as $value)
                                                                    @if ($value->id == $nguoidungItem->huyen_id)
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
                                                                @foreach ($phuong->getWard($nguoidungItem->phuong_id) as $value)
                                                                    @if ($value->id == $nguoidungItem->phuong_id)
                                                                        <option value="{{ $value->id }}"  selected>{{ $value->ward_name }}</option>
                                                                    @else
                                                                        <option value="{{ $value->id }}">{{ $value->ward_name }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                        
                                                <div class="form-group col-lg-12">
                                                    <label class="col-md-4 control-label" for="address">Địa chỉ cụ thể</label>
                                                    <div class="col-md-12"><input class="form-control" id="address" name="address" placeholder="Số nhà, ngõ, đường" value="{{ $nguoidungItem->address }}" type="text" /></div>
                                                </div>
                                                @if ($errors->has('address'))
                                                    <span class="alert" style="color: red">{{ $errors->first('address') }} </span>
                                                @endif
    
                                                <div class="form-group col-lg-12">
                                                    <label class="col-md-4 control-label">E-mail</label>
                                                    <div class="col-md-12"><input class="form-control" id="email" name="email" 
                                                        placeholder="E-mail" value="{{ $nguoidungItem->email }}" type="email" /></div>
                                                </div>
                                                @if ($errors->has('email'))
                                                    <span class="alert" style="color: red">{{ $errors->first('email') }} </span>
                                                @endif
                
                                            </div>
                                        </div>
    
                                        <div class="col-lg-6">
                                            <div class="row g-0">
                                                <div class="form-group">
                                                    <label class="col-md-6 control-label">Số điện thoại</label>
                                                    <div class="col-md-12"><input class="form-control" id="phone" name="phone" 
                                                        placeholder="Nhập số điện thoại" value="{{ $nguoidungItem->phone }}" type="text" readonly /></div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-md-6"> Quyền </label>
                                                    <div class="col-md-12">
                                                        <select class="form-control" name="role" id="">
                                                            <option value="1"> Khách hàng </option>
                                                            <option value="0" @if ($nguoidungItem->role == 0) selected @endif> Admin </option>
                                                        </select>
                                                    </div>
                                                </div>
                                  
                                                <div class="form-group">
                                                    <div class="col-md-12 d-flex justify-content-between">
                                                        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Hủy</a>
                                                        <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger">Xóa người dùng</a>
                                                        <a data-bs-toggle="modal" data-bs-target="#passwordModal" class="btn btn-primary">Đổi mật khẩu</a>
                                                        <button type="submit" class="btn btn-primary">Lưu</button>
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

    <div class="deleteHidden">
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn xóa người dùng này?</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p> Thao tác này sẽ xóa người dùng <b> {{ $nguoidungItem->name }} </b> của bạn. Thao tác này không thể khôi phục. </p> 
                </div>
                <div class="modal-footer">
                    <a href="{{ route('admin.user.delete', $nguoidungItem->id) }}" class="btn btn-danger">Xóa</a>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="passwordHidden">
        @include('Admin.components.passwordUpdate');
    </div>
@endsection