@extends('Admin.layouts.MasterLayout')

@section('title')
    <title>Tổng Quan</title>
@endsection

@section('content')
    <!-- Chen trang home -->
    <div class="home">
        <div class="homeFrame">
            <!-- Chen trang dashboard -->
            <div class="dashboardBoxFrame">
                @include("Admin.components.dashboardBox")
            </div>

            <!-- Chen trang topProduct -->
            <div class="topProductFrame">
                @include("Admin.components.topProduct")
            </div>
        </div>
    </div>
@endsection
