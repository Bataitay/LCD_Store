<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ !empty(auth()->user()->avatar) ? asset(auth()->user()->avatar) : asset('assets/images/no_image.png') }}"
                 alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">Julia Hudda</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Admin</li>

                <li>
                    <a href="index.html" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="calendar.html" class=" waves-effect">
                        <i class="ri-calendar-2-line"></i>
                        <span>Banners</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('category.index')}}" class=" waves-effect">
                        <i class="ri-calendar-2-line"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="calendar.html" class=" waves-effect">
                        <i class="ri-pencil-ruler-2-line"></i>
                        <span>Products</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('brand.index')}}" class=" waves-effect">
                        <i class="ri-vip-crown-2-line"></i>
                        <span>Brands</span>
                    </a>
                </li>



                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-profile-line"></i>
                        <span>Roles</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('role.index') }}">Roles</a></li>
                        <li><a href="pages-timeline.html">Permission</a></li>
                        <li><a href="{{ route('user.index')}}">Employee</a></li>
                    </ul>
                </li>
                <li class="menu-title">Web</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-account-circle-line"></i>
                        <span>Customers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="auth-login.html">Login</a></li>
                        <li><a href="auth-register.html">Register</a></li>
                        <li><a href="auth-recoverpw.html">Recover Password</a></li>
                        <li><a href="auth-lock-screen.html">Lock Screen</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class=" fas fa-cart-plus"></i>
                        <span>Orders</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="ui-alerts.html">Orders</a></li>
                        <li><a href="ui-buttons.html">Orders detail</a></li>
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
