<div class="headerFrame">
    <div class="w1240Header">
        
        <div class="logoHeader">
            <a href="">
                <img src="{{ asset('images/Site/logo.png') }}" alt="">
            </a>
        </div>

        <div class="search">
            <form action="{{ route('site.search.index') }}">
                <div class="sr">
                    <input type="text" name="key" value="{{ $key = isset($key)?$key:"" }}" placeholder="Nhập tên sản phẩm cần tìm kiếm">
                    <button type="submit"> <i class="fas fa-search"></i> </button>
                </div>
            </form>
        </div>

        <div class="account">
            @if(Auth::check())
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle"></i> {{ Auth::user()->user_name }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('site.order.index', Auth::id()) }}"> <i class="fas fa-clipboard-list"></i> Đơn Hàng </a></li>
                        <li><a class="dropdown-item" href="{{ route('site.address.index') }}"> <i class="fas fa-map-marker-alt"></i> Địa Chỉ </a></li>
                        <li><a class="dropdown-item" href="{{ route('site.account.updateShow', Auth::id()) }}"> <i class="fas fa-user-alt"></i> Tài Khoản </a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"> <i class="fas fa-sign-out-alt"></i> Đăng Xuất </a></li>
                    </ul>
                </div>
            @else
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle"></i> Tài khoản
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#loginModal"> <i class="fas fa-sign-in-alt"></i> Đăng Nhập </a></li>
                      <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#signupModal"> <i class="fas fa-user-plus"></i> Đăng Ký </a></li>
                    </ul>
                </div>
            @endif
        </div>

        <div class="cart">
            @if(Auth::check())
                <a href=" {{ route('site.cart.index') }} ">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            @else
                <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            @endif
        </div>

    </div>

    <div class="loginHidden">
        @include("Site.components.login")
    </div>

    <div class="signupHidden">
        @include("Site.components.signup")
    </div>
</div>