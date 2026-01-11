<?php

namespace Database\Seeders;

use App\Models\Peraturan;
use App\Models\Province;
use Illuminate\Database\Seeder;

class PeraturanSeeder extends Seeder
{
    public function run(): void
    {
        $provinces = Province::all()->keyBy('id');
        
        $peraturanData = [
            // 1. Aceh
            ['province_id' => 1, 'name' => 'Qanun Aceh No. 6 Tahun 2014', 'description' => 'Tentang Hukum Jinayat yang mengatur hukuman cambuk untuk pelanggaran syariat Islam'],
            ['province_id' => 1, 'name' => 'Qanun Aceh No. 8 Tahun 2014', 'description' => 'Tentang Pokok-Pokok Syariat Islam'],
            ['province_id' => 1, 'name' => 'Qanun Aceh No. 11 Tahun 2018', 'description' => 'Tentang Perlindungan Anak'],
            
            // 2. Sumatera Utara
            ['province_id' => 2, 'name' => 'Perda Sumut No. 5 Tahun 2020', 'description' => 'Tentang Pengelolaan Sampah'],
            ['province_id' => 2, 'name' => 'Perda Sumut No. 2 Tahun 2019', 'description' => 'Tentang Rencana Tata Ruang Wilayah Provinsi'],
            ['province_id' => 2, 'name' => 'Perda Sumut No. 1 Tahun 2021', 'description' => 'Tentang Penyelenggaraan Kawasan Ekonomi Khusus'],
            
            // 3. Sumatera Barat
            ['province_id' => 3, 'name' => 'Perda Sumbar No. 7 Tahun 2018', 'description' => 'Tentang Pelestarian dan Pengembangan Nagari'],
            ['province_id' => 3, 'name' => 'Perda Sumbar No. 6 Tahun 2020', 'description' => 'Tentang Penyelenggaraan Pendidikan'],
            ['province_id' => 3, 'name' => 'Perda Sumbar No. 9 Tahun 2019', 'description' => 'Tentang Pelestarian Adat Basandi Syara\', Syara\' Basandi Kitabullah'],
            
            // 4. Riau
            ['province_id' => 4, 'name' => 'Perda Riau No. 1 Tahun 2019', 'description' => 'Tentang Rencana Pembangunan Jangka Menengah Daerah'],
            ['province_id' => 4, 'name' => 'Perda Riau No. 10 Tahun 2020', 'description' => 'Tentang Pengelolaan Lingkungan Hidup'],
            ['province_id' => 4, 'name' => 'Perda Riau No. 6 Tahun 2018', 'description' => 'Tentang Penyelenggaraan Kepemudaan'],
            
            // 5. Jambi
            ['province_id' => 5, 'name' => 'Perda Jambi No. 7 Tahun 2020', 'description' => 'Tentang Rencana Tata Ruang Wilayah Provinsi'],
            ['province_id' => 5, 'name' => 'Perda Jambi No. 3 Tahun 2021', 'description' => 'Tentang Pengelolaan Hutan Lindung'],
            ['province_id' => 5, 'name' => 'Perda Jambi No. 5 Tahun 2019', 'description' => 'Tentang Penyelenggaraan Pariwisata'],
            
            // 6. Sumatera Selatan
            ['province_id' => 6, 'name' => 'Perda Sumsel No. 14 Tahun 2020', 'description' => 'Tentang Rencana Induk Pariwisata Daerah'],
            ['province_id' => 6, 'name' => 'Perda Sumsel No. 8 Tahun 2019', 'description' => 'Tentang Pengelolaan Sungai Musi'],
            ['province_id' => 6, 'name' => 'Perda Sumsel No. 11 Tahun 2021', 'description' => 'Tentang Perlindungan Lahan Pertanian Pangan Berkelanjutan'],
            
            // 7. Bengkulu
            ['province_id' => 7, 'name' => 'Perda Bengkulu No. 5 Tahun 2019', 'description' => 'Tentang Penyelenggaraan Kesehatan'],
            ['province_id' => 7, 'name' => 'Perda Bengkulu No. 7 Tahun 2020', 'description' => 'Tentang Kawasan Tanpa Rokok'],
            ['province_id' => 7, 'name' => 'Perda Bengkulu No. 3 Tahun 2021', 'description' => 'Tentang Pengelolaan Pasar Rakyat'],
            
            // 8. Lampung
            ['province_id' => 8, 'name' => 'Perda Lampung No. 1 Tahun 2020', 'description' => 'Tentang Rencana Tata Ruang Wilayah Provinsi'],
            ['province_id' => 8, 'name' => 'Perda Lampung No. 9 Tahun 2019', 'description' => 'Tentang Penyelenggaraan Pendidikan'],
            ['province_id' => 8, 'name' => 'Perda Lampung No. 5 Tahun 2018', 'description' => 'Tentang Pelestarian Kebudayaan Lampung'],
            
            // 9. Bangka Belitung
            ['province_id' => 9, 'name' => 'Perda Babel No. 6 Tahun 2020', 'description' => 'Tentang Pengelolaan Pertambangan Timah Berkelanjutan'],
            ['province_id' => 9, 'name' => 'Perda Babel No. 8 Tahun 2019', 'description' => 'Tentang Konservasi Laut'],
            ['province_id' => 9, 'name' => 'Perda Babel No. 4 Tahun 2021', 'description' => 'Tentang Penyelenggaraan Pariwisata Berkelanjutan'],
            
            // 10. Kepulauan Riau
            ['province_id' => 10, 'name' => 'Perda Kepri No. 2 Tahun 2020', 'description' => 'Tentang Pengelolaan Kawasan Ekonomi Khusus'],
            ['province_id' => 10, 'name' => 'Perda Kepri No. 7 Tahun 2019', 'description' => 'Tentang Pelestarian Budaya Melayu'],
            ['province_id' => 10, 'name' => 'Perda Kepri No. 5 Tahun 2018', 'description' => 'Tentang Penyelenggaraan Perdagangan Bebas'],
            
            // 11. DKI Jakarta
            ['province_id' => 11, 'name' => 'Perda DKI No. 3 Tahun 2020', 'description' => 'Tentang Penanggulangan dan Peningkatan Kualitas Terhadap Penyandang Masalah Kesejahteraan Sosial'],
            ['province_id' => 11, 'name' => 'Perda DKI No. 8 Tahun 2019', 'description' => 'Tentang Pengelolaan Sampah'],
            ['province_id' => 11, 'name' => 'Perda DKI No. 1 Tahun 2021', 'description' => 'Tentang Penyelenggaraan Transportasi Umum'],
            
            // 12. Jawa Barat
            ['province_id' => 12, 'name' => 'Perda Jabar No. 2 Tahun 2020', 'description' => 'Tentang Penyelenggaraan Sistem Pemerintahan Berbasis Elektronik'],
            ['province_id' => 12, 'name' => 'Perda Jabar No. 22 Tahun 2010', 'description' => 'Tentang Rencana Tata Ruang Wilayah Provinsi'],
            ['province_id' => 12, 'name' => 'Perda Jabar No. 9 Tahun 2020', 'description' => 'Tentang Pelestarian dan Pengembangan Bahasa Sunda'],
            
            // 13. Jawa Tengah
            ['province_id' => 13, 'name' => 'Perda Jateng No. 5 Tahun 2019', 'description' => 'Tentang Pengelolaan Kualitas Air dan Pengendalian Pencemaran Air'],
            ['province_id' => 13, 'name' => 'Perda Jateng No. 10 Tahun 2020', 'description' => 'Tentang Rencana Induk Pariwisata Daerah'],
            ['province_id' => 13, 'name' => 'Perda Jateng No. 1 Tahun 2021', 'description' => 'Tentang Pelestarian Kebudayaan Jawa'],
            
            // 14. DI Yogyakarta
            ['province_id' => 14, 'name' => 'Perda DIY No. 5 Tahun 2019', 'description' => 'Tentang Pemeliharaan dan Pengembangan Kebudayaan'],
            ['province_id' => 14, 'name' => 'Perda DIY No. 1 Tahun 2020', 'description' => 'Tentang Penyelenggaraan Keistimewaan'],
            ['province_id' => 14, 'name' => 'Perda DIY No. 6 Tahun 2018', 'description' => 'Tentang Pengelolaan Kawasan Cagar Budaya'],
            
            // 15. Jawa Timur
            ['province_id' => 15, 'name' => 'Perda Jatim No. 6 Tahun 2019', 'description' => 'Tentang Rencana Tata Ruang Wilayah Provinsi'],
            ['province_id' => 15, 'name' => 'Perda Jatim No. 3 Tahun 2020', 'description' => 'Tentang Penyelenggaraan Industri'],
            ['province_id' => 15, 'name' => 'Perda Jatim No. 9 Tahun 2021', 'description' => 'Tentang Perlindungan dan Pemberdayaan Petani'],
            
            // 16. Banten
            ['province_id' => 16, 'name' => 'Perda Banten No. 7 Tahun 2019', 'description' => 'Tentang Rencana Tata Ruang Wilayah Provinsi'],
            ['province_id' => 16, 'name' => 'Perda Banten No. 2 Tahun 2020', 'description' => 'Tentang Pengelolaan Kawasan Industri'],
            ['province_id' => 16, 'name' => 'Perda Banten No. 4 Tahun 2021', 'description' => 'Tentang Perlindungan Nelayan Tradisional'],
            
            // 17. Bali
            ['province_id' => 17, 'name' => 'Perda Bali No. 4 Tahun 2019', 'description' => 'Tentang Desa Adat di Bali'],
            ['province_id' => 17, 'name' => 'Perda Bali No. 7 Tahun 2020', 'description' => 'Tentang Pengelolaan Sampah Plastik'],
            ['province_id' => 17, 'name' => 'Perda Bali No. 2 Tahun 2021', 'description' => 'Tentang Kualitas Pariwisata Budaya'],
            
            // 18. Nusa Tenggara Barat
            ['province_id' => 18, 'name' => 'Perda NTB No. 7 Tahun 2020', 'description' => 'Tentang Pengelolaan Pariwisata Halal'],
            ['province_id' => 18, 'name' => 'Perda NTB No. 3 Tahun 2019', 'description' => 'Tentang Rencana Tata Ruang Wilayah Provinsi'],
            ['province_id' => 18, 'name' => 'Perda NTB No. 5 Tahun 2021', 'description' => 'Tentang Pelestarian Kebudayaan Sasak'],
            
            // 19. Nusa Tenggara Timur
            ['province_id' => 19, 'name' => 'Perda NTT No. 1 Tahun 2020', 'description' => 'Tentang Perlindungan Taman Nasional Komodo'],
            ['province_id' => 19, 'name' => 'Perda NTT No. 8 Tahun 2019', 'description' => 'Tentang Penyelenggaraan Kepariwisataan'],
            ['province_id' => 19, 'name' => 'Perda NTT No. 4 Tahun 2021', 'description' => 'Tentang Konservasi Tenun Tradisional'],
            
            // 20. Kalimantan Barat
            ['province_id' => 20, 'name' => 'Perda Kalbar No. 1 Tahun 2020', 'description' => 'Tentang Perlindungan Hutan Adat Dayak'],
            ['province_id' => 20, 'name' => 'Perda Kalbar No. 6 Tahun 2019', 'description' => 'Tentang Rencana Tata Ruang Wilayah'],
            ['province_id' => 20, 'name' => 'Perda Kalbar No. 3 Tahun 2021', 'description' => 'Tentang Pengelolaan Sungai Kapuas'],
            
            // 21. Kalimantan Tengah
            ['province_id' => 21, 'name' => 'Perda Kalteng No. 5 Tahun 2020', 'description' => 'Tentang Perlindungan Orangutan'],
            ['province_id' => 21, 'name' => 'Perda Kalteng No. 2 Tahun 2019', 'description' => 'Tentang Pelestarian Budaya Dayak'],
            ['province_id' => 21, 'name' => 'Perda Kalteng No. 7 Tahun 2021', 'description' => 'Tentang Pengelolaan Lahan Gambut'],
            
            // 22. Kalimantan Selatan
            ['province_id' => 22, 'name' => 'Perda Kalsel No. 9 Tahun 2020', 'description' => 'Tentang Pengelolaan Pasar Terapung'],
            ['province_id' => 22, 'name' => 'Perda Kalsel No. 3 Tahun 2019', 'description' => 'Tentang Rencana Tata Ruang Wilayah'],
            ['province_id' => 22, 'name' => 'Perda Kalsel No. 5 Tahun 2021', 'description' => 'Tentang Pengembangan Industri Batu Permata'],
            
            // 23. Kalimantan Timur
            ['province_id' => 23, 'name' => 'Perda Kaltim No. 1 Tahun 2020', 'description' => 'Tentang Perlindungan Kawasan Konservasi Laut'],
            ['province_id' => 23, 'name' => 'Perda Kaltim No. 7 Tahun 2019', 'description' => 'Tentang Rencana Zonasi Wilayah Pesisir'],
            ['province_id' => 23, 'name' => 'Perda Kaltim No. 4 Tahun 2021', 'description' => 'Tentang Penyelenggaraan Pertambangan Berkelanjutan'],
            
            // 24. Kalimantan Utara
            ['province_id' => 24, 'name' => 'Perda Kaltara No. 2 Tahun 2020', 'description' => 'Tentang Rencana Tata Ruang Wilayah Provinsi'],
            ['province_id' => 24, 'name' => 'Perda Kaltara No. 5 Tahun 2019', 'description' => 'Tentang Perlindungan Hutan Lindung'],
            ['province_id' => 24, 'name' => 'Perda Kaltara No. 3 Tahun 2021', 'description' => 'Tentang Pengelolaan Perbatasan Negara'],
            
            // 25. Sulawesi Utara
            ['province_id' => 25, 'name' => 'Perda Sulut No. 6 Tahun 2020', 'description' => 'Tentang Perlindungan Taman Laut Bunaken'],
            ['province_id' => 25, 'name' => 'Perda Sulut No. 1 Tahun 2019', 'description' => 'Tentang Rencana Tata Ruang Wilayah'],
            ['province_id' => 25, 'name' => 'Perda Sulut No. 8 Tahun 2021', 'description' => 'Tentang Pelestarian Budaya Minahasa'],
            
            // 26. Sulawesi Tengah
            ['province_id' => 26, 'name' => 'Perda Sulteng No. 4 Tahun 2020', 'description' => 'Tentang Pengelolaan Taman Nasional Lore Lindu'],
            ['province_id' => 26, 'name' => 'Perda Sulteng No. 7 Tahun 2019', 'description' => 'Tentang Pelestarian Megalitikum'],
            ['province_id' => 26, 'name' => 'Perda Sulteng No. 2 Tahun 2021', 'description' => 'Tentang Mitigasi Bencana Gempa dan Tsunami'],
            
            // 27. Sulawesi Selatan
            ['province_id' => 27, 'name' => 'Perda Sulsel No. 2 Tahun 2020', 'description' => 'Tentang Perlindungan Rumah Adat Tongkonan'],
            ['province_id' => 27, 'name' => 'Perda Sulsel No. 9 Tahun 2019', 'description' => 'Tentang Rencana Tata Ruang Wilayah'],
            ['province_id' => 27, 'name' => 'Perda Sulsel No. 6 Tahun 2021', 'description' => 'Tentang Pelestarian Budaya Bugis-Makassar'],
            
            // 28. Sulawesi Tenggara
            ['province_id' => 28, 'name' => 'Perda Sultra No. 3 Tahun 2020', 'description' => 'Tentang Perlindungan Taman Nasional Wakatobi'],
            ['province_id' => 28, 'name' => 'Perda Sultra No. 8 Tahun 2019', 'description' => 'Tentang Pengelolaan Sumber Daya Kelautan'],
            ['province_id' => 28, 'name' => 'Perda Sultra No. 5 Tahun 2021', 'description' => 'Tentang Pengembangan Aspal Buton'],
            
            // 29. Gorontalo
            ['province_id' => 29, 'name' => 'Perda Gorontalo No. 7 Tahun 2020', 'description' => 'Tentang Rencana Tata Ruang Wilayah Provinsi'],
            ['province_id' => 29, 'name' => 'Perda Gorontalo No. 3 Tahun 2019', 'description' => 'Tentang Pengelolaan Jagung sebagai Komoditas Utama'],
            ['province_id' => 29, 'name' => 'Perda Gorontalo No. 2 Tahun 2021', 'description' => 'Tentang Pelestarian Budaya Hulontalo'],
            
            // 30. Sulawesi Barat
            ['province_id' => 30, 'name' => 'Perda Sulbar No. 5 Tahun 2020', 'description' => 'Tentang Rencana Tata Ruang Wilayah Provinsi'],
            ['province_id' => 30, 'name' => 'Perda Sulbar No. 1 Tahun 2019', 'description' => 'Tentang Pelestarian Budaya Mandar'],
            ['province_id' => 30, 'name' => 'Perda Sulbar No. 4 Tahun 2021', 'description' => 'Tentang Pengembangan Sektor Perikanan'],
            
            // 31. Maluku
            ['province_id' => 31, 'name' => 'Perda Maluku No. 6 Tahun 2020', 'description' => 'Tentang Perlindungan Kepulauan Banda'],
            ['province_id' => 31, 'name' => 'Perda Maluku No. 2 Tahun 2019', 'description' => 'Tentang Pelestarian Budaya Pela Gandong'],
            ['province_id' => 31, 'name' => 'Perda Maluku No. 8 Tahun 2021', 'description' => 'Tentang Pengelolaan Rempah-Rempah'],
            
            // 32. Maluku Utara
            ['province_id' => 32, 'name' => 'Perda Malut No. 4 Tahun 2020', 'description' => 'Tentang Pelestarian Kesultanan Ternate'],
            ['province_id' => 32, 'name' => 'Perda Malut No. 7 Tahun 2019', 'description' => 'Tentang Pengelolaan Jalur Rempah'],
            ['province_id' => 32, 'name' => 'Perda Malut No. 3 Tahun 2021', 'description' => 'Tentang Perlindungan Hutan Pala'],
            
            // 33. Papua
            ['province_id' => 33, 'name' => 'Perda Papua No. 23 Tahun 2020', 'description' => 'Tentang Perlindungan Hak Ulayat Masyarakat Adat'],
            ['province_id' => 33, 'name' => 'Perda Papua No. 15 Tahun 2019', 'description' => 'Tentang Rencana Tata Ruang Wilayah'],
            ['province_id' => 33, 'name' => 'Perda Papua No. 21 Tahun 2021', 'description' => 'Tentang Pelestarian Budaya Papua'],
            
            // 34. Papua Barat
            ['province_id' => 34, 'name' => 'Perda Papua Barat No. 12 Tahun 2020', 'description' => 'Tentang Perlindungan Raja Ampat'],
            ['province_id' => 34, 'name' => 'Perda Papua Barat No. 8 Tahun 2019', 'description' => 'Tentang Pengelolaan Konservasi Laut'],
            ['province_id' => 34, 'name' => 'Perda Papua Barat No. 6 Tahun 2021', 'description' => 'Tentang Pengembangan Ekowisata'],
            
            // 35. Papua Selatan
            ['province_id' => 35, 'name' => 'Perda Papua Selatan No. 1 Tahun 2023', 'description' => 'Tentang Penyelenggaraan Pemerintahan Daerah'],
            ['province_id' => 35, 'name' => 'Perda Papua Selatan No. 2 Tahun 2023', 'description' => 'Tentang Perlindungan Hutan Sagu'],
            ['province_id' => 35, 'name' => 'Perda Papua Selatan No. 3 Tahun 2023', 'description' => 'Tentang Pelestarian Budaya Asmat'],
            
            // 36. Papua Tengah
            ['province_id' => 36, 'name' => 'Perda Papua Tengah No. 1 Tahun 2023', 'description' => 'Tentang Penyelenggaraan Otonomi Daerah'],
            ['province_id' => 36, 'name' => 'Perda Papua Tengah No. 2 Tahun 2023', 'description' => 'Tentang Perlindungan Puncak Jaya'],
            ['province_id' => 36, 'name' => 'Perda Papua Tengah No. 3 Tahun 2023', 'description' => 'Tentang Hak Ulayat Masyarakat Adat Pegunungan'],
            
            // 37. Papua Pegunungan
            ['province_id' => 37, 'name' => 'Perda Papua Pegunungan No. 1 Tahun 2023', 'description' => 'Tentang Pembentukan Pemerintahan Daerah'],
            ['province_id' => 37, 'name' => 'Perda Papua Pegunungan No. 2 Tahun 2023', 'description' => 'Tentang Pelestarian Budaya Suku Dani'],
            ['province_id' => 37, 'name' => 'Perda Papua Pegunungan No. 3 Tahun 2023', 'description' => 'Tentang Pengelolaan Lingkungan Hutan Pegunungan'],
            
            // 38. Papua Barat Daya
            ['province_id' => 38, 'name' => 'Perda Papua Barat Daya No. 1 Tahun 2023', 'description' => 'Tentang Penyelenggaraan Pemerintahan Provinsi'],
            ['province_id' => 38, 'name' => 'Perda Papua Barat Daya No. 2 Tahun 2023', 'description' => 'Tentang Pengelolaan Kawasan Pesisir'],
            ['province_id' => 38, 'name' => 'Perda Papua Barat Daya No. 3 Tahun 2023', 'description' => 'Tentang Perlindungan Masyarakat Adat Kanum'],
        ];

        foreach ($peraturanData as $data) {
            if (isset($provinces[$data['province_id']])) {
                Peraturan::create($data);
            }
        }
    }
}
