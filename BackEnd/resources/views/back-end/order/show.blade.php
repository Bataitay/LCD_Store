@extends('back-end.master')
@section('content')
    <div class="container-fluid">

        <div class="container">
            <div class="col-md-12 d-flex">
                <div class="md-3">
                    <a href="{{ route('order.index') }}"
                        class="btn btn-danger btn-rounded waves-effect waves-light ">
                        <i class=" fas fa-reply-all"></i>
                        Back</a>
                </div>
            </div>
            <!-- Title -->
            <div class="mb-3 text-center">
                <h2>Order Detail</h2>
            </div>
            <div class="d-flex justify-content-between align-items-center py-3">
                <h5>Order ID: {{ $order->id }}</h5>
            </div>

            <!-- Main content -->
            <div class="row">
                <div class="col-lg-8">
                    <!-- Details -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3 d-flex justify-content-between">
                                <div>
                                    <span class="me-3">Created At: {{ $order->created_at }}</span>
                                    <span class="me-3">Updated At: {{ $order->updated_at }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <span class="me-3">Customer Name: {{ $order->name }}</span>
                            </div>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Product</td>
                                        <td>Quantity</td>
                                        <td class="text-end">Price</td>
                                        <td class="text-end">Subtotal</td>
                                    </tr>
                                    @php
                                        $totalPriceOrder = 0;
                                    @endphp
                                    @foreach ($orderDetails as $orderDetail)
                                    <tr>
                                        <td>
                                            <div class="d-flex mb-2">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ asset($orderDetail->products->image) }}"
                                                        alt="" width="35" class="img-fluid">
                                                </div>
                                                <div class="flex-lg-grow-1 ms-3">
                                                    <h6 class="small mb-0">
                                                        <a href="#" class="text-reset">{{ $orderDetail->products->name }}</a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $orderDetail->product_quantity }}</td>
                                        <td class="text-end">{{ number_format($orderDetail->product_price) }}</td>
                                        <td class="text-end">{{ number_format($orderDetail->product_price * $orderDetail->product_quantity) }}</td>
                                        @php
                                            $totalPriceOrder += $orderDetail->product_price * $orderDetail->product_quantity;    
                                        @endphp
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="fw-bold">
                                        <td colspan="3">TOTAL</td>
                                        <td class="text-end">{{ number_format($totalPriceOrder) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- Payment -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="h6">Payment Method</h3>
                                    <p>Visa -1234 <br>
                                        Total: $169,98 <span class="badge bg-success rounded-pill">PAID</span></p>
                                </div>
                                <div class="col-lg-6">
                                    <h3 class="h6">Billing address</h3>
                                    <address>
                                        <div>
                                            <strong>{{ $order->province->name }}, {{ $order->district->name }}, {{ $order->ward->name }}</strong>
                                        </div>
                                        <div>
                                            <strong>{{ $order->address }}</strong>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Customer Notes -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="h6">Note</h3>
                            <p>{{ $order->note }}</p>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <!-- Shipping information -->
                        <div class="card-body">
                            <h3 class="h6">Shipping Information</h3>
                            <strong>FedEx</strong>
                            <span><a href="#" class="text-decoration-underline" target="_blank">FF1234567890</a> <i
                                    class="bi bi-box-arrow-up-right"></i> </span>
                            <hr>
                            <h3 class="h6">Address</h3>
                            <address>
                                <strong>John Doe</strong><br>
                                1355 Market St, Suite 900<br>
                                San Francisco, CA 94103<br>
                                <abbr title="Phone">P:</abbr> (123) 456-7890
                            </address>
                        </div>
                    </div>
                    @if ($order->status)
                    <div class="text-center">
                        <h5>Order Approved<i class="bi bi-check2 text-success"></i></h5>
                    </div>
                    @else 
                        <div class="mb-4">
                            <form action="{{ route('order.updatesingle', $order->id) }}" method="POST" class="mb-3">
                                @csrf
                                @method('PUT')
                                <div class="text-center">
                                    <button class="btn btn-primary">Approve<i class="bi bi-check2 text-success"></i></button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let href = $(this).data('href');
            // alert(href)
            let csrf = '{{ csrf_token() }}';
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: href,
                        method: 'delete',
                        data: {
                            _token: csrf
                        },
                        success: function(res) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            $('.item-' + id).remove();
                        }
                    });
                }
            })
        });
    </script>
@endsection
