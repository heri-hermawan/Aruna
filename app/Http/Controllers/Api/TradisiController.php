<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tradisi;
use Illuminate\Http\Request;

class TradisiController extends Controller
{
    public function index()
    {
        // Use explicit ordering to prevent pagination duplicates
        // When multiple records have the same created_at, we need ID as tiebreaker
        $tradisi = Tradisi::with('province')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(12);
        
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
            'message' => 'Tradisi created successfully',
            'data' => $tradisi
        ], 201);
    }

    public function show(Tradisi $tradisi)
    {
        $tradisi->load('province');
        
        return response()->json($tradisi);
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
            'message' => 'Tradisi updated successfully',
            'data' => $tradisi
        ], 200);
    }

    public function destroy(Tradisi $tradisi)
    {
        $tradisi->delete();

        return response()->json([
            'message' => 'Tradisi deleted successfully'
        ], 200);
    }
}
