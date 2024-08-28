<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset($company->logo) }}" alt="admin" class="brand-image  elevation-3" style="opacity: .8">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset(auth()->guard('admin')->user()->image) }}" class="img-circle elevation-2" alt="AI">
            </div>
            <div class="info">
                <a href="{{ route('admin.dashboard') }}"
                    class="d-block">{{ auth()->guard('admin')->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                {{-- admin --}}
                @if (auth()->guard('admin')->user()->admin_user == 1)
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-warning"></i>
                            <p class="text">
                                Admin
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-header">
                            <li class="nav-item">
                                <a href="{{ route('admin.adminList') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Admin List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.createAdmin') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Create New Admin</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.customerList') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Customer List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif



                {{-- category --}}
                @if (auth()->guard('admin')->user()->main_menu == 1)
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-warning"></i>
                            <p class="text">
                                Main Menu
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-header">
                            <li class="nav-item">
                                <a href="{{ route('admin.category') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.subcategory') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Subcategory</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.childcategory') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Childcategory</p>
                                </a>
                            </li>
                            {{-- main slider --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.allSlider') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>
                                        Main Slider
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- product --}}
                @if (auth()->guard('admin')->user()->product == 1)
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-warning"></i>
                            <p class="text">
                                Product
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-header">
                            <li class="nav-item">
                                <a href="{{ route('admin.index') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>All Products</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.createProduct') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Creater Products</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.sizes.index') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Sizes</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.colors.index') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Colors</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.brands.index') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Brand</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.showShippingCharge') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Shipping Charge</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.productStock') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Product Stock</p>
                                </a>
                            </li>
                            {{-- reting and review --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.showRatingReview') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>
                                        Rating & Reviews
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- offer --}}
                @if (auth()->guard('admin')->user()->offer == 1)
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-warning"></i>
                            <p class="text">
                                Offer
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-header">
                            <li class="nav-item">
                                <a href="{{ route('admin.coupons.index') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>
                                        Coupon
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.voucherList') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>
                                        Voucher
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.flashSaleTimer') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>
                                        Flash Sale Timer
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- product collection --}}
                @if (auth()->guard('admin')->user()->collection == 1)
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-warning"></i>
                            <p class="text">
                                Collections
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-header">
                            <li class="nav-item">
                                <a href="{{ route('admin.productCollection') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>
                                        Product Collection
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.bannerCollection') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>
                                        Banner Collection
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif


                {{-- order --}}
                @if (auth()->guard('admin')->user()->order_history == 1)
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-warning"></i>
                            <p class="text">
                                Order
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-header">
                            <li class="nav-item">
                                <a href="{{ route('admin.cancelOrder') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Canceled Order</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.pendingOrder') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Pending Order</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.confirmOrder') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Confirm Order</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.shippedOrder') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Shipped Order</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif



                {{-- company info --}}
                @if (auth()->guard('admin')->user()->company == 1)
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-warning"></i>
                            <p class="text">
                                Company Info
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-header">
                            <li class="nav-item">
                                <a href="{{ route('admin.showCompanyInfo') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Company Information</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.pageList') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Pages</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
