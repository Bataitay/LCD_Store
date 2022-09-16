<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $fillable = [
        'name', 'price', 'quantity', 'category_id', 'brand_id', 'image', 'sale_price', 'status', 'description', 'created_by'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function file_names()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function specification()
    {
        return $this->hasOne(Specifications::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function oderDetails(){
        return $this->hasMany(OrderDetail::class, 'product_id', 'id');
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function scopeSearch($query, $term)
    {
        if ($term) {
            $query->where('name', 'like', '%' . $term . '%')
                ->orWhere('price', 'like', '%' . $term . '%')
                ->orWhere('sale_price', 'like', '%' . $term . '%')
                ->orWhere('status', 'like', '%' . $term . '%')
                ->orWhere('quantity', 'like', '%' . $term . '%');
        }
        return $query;
    }
    public function scopeNameCate($query, $request)
    {
        if ($request->has('category_id')) {
            return $query->whereHas('category', function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            });
        }
    }
    public function scopeFilterPrice($query, array $filters)
    {
        if (isset($filters['startPrice']) && isset($filters['endPrice'])) {
            $query->whereBetween('price', [$filters['startPrice'], $filters['endPrice']]);
        }
        return $query;
    }
    public function scopefilterDate($query, array $date_to_date)
    {
        if (isset($date_to_date['start_date']) && isset($date_to_date['end_date'])) {
            $query->whereBetween('created_at', [$date_to_date['start_date'], $date_to_date['end_date']]);
        }
        return $query;
    }
    public function scopeStatus($query, $request)
    {
        if ($request->has('status')) {
            $query->where('status', $request->status);
        };
        return $query;
    }
}
