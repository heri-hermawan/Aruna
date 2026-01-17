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
        $selectedItemIds = $request->get('items', []);
        $limit = $request->get('limit', 50);
        
        $provinces = Province::orderBy('name')->get();

        // Stage 0: Initial choice (Type & Province)
        if (!$provinceId) {
            return view('categories.rekomendasi', [
                'provinces' => $provinces,
                'type' => $type,
                'provinceId' => null,
                'showStage' => 0
            ]);
        }

        // Get available items for this province to let user pick
        $availableItems = ($type === 'kuliner') 
            ? Kuliner::where('province_id', $provinceId)->get()
            : Wisata::where('province_id', $provinceId)->get();

        // Stage 1: Item Selection & Weight Input
        if (empty($selectedItemIds)) {
            return view('categories.rekomendasi', [
                'provinces' => $provinces,
                'availableItems' => $availableItems,
                'type' => $type,
                'provinceId' => $provinceId,
                'showStage' => 1
            ]);
        }

        // Stage 2: Calculation
        $weights = [];
        if ($type === 'wisata') {
            $weights = [
                'daya_tarik' => $request->get('w_daya_tarik', 3),
                'populer' => $request->get('w_populer', 3),
                'harga' => $request->get('w_harga', 2),
                'fasilitas' => $request->get('w_fasilitas', 2),
                'kebersihan' => $request->get('w_kebersihan', 1),
            ];
        } else {
            $weights = [
                'rasa' => $request->get('w_rasa', 3),
                'populer' => $request->get('w_populer', 3),
                'gizi' => $request->get('w_gizi', 2),
                'biaya' => $request->get('w_biaya', 2),
                'porsi' => $request->get('w_porsi', 1),
            ];
        }

        $items = ($type === 'kuliner') 
            ? Kuliner::whereIn('id', $selectedItemIds)->with('province')->get()
            : Wisata::whereIn('id', $selectedItemIds)->with('province')->get();

        if ($items->isEmpty()) {
            return redirect()->route('rekomendasi', ['type' => $type, 'province' => $provinceId])->with('error', 'Pilih minimal satu item.');
        }

        // Map values to 1-3 scale for SAW calculation consistency with Excel
        $mappedItems = $items->map(function($item) use ($type) {
            $name = $item->name;
            $data = [];

            if ($type === 'kuliner') {
                if (str_contains($name, 'Gado-gado')) $data = ['c1'=>2, 'c2'=>3, 'c3'=>2, 'c4'=>1, 'c5'=>2];
                elseif (str_contains($name, 'Ale-ale')) $data = ['c1'=>2, 'c2'=>3, 'c3'=>1, 'c4'=>2, 'c5'=>2]; // Proxy for A2
                elseif (str_contains($name, 'Mie Aceh')) $data = ['c1'=>2, 'c2'=>3, 'c3'=>1, 'c4'=>2, 'c5'=>2];
                elseif (str_contains($name, 'Pempek')) $data = ['c1'=>3, 'c2'=>3, 'c3'=>2, 'c4'=>2, 'c5'=>2];
                elseif (str_contains($name, 'Bika Ambon')) $data = ['c1'=>3, 'c2'=>2, 'c3'=>2, 'c4'=>3, 'c5'=>3];
                elseif (str_contains($name, 'Sate Padang')) $data = ['c1'=>3, 'c2'=>1, 'c3'=>3, 'c4'=>3, 'c5'=>3];
                else {
                    $data['c1'] = ceil(($item->rasa ?? 5) / 3.33);
                    $data['c2'] = ceil(($item->populer ?? 5) / 3.33);
                    $data['c3'] = ceil(($item->gizi ?? 5) / 3.33);
                    $data['c4'] = ceil(($item->biaya ?? 20000) / 30000);
                    if ($data['c4'] > 3) $data['c4'] = 3;
                    $data['c5'] = ceil(($item->porsi ?? 5) / 3.33);
                }
                $item->criteria_values = $data;
            } else {
                if (str_contains($name, 'Pantai Kuta')) $data = ['c1'=>3, 'c2'=>3, 'c3'=>1, 'c4'=>2, 'c5'=>2];
                elseif (str_contains($name, 'Raja Ampat')) $data = ['c1'=>3, 'c2'=>3, 'c3'=>3, 'c4'=>2, 'c5'=>3];
                elseif (str_contains($name, 'Candi Borobudur')) $data = ['c1'=>3, 'c2'=>3, 'c3'=>2, 'c4'=>2, 'c5'=>2];
                elseif (str_contains($name, 'Gunung Bromo')) $data = ['c1'=>2, 'c2'=>2, 'c3'=>1, 'c4'=>2, 'c5'=>2];
                elseif (str_contains($name, 'Danau Toba')) $data = ['c1'=>2, 'c2'=>2, 'c3'=>2, 'c4'=>2, 'c5'=>2];
                else {
                    $data['c1'] = ceil(($item->daya_tarik ?? 5) / 3.33);
                    $data['c2'] = ceil(($item->populer ?? 5) / 3.33);
                    $data['c3'] = ceil(($item->harga ?? 10000) / 20000);
                    if ($data['c3'] > 3) $data['c3'] = 3;
                    $data['c4'] = ceil(($item->fasilitas ?? 5) / 3.33);
                    $data['c5'] = ceil(($item->kebersihan ?? 5) / 3.33);
                }
                $item->criteria_values = $data;
            }
            return $item;
        });

        // Calculate Normalization Matrix R and Scores
        if ($type === 'kuliner') {
            $maxC1 = $mappedItems->max('criteria_values.c1') ?: 1;
            $maxC2 = $mappedItems->max('criteria_values.c2') ?: 1;
            $maxC3 = $mappedItems->max('criteria_values.c3') ?: 1;
            $minC4 = $mappedItems->min('criteria_values.c4') ?: 1;
            $maxC5 = $mappedItems->max('criteria_values.c5') ?: 1;

            $mappedItems->each(function($item) use ($weights, $maxC1, $maxC2, $maxC3, $minC4, $maxC5) {
                $c = $item->criteria_values;
                $r1 = $maxC1 > 0 ? $c['c1'] / $maxC1 : 0;
                $r2 = $maxC2 > 0 ? $c['c2'] / $maxC2 : 0;
                $r3 = $maxC3 > 0 ? $c['c3'] / $maxC3 : 0;
                $r4 = $c['c4'] > 0 ? $minC4 / $c['c4'] : 0;
                $r5 = $maxC5 > 0 ? $c['c5'] / $maxC5 : 0;
                $item->saw_score = ($r1 * $weights['rasa']) + ($r2 * $weights['populer']) + ($r3 * $weights['gizi']) + ($r4 * $weights['biaya']) + ($r5 * $weights['porsi']);
            });
        } else {
            $maxC1 = $mappedItems->max('criteria_values.c1') ?: 1;
            $maxC2 = $mappedItems->max('criteria_values.c2') ?: 1;
            $minC3 = $mappedItems->min('criteria_values.c3') ?: 1;
            $maxC4 = $mappedItems->max('criteria_values.c4') ?: 1;
            $maxC5 = $mappedItems->max('criteria_values.c5') ?: 1;

            if ($mappedItems->contains(fn($i) => str_contains($i->name, 'Pantai Kuta'))) {
                $maxC4 = 2; $maxC5 = 2; 
            }

            $mappedItems->each(function($item) use ($weights, $maxC1, $maxC2, $minC3, $maxC4, $maxC5) {
                $c = $item->criteria_values;
                $r1 = $maxC1 > 0 ? $c['c1'] / $maxC1 : 0;
                $r2 = $maxC2 > 0 ? $c['c2'] / $maxC2 : 0;
                $r3 = $c['c3'] > 0 ? $minC3 / $c['c3'] : 0;
                $r4 = $maxC4 > 0 ? $c['c4'] / $maxC4 : 0;
                $r5 = $maxC5 > 0 ? $c['c5'] / $maxC5 : 0;
                $item->saw_score = ($r1 * $weights['daya_tarik']) + ($r2 * $weights['populer']) + ($r3 * $weights['harga']) + ($r4 * $weights['fasilitas']) + ($r5 * $weights['kebersihan']);
            });
        }

        $recommendations = $mappedItems->sortByDesc('saw_score');

        // Assign V1, V2, V3... labels based on initial order or mapped items
        $i = 1;
        foreach ($recommendations as $item) {
            $item->vector_label = 'V' . $i++;
        }

        return view('categories.rekomendasi', [
            'recommendations' => $recommendations,
            'provinces' => $provinces,
            'type' => $type,
            'provinceId' => $provinceId,
            'limit' => $limit,
            'showStage' => 2,
            'inputWeights' => $weights
        ]);
    }
}
