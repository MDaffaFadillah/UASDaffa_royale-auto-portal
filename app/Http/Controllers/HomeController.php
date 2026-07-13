<?php

namespace App\Http\Controllers;

use App\Models\LuxuryCar;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil semua data mobil untuk ditampilkan di halaman utama
        $cars = LuxuryCar::all();
        
        return view('index', compact('cars'));
    }

    public function show($id)
    {
        $car = LuxuryCar::findOrFail($id);
        return view('detail', compact('car'));
    }
}