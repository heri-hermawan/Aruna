<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        $provinces = [
            ['name' => 'Aceh', 'code' => 'AC', 'image' => 'images/provinces/aceh_mosque.png'],
            ['name' => 'Sumatera Utara', 'code' => 'SU', 'image' => 'images/provinces/sumut_landmark.png'],
            ['name' => 'Sumatera Barat', 'code' => 'SB', 'image' => 'images/provinces/sumbar_jam_gadang.png'],
            ['name' => 'Riau', 'code' => 'RI', 'image' => 'images/provinces/riau.png'],
            ['name' => 'Jambi', 'code' => 'JA', 'image' => 'images/provinces/jambi_tugu_keris.jpg'],
            ['name' => 'Sumatera Selatan', 'code' => 'SS', 'image' => 'images/provinces/sumsel_ampera.png'],
            ['name' => 'Bengkulu', 'code' => 'BE', 'image' => 'images/provinces/bengkulu_landmark.png'],
            ['name' => 'Lampung', 'code' => 'LA', 'image' => 'images/provinces/lampung_siger.png'],
            ['name' => 'Kepulauan Bangka Belitung', 'code' => 'BB', 'image' => 'images/provinces/babel_lighthouse.png'],
            ['name' => 'Kepulauan Riau', 'code' => 'KR', 'image' => 'images/provinces/kepri_bridge.png'],
            ['name' => 'DKI Jakarta', 'code' => 'JK', 'image' => 'images/provinces/dki_jakarta.png'],
            ['name' => 'Jawa Barat', 'code' => 'JB', 'image' => 'images/provinces/jabar_monju.png'],
            ['name' => 'Jawa Tengah', 'code' => 'JT', 'image' => 'images/provinces/jawa_tengah.png'],
            ['name' => 'DI Yogyakarta', 'code' => 'YO', 'image' => 'images/provinces/di_yogyakarta.png'],
            ['name' => 'Jawa Timur', 'code' => 'JI', 'image' => 'images/provinces/jawa_timur.png'],
            ['name' => 'Banten', 'code' => 'BT', 'image' => 'images/provinces/banten_masjid_agung.jpg'],
            ['name' => 'Bali', 'code' => 'BA', 'image' => 'images/provinces/bali_handara_gate.jpg'],
            ['name' => 'Nusa Tenggara Barat', 'code' => 'NB', 'image' => 'images/provinces/ntb_roundabout.png'],
            ['name' => 'Nusa Tenggara Timur', 'code' => 'NT', 'image' => 'images/provinces/ntt_gong_perdamaian.png'],
            ['name' => 'Kalimantan Barat', 'code' => 'KB', 'image' => 'images/provinces/kalimantan_barat.png'],
            ['name' => 'Kalimantan Tengah', 'code' => 'KT', 'image' => 'images/provinces/kalimantan_tengah.png'],
            ['name' => 'Kalimantan Selatan', 'code' => 'KS', 'image' => 'images/provinces/kalimantan_selatan.png'],
            ['name' => 'Kalimantan Timur', 'code' => 'KI', 'image' => 'images/provinces/kalimantan_timur.png'],
            ['name' => 'Kalimantan Utara', 'code' => 'KU', 'image' => 'images/provinces/kaltara_enggang.jpg'],
            ['name' => 'Sulawesi Utara', 'code' => 'SA', 'image' => 'images/provinces/sulut_scenic.png'],
            ['name' => 'Sulawesi Tengah', 'code' => 'ST', 'image' => 'images/provinces/sulawesi-tengah.png'],
            ['name' => 'Sulawesi Selatan', 'code' => 'SN', 'image' => 'images/provinces/sulsel_tongkonan.png'],
            ['name' => 'Sulawesi Tenggara', 'code' => 'SG', 'image' => 'images/provinces/sultra_mtq.png'],
            ['name' => 'Gorontalo', 'code' => 'GO', 'image' => 'images/provinces/gorontalo.png'],
            ['name' => 'Sulawesi Barat', 'code' => 'SR', 'image' => 'images/provinces/sulawesi-barat.png'],
            ['name' => 'Maluku', 'code' => 'MA', 'image' => 'images/provinces/maluku_pattimura.png'],
            ['name' => 'Maluku Utara', 'code' => 'MU', 'image' => 'images/provinces/malut_ora.png'],
            ['name' => 'Papua', 'code' => 'PA', 'image' => 'images/provinces/papua.png'],
            ['name' => 'Papua Barat', 'code' => 'PB', 'image' => 'images/provinces/papua-barat.png'],
            ['name' => 'Papua Selatan', 'code' => 'PS', 'image' => 'images/provinces/papua-selatan.png'],
            ['name' => 'Papua Tengah', 'code' => 'PT', 'image' => 'images/provinces/papua_tengah_custom.png'],
            ['name' => 'Papua Pegunungan', 'code' => 'PP', 'image' => 'images/provinces/papua-pegunungan.png'],
            ['name' => 'Papua Barat Daya', 'code' => 'PD', 'image' => 'images/provinces/papua-barat-daya.png'],
        ];

        foreach ($provinces as $province) {
            Province::create($province);
        }
    }
}
