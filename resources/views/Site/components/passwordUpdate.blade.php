<!-- Password Update -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ĐỔI MẬT KHẨU</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="d-flex justify-content-center h-100">
                    <div class="card col-md-12">
                        <div class="card-body">
                            <form action="{{ route('site.account.updatePassword', $nguoidungItem->id) }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control" name="updatePassword" placeholder="Mật khẩu mới">
                                </div>
                                @if ($errors->has('updatePassword'))
                                    <span class="alert" style="color: red"> {{ $errors->first('updatePassword') }} </span>
                                @endif

                                <div class="form-group">
                                    <input type="submit" value="Lưu" class="btn btn-primary float-right">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
<!-- End Password Update -->