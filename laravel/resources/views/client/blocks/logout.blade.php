<ul class="nav">
    <li class="nav-item">
        <a class="nav-link  text-light item_header" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất?')" aria-current="page" href="{{route('trangchu.logout')}}">Logout</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-light item_header" href="{{route('user.personalpage')}}">@yield('name')</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-light item_header" href="{{route('user.getCart')}}"><ion-icon name="cart-outline" style="font-size: 25px;"></ion-icon></a>
    </li>
</ul>
