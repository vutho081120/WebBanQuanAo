<div class="headerFrame">
    <div class="w1240Header">
        
        <div class="logoHeader">
            <a href="">
                <img src="{{ asset('images/Site/logo.png') }}" alt="">
            </a>
        </div>

        <div class="account">
            @if(Auth::check())
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle"></i> {{ Auth::user()->user_name }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('logout') }}"> <i class="fas fa-sign-out-alt"></i> Đăng Xuất </a></li>
                    </ul>
                </div>
            @endif
        </div>

    </div>
</div>