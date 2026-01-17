<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tradisi;
use Illuminate\Http\Request;

class TradisiController extends Controller
{
    public function index(Request $request)
    {
        $query = Tradisi::with('province')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc');
        
        // Cek apakah ada parameter 'all' untuk mengambil semua data
        if ($request->has('all') && $request->get('all') == 'true') {
            $tradisi = $query->get();
            
            return response()->json([
                'success' => true,
                'message' => 'Semua data tradisi berhasil diambil',
                'data' => $tradisi,
                'total' => $tradisi->count()
            ]);
        }
        
        // Default: gunakan pagination
        $perPage = $request->get('per_page', 12);
        $tradisi = $query->paginate($perPage);
        
        return response()->json($tradisi);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|string',
        ]);

        $tradisi = Tradisi::create($validated);
        $tradisi->load('province');

        return response()->json([
            'success' => true,
            'message' => 'Tradisi created successfully',
            'data' => $tradisi
        ], 201);
    }

    public function show(Tradisi $tradisi)
    {
        $tradisi->load('province');
        
        return response()->json([
            'success' => true,
            'data' => $tradisi
        ]);
    }

    public function update(Request $request, Tradisi $tradisi)
    {
        $validated = $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|string',
        ]);

        $tradisi->update($validated);
        $tradisi->load('province');

        return response()->json([
            'success' => true,
            'message' => 'Tradisi updated successfully',
            'data' => $tradisi
        ], 200);
    }

    public function destroy(Tradisi $tradisi)
    {
        $tradisi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tradisi deleted successfully'
        ], 200);
    }
}