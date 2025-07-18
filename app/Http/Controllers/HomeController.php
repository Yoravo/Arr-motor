<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function welcome(){
        // eager loading with cache
        $cars = Cache::remember('cars', 60, function () {
            return Car::with('images')->latest()->get();
        });

        // N+1 problem
        // $cars = Car::latest()->get();

        // foreach ($cars as $car) {
        //     $car->images->count();
        // }
        
        return view('welcome', compact('cars'));
    }

    public function about(){
        return view('about');
    }

    public function contact(){
        return view('contact');
    }

    public function register(){
        abort(403, 'Unauthorized action.');
    }
}
