<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'merek', 'nama', 'slug', 'transmisi', 'bahan_bakar',
        'tahun', 'harga', 'status', 'deskripsi'
    ];

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
