<?php

namespace Database\Seeders;

use App\Models\Tradisi;
use App\Models\Province;
use Illuminate\Database\Seeder;

class TradisiSeeder extends Seeder
{
    public function run(): void
    {
        $provinces = Province::all()->keyBy('id');
        
        $tradisiData = [
            // 1. Aceh
            ['province_id' => 1, 'name' => 'Tari Saman', 'description' => 'Tarian tradisional Aceh yang terkenal dengan gerakan kompak dan dinamis, terdaftar dalam warisan budaya UNESCO', 'image' => 'images/tradisi/tari saman.jpg'],
            ['province_id' => 1, 'name' => 'Peusijuek', 'description' => 'Upacara adat Aceh untuk mensyukuri nikmat dan memberi berkah', 'image' => 'images/tradisi/Peusijuek.jpeg'],
            ['province_id' => 1, 'name' => 'Didong', 'description' => 'Seni berbalas pantun sambil menari dalam lingkaran, khas Gayo', 'image' => 'images/tradisi/Didong.png'],
            
            // 2. Sumatera Utara
            ['province_id' => 2, 'name' => 'Tor-Tor', 'description' => 'Tarian tradisional Batak yang sakral, biasa ditampilkan dalam upacara adat', 'image' => 'images/tradisi/Tor-Tor.webp'],
            ['province_id' => 2, 'name' => 'Mangongkal Holi', 'description' => 'Upacara pemindahan tulang belulang leluhur ke makam yang lebih baik', 'image' => 'images/tradisi/Mangongkal Holi.webp'],
            ['province_id' => 2, 'name' => 'Gondang Sabangunan', 'description' => 'Musik tradisional Batak dengan gong dan instrumen perkusi', 'image' => 'images/tradisi/Gondang Sabangunan.png'],
            ['province_id' => 2, 'name' => 'Sigale-Gale', 'description' => 'Boneka kayu menari khas Batak Toba', 'image' => 'images/tradisi/Sigale-Gale.jpg'],
            
            // 3. Sumatera Barat
            ['province_id' => 3, 'name' => 'Tari Piring', 'description' => 'Tarian dengan piring di tangan yang menggambarkan rasa syukur', 'image' => 'images/tradisi/tari_piring.png'],
            ['province_id' => 3, 'name' => 'Batagak Penghulu', 'description' => 'Upacara pengangkatan penghulu adat Minangkabau yang sangat sakral', 'image' => 'images/tradisi/batagak_penghulu.png'],
            ['province_id' => 3, 'name' => 'Randai', 'description' => 'Teater tradisional Minangkabau yang menggabungkan seni tari, musik, dan drama', 'image' => 'images/tradisi/randai.png'],
            ['province_id' => 3, 'name' => 'Baralek Gadang', 'description' => 'Pesta perkawinan adat Minangkabau', 'image' => 'images/tradisi/baralek_gadang.png'],
            
            // 4. Riau
            ['province_id' => 4, 'name' => 'Tari Zapin', 'description' => 'Tarian Melayu dengan pengaruh Arab yang elegan', 'image' => 'images/tradisi/Zapin.jpg'],
            ['province_id' => 4, 'name' => 'Makan Bedulang', 'description' => 'Tradisi makan bersama dalam satu wadah besar sebagai simbol kebersamaan', 'image' => 'images/tradisi/Makan Bedulang.png'],
            ['province_id' => 4, 'name' => 'Tepuk Tepung Tawar', 'description' => 'Upacara penyambutan tamu kehormatan dengan tepung tawar', 'image' => 'images/tradisi/tepuk_tepung_tawar.png'],
            ['province_id' => 4, 'name' => 'Makyong', 'description' => 'Teater tradisional Melayu', 'image' => 'images/tradisi/makyong.png'],
            
            // 5. Jambi
            ['province_id' => 5, 'name' => 'Tari Sekapur Sirih', 'description' => 'Tarian penyambutan tamu dengan menyajikan sirih', 'image' => 'images/tradisi/tari_sekapur_sirih.png'],
            ['province_id' => 5, 'name' => 'Batanghari 9', 'description' => 'Upacara adat masyarakat Jambi untuk menghormati leluhur', 'image' => 'images/tradisi/batanghari_9.png'],
            ['province_id' => 5, 'name' => 'Tari Selampir Delapan', 'description' => 'Tarian kerajaan Jambi yang menggambarkan keanggunan putri', 'image' => 'images/tradisi/tari_selampir_delapan.png'],
            
            // 6. Sumatera Selatan
            ['province_id' => 6, 'name' => 'Tari Gending Sriwijaya', 'description' => 'Tarian penyambutan yang menggambarkan kebesaran Sriwijaya', 'image' => 'images/tradisi/Tari Gending Sriwijaya.jpeg'],
            ['province_id' => 6, 'name' => 'Aesan Gede', 'description' => 'Pakaian pengantin adat Palembang yang mewah dan megah', 'image' => 'images/tradisi/aesan_gede.png'],
            ['province_id' => 6, 'name' => 'Bekhusek', 'description' => 'Tradisi membersihkan makam leluhur menjelang Ramadan', 'image' => 'images/tradisi/Bekhusek_new.png'],
            
            // 7. Bengkulu
            ['province_id' => 7, 'name' => 'Tabot', 'description' => 'Upacara peringatan gugurnya cucu Nabi Muhammad', 'image' => 'images/tradisi/tabot.png'],
            ['province_id' => 7, 'name' => 'Tari Andun', 'description' => 'Tarian tradisional Bengkulu yang menggambarkan kehidupan sehari-hari', 'image' => 'images/tradisi/Tari_Andun_new.png'],
            ['province_id' => 7, 'name' => 'Besale', 'description' => 'Tradisi kunjungan silaturahmi saat hari raya', 'image' => 'images/tradisi/Besale_new.png'],
            ['province_id' => 7, 'name' => 'Tabuik', 'description' => 'Upacara perayaan Islam khas Bengkulu', 'image' => 'images/tradisi/tabuik.png'],
            
            // 8. Lampung
            ['province_id' => 8, 'name' => 'Begawi Cakak Pepadun', 'description' => 'Upacara adat terbesar masyarakat Lampung', 'image' => 'images/tradisi/begawi_cakak_pepadun.png'],
            ['province_id' => 8, 'name' => 'Tari Melinting', 'description' => 'Tarian peperangan dari Lampung', 'image' => 'images/tradisi/tari_melinting.png'],
            ['province_id' => 8, 'name' => 'Siger', 'description' => 'Mahkota adat khas Lampung yang dikenakan pengantin', 'image' => 'images/tradisi/siger.png'],
            ['province_id' => 8, 'name' => 'Begawi', 'description' => 'Upacara adat Lampung', 'image' => 'images/tradisi/Begawi.jpeg'],
            
            // 9. Kepulauan Bangka Belitung
            ['province_id' => 9, 'name' => 'Ruwahan', 'description' => 'Upacara pembersihan diri dan kampung secara spiritual', 'image' => 'images/tradisi/ruwahan.png'],
            ['province_id' => 9, 'name' => 'Tari Campak', 'description' => 'Tarian tradisional Bangka yang dinamis', 'image' => 'images/tradisi/tari_campak.png'],
            ['province_id' => 9, 'name' => 'Sepintu Sedulang', 'description' => 'Tradisi makan bersama dalam satu wadah', 'image' => 'images/tradisi/sepintu_sedulang.png'],
            
            // 10. Kepulauan Riau
            ['province_id' => 10, 'name' => 'Tari Persembahan', 'description' => 'Tarian penyambutan tamu kehormatan Melayu', 'image' => 'images/tradisi/tari_persembahan.png'],
            ['province_id' => 10, 'name' => 'Makyong', 'description' => 'Teater tradisional Melayu yang dipentaskan pada malam hari', 'image' => 'images/tradisi/makyong.png'],
            ['province_id' => 10, 'name' => 'Rodat', 'description' => 'Seni musik dan tarian bernafaskan Islam', 'image' => 'images/tradisi/rodat.png'],
            ['province_id' => 10, 'name' => 'Zapin', 'description' => 'Tarian Melayu dengan pengaruh Arab', 'image' => 'images/tradisi/tari_zapin.png'],
            
            // 11. DKI Jakarta
            ['province_id' => 11, 'name' => 'Ondel-Ondel', 'description' => 'Boneka besar khas Betawi sebagai penolak bala', 'image' => 'images/tradisi/ondel_ondel.png'],
            ['province_id' => 11, 'name' => 'Palang Pintu', 'description' => 'Tradisi pernikahan Betawi dengan adu pantun', 'image' => 'images/tradisi/palang_pintu.png'],
            ['province_id' => 11, 'name' => 'Tari Topeng', 'description' => 'Tarian dengan topeng khas Betawi', 'image' => 'images/tradisi/tari_topeng.png'],
            ['province_id' => 11, 'name' => 'Lebaran Betawi', 'description' => 'Perayaan Lebaran khas Betawi', 'image' => 'images/tradisi/Lebaran Betawi.jpg'],
            
            // 12. Jawa Barat
            ['province_id' => 12, 'name' => 'Tari Jaipong', 'description' => 'Tarian tradisional Sunda yang enerjik dan dinamis', 'image' => 'images/tradisi/tari_jaipong.png'],
            ['province_id' => 12, 'name' => 'Ngalaksa', 'description' => 'Tradisi makan ngalaksa saat Rabu Wekasan sebagai bentuk sedekah', 'image' => 'images/tradisi/ngalaksa.png'],
            ['province_id' => 12, 'name' => 'Rengkong', 'description' => 'Upacara panen padi masyarakat Sunda', 'image' => 'images/tradisi/rengkong.png'],
            ['province_id' => 12, 'name' => 'Seren Taun', 'description' => 'Upacara syukuran panen padi Sunda', 'image' => 'images/tradisi/Seren Taun.jpg'],
            
            // 13. Jawa Tengah
            ['province_id' => 13, 'name' => 'Wayang Kulit', 'description' => 'Pertunjukan wayang dengan dalang, terdaftar UNESCO', 'image' => 'images/tradisi/wayang_kulit.png'],
            ['province_id' => 13, 'name' => 'Grebeg Syawal', 'description' => 'Perayaan tradisional Keraton Surakarta', 'image' => 'images/tradisi/grebeg_syawal.png'],
            ['province_id' => 13, 'name' => 'Mitoni', 'description' => 'Upacara tujuh bulanan kehamilan di Jawa', 'image' => 'images/tradisi/mitoni.png'],
            ['province_id' => 13, 'name' => 'Dugderan', 'description' => 'Pawai perayaan Ramadan khas Semarang', 'image' => 'images/tradisi/Dugderan.webp'],
            
            // 14. DI Yogyakarta
            ['province_id' => 14, 'name' => 'Labuhan', 'description' => 'Upacara persembahan Sultan ke laut selatan dan Gunung Merapi', 'image' => 'images/tradisi/labuhan.png'],
            ['province_id' => 14, 'name' => 'Sekaten', 'description' => 'Peringatan Maulid Nabi di alun-alun Keraton', 'image' => 'images/tradisi/sekaten.png'],
            ['province_id' => 14, 'name' => 'Grebeg Maulud', 'description' => 'Upacara pembagian gunungan dari Keraton', 'image' => 'images/tradisi/grebeg_maulud.png'],
            ['province_id' => 14, 'name' => 'Ruwatan', 'description' => 'Upacara tolak bala Jawa', 'image' => 'images/tradisi/Ruwatan.webp'],
            
            // 15. Jawa Timur
            ['province_id' => 15, 'name' => 'Reog Ponorogo', 'description' => 'Kesenian khas Ponorogo dengan topeng singa barong', 'image' => 'images/tradisi/reog_ponorogo.png'],
            ['province_id' => 15, 'name' => 'Karapan Sapi', 'description' => 'Tradisi balap sapi dari Madura', 'image' => 'images/tradisi/karapan_sapi.png'],
            ['province_id' => 15, 'name' => 'Ludruk', 'description' => 'Teater tradisional Jawa Timur dengan komedi', 'image' => 'images/tradisi/ludruk.png'],
            ['province_id' => 15, 'name' => 'Tari Gandrung', 'description' => 'Tarian pergaulan muda-mudi', 'image' => 'images/tradisi/Tari Gandrung.jpg'],
            
            // 16. Banten
            ['province_id' => 16, 'name' => 'Debus', 'description' => 'Kesenian bela diri spiritual khas Banten', 'image' => 'images/tradisi/debus.png'],
            ['province_id' => 16, 'name' => 'Tari Saman Banten', 'description' => 'Tarian kelompok yang penuh keselarasan', 'image' => 'images/tradisi/tari_saman_banten.png'],
            ['province_id' => 16, 'name' => 'Rampak Bedug', 'description' => 'Seni tabuh bedug secara bersamaan', 'image' => 'images/tradisi/rampak_bedug.png'],
            ['province_id' => 16, 'name' => 'Umbruk', 'description' => 'Tradisi gotong royong Banten', 'image' => 'images/tradisi/Umbruk.webp'],
            
            // 17. Bali
            ['province_id' => 17, 'name' => 'Ngaben', 'description' => 'Upacara kremasi jenazah khas Bali yang megah', 'image' => 'images/tradisi/ngaben.png'],
            ['province_id' => 17, 'name' => 'Tari Kecak', 'description' => 'Tarian kolosal khas Bali dengan suara cak', 'image' => 'images/tradisi/tari_kecak.png'],
            ['province_id' => 17, 'name' => 'Nyepi', 'description' => 'Hari raya tahun baru Saka dengan hening sehari penuh', 'image' => 'images/tradisi/nyepi.png'],
            ['province_id' => 17, 'name' => 'Melasti', 'description' => 'Upacara penyucian arca ke laut sebelum Nyepi', 'image' => 'images/tradisi/Melasti.jpg'],
            ['province_id' => 17, 'name' => 'Metatah', 'description' => 'Upacara potong gigi Bali', 'image' => 'images/tradisi/Metatah.webp'],
            
            // 18. Nusa Tenggara Barat
            ['province_id' => 18, 'name' => 'Bau Nyale', 'description' => 'Tradisi menangkap cacing laut di Lombok', 'image' => 'images/tradisi/Bau Nyale.jpg'],
            ['province_id' => 18, 'name' => 'Peresean', 'description' => 'Pertarungan menggunakan rotan dan perisai', 'image' => 'images/tradisi/Peresean.webp'],
            ['province_id' => 18, 'name' => 'Tari Gandrung', 'description' => 'Tarian pergaulan muda-mudi Lombok', 'image' => 'images/tradisi/Tari Gandrung.jpg'],
            
            // 19. Nusa Tenggara Timur
            ['province_id' => 19, 'name' => 'Pasola', 'description' => 'Permainan perang-perangan berkuda dari Sumba', 'image' => 'images/tradisi/Pasola.jpg'],
            ['province_id' => 19, 'name' => 'Caci', 'description' => 'Tarian perang menggunakan cambuk dari Flores', 'image' => 'images/tradisi/Caci.jpg'],
            ['province_id' => 19, 'name' => 'Reba', 'description' => 'Upacara syukuran panen di Flores', 'image' => 'images/tradisi/reba-58.png'],
            
            // 20. Kalimantan Barat
            ['province_id' => 20, 'name' => 'Gawai Dayak', 'description' => 'Upacara syukur panen suku Dayak', 'image' => 'images/tradisi/gawa_i_dayak_1767578243.png'],
            ['province_id' => 20, 'name' => 'Tari Monong', 'description' => 'Tarian penyambutan tamu suku Dayak', 'image' => 'images/tradisi/tari-monong-60.png'],
            ['province_id' => 20, 'name' => 'Naik Dango', 'description' => 'Upacara adat tolak bala Dayak', 'image' => 'images/tradisi/naik-dango-61.png'],
            ['province_id' => 20, 'name' => 'Gawi', 'description' => 'Pesta adat Dayak', 'image' => 'images/tradisi/Gawi.jpg'],
            
            // 21. Kalimantan Tengah
            ['province_id' => 21, 'name' => 'Tiwah', 'description' => 'Upacara kematian suku Dayak Ngaju yang megah', 'image' => 'images/tradisi/tiwah-62.png'],
            ['province_id' => 21, 'name' => 'Tari Tambun dan Bungai', 'description' => 'Tarian yang menceritakan legenda Dayak', 'image' => 'images/tradisi/Tari Tambun dan Bungai.jpg'],
            ['province_id' => 21, 'name' => 'Balian', 'description' => 'Ritual pengobatan tradisional Dayak', 'image' => 'images/tradisi/Balian.jpeg'],
            
            // 22. Kalimantan Selatan
            ['province_id' => 22, 'name' => 'Baayun Maulid', 'description' => 'Upacara mandi-mandi bayi saat Maulid Nabi', 'image' => 'images/tradisi/Baayun Maulid.jpg'],
            ['province_id' => 22, 'name' => 'Tari Baksa Kembang', 'description' => 'Tarian penyambutan tamu Banjar', 'image' => 'images/tradisi/Tari Baksa Kembang.jpg'],
            ['province_id' => 22, 'name' => 'Mamanda', 'description' => 'Teater tradisional khas Banjar', 'image' => 'images/tradisi/Mamanda.jpg'],
            
            // 23. Kalimantan Timur
            ['province_id' => 23, 'name' => 'Erau', 'description' => 'Upacara adat terbesar Kesultanan Kutai', 'image' => 'images/tradisi/Erau.webp'],
            ['province_id' => 23, 'name' => 'Tari Gong', 'description' => 'Tarian sakral suku Dayak Kenyah', 'image' => 'images/tradisi/tari-gong-69.png'],
            ['province_id' => 23, 'name' => 'Belian', 'description' => 'Ritual pengobatan dan tolak bala Dayak', 'image' => 'images/tradisi/belian-70.png'],
            
            // 24. Kalimantan Utara
            ['province_id' => 24, 'name' => 'Tari Kancet Ledo', 'description' => 'Tarian penyambutan suku Dayak Kenyah', 'image' => 'images/tradisi/tari-kancet-ledo-71.png'],
            ['province_id' => 24, 'name' => 'Hudoq', 'description' => 'Tarian ritual dengan topeng suku Dayak Bahau', 'image' => 'images/tradisi/hudoq-72.png'],
            ['province_id' => 24, 'name' => 'Kwangkay', 'description' => 'Upacara kematian suku Dayak Lundayeh', 'image' => 'images/tradisi/kwangkay-73.png'],
            
            // 25. Sulawesi Utara
            ['province_id' => 25, 'name' => 'Kabasaran', 'description' => 'Tarian perang suku Minahasa yang gagah', 'image' => 'images/tradisi/Kabasaran.jpg'],
            ['province_id' => 25, 'name' => 'Tulude', 'description' => 'Festival tahunan Minahasa untuk syukuran', 'image' => 'images/tradisi/Tulude.jpg'],
            ['province_id' => 25, 'name' => 'Maengket', 'description' => 'Tarian syukuran panen Minahasa', 'image' => 'images/tradisi/Maengket.jpg'],
            
            // 26. Sulawesi Tengah
            ['province_id' => 26, 'name' => 'Tari Dero', 'description' => 'Tarian tradisional Kaili yang dinamis', 'image' => 'images/tradisi/Dero.jpg'],
            ['province_id' => 26, 'name' => 'Wunja Tadulako', 'description' => 'Upacara adat suku Kaili', 'image' => 'images/tradisi/Wunja Tadulako.webp'],
            ['province_id' => 26, 'name' => 'Nosu', 'description' => 'Tradisi panen padi suku Kaili', 'image' => 'images/tradisi/Nosu.png'],
            
            // 27. Sulawesi Selatan
            ['province_id' => 27, 'name' => 'Mappanre Tassi', 'description' => 'Ritual menangkap ikan pertama kali nelayan Bugis', 'image' => 'images/tradisi/mappanre_tassi.png'],
            ['province_id' => 27, 'name' => "Ma'nene", 'description' => 'Upacara membersihkan jenazah leluhur Toraja', 'image' => 'images/tradisi/Manene.png'],
            ['province_id' => 27, 'name' => 'Rambu Solo', 'description' => 'Upacara kematian Toraja yang megah dan meriah', 'image' => 'images/tradisi/rambu_solo.png'],
            ['province_id' => 27, 'name' => 'Mappalili', 'description' => 'Upacara awal musim tanam padi', 'image' => 'images/tradisi/mappalili.jpg'],
            
            // 28. Sulawesi Tenggara
            ['province_id' => 28, 'name' => 'Tari Lulo', 'description' => 'Tarian pergaulan suku Tolaki', 'image' => 'images/tradisi/Lulo_new.png'],
            ['province_id' => 28, 'name' => 'Kabhanti', 'description' => 'Seni berbalas pantun suku Muna', 'image' => 'images/tradisi/Kabanti.jpg'],
            ['province_id' => 28, 'name' => 'Haroa', 'description' => 'Upacara syukuran panen suku Tolaki', 'image' => 'images/tradisi/haroa-85.png'],
            
            // 29. Gorontalo
            ['province_id' => 29, 'name' => 'Tari Saronde', 'description' => 'Tarian adat Gorontalo yang berasal dari tradisi pernikahan prasejarah, digunakan untuk menengok calon istri (Mopotulunuo) dan penyambutan tamu.', 'image' => 'images/tradisi/tari-saronde-86.png'],
            ['province_id' => 29, 'name' => 'Upacara Tumbilotohe', 'description' => 'Tradisi memasang lampu minyak di halaman rumah dan jalanan pada tiga malam terakhir Ramadan sebagai simbol penerangan jalan bagi masyarakat dan penyambutan malam Lailatul Qadar.', 'image' => 'images/tradisi/tumbilotohe_new.png'],
            ['province_id' => 29, 'name' => 'Dhikiri', 'description' => 'Seni vokal religius Gorontalo yang melantunkan puji-pujian kepada Allah SWT dan shalawat Nabi, biasanya dipentaskan pada peringatan Maulid Nabi.', 'image' => 'images/tradisi/dhikiri-88.png'],
            
            // 30. Sulawesi Barat
            ['province_id' => 30, 'name' => 'Tari Patuddu', 'description' => 'Tarian perang suku Mandar', 'image' => 'images/tradisi/tari-patuddu-89.png'],
            ['province_id' => 30, 'name' => 'Sayyang Pattuqduq', 'description' => 'Atraksi kuda menari khas Mandar', 'image' => 'images/tradisi/Sayyang_Pattudu_new.jpg'],
            ['province_id' => 30, 'name' => 'Upacara Maccera Tasi', 'description' => 'Ritual nelayan Mandar', 'image' => 'images/tradisi/Upacara Maccera Tasi.jpg'],
            
            // 31. Maluku
            ['province_id' => 31, 'name' => 'Tari Cakalele', 'description' => 'Tarian perang khas Maluku', 'image' => 'images/tradisi/Tari Cakalele.webp'],
            ['province_id' => 31, 'name' => 'Pukul Sapu', 'description' => 'Tradisi adu kekuatan dengan sapu lidi', 'image' => 'images/tradisi/Pukul Sapu.webp'],
            ['province_id' => 31, 'name' => 'Pela Gandong', 'description' => 'Sistem persaudaraan antar negeri', 'image' => 'images/tradisi/Pela Gandong.webp'],
            
            // 32. Maluku Utara
            ['province_id' => 32, 'name' => 'Tari Soya-Soya', 'description' => 'Tarian tradisional Ternate', 'image' => 'images/tradisi/tari-soya-soya-95.png'],
            ['province_id' => 32, 'name' => 'Kora-Kora', 'description' => 'Tradisi lomba perahu perang', 'image' => 'images/tradisi/kora-kora-96.png'],
            ['province_id' => 32, 'name' => 'Bambu Gila', 'description' => 'Permainan tradisional dengan bambu', 'image' => 'images/tradisi/bambu-gila-97.png'],
            
            // 33. Papua
            ['province_id' => 33, 'name' => 'Tari Yospan', 'description' => 'Tarian pergaulan muda-mudi Papua', 'image' => 'images/tradisi/tari-yospan-98.png'],
            ['province_id' => 33, 'name' => 'Bakar Batu', 'description' => 'Tradisi memasak dengan batu panas', 'image' => 'images/tradisi/bakar-batu-99.png'],
            ['province_id' => 33, 'name' => 'Tari Perang', 'description' => 'Tarian perang suku Dani', 'image' => 'images/tradisi/Tari Perang Suku.jpg'],
            
            // 34. Papua Barat
            ['province_id' => 34, 'name' => 'Tari Suanggi', 'description' => 'Tarian spiritual Papua Barat', 'image' => 'images/tradisi/Tari Suanggi.jpg'],
            ['province_id' => 34, 'name' => 'Ararem', 'description' => 'Upacara adat suku Biak', 'image' => 'images/tradisi/Ararem.jpg'],
            ['province_id' => 34, 'name' => 'Wor', 'description' => 'Tarian kepemilikan tanah Biak', 'image' => 'images/tradisi/Wor.jpeg'],
            
            // 35. Papua Selatan
            ['province_id' => 35, 'name' => 'Tari Gatsi', 'description' => 'Tarian selamat datang suku Asmat', 'image' => 'images/tradisi/Tari Gatsi.png'],
            ['province_id' => 35, 'name' => 'Ukiran Asmat', 'description' => 'Tradisi ukir kayu khas Asmat', 'image' => 'images/tradisi/Ukiran Asmat.jpg'],
            ['province_id' => 35, 'name' => 'Sago Grub', 'description' => 'Tradisi memanen sagu', 'image' => 'images/tradisi/Sago Grub.webp'],
            
            // 36. Papua Tengah
            ['province_id' => 36, 'name' => 'Tari Panah', 'description' => 'Tarian dengan busur panah', 'image' => 'images/tradisi/Tari_Panah_new.jpg'],
            ['province_id' => 36, 'name' => 'Upacara Bakar Batu', 'description' => 'Pesta adat suku Mee', 'image' => 'images/tradisi/Upacara Bakar Batu.webp'],
            ['province_id' => 36, 'name' => 'Noken', 'description' => 'Tradisi membuat tas khas Papua', 'image' => 'images/tradisi/Noken.jpg'],
            
            // 37. Papua Pegunungan
            ['province_id' => 37, 'name' => 'Tari Perang Suku', 'description' => 'Tarian perang antar suku', 'image' => 'images/tradisi/Tari Perang Suku.jpg'],
            ['province_id' => 37, 'name' => 'Koteka', 'description' => 'Pakaian adat pria Papua pegunungan', 'image' => 'images/tradisi/Koteka.webp'],
            ['province_id' => 37, 'name' => 'Upacara Pig Feast', 'description' => 'Pesta babi sebagai simbol kekayaan', 'image' => 'images/tradisi/Upacara Pig Feast.jpg'],
            
            // 38. Papua Barat Daya
            ['province_id' => 38, 'name' => 'Tari Topeng', 'description' => 'Tarian dengan topeng suku Kanum', 'image' => 'images/tradisi/Tari Topeng Papua.png'],
            ['province_id' => 38, 'name' => 'Ritual Sasi', 'description' => 'Larangan mengambil hasil laut/hutan', 'image' => 'images/tradisi/Ritual Sasi.jpg'],
            ['province_id' => 38, 'name' => 'Tari Bambu Gila', 'description' => 'Permainan dengan bambu yang bergerak', 'image' => 'images/tradisi/Tari Bambu Gila.jpg'],
        ];

        foreach ($tradisiData as $data) {
            if (isset($provinces[$data['province_id']])) {
                Tradisi::create($data);
            }
        }
    }
}
