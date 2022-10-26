<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ !empty(auth()->user()->avatar) ? asset(auth()->user()->avatar) : asset('assets/images/no_image.png') }}"
                 alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ Auth::user()->name}}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Admin</li>

                <li>
                    <a href="{{ route('dashboard')}}" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    @can('List_Banner', 'List_Banner')
                    <a href="{{ route('banner.index') }}" class=" waves-effect">
                        <i class="ri-calendar-2-line"></i>
                        <span>Banners</span>
                    </a>
                    @endcan
                </li>
                <li>
                    @can('List_Category', 'List_Category')
                    <a href="{{route('category.index')}}" class=" waves-effect">
                        <i class="ri-calendar-2-line"></i>
                        <span>Categories</span>
                    </a>
                    @endcan
                </li>
                <li>
                    @can('List_Product', 'List_Product')
                    <a href="{{ route('product.index')}}" class=" waves-effect">
                        <i class="ri-pencil-ruler-2-line"></i>
                        <span>Products</span>
                    </a>
                    @endcan
                </li>
                <li>
                    @can('List_Review', 'List_Review')
                    <a href="{{route('review.index')}}" class=" waves-effect">
                        <i class="ri-vip-crown-2-line"></i>
                        <span>Review</span>
                    </a>
                    @endcan
                </li>
                <li>
                    @can('List_Brand', 'List_Brand')
                    <a href="{{route('brand.index')}}" class=" waves-effect">
                        <i class="ri-vip-crown-2-line"></i>
                        <span>Brands</span>
                    </a>
                    @endcan
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-profile-line"></i>
                        <span>Roles</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            @can('List_Role', 'List_Role')
                            <a href="{{ route('role.index') }}">Roles</a>
                            @endcan
                        </li>
                        <li>
                            @can('List_Employee', 'List_Employee')
                            <a href="{{ route('user.index')}}">Employee</a>
                            @endcan
                        </li>
                    </ul>
                </li>
                <li class="menu-title">Web</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-account-circle-line"></i>
                        <span>Customers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li><a href="auth-login.html">Login</a></li> --}}
                        <li>
                            @can('List_Customer', 'List_Customer')
                            <a href="{{route('customer.index')}}">List Customer</a>
                            @endcan
                        </li>
                        {{-- <li><a href="auth-register.html">Register</a></li>
                        <li><a href="auth-recoverpw.html">Recover Password</a></li>
                        <li><a href="auth-lock-screen.html">Lock Screen</a></li> --}}
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class=" fas fa-cart-plus"></i>
                        <span>Orders</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            @can('List_Order', 'List_Order')
                            <a href="{{ route('order.index') }}">Orders</a>
                            @endcan
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Message</span>
                    </a>

                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
