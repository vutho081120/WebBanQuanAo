@extends('Admin.layouts.MasterLayout')

@section('title')
    <title> Thêm người dùng </title>
@endsection

@section('content')
    <!-- Chen trang them nguoi dung -->
    <div class="userCreate">
        <div class="userCreateFrame">
            <!-- Trang nguoi dung -->
            <div class="head">
                <h2>  Thêm người dùng </h2>
            </div>
            <div class="body">
                <section class="h-100 bg-secondary">
                    <form action="{{ route('admin.user.create') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="container h-100" style="max-width: 1240px">
                            <div class="row d-flex justify-content-center align-items-center ">
                                <div class="col-12 bg-white">
                                    <div class="row g-0">
                                        <div class="col-lg-6">
                                            <div class="row g-0">
                                                <div class="form-group col-lg-12">
                                                    <label class="col-md-12 control-label" for="user_name">Họ và tên</label>
                                                    <div class="col-md-12"><input class="form-control" id="user_name" name="user_name" placeholder="Nhập tên của bạn" title="" type="text"></div>
                                                </div>
                                                @if ($errors->has('user_name'))
                                                    <span class="alert" style="color: red"> {{ $errors->first('user_name') }} </span>
                                                @endif
    
                                                <div class="form-group col-lg-12">
                                                    <label for="date" class="col-md-6 control-label" for="datepicker">Ngày sinh</label>
                                                    <div class="col-md-12">
                                                        <div class="input-group date" id="datepicker">
                                                            <input type="text" class="form-control" id="date" name="birthday" readonly>
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
                                                            <input class="form-check-input" type="radio" name="gender" id="male_gender" value="Nam" checked>
                                                            <label class="form-check-label" for="male_gender"> Nam </label>
                                                        </div>
                                                        <div class="form-check col-lg-4">
                                                            <input class="form-check-input" type="radio" name="gender" id="female_gender" value="Nữ">
                                                            <label class="form-check-label" for="female_gender"> Nữ </label>
                                                        </div>
                                                        <div class="form-check col-lg-4">
                                                            <input class="form-check-input" type="radio" name="gender" id="other_gender" value="Khác">
                                                            <label class="form-check-label" for="other_gender"> Khác </label>
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <div class=" form-group px-3 col-lg-12">
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
                
                                                <div class="form-group col-lg-12">
                                                    <label class="col-md-6 control-label" for="address">Địa chỉ cụ thể</label>
                                                    <div class="col-md-12"><input class="form-control" id="address" name="address" placeholder="Số nhà, ngõ, đường" title="" type="text" /></div>
                                                </div>
                                                @if ($errors->has('address'))
                                                    <span class="alert" style="color: red">{{ $errors->first('address') }} </span>
                                                @endif
    
                                                <div class="form-group col-lg-12">
                                                    <label class="col-md-4 control-label">E-mail</label>
                                                    <div class="col-md-12"><input class="form-control" id="email" name="email" placeholder="E-mail" title="" type="email" /></div>
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
                                                    <div class="col-md-12"><input class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" title="" type="text" /></div>
                                                </div>
                                                @if ($errors->has('phone'))
                                                    <span class="alert" style="color: red"> {{ $errors->first('phone') }} </span>
                                                @endif
    
                                                <div class="form-group">
                                                    <label class="col-md-6 control-label">Mật khẩu</label>
                                                    <div class="col-md-12"><input class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" title="" type="password" /></div>
                                                </div>
                                                @if ($errors->has('password'))
                                                    <span class="alert" style="color: red">{{ $errors->first('password') }} </span>
                                                @endif
    
                                                {{-- <div class="form-group">
                                                    <label class="col-md-6 control-label">Nhập lại mật khẩu</label>
                                                    <div class="col-md-12"><input class="form-control" id="cf_password" name="cf_password" placeholder="Nhập lại mật khẩu" title="" type="password" /></div>
                                                </div> --}}
                                                
                                                <div class="form-group">
                                                    <label class="col-md-6"> Quyền </label>
                                                    <div class="col-md-12">
                                                        <select class="form-control" name="role" id="">
                                                            <option value="1"> Khách hàng </option>
                                                            <option value="0"> Admin </option>
                                                        </select>
                                                    </div>
                                                </div>
                        
                                                <div class="form-group">
                                                    <div class="col-md-12 d-flex justify-content-between">
                                                        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Hủy</a>
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