<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'merk', 'nama', 'transmisi', 'bahan_bakar',
        'tahun', 'harga', 'status', 'deskripsi'
    ];

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }
}
