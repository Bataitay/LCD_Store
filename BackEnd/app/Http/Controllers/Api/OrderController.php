<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Support\Facades\Cache;

class OrderController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $provinces = Province::all();
        $district = District::all();
        $ward = Ward::all();
        $params = [
            'provinces' => $provinces,
            'district' => $district,
            'ward' => $ward,
        ];
        return response()->json($params);
    }

    function getAllProvince() {
        $provinces = Province::all();
        return response()->json($provinces);
    }

    function getAllDistrictByProvinceId($id) {
        $districts = District::where('province_id', '=', $id)->get();
        return response()->json($districts);
    }
    function getAllWardByDistrictId($id) {
        $wards = Ward::where('district_id', '=', $id)->get();
        return response()->json($wards);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $order = Order::create([
            'note' => $request->note,
            'address' => $request->address,
            'customer_id' => 1,
            'province_id' => $request->provinceId,
            'district_id' => $request->districtId,
            'ward_id' => $request->wardId,
        ]);
        $carts = Cache::get('carts');
        foreach ($carts as $productId => $cart) {
            OrderDetail::create([
                'product_price' => $cart['price'],
                'product_quantity' => $cart['quantity'],
                'product_id' => $productId,
                'order_id' => $order->id,
            ]);
            Product::where('id', $productId)->decrement('quantity', $cart['quantity']);
        }
        Cache::forget('carts');
        $carts = Cache::get('carts');

        
        //sendmail after order
        $orderId=$order->id;
        $customerCurent= Auth::guard('api')->user();
        $mailData = [
            'title' => 'Order confirmation',
            'body' => 'Dear'.$customerCurent->name,
            'orderId' => $orderId
        ];

        Mail::to($customerCurent->email)->send(new SendMail($mailData));
        return response()->json($carts);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
