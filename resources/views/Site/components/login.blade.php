<!-- Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ĐĂNG NHẬP</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="d-flex justify-content-center h-100">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('login') }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="phoneLogin" placeholder="Số điện thoại">
                                </div>
                                @if ($errors->has('phoneLogin'))
                                    <span class="alert"> {{ $errors->first('phoneLogin') }} </span>
                                @endif
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control" name="passwordLogin" placeholder="Mật khẩu">
                                </div>
                                @if ($errors->has('passwordLogin'))
                                    <span class="alert"> {{ $errors->first('passwordLogin') }} </span>
                                @endif
                                <div class="row align-items-center remember">
                                    <input type="checkbox" name="remember" class="save">Lưu tài khoản
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Đăng nhập" class="btn float-right login_btn">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center links">
                                Bạn không có tài khoản?<a href="#" data-bs-toggle="modal" data-bs-target="#signupModal">Đăng ký</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
<!-- End Login -->

