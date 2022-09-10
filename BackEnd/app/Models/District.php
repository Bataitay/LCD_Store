<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $table = 'districts';

    protected $fillable = ['name', 'gso_id', 'province_id'];
    public function provinces()
    {
        return $this->belongsTo(Province::class,'district_id','id');
    }
}
