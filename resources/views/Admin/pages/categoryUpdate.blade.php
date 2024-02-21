@extends('Admin.layouts.MasterLayout')

@section('title')
    <title> Danh mục </title>
@endsection

@section('content')
    <!-- Chen trang cap nhat danh muc -->
    <div class="categoryUpdate">
        <div class="categoryUpdateFrame">
            <!-- Trang cap nhat danh muc -->
            <div class="head">
                <h2>  Cập nhật danh mục </h2>
            </div>
            <div class="body">
                <div class="col-md-6">
                    <form action="{{ route('admin.category.update', $danhmucItem->id) }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label> Tên danh mục </label>
                            <input type="text" class="form-control" name="category_name" id="" placeholder="Nhập tên danh mục" 
                            value="{{ $danhmucItem->category_name }}">
                        </div>
                        @if ($errors->has('category_name'))
                            <span class="alert" style="color: red"> {{ $errors->first('category_name') }} </span>
                        @endif
        
                        <div class="form-group">
                            <label> Danh mục cha </label>
                            <select class="form-control" name="parent_id" id="">
                                {!! $htmlOption !!}
                            </select>
                        </div>
                        <div class="form-group d-flex justify-content-between">
                            <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Hủy</a>
                            <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger">Xóa danh mục</a>
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
                  <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn xóa danh mục này?</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p> Thao tác này sẽ xóa danh mục <b> {{ $danhmucItem->category_name }} </b> của bạn. Thao tác này không thể khôi phục. </p> 
                </div>
                <div class="modal-footer">
                    <a href="{{ route('admin.category.delete', $danhmucItem->id) }}" class="btn btn-danger">Xóa</a>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection