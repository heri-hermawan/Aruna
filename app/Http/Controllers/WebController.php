<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Tradisi;
use App\Models\Peraturan;
use App\Models\Wisata;
use App\Models\Kuliner;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home()
    {
        $featuredProvinces = Province::withCount(['tradisis', 'peraturans', 'wisatas', 'kuliners'])
            ->inRandomOrder()
            ->take(6)
            ->get();
            
        return view('home', compact('featuredProvinces'));
    }

    public function provinces(Request $request)
    {
        $search = $request->get('search');
        
        $provinces = Province::withCount(['tradisis', 'peraturans', 'wisatas', 'kuliners'])
            ->when($search, function($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->get();
            
        return view('provinces', compact('provinces', 'search'));
    }

    public function provinceDetail(Province $province)
    {
        $province->load(['tradisis', 'peraturans', 'wisatas', 'kuliners']);
        
        return view('province-detail', compact('province'));
    }

    public function tradisi(Request $request)
    {
        $search = $request->get('search');
        $provinceId = $request->get('province');
        
        $tradisis = Tradisi::with('province')
            ->when($search, function($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            })
            ->when($provinceId, function($query, $provinceId) {
                $query->where('province_id', $provinceId);
            })
            ->latest()
            ->paginate(12);
            
        $provinces = Province::orderBy('name')->get();
        
        return view('categories.tradisi', compact('tradisis', 'provinces', 'search', 'provinceId'));
    }

    public function peraturan(Request $request)
    {
        $search = $request->get('search');
        $provinceId = $request->get('province');
        $type = $request->get('type');
        
        $provincesWithPeraturans = Province::with(['peraturans' => function($query) use ($search, $type) {
                $query->when($search, function($q, $search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                })
                ->when($type, function($q, $type) {
                    $q->where('type', $type);
                })
                ->latest();
            }])
            ->whereHas('peraturans', function($query) use ($search, $type) {
                $query->when($search, function($q, $search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                })
                ->when($type, function($q, $type) {
                    $q->where('type', $type);
                });
            })
            ->when($provinceId, function($query, $provinceId) {
                $query->where('id', $provinceId);
            })
            ->orderBy('name')
            ->get();
            
        $provinces = Province::orderBy('name')->get();
        
        return view('categories.peraturan', compact('provincesWithPeraturans', 'provinces', 'search', 'provinceId', 'type'));
    }

    public function wisata(Request $request)
    {
        $search = $request->get('search');
        $provinceId = $request->get('province');
        
        $wisatas = Wisata::with('province')
            ->when($search, function($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            })
            ->when($provinceId, function($query, $provinceId) {
                $query->where('province_id', $provinceId);
            })
            ->latest()
            ->paginate(12);
            
        $provinces = Province::orderBy('name')->get();
        
        return view('categories.wisata', compact('wisatas', 'provinces', 'search', 'provinceId'));
    }

    public function kuliner(Request $request)
    {
        $search = $request->get('search');
        $provinceId = $request->get('province');
        
        $kuliners = Kuliner::with('province')
            ->when($search, function($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            })
            ->when($provinceId, function($query, $provinceId) {
                $query->where('province_id', $provinceId);
            })
            ->latest()
            ->paginate(12);
            
        $provinces = Province::orderBy('name')->get();
        
        return view('categories.kuliner', compact('kuliners', 'provinces', 'search', 'provinceId'));
    }

    public function chat()
    {
        return view('chat');
    }
}
