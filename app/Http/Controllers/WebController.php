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
        return view('chatbot.index');
    }

    public function rekomendasi(Request $request)
    {
        $type = $request->get('type', 'wisata');
        $provinceId = $request->get('province');
        $limit = $request->get('limit', 50);
        
        $provinces = Province::orderBy('name')->get();
        
        // Get recommendations based on type
        if ($type === 'kuliner') {
            if ($provinceId) {
                $recommendations = Kuliner::where('province_id', $provinceId)->with('province')->inRandomOrder()->take($limit)->get();
            } else {
                $recommendations = Kuliner::with('province')->inRandomOrder()->take($limit)->get();
            }
        } elseif ($type === 'all') {
            // Combine wisata and kuliner
            $wisataCount = intval($limit / 2);
            $kulinerCount = $limit - $wisataCount;
            
            $wisatas = Wisata::with('province')->inRandomOrder()->take($wisataCount)->get();
            $kuliners = Kuliner::with('province')->inRandomOrder()->take($kulinerCount)->get();
            
            $recommendations = collect();
            foreach ($wisatas as $w) {
                $recommendations->push($w);
            }
            foreach ($kuliners as $k) {
                $recommendations->push($k);
            }
            $recommendations = $recommendations->shuffle();
        } else {
            if ($provinceId) {
                $recommendations = Wisata::where('province_id', $provinceId)->with('province')->inRandomOrder()->take($limit)->get();
            } else {
                $recommendations = Wisata::with('province')->inRandomOrder()->take($limit)->get();
            }
        }
        
        // Sort by saw_score if available, otherwise by ratings
        if ($type === 'kuliner') {
            $recommendations = $recommendations->sortByDesc(function($item) {
                if (!isset($item->rasa)) return 0;
                $weights = ['rasa' => 5, 'populer' => 4, 'gizi' => 3, 'biaya' => 2, 'porsi' => 1];
                $rasa = $item->rasa ?? 5;
                $populer = $item->populer ?? 5;
                $gizi = $item->gizi ?? 5;
                $biaya = $item->biaya ?? 50000;
                $porsi = $item->porsi ?? 5;
                
                $maxRasa = 10;
                $maxPopuler = 10;
                $maxGizi = 10;
                $minBiaya = 5000;
                $maxPorsi = 10;
                
                $r1 = $maxRasa > 0 ? $rasa / $maxRasa : 0;
                $r2 = $maxPopuler > 0 ? $populer / $maxPopuler : 0;
                $r3 = $maxGizi > 0 ? $gizi / $maxGizi : 0;
                $r4 = $biaya > 0 ? $minBiaya / $biaya : 0;
                $r5 = $maxPorsi > 0 ? $porsi / $maxPorsi : 0;
                
                return ($r1 * $weights['rasa']) + ($r2 * $weights['populer']) + ($r3 * $weights['gizi']) + ($r4 * $weights['biaya']) + ($r5 * $weights['porsi']);
            });
        } else {
            $recommendations = $recommendations->sortByDesc(function($item) {
                if (!isset($item->daya_tarik)) return 0;
                $weights = ['daya_tarik' => 7, 'populer' => 7, 'harga' => 5, 'fasilitas' => 3, 'kebersihan' => 1];
                $dayaTarik = $item->daya_tarik ?? 5;
                $populer = $item->populer ?? 5;
                $harga = $item->harga ?? 50000;
                $fasilitas = $item->fasilitas ?? 5;
                $kebersihan = $item->kebersihan ?? 5;
                
                $maxDayaTarik = 10;
                $maxPopuler = 10;
                $minHarga = 0;
                $maxFasilitas = 10;
                $maxKebersihan = 10;
                
                $r1 = $maxDayaTarik > 0 ? $dayaTarik / $maxDayaTarik : 0;
                $r2 = $maxPopuler > 0 ? $populer / $maxPopuler : 0;
                $r3 = $harga > 0 ? $minHarga / $harga : 0;
                $r4 = $maxFasilitas > 0 ? $fasilitas / $maxFasilitas : 0;
                $r5 = $maxKebersihan > 0 ? $kebersihan / $maxKebersihan : 0;
                
                return ($r1 * $weights['daya_tarik']) + ($r2 * $weights['populer']) + ($r3 * $weights['harga']) + ($r4 * $weights['fasilitas']) + ($r5 * $weights['kebersihan']);
            });
        }
        
        return view('categories.rekomendasi', compact('recommendations', 'provinces', 'type', 'provinceId', 'limit'));
    }
}
