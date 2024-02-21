@extends('Site.layouts.MasterLayout')

@section('title')
    <title>Danh sách sản phẩm</title>
@endsection

@section('content')
    <!-- Category -->
    <div class="category">
        <!-- Chen category -->
        <div class="categoryFrame">
            <!-- Chen bo loc -->
            <div class="bolocFrame">
                @include("Site.components.boloc")
            </div>

            <!-- Chen trang danh sach -->
            <div class="categoryViewFrame">  
                @include("Site.components.searchView")
            </div>
        </div>
    </div>
@endsection