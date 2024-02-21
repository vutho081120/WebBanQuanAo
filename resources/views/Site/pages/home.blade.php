@extends('Site.layouts.MasterLayout')

@section('title')
    <title>Trang Chủ</title>
@endsection

@section('content')
    <!-- Chen trang home -->
    <div class="home">
        <div class="homeFrame">
            <!-- Chen gallery quang cao -->
            <div class="galleryTopFrame">
                @include("Site.components.galleryTop")
            </div>

            <!-- Chen gallery noi bat -->
            <div class="galleryNoiBatFrame">
                @include("Site.components.galleryNoiBat")
            </div>

            <!-- Chen keyword search -->
            {{-- <div class="keywordFrame">
                @include("Site.components.keyword")
            </div> --}}

            <!-- Chen danh sach san pham goi y -->
            <div class="spGoiYFrame">
                @include("Site.components.goiy")
            </div>
        </div>
    </div>
@endsection
