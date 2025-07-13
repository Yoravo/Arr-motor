<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $page = $request->get('page', 1);
        $cacheKey = 'cars_page_' . $page;

        $cars = Cache::remember($cacheKey, now()->addMinutes(10), function () {
            return Car::with('images')->latest()->paginate(10);
        });

        return view('admin.dashboard', compact('cars'));
    }
}
