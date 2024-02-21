<!-- slide quang cao -->

{{-- <div class="slider" id="galleryTop">
    <ul>
        @for ($i = 0; $i < 5; $i++)
            <li>
                <a href=''>
                    <img src="{{ asset('images/Site/galleryTop/anh'.($i+1).'.png') }}" alt="">
                </a>
            </li>
        @endfor
    </ul>

    <div class="button">
        <ul class="dots">
            
        </ul>
    </div>
</div>

<!-- bi loi vi khi goi the dom ko duoc init phia sau neu dung dang query phai khai bao script phia duoi the dom hoac dat trang thai script async domload xong mới dùng được hàm -->
<script type="text/javascript" src="{{ asset('js/Site/galleryHorizontal.js') }}"></script>
<script>
    var optionTop = {ele:'#galleryTop', limit: 1, widthNext: -1457, widthLech: 0};

    var galleryTop = new slide(optionTop);
</script> --}}

<div id="carouselExampleCaptions" class="carousel carousel-captions slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="5000">
            <img src="{{ asset('images/Site/galleryTop/anh1.png') }}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="5000">
            <img src="{{ asset('images/Site/galleryTop/anh2.png') }}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="5000">
            <img src="{{ asset('images/Site/galleryTop/anh3.png') }}" class="d-block w-100" alt="...">
        </div>
    </div>
</div>