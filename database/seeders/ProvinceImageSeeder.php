<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceImageSeeder extends Seeder
{
    /**
     * Seed province images with iconic landmarks/symbols
     */
    public function run(): void
    {
        $provinceImages = [
            'Aceh' => 'images/provinces/aceh.png',
            'Bali' => 'images/provinces/bali.png',
            'Banten' => 'images/provinces/banten.png', // Baduy, Ujung Kulon
            'Bengkulu' => 'images/provinces/bengkulu.png', // Rafflesia
            'DI Yogyakarta' => 'images/provinces/yogyakarta.png', // Candi Prambanan
            'DKI Jakarta' => 'images/provinces/jakarta.png', // Monas
            'Gorontalo' => 'images/provinces/gorontalo.png',
            'Jambi' => 'images/provinces/jambi.png', // Candi Muaro Jambi
            'Jawa Barat' => 'images/provinces/jawa-barat.png', // Gedung Sate
            'Jawa Tengah' => 'images/provinces/jawa-tengah.png', // Borobudur
            'Jawa Timur' => 'images/provinces/jawa-timur.png', // Bromo
            'Kalimantan Barat' => 'images/provinces/kalbar.png', // Tugu Khatulistiwa
            'Kalimantan Selatan' => 'images/provinces/kalsel.png', // Pasar Terapung
            'Kalimantan Tengah' => 'images/provinces/kalteng.png',
            'Kalimantan Timur' => 'images/provinces/kaltim.png',
            'Kalimantan Utara' => 'images/provinces/kaltara.png',
            'Kepulauan Bangka Belitung' => 'images/provinces/babel.png', // Pantai Tanjung Tinggi
            'Kepulauan Riau' => 'images/provinces/kepri.png',
            'Lampung' => 'images/provinces/lampung.png', // Siger
            'Maluku' => 'images/provinces/maluku.png',
            'Maluku Utara' => 'images/provinces/malut.png',
            'Nusa Tenggara Barat' => 'images/provinces/ntb.png', // Gunung Rinjani
            'Nusa Tenggara Timur' => 'images/provinces/ntt.png', // Komodo
            'Papua' => 'images/provinces/papua.png', // Cendrawasih
            'Papua Barat' => 'images/provinces/papua-barat.png', // Raja Ampat
            'Papua Barat Daya' => 'images/provinces/papua-barat-daya.png',
            'Papua Pegunungan' => 'images/provinces/papua-pegunungan.png',
            'Papua Selatan' => 'images/provinces/papua-selatan.png',
            'Papua Tengah' => 'images/provinces/papua-tengah.png',
            'Riau' => 'images/provinces/riau.png',
            'Sulawesi Barat' => 'images/provinces/sulbar.png',
            'Sulawesi Selatan' => 'images/provinces/sulsel.png', // Benteng Rotterdam
            'Sulawesi Tengah' => 'images/provinces/sulteng.png',
            'Sulawesi Tenggara' => 'images/provinces/sultra.png',
            'Sulawesi Utara' => 'images/provinces/sulut.png', // Bunaken
            'Sumatera Barat' => 'images/provinces/sumbar.png', // Jam Gadang
            'Sumatera Selatan' => 'images/provinces/sumsel.png', // Jembatan Ampera
            'Sumatera Utara' => 'images/provinces/sumut.png', // Danau Toba
        ];

        foreach ($provinceImages as $name => $image) {
            DB::table('provinces')
                ->where('name', $name)
                ->update(['image' => $image]);
        }
    }
}
