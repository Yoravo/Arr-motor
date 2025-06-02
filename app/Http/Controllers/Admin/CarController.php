<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::with('images')->get();
        return view('admin.cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'merk' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'transmisi' => 'required|string|max:50',
            'bahan_bakar' => 'required|string|max:50',
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:available,unavailable',
            'deskripsi' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $car = Car::create($validated);

        if ($request->hasFile('images')){
            foreach ($request->file('images') as $img) {
                $path = $img->store('cars', 'public');
                $car->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.cars.index')->with('success', 'Mobil berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $car->load('images');
        return view('admin.cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'merk' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'transmisi' => 'required|string|max:50',
            'bahan_bakar' => 'required|string|max:50',
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:available,unavailable',
            'deskripsi' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $car->update($validated);

        if ($request->hasFile('images')){
            foreach ($request->file('images') as $img) {
                $path = $img->store('cars', 'public');
                $car->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.cars.index')->with('success', 'Mobil berhasil diperbarui.');
    }
}
