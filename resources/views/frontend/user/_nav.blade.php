<div class="sidebar widget widget-dashboard mb-lg-0 mb-3 col-lg-3 order-0">
    <h2 class="text-uppercase">My Account </h2>
    <ul class="nav nav-tabs list flex-column mb-0" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'user.dashboard' ? 'active' : '' }}"
                href="{{ route('user.dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'orderHistory' ? 'active' : '' }}"
                href="{{ route('orderHistory') }}">Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'showProfile' ? 'active' : '' }}"
                href="{{ route('showProfile') }}">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'wishlist' ? 'active' : '' }}"
                href="{{ route('wishlist') }}">Wishlist</a>
        </li>
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm rounded btn-block" style="cursor: pointer;">
                    Logout
                </button>
            </form>
        </li>
    </ul>
</div>
