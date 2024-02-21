<!-- Keyword -->

<div class="keyword">
    @for ($i = 0; $i < 6; $i++)
        <a href='' class='item'>
            <img src="{{ asset('images/Site/icon/'.($i+1).'.png') }}" alt="">
            <span> Quần áo mùa đông </span>
        </a>
    @endfor
</div>