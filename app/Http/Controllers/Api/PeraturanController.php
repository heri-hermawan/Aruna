<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Peraturan;
use Illuminate\Http\Request;

class PeraturanController extends Controller
{
    public function index()
    {
        $peraturan = Peraturan::with('province')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(12);
        
        return response()->json($peraturan);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'document' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $peraturan = Peraturan::create($validated);
        $peraturan->load('province');

        return response()->json([
            'message' => 'Peraturan created successfully',
            'data' => $peraturan
        ], 201);
    }

    public function show(Peraturan $peraturan)
    {
        $peraturan->load('province');
        
        return response()->json($peraturan);
    }

    public function update(Request $request, Peraturan $peraturan)
    {
        $validated = $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'document' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $peraturan->update($validated);
        $peraturan->load('province');

        return response()->json([
            'message' => 'Peraturan updated successfully',
            'data' => $peraturan
        ], 200);
    }

    public function destroy(Peraturan $peraturan)
    {
        $peraturan->delete();

        return response()->json([
            'message' => 'Peraturan deleted successfully'
        ], 200);
    }
}
