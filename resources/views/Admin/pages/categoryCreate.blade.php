@extends('Admin.layouts.MasterLayout')

@section('title')
    <title> Thêm danh mục </title>
@endsection

@section('content')
    <!-- Chen trang them danh muc -->
    <div class="categoryCreate">
        <div class="categoryCreateFrame">
            <!-- Trang them danh muc -->
            <div class="head">
                <h2>  Thêm danh mục </h2>
            </div>
            <div class="body">
                <div class="col-md-6">
                    <form action="{{ route('admin.category.create') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label> Tên danh mục </label>
                            <input type="text" class="form-control" name="category_name" id="" placeholder="Nhập tên danh mục">
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
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection