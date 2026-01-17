<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    public function index(Request $request)
    {
        $query = Wisata::with('province')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc');
        
        // Cek apakah ada parameter 'all' untuk mengambil semua data
        if ($request->has('all') && $request->get('all') == 'true') {
            $wisata = $query->get();
            
            return response()->json([
                'success' => true,
                'message' => 'Semua data wisata berhasil diambil',
                'data' => $wisata,
                'total' => $wisata->count()
            ]);
        }
        
        // Default: gunakan pagination
        $perPage = $request->get('per_page', 12);
        $wisata = $query->paginate($perPage);
        
        return response()->json($wisata);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|string',
        ]);

        $wisata = Wisata::create($validated);
        $wisata->load('province');

        return response()->json([
            'success' => true,
            'message' => 'Wisata created successfully',
            'data' => $wisata
        ], 201);
    }

    public function show(Wisata $wisata)
    {
        $wisata->load('province');
        
        return response()->json([
            'success' => true,
            'data' => $wisata
        ]);
    }

    public function update(Request $request, Wisata $wisata)
    {
        $validated = $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|string',
        ]);

        $wisata->update($validated);
        $wisata->load('province');

        return response()->json([
            'success' => true,
            'message' => 'Wisata updated successfully',
            'data' => $wisata
        ], 200);
    }

    public function destroy(Wisata $wisata)
    {
        $wisata->delete();

        return response()->json([
            'success' => true,
            'message' => 'Wisata deleted successfully'
        ], 200);
    }
}