<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    protected $table = 'wards';

    protected $fillable = ['name', 'gso_id', 'district_id'];

    public function districts()
    {
        return $this->belongsTo(Districts::class);
    }
}
