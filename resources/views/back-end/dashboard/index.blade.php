@extends('back-end.master')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Upcube</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">Total Sales</p>
                            <h4 class="mb-2">{{ $totalSales }}</h4>
                            <p class="text-muted mb-0">
                                <span class="text-success fw-bold font-size-12 me-2">
                                <i class="ri-arrow-right-up-line me-1 align-middle"></i>
                                9.23%
                                </span>
                                from previous period
                            </p>
                        </div>
                        <div class="avatar-sm">
                            <span class="avatar-title bg-light text-primary rounded-3">
                                <i class="ri-shopping-cart-2-line font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">New Orders</p>
                            <h4 class="mb-2">{{ $totalOrders }}</h4>
                            <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i class="ri-arrow-right-down-line me-1 align-middle"></i>1.09%</span>from previous period</p>
                        </div>
                        <div class="avatar-sm">
                            <span class="avatar-title bg-light text-success rounded-3">
                                <i class="mdi mdi-currency-usd font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">New Users</p>
                            <h4 class="mb-2">{{ $totalCustomer }}</h4>
                            <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>16.2%</span>from previous period</p>
                        </div>
                        <div class="avatar-sm">
                            <span class="avatar-title bg-light text-primary rounded-3">
                                <i class="ri-user-3-line font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">Unique Visitors</p>
                            <h4 class="mb-2">29670</h4>
                            <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>11.7%</span>from previous period</p>
                        </div>
                        <div class="avatar-sm">
                            <span class="avatar-title bg-light text-success rounded-3">
                                <i class="mdi mdi-currency-btc font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

    <div class="row">
        <div class="col-xl-6">

            <div class="card">
                <div class="card-body pb-0">
                    <div class="float-end d-none d-md-inline-block">
                        <div class="dropdown card-header-dropdown">
                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted">Report<i class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Export</a>
                                <a class="dropdown-item" href="#">Import</a>
                                <a class="dropdown-item" href="#">Download Report</a>
                            </div>
                        </div>
                    </div>
                    <h4 class="card-title mb-4">Email Sent</h4>

                    <div class="text-center pt-3">
                        <div class="row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <div class="d-inline-flex">
                                    <h5 class="me-2">25,117</h5>
                                    <div class="text-success font-size-12">
                                        <i class="mdi mdi-menu-up font-size-14"> </i>2.2 %
                                    </div>
                                </div>
                                <p class="text-muted text-truncate mb-0">Marketplace</p>
                            </div><!-- end col -->
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <div class="d-inline-flex">
                                    <h5 class="me-2">$34,856</h5>
                                    <div class="text-success font-size-12">
                                        <i class="mdi mdi-menu-up font-size-14"> </i>1.2 %
                                    </div>
                                </div>
                                <p class="text-muted text-truncate mb-0">Last Week</p>
                            </div><!-- end col -->
                            <div class="col-sm-4">
                                <div class="d-inline-flex">
                                    <h5 class="me-2">$18,225</h5>
                                    <div class="text-success font-size-12">
                                        <i class="mdi mdi-menu-up font-size-14"> </i>1.7 %
                                    </div>
                                </div>
                                <p class="text-muted text-truncate mb-0">Last Month</p>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div>
                </div>
                <div class="card-body py-0 px-2">
                    <div id="area_chart" class="apex-charts" dir="ltr"></div>
                </div>
            </div><!-- end card -->
        </div>
        <!-- end col -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body pb-0">
                    <div class="float-end d-none d-md-inline-block">
                        <div class="dropdown">
                            <a class="text-reset" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted">This Years<i class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Today</a>
                                <a class="dropdown-item" href="#">Last Week</a>
                                <a class="dropdown-item" href="#">Last Month</a>
                                <a class="dropdown-item" href="#">This Year</a>
                            </div>
                        </div>
                    </div>
                    <h4 class="card-title mb-4">Revenue</h4>

                    <div class="text-center pt-3">
                        <div class="row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <div>
                                    <h5>17,493</h5>
                                    <p class="text-muted text-truncate mb-0">Marketplace</p>
                                </div>
                            </div><!-- end col -->
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <div>
                                    <h5>$44,960</h5>
                                    <p class="text-muted text-truncate mb-0">Last Week</p>
                                </div>
                            </div><!-- end col -->
                            <div class="col-sm-4">
                                <div>
                                    <h5>$29,142</h5>
                                    <p class="text-muted text-truncate mb-0">Last Month</p>
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div>
                </div>
                <div class="card-body py-0 px-2">
                    <div id="column_line_chart" class="apex-charts" dir="ltr"></div>
                </div>
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <div class="row">
        <h5 class="mb-sm-0">Top 10 best selling products </h5> <br><br>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                    </div>
                    <h4 class="card-title mb-4">By Revenue</h4>

                    <div class="table-responsive">
                        <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Revenue</th>
                                </tr>
                            </thead><!-- end thead -->
                            <tbody>
                                @foreach ($byRevenues as $byRevenue)
                                <tr>
                                    <td>{{ $byRevenue->name }}</td>
                                    <td>{{ $byRevenue->totalbyRevenue }}</td>
                                </tr>
                                @endforeach
                            </tbody><!-- end tbody -->
                        </table> <!-- end table -->
                    </div>
                </div><!-- end card -->
            </div><!-- end card -->
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                    </div>
                    <h4 class="card-title mb-4">By Quantity</h4>

                    <div class="table-responsive">
                        <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead><!-- end thead -->
                            <tbody>
                                @foreach ($byQuabtitys as $byQuabtity)
                                <tr>
                                    <td>{{ $byQuabtity->name}}</td>
                                    <td>{{ $byQuabtity->totalByQuan}}</td>
                                </tr>
                                @endforeach
                            </tbody><!-- end tbody -->
                        </table> <!-- end table -->
                    </div>
                </div><!-- end card -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="float-end">
                        <select class="form-select shadow-none form-select-sm">
                            <option selected>Apr</option>
                            <option value="1">Mar</option>
                            <option value="2">Feb</option>
                            <option value="3">Jan</option>
                        </select>
                    </div>
                    <h4 class="card-title mb-4">Monthly Earnings</h4>

                    <div class="table-responsive">
                        <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th> Revenue Total</th>
                                </tr>
                            </thead><!-- end thead -->
                            <tbody>
                                @foreach ($customerByingSellings as $customerByingSelling)
                                <tr>
                                    <td>{{ $customerByingSelling->name}}</td>
                                    <td>{{ $customerByingSelling->cusByingSelling}}</td>
                                </tr>
                                @endforeach
                            </tbody><!-- end tbody -->
                        </table> <!-- end table -->
                    </div>
                    <!-- end row -->

                    <div class="mt-4">
                        <div id="donut-chart" class="apex-charts"></div>
                    </div>
                </div>
            </div><!-- end card -->
        </div><!-- end col -->
    </div>
    <!-- end row -->
</div>
@endsection
