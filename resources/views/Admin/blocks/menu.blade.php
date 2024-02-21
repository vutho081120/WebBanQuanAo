<div class="menuFrame">
    <div class="menuTop">
        <ul class="nav">
            <li>
                <a href=" {{ route('admin.home.index') }}"> Tổng quan </a>
            </li>
            <li>
                <a> Hàng hóa </a>
                <ul class="sub-menu">
                    <li><a href="{{ route('admin.category.index') }}"> Danh mục </a></li>
                    <li><a href="{{ route('admin.product.index') }}"> Sản Phẩm </a></li>
                </ul>
            </li>
            <li>
                <a> Giao dịch </a>
                <ul class="sub-menu">
                    <li><a href="{{ route('admin.bill.index') }}"> Hóa đơn </a></li>
                </ul>
            </li>
            <li>
                <a> Tài khoản </a>
                <ul class="sub-menu">
                    <li><a href="{{ route('admin.user.index') }}"> Người dùng </a></li>
                </ul>
            </li>
            <li>
                <a> Báo cáo </a>
            </li>
        </ul>
    </div>
</div>