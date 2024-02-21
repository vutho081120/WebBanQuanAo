@extends('Admin.layouts.MasterLayout')

@section('title')
    <title> Danh mục </title>
@endsection

@section('content')
    <!-- Chen trang danh muc -->
    <div class="category">
        <div class="categoryFrame">
            <!-- Trang danh mục -->
            <div class="head">
                <h2> Danh mục </h2>
                <a href="{{ route('admin.category.createShow') }}" class="btn btn-primary btn-sm active" role="button" aria-pressed="true"> Thêm danh mục </a>
            </div>
            <div class="body">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Tên danh mục</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($danhmucList as $key => $value)   
                            <tr> 
                                <th scope="row"> 
                                    <a href="{{ route('admin.category.updateShow', $value->id) }}">
                                        {{ $value->category_name }} 
                                    </a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="page">
                @if (isset($danhmucList) && count($danhmucList) > 0)
                    {{ $danhmucList->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection