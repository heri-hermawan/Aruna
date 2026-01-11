<?php

namespace Database\Seeders;

use App\Models\Wisata;
use App\Models\Province;
use Illuminate\Database\Seeder;

class WisataSeeder extends Seeder
{
    public function run(): void
    {
        $provinces = Province::all()->keyBy('id');
        
        $wisataData = [
            // 1. Aceh
            ['province_id' => 1, 'name' => 'Masjid Raya Baiturrahman', 'description' => 'Masjid megah simbol Aceh dengan arsitektur yang indah', 'address' => 'Banda Aceh', 'price' => 0, 'image' => 'images/wisata/Masjid Raya Baiturrahman.jpg'],
            ['province_id' => 1, 'name' => 'Pantai Lampuuk', 'description' => 'Pantai dengan ombak yang cocok untuk surfing', 'address' => 'Aceh Besar', 'price' => 5000, 'image' => 'images/wisata/Pantai Lampuuk.webp'],
            ['province_id' => 1, 'name' => 'Pulau Weh', 'description' => 'Surga diving dengan keindahan bawah laut yang menakjubkan', 'address' => 'Sabang', 'price' => 50000],
            
            // 2. Sumatera Utara
            ['province_id' => 2, 'name' => 'Danau Toba', 'description' => 'Danau vulkanik terbesar di Indonesia dengan Pulau Samosir di tengahnya', 'address' => 'Kabupaten Toba', 'price' => 10000, 'image' => 'images/wisata/danau_toba_1767529778.png'],
            ['province_id' => 2, 'name' => 'Istana Maimun', 'description' => 'Istana Kesultanan Deli yang megah', 'address' => 'Medan', 'price' => 20000, 'image' => 'images/wisata/Istana Maimun.webp'],
            ['province_id' => 2, 'name' => 'Bukit Lawang', 'description' => 'Taman nasional habitat orangutan Sumatera', 'address' => 'Langkat', 'price' => 150000, 'image' => 'images/wisata/Taman Nasional Gunung Leuser.png'],
            ['province_id' => 2, 'name' => 'Air Terjun Sipiso-piso', 'description' => 'Air terjun spektakuler di dataran tinggi Karo', 'address' => 'Karo', 'price' => 20000, 'image' => 'images/wisata/Air Terjun Sipiso-piso.jpg'],
            
            // 3. Sumatera Barat
            ['province_id' => 3, 'name' => 'Jam Gadang', 'description' => 'Menara jam ikonik Bukittinggi', 'address' => 'Bukittinggi', 'price' => 0, 'image' => 'images/wisata/Jam Gadang.jpg'],
            ['province_id' => 3, 'name' => 'Ngarai Sianok', 'description' => 'Lembah hijau yang memesona', 'address' => 'Bukittinggi', 'price' => 10000, 'image' => 'images/wisata/ngarai_sianok_1767529778.png'],
            ['province_id' => 3, 'name' => 'Pulau Cubadak', 'description' => 'Pulau kecil dengan pantai pasir putih', 'address' => 'Pesisir Selatan', 'price' => 25000, 'image' => 'images/wisata/Pulau Cubadak.jpg'],
            
            // 4. Riau
            ['province_id' => 4, 'name' => 'Masjid Agung An-Nur', 'description' => 'Masjid terbesar di Pekanbaru', 'address' => 'Pekanbaru', 'price' => 0],
            ['province_id' => 4, 'name' => 'Taman Wisata Alam Tesso Nilo', 'description' => 'Hutan hujan tropis dengan gajah Sumatera', 'address' => 'Pelalawan', 'price' => 50000],
            ['province_id' => 4, 'name' => 'Danau Raja', 'description' => 'Danau alami yang sejuk', 'address' => 'Siak', 'price' => 5000, 'image' => 'images/wisata/Danau Raja.jpg'],
            
            // 5. Jambi
            ['province_id' => 5, 'name' => 'Candi Muaro Jambi', 'description' => 'Kompleks candi Buddha terbesar di Indonesia', 'address' => 'Muaro Jambi', 'price' => 10000, 'image' => 'images/wisata/candi_muara_jambi_1767578237.png'],
            ['province_id' => 5, 'name' => 'Danau Kaco', 'description' => 'Danau biru yang jernih di tengah hutan', 'address' => 'Kerinci', 'price' => 20000],
            ['province_id' => 5, 'name' => 'Taman Nasional Kerinci Seblat', 'description' => 'Taman nasional dengan Gunung Kerinci', 'address' => 'Kerinci', 'price' => 50000],
            
            // 6. Sumatera Selatan
            ['province_id' => 6, 'name' => 'Masjid Agung Palembang', 'description' => 'Masjid megah Sultan Mahmud Badaruddin I', 'address' => 'Palembang', 'price' => 0],
            ['province_id' => 6, 'name' => 'Jembatan Ampera', 'description' => 'Jembatan ikonik di atas Sungai Musi', 'address' => 'Palembang', 'price' => 0],
            ['province_id' => 6, 'name' => 'Pulau Kemaro', 'description' => 'Pulau di tengah Sungai Musi dengan pagoda', 'address' => 'Palembang', 'price' => 10000],
            
            // 7. Bengkulu
            ['province_id' => 7, 'name' => 'Benteng Marlborough', 'description' => 'Benteng peninggalan Inggris yang kokoh', 'address' => 'Bengkulu', 'price' => 10000, 'image' => 'images/wisata/wisata_marlborough.png'],
            ['province_id' => 7, 'name' => 'Pantai Panjang', 'description' => 'Pantai sepanjang 7 km dengan sunset indah', 'address' => 'Bengkulu', 'price' => 5000, 'image' => 'images/wisata/Pantai Panjang.jpg'],
            ['province_id' => 7, 'name' => 'Danau Dendam Tak Sudah', 'description' => 'Danau dengan legenda yang menarik', 'address' => 'Bengkulu', 'price' => 5000],
            
            // 8. Lampung
            ['province_id' => 8, 'name' => 'Pahawang Island', 'description' => 'Surga snorkeling dengan air jernih', 'address' => 'Pesawaran', 'price' => 75000, 'image' => 'images/wisata/Pulau Pahawang Lampung.jpeg'],
            ['province_id' => 8, 'name' => 'Way Kambas', 'description' => 'Taman nasional gajah Sumatera', 'address' => 'Lampung Timur', 'price' => 50000, 'image' => 'images/wisata/Taman Nasional Way Kambas.jpg'],
            ['province_id' => 8, 'name' => 'Krakatau', 'description' => 'Gunung berapi yang terkenal di seluruh dunia', 'address' => 'Lampung Selatan', 'price' => 200000, 'image' => 'images/wisata/Gunung Krakatau.jpg'],
            
            // 9. Bangka Belitung
            ['province_id' => 9, 'name' => 'Pantai Tanjung Tinggi', 'description' => 'Pantai dengan batu granit raksasa', 'address' => 'Belitung', 'price' => 10000],
            ['province_id' => 9, 'name' => 'Pulau Lengkuas', 'description' => 'Pulau dengan mercusuar tua yang ikonik', 'address' => 'Belitung', 'price' => 50000, 'image' => 'images/wisata/Pulau Lengkuas.jpg'],
            ['province_id' => 9, 'name' => 'Danau Kaolin', 'description' => 'Danau buatan berwarna biru kehijauan', 'address' => 'Belitung', 'price' => 5000, 'image' => 'images/wisata/Danau Kaolin.jpg'],
            
            // 10. Kepulauan Riau
            ['province_id' => 10, 'name' => 'Barelang Bridge', 'description' => '6 jembatan yang menghubungkan pulau-pulau', 'address' => 'Batam', 'price' => 0],
            ['province_id' => 10, 'name' => 'Pulau Penyengat', 'description' => 'Pulau bersejarah Kesultanan Riau', 'address' => 'Tanjung Pinang', 'price' => 20000, 'image' => 'images/wisata/Pulau Penyengat.jpg'],
            ['province_id' => 10, 'name' => 'Lagoi Beach', 'description' => 'Pantai indah dengan resort mewah', 'address' => 'Bintan', 'price' => 0],
            
            // 11. DKI Jakarta
            ['province_id' => 11, 'name' => 'Monas', 'description' => 'Monumen Nasional simbol kemerdekaan Indonesia', 'address' => 'Jakarta Pusat', 'price' => 15000],
            ['province_id' => 11, 'name' => 'Taman Mini Indonesia Indah', 'description' =>'Miniatur budaya Indonesia', 'address' => 'Jakarta Timur', 'price' => 20000, 'image' => 'images/wisata/Taman Mini Indonesia Indah.jpg'],
            ['province_id' => 11, 'name' => 'Kota Tua Jakarta', 'description' => 'Kawasan bersejarah dengan bangunan kolonial', 'address' => 'Jakarta Barat', 'price' => 0],
            ['province_id' => 11, 'name' => 'Museum Nasional', 'description' => 'Museum sejarah dan budaya Indonesia', 'address' => 'Jakarta Pusat', 'price' => 10000, 'image' => 'images/wisata/Museum Nasional.jpg'],
            
            // 12. Jawa Barat
            ['province_id' => 12, 'name' => 'Tangkuban Perahu', 'description' => 'Gunung berapi dengan kawah yang masih aktif', 'address' => 'Bandung', 'price' => 30000, 'image' => 'images/wisata/Tangkuban Perahu.jpeg'],
            ['province_id' => 12, 'name' => 'Kawah Putih', 'description' => 'Danau kawah berwarna putih kehijauan', 'address' => 'Bandung', 'price' => 50000, 'image' => 'images/wisata/wisata_kawah_putih.png'],
            ['province_id' => 12, 'name' => 'Green Canyon', 'description' => 'Ngarai hijau dengan sungai yang jernih', 'address' => 'Pangandaran', 'price' => 100000, 'image' => 'images/wisata/Green Canyon.jpg'],
            
            // 13. Jawa Tengah
            ['province_id' => 13, 'name' => 'Candi Borobudur', 'description' => 'Candi Buddha terbesar di dunia, warisan UNESCO', 'address' => 'Magelang', 'price' => 50000, 'image' => 'images/wisata/borobudur_temple_1767529778.png'],
            ['province_id' => 13, 'name' => 'Candi Prambanan', 'description' => 'Kompleks candi Hindu yang megah', 'address' => 'Sleman', 'price' => 50000, 'image' => 'images/wisata/Candi Prambanan.jpg'],
            ['province_id' => 13, 'name' => 'Lawang Sewu', 'description' => 'Bangunan kolonial bersejarah', 'address' => 'Semarang', 'price' => 20000, 'image' => 'images/wisata/Lawang Sewu.jpeg'],
            
            // 14. DI Yogyakarta
            ['province_id' => 14, 'name' => 'Malioboro', 'description' => 'Jalan legendaris pusat oleh-oleh Jogja', 'address' => 'Yogyakarta', 'price' => 0, 'image' => 'images/wisata/Malioboro.jpg'],
            ['province_id' => 14, 'name' => 'Keraton Yogyakarta', 'description' => 'Istana Sultan yang masih berfungsi', 'address' => 'Yogyakarta', 'price' => 15000, 'image' => 'images/wisata/Keraton Yogyakarta.jpg'],
            ['province_id' => 14, 'name' => 'Pantai Parangtritis', 'description' => 'Pantai dengan legenda dan sunset indah', 'address' => 'Bantul', 'price' => 10000, 'image' => 'images/wisata/Pantai Parangtritis.jpg'],
            
            // 15. Jawa Timur
            ['province_id' => 15, 'name' => 'Gunung Bromo', 'description' => 'Gunung berapi dengan sunrise yang spektakuler', 'address' => 'Probolinggo', 'price' => 35000, 'image' => 'images/wisata/bromo_volcano_1767529778.png'],
            ['province_id' => 15, 'name' => 'Taman Nasional Baluran', 'description' => 'Afrika van Java dengan savana luas', 'address' => 'Situbondo', 'price' => 15000, 'image' => 'images/wisata/Taman Nasional Baluran.jpg'],
            ['province_id' => 15, 'name' => 'Kawah Ijen', 'description' => 'Kawah dengan blue fire yang menakjubkan', 'address' => 'Banyuwangi', 'price' => 150000, 'image' => 'images/wisata/kawah_ijen_1767529778.png'],
            
            // 16. Banten
            ['province_id' => 16, 'name' => 'Ujung Kulon', 'description' => 'Taman nasional habitat badak Jawa', 'address' => 'Pandeglang', 'price' => 200000, 'image' => 'images/wisata/Taman Nasional Ujung Kulon.webp'],
            ['province_id' => 16, 'name' => 'Pantai Anyer', 'description' => 'Pantai dengan pemandangan Gunung Krakatau', 'address' => 'Serang', 'price' => 10000, 'image' => 'images/wisata/Pantai Anyer.jpg'],
            ['province_id' => 16, 'name' => 'Benteng Speelwijk', 'description' => 'Benteng VOC yang kokoh', 'address' => 'Banten', 'price' => 5000],
            
            // 17. Bali
            ['province_id' => 17, 'name' => 'Tanah Lot', 'description' => 'Pura di atas batu karang dengan sunset memukau', 'address' => 'Tabanan', 'price' => 60000, 'image' => 'images/wisata/Tanah Lot.jpg'],
            ['province_id' => 17, 'name' => 'Ubud', 'description' => 'Pusat seni dan budaya Bali', 'address' => 'Gianyar', 'price' => 0, 'image' => 'images/wisata/Ubud.jpg'],
            ['province_id' => 17, 'name' => 'Nusa Penida', 'description' => 'Pulau dengan tebing dan pantai yang dramatis', 'address' => 'Klungkung', 'price' => 15000, 'image' => 'images/wisata/Nusa Penida.webp'],
            
            // 18. Nusa Tenggara Barat
            ['province_id' => 18, 'name' => 'Gili Trawangan', 'description' => 'Pulau cantik dengan pantai pasir putih', 'address' => 'Lombok Utara', 'price' => 15000, 'image' => 'images/wisata/gili_trawangan_1767578234.png'],
            ['province_id' => 18, 'name' => 'Gunung Rinjani', 'description' => 'Gunung dengan Danau Segara Anak', 'address' => 'Lombok Timur', 'price' => 150000, 'image' => 'images/wisata/gunung_rinjani_1767578235.png'],
            ['province_id' => 18, 'name' => 'Pantai Pink', 'description' => 'Pantai dengan pasir berwarna pink', 'address' => 'Lombok Timur', 'price' => 10000, 'image' => 'images/wisata/Pantai Pink.jpeg'],
            
            // 19. Nusa Tenggara Timur
            ['province_id' => 19, 'name' => 'Pulau Komodo', 'description' => 'Habitat asli komodo, hewan purba yang langka', 'address' => 'Manggarai Barat', 'price' => 250000, 'image' => 'images/wisata/komodo_island_1767529778.png'],
            ['province_id' => 19, 'name' => 'Labuan Bajo', 'description' => 'Kota pelabuhan menuju Komodo', 'address' => 'Manggarai Barat', 'price' => 0, 'image' => 'images/wisata/Labuan Bajo.jpg'],
            ['province_id' => 19, 'name' => 'Kelimutu', 'description' => 'Danau tiga warna yang mistis', 'address' => 'Ende', 'price' => 150000, 'image' => 'images/wisata/danau_kelimutu_1767529778.png'],
            
            // 20. Kalimantan Barat
            ['province_id' => 20, 'name' => 'Taman Nasional Gunung Palung', 'description' => 'Habitat orangutan Kalimantan', 'address' => 'Ketapang', 'price' => 100000],
            ['province_id' => 20, 'name' => 'Equator Monument', 'description' => 'Tugu khatulistiwa yang ikonik', 'address' => 'Pontianak', 'price' => 0],
            ['province_id' => 20, 'name' => 'Danau Sentarum', 'description' => 'Danau musiman yang unik', 'address' => 'Kapuas Hulu', 'price' => 50000],
            
            // 21. Kalimantan Tengah
            ['province_id' => 21, 'name' => 'Taman Nasional Tanjung Puting', 'description' => 'Pusat konservasi orangutan', 'address' => 'Kotawaringin Barat', 'price' => 500000],
            ['province_id' => 21, 'name' => 'Bukit Batu', 'description' => 'Bukit dengan pemandangan sungai Kahayan', 'address' => 'Palangka Raya', 'price' => 5000],
            ['province_id' => 21, 'name' => 'Danau Tahai', 'description' => 'Danau jernih di tengah hutan', 'address' => 'Palangka Raya', 'price' => 10000],
            
            // 22. Kalimantan Selatan
            ['province_id' => 22, 'name' => 'Pasar Terapung Lok Baintan', 'description' => 'Pasar tradisional di atas perahu', 'address' => 'Banjar', 'price' => 0],
            ['province_id' => 22, 'name' => 'Pulau Kembang', 'description' => 'Pulau dengan habitat kera ekor panjang', 'address' => 'Barito Kuala', 'price' => 20000],
            ['province_id' => 22, 'name' => 'Masjid Sultan Suriansyah', 'description' => 'Masjid tertua di Kalimantan Selatan', 'address' => 'Banjarmasin', 'price' => 0],
            
            // 23. Kalimantan Timur
            ['province_id' => 23, 'name' => 'Pulau Derawan', 'description' => 'Surga diving dengan penyu dan pari manta', 'address' => 'Berau', 'price' => 100000, 'image' => 'images/wisata/derawan_island_1767578233.png'],
            ['province_id' => 23, 'name' => 'Danau Labuan Cermin', 'description' => 'Danau dua rasa unik', 'address' => 'Berau', 'price' => 50000, 'image' => 'images/wisata/Danau Labuan Cermin.jpg'],
            ['province_id' => 23, 'name' => 'Mahakam River', 'description' => 'Sungai terpanjang di Kalimantan', 'address' => 'Kutai Kartanegara', 'price' => 75000],
            
            // 24. Kalimantan Utara
            ['province_id' => 24, 'name' => 'Pulau Maratua', 'description' => 'Pulau dengan resort mewah dan diving', 'address' => 'Berau', 'price' => 150000, 'image' => 'images/wisata/Pulau Maratua.jpg'],
            ['province_id' => 24, 'name' => 'Taman Nasional Kayan Mentarang', 'description' => 'Hutan hujan tropis yang luas', 'address' => 'Malinau', 'price' => 200000],
            ['province_id' => 24, 'name' => 'Bulungan Waterfall', 'description' => 'Air terjun di tengah hutan', 'address' => 'Bulungan', 'price' => 25000],
            
            // 25. Sulawesi Utara
            ['province_id' => 25, 'name' => 'Bunaken', 'description' => 'Surga diving kelas dunia', 'address' => 'Manado', 'price' => 150000, 'image' => 'images/wisata/bunaken_diving_1767529778.png'],
            ['province_id' => 25, 'name' => 'Danau Tondano', 'description' => 'Danau vulkanik yang indah', 'address' => 'Minahasa', 'price' => 10000, 'image' => 'images/wisata/Danau Tondano.jpg'],
            ['province_id' => 25, 'name' => 'Pulau Lembeh', 'description' => 'Muck diving terbaik di dunia', 'address' => 'Bitung', 'price' => 100000, 'image' => 'images/wisata/Pulau Lembeh.jpeg'],
            
            // 26. Sulawesi Tengah
            ['province_id' => 26, 'name' => 'Lore Lindu', 'description' => 'Taman nasional dengan megalit purba', 'address' => 'Poso', 'price' => 50000, 'image' => 'images/wisata/Taman Nasional Lore Lindu.webp'],
            ['province_id' => 26, 'name' => 'Pulau Togean', 'description' => 'Kepulauan dengan terumbu karang indah', 'address' => 'Tojo Una-Una', 'price' => 100000],
            ['province_id' => 26, 'name' => 'Danau Poso', 'description' => 'Danau terdalam ketiga di Indonesia', 'address' => 'Poso', 'price' => 10000, 'image' => 'images/wisata/Danau Poso.webp'],
            
            // 27. Sulawesi Selatan
            ['province_id' => 27, 'name' => 'Tana Toraja', 'description' => 'Daerah dengan budaya unik dan rumah Tongkonan', 'address' => 'Toraja Utara', 'price' => 50000, 'image' => 'images/wisata/tana_toraja_1767529778.png'],
            ['province_id' => 27, 'name' => 'Pantai Losari', 'description' => 'Pantai ikonik Makassar dengan sunset', 'address' => 'Makassar', 'price' => 0, 'image' => 'images/wisata/Pantai Losari.jpg'],
            ['province_id' => 27, 'name' => 'Taman Nasional Bantimurung', 'description' => 'Kingdom of Butterfly dengan air terjun', 'address' => 'Maros', 'price' => 30000],
            
            // 28. Sulawesi Tenggara
            ['province_id' => 28, 'name' => 'Wakatobi', 'description' => 'Surga diving dengan biodiversitas tertinggi', 'address' => 'Wakatobi', 'price' => 200000, 'image' => 'images/wisata/wakatobi_1767529778.png'],
            ['province_id' => 28, 'name' => 'Pulau Muna', 'description' => 'Pulau dengan pantai dan gua yang eksotis', 'address' => 'Muna', 'price' => 50000],
            ['province_id' => 28, 'name' => 'Danau Napabale', 'description' => 'Danau dengan pemandangan indah', 'address' => 'Muna', 'price' => 10000],
            
            // 29. Gorontalo
            ['province_id' => 29, 'name' => 'Olele Beach', 'description' => 'Pantai dengan underwater wall diving', 'address' => 'Bone Bolango', 'price' => 10000],
            ['province_id' => 29, 'name' => 'Benteng Otanaha', 'description' => 'Benteng di atas bukit', 'address' => 'Gorontalo', 'price' => 5000],
            ['province_id' => 29, 'name' => 'Pulau Saronde', 'description' => 'Pulau kecil dengan pantai putih', 'address' => 'Gorontalo Utara', 'price' => 50000],
            
            // 30. Sulawesi Barat
            ['province_id' => 30, 'name' => 'Pantai Palippis', 'description' => 'Pantai dengan pasir putih yang tenang', 'address' => 'Polewali Mandar', 'price' => 5000],
            ['province_id' => 30, 'name' => 'Danau Rano', 'description' => 'Danau di ketinggian dengan udara sejuk', 'address' => 'Mamuju', 'price' => 10000, 'image' => 'images/wisata/Danau Rano.jpg'],
            ['province_id' => 30, 'name' => 'Air Terjun Tamasapi', 'description' => 'Air terjun bertingkat yang indah', 'address' => 'Mamuju', 'price' => 15000],
            
            // 31. Maluku
            ['province_id' => 31, 'name' => 'Banda Islands', 'description' => 'Kepulauan bersejarah dengan diving yang amazing', 'address' => 'Maluku Tengah', 'price' => 200000, 'image' => 'images/wisata/Banda Islands.jpeg'],
            ['province_id' => 31, 'name' => 'Pantai Natsepa', 'description' => 'Pantai pasir putih dengan air jernih', 'address' => 'Ambon', 'price' => 10000],
            ['province_id' => 31, 'name' => 'Benteng Victoria', 'description' => 'Benteng peninggalan Portugis', 'address' => 'Ambon', 'price' => 15000],
            
            // 32. Maluku Utara
            ['province_id' => 32, 'name' => 'Pulau Ternate', 'description' => 'Pulau bersejarah rempah-rempah', 'address' => 'Ternate', 'price' => 0],
            ['province_id' => 32, 'name' => 'Danau Tolire', 'description' => 'Danau kawah dengan legenda mistis', 'address' => 'Ternate', 'price' => 5000, 'image' => 'images/wisata/Danau Tolire.jpg'],
            ['province_id' => 32, 'name' => 'Pulau Halmahera', 'description' => 'Pulau terbesar di Maluku Utara', 'address' => 'Halmahera Tengah', 'price' => 50000, 'image' => 'images/wisata/Pulau Halmahera.jpg'],
            
            // 33. Papua
            ['province_id' => 33, 'name' => 'Raja Ampat', 'description' => 'Surga diving terbaik di dunia dengan keanekaragaman hayati luar biasa', 'address' => 'Raja Ampat', 'price' => 500000, 'image' => 'images/wisata/raja_ampat_1767529778.png'],
            ['province_id' => 33, 'name' => 'Danau Sentani', 'description' => 'Danau terbesar di Papua', 'address' => 'Jayapura', 'price' => 10000, 'image' => 'images/wisata/danau_sentani_1767578236.png'],
            ['province_id' => 33, 'name' => 'Lembah Baliem', 'description' => 'Lembah dengan suku Dani dan pemandangan spektakuler', 'address' => 'Jayawijaya', 'price' => 200000, 'image' => 'images/wisata/Lembah Baliem.jpg'],
            
            // 34. Papua Barat
            ['province_id' => 34, 'name' => 'Teluk Cenderawasih', 'description' => 'Taman laut dengan hiu paus', 'address' => 'Teluk Wondama', 'price' => 300000, 'image' => 'images/wisata/Teluk Cenderawasih.webp'],
            ['province_id' => 34, 'name' => 'Pulau Misool', 'description' => 'Pulau dengan laguna tersembunyi', 'address' => 'Raja Ampat', 'price' => 400000],
            ['province_id' => 34, 'name' => 'Arborek Island', 'description' => 'Pulau kecil dengan manta cleaning station', 'address' => 'Raja Ampat', 'price' => 350000],
            
            // 35. Papua Selatan
            ['province_id' => 35, 'name' => 'Taman Nasional Lorentz', 'description' => 'Taman nasional dengan gletser tropis satu-satunya', 'address' => 'Merauke', 'price' => 500000],
            ['province_id' => 35, 'name' => 'Pantai Lampu Satu', 'description' => 'Pantai dengan pasir putih di Merauke', 'address' => 'Merauke', 'price' => 0],
            ['province_id' => 35, 'name' => 'Museum Asmat', 'description' => 'Museum budaya suku Asmat', 'address' => 'Asmat', 'price' => 20000],
            
            // 36. Papua Tengah
            ['province_id' => 36, 'name' => 'Puncak Jaya', 'description' => 'Puncak tertinggi di Indonesia dengan salju abadi', 'address' => 'Puncak', 'price' => 1000000, 'image' => 'images/wisata/Puncak Jaya.jpeg'],
            ['province_id' => 36, 'name' => 'Danau Habbema', 'description' => 'Danau di ketinggian 3300 mdpl', 'address' => 'Puncak', 'price' => 500000],
            ['province_id' => 36, 'name' => 'Lembah Dani', 'description' => 'Lembah dengan budaya Dani yang kental', 'address' => 'Nduga', 'price' => 300000],
            
            // 37. Papua Pegunungan
            ['province_id' => 37, 'name' => 'Gunung Mandala', 'description' => 'Gunung dengan pemandangan spektakuler', 'address' => 'Yahukimo', 'price' => 800000],
            ['province_id' => 37, 'name' => 'Lembah Yali', 'description' => 'Lembah terisolasi dengan suku Yali', 'address' => 'Yahukimo', 'price' => 500000],
            ['province_id' => 37, 'name' => 'Danau Pegunungan', 'description' => 'Danau di puncak pegunungan', 'address' => 'Tolikara', 'price' => 400000],
            
            // 38. Papua Barat Daya
            ['province_id' => 38, 'name' => 'Pulau Kokas', 'description' => 'Pulau dengan formasi karang unik', 'address' => 'Fakfak', 'price' => 200000, 'image' => 'images/wisata/Pulau Kokas.jpeg'],
            ['province_id' => 38, 'name' => 'Air Terjun Kali Biru', 'description' => 'Air terjun dengan air berwarna biru', 'address' => 'Kaimana', 'price' => 50000, 'image' => 'images/wisata/Air Terjun Kali Biru.jpg'],
            ['province_id' => 38, 'name' => 'Pantai Venu', 'description' => 'Pantai terpencil yang eksotis', 'address' => 'Sorong Selatan', 'price' => 25000, 'image' => 'images/wisata/Pantai Venu.jpg'],
        ];

        foreach ($wisataData as $data) {
            if (isset($provinces[$data['province_id']])) {
                Wisata::create($data);
            }
        }
    }
}
