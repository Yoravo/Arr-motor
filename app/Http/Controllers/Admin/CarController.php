<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $cacheKey = 'cars_page_' . $page;

        $cars = Cache::remember($cacheKey, 600, function () {
            return Car::with('images')->latest()->paginate(10);
        });

        return view('admin.dashboard', compact('cars'));
    }

    public function show($slug)
    {
        $car = Cache::remember("car_{$slug}", 600, function () use ($slug) {
            return Car::with('images')->where('slug', $slug)->firstOrFail();
        });

        return view('admin.show', compact('car'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'merek' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'transmisi' => 'required|string|in:manual,matic',
            'bahan_bakar' => 'required|string|in:bensin,solar,listrik',
            'tahun' => 'required|integer|min:2000|max:' . date('Y'),
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:tersedia,terjual',
            'deskripsi' => 'nullable|string',
            'gambar1' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
            'gambar2' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
            'gambar3' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
            'gambar4' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
            'gambar5' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
            'opsional1' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
            'opsional2' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
            'opsional3' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
            'opsional4' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
            'opsional5' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
        ]);

        $baseSlug = Str::slug("{$validated['merek']} {$validated['nama']} {$validated['transmisi']} {$validated['tahun']}");
        $slug = $baseSlug;

        if (Car::where('slug', $slug)->exists()) {
            $slug .= '-' . now()->format('YmdHis');
        }

        $car = Car::create(array_merge($validated, ['slug' => $slug]));

        $this->clearCarPaginationCache();

        $angles = ['gambar1', 'gambar2', 'gambar3', 'gambar4', 'gambar5', 'opsional1', 'opsional2', 'opsional3', 'opsional4', 'opsional5'];
        $manager = new ImageManager(new Driver());

        foreach ($angles as $angle) {
            if ($request->hasFile($angle)) {
                $file = $request->file($angle);
                $filename = uniqid() . '.webp';
                $savePath = 'cars/' . $filename;

                $image = $manager->read($file)->cover(1600, 900);
                Storage::disk('public')->put($savePath, (string) $image->toWebp(80));

                $car->images()->create([
                    'angle' => $angle,
                    'image_path' => $savePath,
                ]);
            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Mobil berhasil ditambahkan.');
    }

    public function edit(Car $car)
    {
        return view('admin.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'merek' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'transmisi' => 'required|string|in:manual,matic',
            'bahan_bakar' => 'required|in:bensin,solar,listrik',
            'tahun' => 'required|integer|min:2000|max:' . date('Y'),
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:tersedia,terjual',
            'deskripsi' => 'nullable|string',
        ]);

        $car->update($validated);

        $baseSlug = Str::slug("{$validated['merek']} {$validated['nama']} {$validated['transmisi']} {$validated['tahun']}");
        $newSlug = $baseSlug;

        if ($car->slug !== $newSlug) {
            if (Car::where('slug', $newSlug)->where('id', '!=', $car->id)->exists()) {
                $newSlug .= '-' . now()->format('YmdHis');
            }
            $car->update(['slug' => $newSlug]);
            Cache::forget("car_{$newSlug}");
        } else {
            Cache::forget('car_' . $car->slug);
        }

        $this->clearCarPaginationCache();

        $angles = ['gambar1', 'gambar2', 'gambar3', 'gambar4', 'gambar5', 'opsional1', 'opsional2', 'opsional3', 'opsional4', 'opsional5'];
        $manager = new ImageManager(new Driver());

        foreach ($angles as $angle) {
            if ($request->hasFile($angle)) {
                $file = $request->file($angle);
                $filename = uniqid() . '.webp';
                $savePath = 'cars/' . $filename;

                $image = $manager->read($file)->cover(1600, 900);
                Storage::disk('public')->put($savePath, (string) $image->toWebp(80));

                $carImage = $car->images()->where('angle', $angle)->first();

                if ($carImage) {
                    Storage::disk('public')->delete($carImage->image_path);
                    $carImage->update(['image_path' => $savePath]);
                } else {
                    $car->images()->create([
                        'angle' => $angle,
                        'image_path' => $savePath,
                    ]);
                }
            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Data mobil dan gambar berhasil diperbarui.');
    }

    public function destroyImage(Car $car, CarImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        Cache::forget('car_' . $car->slug);
        $this->clearCarPaginationCache();

        return redirect()->route('cars.edit', $car->slug)->with('success', 'Gambar berhasil dihapus.');
    }

    public function destroy(Car $car)
    {
        Cache::forget('car_' . $car->slug);
        $this->clearCarPaginationCache();

        foreach ($car->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        $car->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Mobil berhasil dihapus.');
    }

    /**
     * Hapus semua cache halaman pagination mobil.
     */
    private function clearCarPaginationCache()
    {
        for ($i = 1; $i <= 10; $i++) {
            Cache::forget("cars_page_{$i}");
        }
    }
}
