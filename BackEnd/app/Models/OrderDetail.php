<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $fillable = [
        'product_price','product_quantity','product_id','order_id'
    ];
    function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    function oders(){
        return $this->belongsTo(Order::class);
    }
}
