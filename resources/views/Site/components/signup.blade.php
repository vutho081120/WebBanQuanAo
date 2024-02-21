<!-- Signup -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1240px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ĐĂNG KÝ</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <section class="h-100 bg-secondary">
                <form action="{{ route('signup') }}" name="registration" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="container h-100">
                        <div class="row d-flex justify-content-center align-items-center ">
                            <div class="col-12 bg-white">
                                <div class="row g-0">
                                    <div class="col-lg-6">
                                        <div class="row g-0">
                                            <div class="form-group col-lg-12">
                                                <label class="col-md-12 control-label" for="nameSignup">Họ và tên</label>
                                                <div class="col-md-12"><input class="form-control" id="nameSignup" name="nameSignup" placeholder="Nhập tên của bạn" title="" type="text"></div>
                                            </div>
                                            @if ($errors->has('nameSignup'))
                                                <span class="alert" style="color: red"> {{ $errors->first('nameSignup') }} </span>
                                            @endif

                                            <div class="form-group col-lg-12">
                                                <label for="date" class="col-md-6 control-label" for="datepicker">Ngày sinh</label>
                                                <div class="col-md-12">
                                                    <div class="input-group date" id="datepicker">
                                                        <input type="text" class="form-control" id="date" name="birthdaySignup" readonly>
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
                                                        <input class="form-check-input" type="radio" name="genderSignup" id="male_gender" value="Nam" checked>
                                                        <label class="form-check-label" for="male_gender"> Nam </label>
                                                    </div>
                                                    <div class="form-check col-lg-4">
                                                        <input class="form-check-input" type="radio" name="genderSignup" id="female_gender" value="Nữ">
                                                        <label class="form-check-label" for="female_gender"> Nữ </label>
                                                    </div>
                                                    <div class="form-check col-lg-4">
                                                        <input class="form-check-input" type="radio" name="genderSignup" id="other_gender" value="Khác">
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
                                                <label class="col-md-6 control-label" for="addressSignup">Địa chỉ cụ thể</label>
                                                <div class="col-md-12"><input class="form-control" id="addressSignup" name="addressSignup" placeholder="Số nhà, ngõ, đường" title="" type="text" /></div>
                                            </div>
                                            @if ($errors->has('addressSignup'))
                                                <span class="alert" style="color: red">{{ $errors->first('addressSignup') }} </span>
                                            @endif

                                            <div class="form-group col-lg-12">
                                                <label class="col-md-4 control-label">E-mail</label>
                                                <div class="col-md-12"><input class="form-control" id="emailSignup" name="emailSignup" placeholder="E-mail" title="" type="email" /></div>
                                            </div>
                                            @if ($errors->has('emailSignup'))
                                                <span class="alert" style="color: red">{{ $errors->first('emailSignup') }} </span>
                                            @endif
            
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="row g-0">
                                            <div class="form-group">
                                                <label class="col-md-6 control-label">Số điện thoại</label>
                                                <div class="col-md-12"><input class="form-control" id="phoneSignup" name="phoneSignup" placeholder="Nhập số điện thoại" title="" type="text" /></div>
                                            </div>
                                            @if ($errors->has('phoneSignup'))
                                                <span class="alert" style="color: red"> {{ $errors->first('phoneSignup') }} </span>
                                            @endif

                                            <div class="form-group">
                                                <label class="col-md-6 control-label">Mật khẩu</label>
                                                <div class="col-md-12"><input class="form-control" id="passwordSignup" name="passwordSignup" placeholder="Nhập mật khẩu" title="" type="password" /></div>
                                            </div>
                                            @if ($errors->has('passwordSignup'))
                                                <span class="alert" style="color: red">{{ $errors->first('passwordSignup') }} </span>
                                            @endif

                                            {{-- <div class="form-group">
                                                <label class="col-md-6 control-label">Nhập lại mật khẩu</label>
                                                <div class="col-md-12"><input class="form-control" id="cf_password" name="cf_password" placeholder="Nhập lại mật khẩu" title="" type="password" /></div>
                                            </div> --}}
                                            
                                            <div class="col-md-12 d-flex justify-content-center">
                                                <button type="submit" class="form-group btn btn-primary col-md-6">Đăng ký</button>
                                            </div>
                                        
                                            <div class="col-md-12 ">
                                                <div class="d-flex justify-content-center links">
                                                    Bạn đã có sẵn một tài khoản?<a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Đăng nhập</a>
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
<!-- End Signup -->


