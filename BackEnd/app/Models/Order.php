<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    function oderDetails(){
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
    function province(){
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }
    function district(){
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
    function ward(){
        return $this->belongsTo(Ward::class, 'ward_id', 'id');
    }
}
