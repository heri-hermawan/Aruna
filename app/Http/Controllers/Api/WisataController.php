<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    public function index()
    {
        $wisata = Wisata::with('province')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(12);
        
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
            'message' => 'Wisata created successfully',
            'data' => $wisata
        ], 201);
    }

    public function show(Wisata $wisata)
    {
        $wisata->load('province');
        
        return response()->json($wisata);
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
            'message' => 'Wisata updated successfully',
            'data' => $wisata
        ], 200);
    }

    public function destroy(Wisata $wisata)
    {
        $wisata->delete();

        return response()->json([
            'message' => 'Wisata deleted successfully'
        ], 200);
    }
}
