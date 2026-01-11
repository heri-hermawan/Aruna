<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kuliner;
use Illuminate\Http\Request;

class KulinerController extends Controller
{
    public function index()
    {
        $kuliner = Kuliner::with('province')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(12);
        
        return response()->json($kuliner);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|string',
        ]);

        $kuliner = Kuliner::create($validated);
        $kuliner->load('province');

        return response()->json([
            'message' => 'Kuliner created successfully',
            'data' => $kuliner
        ], 201);
    }

    public function show(Kuliner $kuliner)
    {
        $kuliner->load('province');
        
        return response()->json($kuliner);
    }

    public function update(Request $request, Kuliner $kuliner)
    {
        $validated = $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|string',
        ]);

        $kuliner->update($validated);
        $kuliner->load('province');

        return response()->json([
            'message' => 'Kuliner updated successfully',
            'data' => $kuliner
        ], 200);
    }

    public function destroy(Kuliner $kuliner)
    {
        $kuliner->delete();

        return response()->json([
            'message' => 'Kuliner deleted successfully'
        ], 200);
    }
}
