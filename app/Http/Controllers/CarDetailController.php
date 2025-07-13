<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Cache;

class CarDetailController extends Controller
{
    public function show($slug)
    {
        // ================================
        // OPTION 1: N+1 Problem (Tanpa Eager + Cache)
        // ================================
        // Gunakan ini untuk demonstrasi sebelum optimasi
        /*
        $car = Car::where('slug', $slug)->firstOrFail();

        foreach ($car->images as $image) {
            // Akan men-trigger query tambahan untuk relasi images
            $imagePath = $image->image_path;
        }

        return view('show', compact('car'));
        */


        // ================================
        // OPTION 2: Optimasi (Eager Loading + Caching)
        // ================================
        // Gunakan ini untuk kondisi setelah optimasi
        $car = Cache::remember('car_' . $slug, 3600, function () use ($slug) {
            return Car::with('images')->where('slug', $slug)->firstOrFail();
        });

        return view('show', compact('car'));
    }
}
