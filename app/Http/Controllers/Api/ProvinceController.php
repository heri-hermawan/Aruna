<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Tradisi;
use App\Models\Peraturan;
use App\Models\Wisata;
use App\Models\Kuliner;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::withCount(['tradisis', 'peraturans', 'wisatas', 'kuliners'])
            ->orderBy('name')
            ->get();
            
        return response()->json($provinces);
    }

    public function show(Province $province)
    {
        $province->load(['tradisis', 'peraturans', 'wisatas', 'kuliners']);
        
        return response()->json($province);
    }

    public function tradisi(Province $province)
    {
        $tradisi = $province->tradisis()->get();
        
        return response()->json($tradisi);
    }

    public function peraturan(Province $province)
    {
        $peraturan = $province->peraturans()->get();
        
        return response()->json($peraturan);
    }

    public function wisata(Province $province)
    {
        $wisata = $province->wisatas()->get();
        
        return response()->json($wisata);
    }

    public function kuliner(Province $province)
    {
        $kuliner = $province->kuliners()->get();
        
        return response()->json($kuliner);
    }

    // Get all items for each category
    public function allTradisi()
    {
        $tradisi = Tradisi::with('province')->latest()->paginate(12);
        
        return response()->json($tradisi);
    }

    public function allPeraturan()
    {
        $peraturan = Peraturan::with('province')->latest()->paginate(12);
        
        return response()->json($peraturan);
    }

    public function allWisata()
    {
        $wisata = Wisata::with('province')->latest()->paginate(12);
        
        return response()->json($wisata);
    }

    public function allKuliner()
    {
        $kuliner = Kuliner::with('province')->latest()->paginate(12);
        
        return response()->json($kuliner);
    }

    // CRUD Operations
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:provinces,name',
            'code' => 'nullable|string|max:10',
            'image' => 'nullable|string',
        ]);

        $province = Province::create($validated);

        return response()->json([
            'message' => 'Province created successfully',
            'data' => $province
        ], 201);
    }

    public function update(Request $request, Province $province)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:provinces,name,' . $province->id,
            'code' => 'nullable|string|max:10',
            'image' => 'nullable|string',
        ]);

        $province->update($validated);

        return response()->json([
            'message' => 'Province updated successfully',
            'data' => $province
        ], 200);
    }

    public function destroy(Province $province)
    {
        $province->delete();

        return response()->json([
            'message' => 'Province deleted successfully'
        ], 200);
    }
}
