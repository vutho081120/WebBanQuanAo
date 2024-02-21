<div class="menuFrame">
    <div class="menuTop">
        <ul class="nav">
            <li>
                <a href=" {{ route('site.home.index') }}"> TRANG CHỦ </a>
            </li>
            <!-- Start an unoredered list -->

            <!-- Loop through each category -->
            @foreach ($categories as $category)

                <!-- Include subcategories.blade.php file and pass the current category to it -->
                @include('Site.components.subcategories', ['category' => $category])
            @endforeach
            <li>
                <a> Thông Tin </a>
                <ul class="sub-menu">
                    <li><a href=" {{ route('site.policy.index') }} "> Chính sách </a></li>
                    <li><a href=" {{ route('site.contact.index') }} "> Liên Hệ </a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>