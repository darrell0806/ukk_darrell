<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\KoleksiModel;
class M_model extends Model
{
    public function tampil($table) {
        return $this->db->table($table)
        ->where("$table.deleted_at", null)
        ->orderBy('created_at', 'desc')
        ->get()
        ->getResult();
    }
    
    
    public function geta()
    {
        return $this->findAll();
    }
    public function hapus($table, $where){
        return $this->db->table($table)->delete($where);
    }
    public function simpan($table, $data){
        return $this->db->table($table)->insert($data);
    }
    public function getWhere($table, $where){
        return $this->db->table($table)->getWhere($where)->getRow();
    }
    public function qedit($table, $data, $where){
        return $this->db->table($table)->update($data, $where);
    }
    public function getStatusKoleksi($bookId)
    {
        $koleksiModel = new KoleksiModel();
        $statusKoleksi = $koleksiModel->where(['book_id' => $bookId])->first();
    
        // Periksa apakah statusKoleksi ada, jika tidak, berikan nilai default
        return $statusKoleksi ? $statusKoleksi['status'] : 'Default';
    }
    public function join2($table1, $table2, $on){
        return $this->db->table($table1)
        ->join($table2, $on, 'left')
        ->orderBy("$table1.created_at", 'desc') 
        ->get()
        ->getResult();
    }
    public function getAllRombelDetails()
    {
        $jenjang = session()->get('jenjang'); // Ambil jenjang dari sesi saat login
        
        $query = $this->db->table('guru')
        ->select('rombel.nama_r, user.jenjang, guru.user, guru.id_guru, guru.nik, guru.nama, kelas.nama_kelas, jurusan.nama_jurusan')
            ->join('user', 'user.id_user = guru.user') // Gabungkan guru dengan user
            ->join('rombel', 'rombel.id_rombel = guru.rombel')
            ->join('kelas', 'kelas.id_kelas = rombel.kelas')
            ->join('jurusan', 'jurusan.id_jurusan = rombel.jurusan')
            ->orderBy('guru.created_at', 'desc');
            
            if ($jenjang) {
            // Jika ada jenjang dalam sesi, tambahkan klausa WHERE untuk membatasi berdasarkan jenjang
                $query->where('user.jenjang', $jenjang);
            }
            
            return $query->get()->getResult();
        }
        
        
        public function getAllRombelDetaial($id_user)
        {
        $jenjang = session()->get('jenjang'); // Ambil jenjang dari sesi saat login
        
        // Mengambil ID rombel dari guru yang login
        $query = $this->db->table('guru')
        ->select('rombel')
        ->where('user', $id_user)
        ->get()
        ->getRow();
        
        if (!$query) {
            return []; 
        }
        
        $id_rombel = $query->rombel;
        
        $query = $this->db->table('siswa')
        ->select('rombel.nama_r, user.id_user, user.jenjang, siswa.user, siswa.id_siswa, siswa.nis, siswa.nama_siswa, kelas.nama_kelas, jurusan.nama_jurusan')
        ->join('rombel', 'rombel.id_rombel = siswa.rombel')
        ->join('user', 'user.id_user = siswa.user')
        ->join('kelas', 'kelas.id_kelas = rombel.kelas')
        ->join('jurusan', 'jurusan.id_jurusan = rombel.jurusan')
        ->where('siswa.rombel', $id_rombel)
        ->where('user.jenjang', $jenjang)
        ->orderBy('siswa.created_at', 'desc');
        
        
        return $query->get()->getResult();
    }
    
    public function getAllRombelDet($id_user)
    {
        $jenjang = session()->get('jenjang'); // Ambil jenjang dari sesi saat login
        
        // Mengambil ID rombel dari guru yang login
        $query = $this->db->table('guru')
        ->select('rombel')
        ->where('user', $id_user)
        ->get()
        ->getRow();
        
        if (!$query) {
            return []; 
        }
        
        $id_rombel = $query->rombel;
        
        $query = $this->db->table('siswa')
        ->select('rombel.nama_r, user.id_user, user.jenjang, siswa.user, siswa.id_siswa, siswa.nis, siswa.nama_siswa, kelas.nama_kelas, jurusan.nama_jurusan')
        ->join('rombel', 'rombel.id_rombel = siswa.rombel')
        ->join('user', 'user.id_user = siswa.user')
        ->join('kelas', 'kelas.id_kelas = rombel.kelas')
        ->join('jurusan', 'jurusan.id_jurusan = rombel.jurusan')
        ->where('siswa.rombel', $id_rombel)
        ->where('user.jenjang', $jenjang)
            ->where('user.level', 5) // Menambahkan kondisi untuk user level 5
            ->orderBy('siswa.created_at', 'desc');
            
            return $query->get()->getResult();
        }
        
        
        public function getAllRombel() {
            return $this->db->table('rombel')
            ->select('rombel.nama_r, rombel.id_rombel,kelas.nama_kelas, jurusan.nama_jurusan')
            ->join('kelas', 'kelas.id_kelas = rombel.kelas')
            ->join('jurusan', 'jurusan.id_jurusan = rombel.jurusan')
            ->get()
            ->getResult();
        }
        public function joinuser($table1, $table2, $table3, $on1, $on2)
        {
            return $this->db->table($table1)
            ->join($table2, $on1, 'left')
            ->join($table3, $on2, 'left')
            ->orderBy("$table1.created_at", 'desc')
            ->get()
            ->getResult();
        }
        public function joinusera($table1, $table2, $table3, $on1, $on2)
        {
        $jenjang = session()->get('jenjang'); // Ambil jenjang dari sesi saat login
        
        $query = $this->db->table($table1)
        ->join($table2, $on1, 'left')
        ->join($table3, $on2, 'left')
        ->orderBy("$table1.created_at", 'desc');
        
        if ($jenjang) {
            // Jika ada jenjang dalam sesi, tambahkan klausa WHERE untuk membatasi berdasarkan jenjang
            $query->where("$table1.jenjang", $jenjang);
        }
        
        return $query->get()->getResult();
    }
    public function join_with_user_id($table1, $table2, $on, $user_id) {
        return $this->db->table($table1)
        ->join($table2, $on, 'left')
        ->where("$table1.user", $user_id) 
        ->get()
        ->getResult();
    }
    
    public function joinaa($table1, $table2, $on, $where = array()){
        return $this->db->table($table1)
        ->join($table2, $on, 'left')
        ->where($where)
        ->get()
        ->getResult();
    }
    public function getblokById($id_blok)
    {
        return $this->db->table('blok')->where('id_blok', $id_blok)->get()->getRow();
    }
    public function gettahunById($id_tahun)
    {
        return $this->db->table('tahun')->where('id_tahun', $id_tahun)->get()->getRow();
    }
    
    public function getPelajaranById($id_pel)
    {
        return $this->db->table('pelajaran')->where('id_pel', $id_pel)->get()->getRow();
    }
    
    public function getWhere2($table, $where){
        return $this->db->table($table)->getWhere($where)->getRowArray();
    }
    public function join3($table1, $table2,$table3, $on,$on1){
        return $this->db->table($table1)
        ->join($table2, $on, 'left')
        ->join($table3, $on1, 'left')
        ->get() 
        ->getResult();
    }
    public function join4($table1, $table2, $table3, $table4, $on1, $on2, $on3)
    {
        $builder = $this->db->table($table1);
        $builder->select('*');
        $builder->join($table2, $on1);
        $builder->join($table3, $on2);
        $builder->join($table4, $on3);
        
        
        // Add the WHERE clause for deleted_at for each table
        $builder->where("$table1.deleted_at IS NULL");
        $builder->where("$table2.deleted_at IS NULL");
        $builder->where("$table3.deleted_at IS NULL");
        $builder->where("$table4.deleted_at IS NULL");
        
        
        $query = $builder->get();
        return $query->getResult();
    }
    
    public function join8($table1, $table2, $table3, $table4, $table5, $table6,$table7,$table8,$on1, $on2, $on3,$on4,$on5,$on6,$on7)
    {
        $builder = $this->db->table($table1);
        $builder->select('*');
        $builder->join($table2, $on1);
        $builder->join($table3, $on2);
        $builder->join($table4, $on3);
        $builder->join($table5, $on4);
        $builder->join($table6, $on5);
        $builder->join($table7, $on6);
        $builder->join($table8, $on7);
        $builder->orderBy($table1 . '.created_at', 'desc');

        
        $query = $builder->get();
        return $query->getResult();
    }
    public function getpeminjamanById($id_peminjaman)
    {
        return $this->db->table('peminjaman')->where('id_peminjaman', $id_peminjaman)->get()->getRow();
    }
    public function jointes($table1, $table2, $on){
        return $this->db->table($table1)
                        ->join($table2, $on, 'left')
                        ->where("$table1.deleted_at IS NOT NULL")
                        ->get()
                        ->getResult();
    }
    public function joint($table1, $table2, $on, $userLevel, $userId){
        $query = $this->db->table($table1)
        ->join($table2, $on, 'left');

    // For levels 1 to 4, allow them to see all data
        if ($userLevel >= 1 && $userLevel <= 4) {
            $query->where('pembayaran.deleted_at', null);
        } elseif ($userLevel == 5) {
        // For level 5, only show their own payment data (user_id in siswa should match the logged-in user's ID)
            $query->where('siswa.user', $userId)
            ->where('pembayaran.deleted_at', null);
        } else {
        // Invalid user level, return an empty result or handle the error accordingly
            return [];
        }

        return $query->get()->getResult();
    }

    public function joiny($table1, $table2, $on){
        return $this->db->table('pengeluaran')
        ->join('siswa', 'pengeluaran.siswa = siswa.id_siswa', 'left')
        ->where('pengeluaran.deleted_at', null)
        ->where('siswa.deleted_at', null)
        ->get()
        ->getResult();
    }
    public function filter2($table, $awal, $akhir)
    {
        return $this->db->query("
            SELECT *
            FROM ".$table."
            INNER JOIN level ON ".$table.".level = level.id_level
            WHERE ".$table.".created_at BETWEEN '".$awal."' AND '".$akhir."'
            ")->getResult();
    }
    public function filterbku($table, $awal, $akhir)
    {
        return $this->db->query("
            SELECT *
            FROM ".$table."
            INNER JOIN kategori ON ".$table.".kategori = kategori.id_kategori
            WHERE ".$table.".created_at BETWEEN '".$awal."' AND '".$akhir."'
            ")->getResult();
    }
    public function simpanDataNilai($data)
{
    // Lakukan operasi penyimpanan ke dalam tabel nilai
    $builder = $this->db->table('nilai');
    $builder->insertBatch($data);
}

    public function getDataByFilter22($rombel)
    {
        $builder = $this->db->table('siswa');
    
        // Tambahkan kolom yang akan dipilih
        $builder->select('siswa.*, rombel.*, kelas.*, jurusan.*');
    
        // Tambahkan join dan atur tipe join yang sesuai
        $builder->join('rombel', 'rombel.id_rombel = siswa.rombel', 'left');
        $builder->join('kelas', 'kelas.id_kelas = rombel.kelas', 'left');
        $builder->join('jurusan', 'jurusan.id_jurusan = rombel.jurusan', 'left');
    
        // Atur klausul WHERE sesuai dengan parameter yang diberikan
        $builder->where('siswa.rombel', $rombel);
    
        // Atur urutan hasil sesuai kebutuhan
        $builder->orderBy('siswa.nama_siswa', 'asc');
    
        // Eksekusi query dan kembalikan hasilnya
        $query = $builder->get();
            
        $results = $query->getResult();
        return $results;
    }
     public function getSiswaInfo($rombel)
    {
        return $this->db->table('siswa')
            ->join('rombel', 'rombel.id_rombel = siswa.rombel', 'left')
            ->where('siswa.rombel', $rombel)
            ->get()
            ->getResult();
    }
    public function getDataNilailah($tahun, $blok, $rombel, $id_siswa)
{
    $builder = $this->db->table('nilai');
    $builder->select('siswa.nis, siswa.nama_siswa, mapel.nama_mapel, nilai.pengetahuan, nilai.keterampilan');
    $builder->join('siswa', 'siswa.id_siswa = nilai.siswa');
    $builder->join('mapel', 'mapel.id_mapel = nilai.mapel');
    $builder->where('nilai.rombel', $rombel);
    $builder->where('nilai.tahun', $tahun);
    $builder->where('nilai.blok', $blok);
    $builder->where('nilai.siswa', $id_siswa);

    $query = $builder->get();
    $results = $query->getResult();

    return $results;
}

    public function getAllSiswaNilai($tahun, $blok, $rombel)
{
    $builder = $this->db->table('siswa');

    // Join dengan tabel nilai berdasarkan tahun, blok, dan rombel
    $builder->join('nilai', 'nilai.siswa = siswa.id_siswa');
    $builder->join('mapel', 'mapel.id_mapel = nilai.mapel');
    $builder->join('blok', 'blok.id_blok = nilai.blok');
    $builder->join('rombel', 'rombel.id_rombel = nilai.rombel');
    $builder->join('kelas', 'kelas.id_kelas = rombel.kelas');
    $builder->join('jurusan', 'jurusan.id_jurusan = rombel.jurusan');
    $builder->join('tahun', 'tahun.id_tahun = nilai.tahun');

    // Buat kondisi filter berdasarkan input pengguna
    $builder->where('nilai.blok', $blok);
    $builder->where('nilai.tahun', $tahun);
    $builder->where('nilai.rombel', $rombel);

    // Select kolom yang ingin ditampilkan
    $builder->select('siswa.id_siswa, siswa.nis, siswa.nama_siswa, mapel.nama_mapel, nilai.pengetahuan, nilai.keterampilan');

    // Eksekusi query dan kembalikan hasilnya
    $query = $builder->get();
    return $query->getResult();
}
public function filter22($table, $awal, $akhir, $status)
{
    return $this->db->query("
        SELECT peminjaman.*, book.nama_b, user.nama as nama
        FROM ".$table."
        INNER JOIN book ON peminjaman.id_book = book.id_book
        INNER JOIN user ON peminjaman.id_user = user.id_user
        WHERE peminjaman.tgl_pinjam BETWEEN '".$awal."' AND '".$akhir."'
        AND peminjaman.status = '".$status."'
    ")->getResult();
}
public function filter222($table, $awal, $akhir, $status)
{
    return $this->db->query("
        SELECT peminjaman.*, book.nama_b, user.nama as nama
        FROM ".$table."
        INNER JOIN book ON peminjaman.id_book = book.id_book
        INNER JOIN user ON peminjaman.id_user = user.id_user
        WHERE peminjaman.tgl_kembali BETWEEN '".$awal."' AND '".$akhir."'
        AND peminjaman.status = '".$status."'
    ")->getResult();
}


public function getKoleksiDataByIdUser($userId)
{
    return $this->db->table('koleksi')
        ->join('book', 'koleksi.book_id = book.id_book')
        ->join('user', 'koleksi.user_id = user.id_user')
        ->where('koleksi.user_id', $userId)
        ->get()
        ->getResult();
}

public function getDataByIdUser($userId)
{
    return $this->db->table('peminjaman')
        ->join('book', 'peminjaman.id_book = book.id_book')
        ->join('user', 'peminjaman.id_user = user.id_user')
        ->where('peminjaman.id_user', $userId)
        ->get()
        ->getResult();
}
public function getCommentsDataByIdUser($userId)
{
    return $this->db->table('comments')
        ->join('book', 'comments.book_id = book.id_book')
        ->join('user', 'comments.user_id = user.id_user')
        ->where('comments.user_id', $userId)
        ->get()
        ->getResult();
}
public function filtersi($table, $awal, $akhir)
{
    return $this->db->query("
        SELECT koleksi.*, book.nama_b, user.nama as nama
        FROM ".$table."
        INNER JOIN book ON koleksi.book_id = book.id_book
        INNER JOIN user ON koleksi.user_id = user.id_user
        WHERE koleksi.created_at BETWEEN '".$awal."' AND '".$akhir."'
    ")->getResult();
}
public function filtersip($table, $awal, $akhir)
{
    return $this->db->query("
        SELECT comments.*, book.nama_b, user.nama as nama
        FROM ".$table."
        INNER JOIN book ON comments.book_id = book.id_book
        INNER JOIN user ON comments.user_id = user.id_user
        WHERE comments.created_at BETWEEN '".$awal."' AND '".$akhir."'
    ")->getResult();
}
    public function getDataByFilter2($blok, $tahun, $rombel)
    {
        $builder = $this->db->table('absen');
    
        // Join dengan tabel lain
        $builder->join('siswa', 'siswa.id_siswa = absen.siswa');
    
        $builder->join('rombel', 'rombel.id_rombel = absen.rombel');
        $builder->join('kelas', 'kelas.id_kelas = rombel.kelas');
        $builder->join('jurusan', 'jurusan.id_jurusan = rombel.jurusan');
    
        $builder->join('blok', 'blok.id_blok = absen.blok');
        $builder->join('tahun', 'tahun.id_tahun = absen.tahun');
    
        // Buat kondisi filter berdasarkan input pengguna
        if ($blok) {
            $builder->where('absen.blok', $blok);
        }
        if ($tahun) {
            $builder->where('absen.tahun', $tahun);
        }
        if ($rombel) {
            $builder->where('absen.rombel', $rombel);
        }
    
        // Mengelompokkan data berdasarkan ID siswa dan menghitung jumlah status
        $builder->select('siswa.id_siswa, 
                          siswa.nama_siswa, 
                          SUM(CASE WHEN absen.status = "H" THEN 1 ELSE 0 END) AS hadir,
                          SUM(CASE WHEN absen.status = "S" THEN 1 ELSE 0 END) AS sakit,
                          SUM(CASE WHEN absen.status = "I" THEN 1 ELSE 0 END) AS izin,
                          SUM(CASE WHEN absen.status = "TK" THEN 1 ELSE 0 END) AS tanpa_keterangan');
    
        $builder->groupBy('siswa.id_siswa, siswa.nama_siswa');
    
        $builder->orderBy('siswa.nama_siswa', 'asc');
    
        // Execute the query and return the results
        $query = $builder->get();
        
        $results = $query->getResultArray();
    
        foreach ($results as &$row) {
            $hadir = $row['hadir'];
            $total = $hadir + $row['sakit'] + $row['izin'] + $row['tanpa_keterangan'];
    
            $persen = ($total > 0) ? ($hadir / $total) * 100 : 0;
            $row['persen'] = $persen;
        }
    
        return $results;
    }
    // Method untuk mendapatkan informasi blok berdasarkan id_blok
    public function getBlokInfo($blok)
    {
        return $this->db->table('blok')
            ->where('id_blok', $blok)
            ->get()
            ->getRow();
    }

    // Method untuk mendapatkan informasi rombel berdasarkan id_rombel
    public function getRombelInfo($rombel)
    {
        return $this->db->table('rombel')
        ->join('kelas', 'kelas.id_kelas = rombel.kelas')
        ->join('jurusan', 'jurusan.id_jurusan = rombel.jurusan')
            ->where('id_rombel', $rombel)

            ->get()
            ->getRow();
    }

    // Method untuk mendapatkan informasi tahun berdasarkan id_tahun
    public function getTahunInfo($tahun)
    {
        return $this->db->table('tahun')
            ->where('id_tahun', $tahun)
            ->get()
            ->getRow();
    }
    public function getDataNilai($tahun, $blok, $rombel, $id_siswa)
    {
        $builder = $this->db->table('nilai');
        
        // Tambahkan kolom yang akan dipilih
        $builder->select('nilai.*, siswa.*, rombel.*, kelas.*, jurusan.*, tahun.*, blok.*, guru.*, mapel.*');
        
        // Tambahkan join dan atur tipe join yang sesuai
        $builder->join('siswa', 'siswa.id_siswa = nilai.siswa');
        $builder->join('tahun', 'tahun.id_tahun = nilai.tahun');
        $builder->join('blok', 'blok.id_blok = nilai.blok');
        $builder->join('guru', 'guru.id_guru = nilai.guru');
        $builder->join('mapel', 'mapel.id_mapel = nilai.mapel');
        $builder->join('rombel', 'rombel.id_rombel = nilai.rombel');
        $builder->join('kelas', 'kelas.id_kelas = rombel.kelas');
        $builder->join('jurusan', 'jurusan.id_jurusan = rombel.jurusan');
        
        // Atur klausul WHERE sesuai dengan parameter yang diberikan
        $builder->where('nilai.rombel', $rombel);
        $builder->where('nilai.tahun', $tahun);
        $builder->where('nilai.blok', $blok);
        $builder->where('nilai.siswa', $id_siswa); // Add this line to filter by student ID
        
        $query = $builder->get();
    
        $results = $query->getResult();
        return $results;
    }
    public function getDataabsen($blok, $tahun, $rombel, $id_siswa)
    {
        $builder = $this->db->table('absen');
    
        // Join dengan tabel lain
        $builder->join('siswa', 'siswa.id_siswa = absen.siswa');
        $builder->join('rombel', 'rombel.id_rombel = absen.rombel');
        $builder->join('kelas', 'kelas.id_kelas = rombel.kelas');
        $builder->join('jurusan', 'jurusan.id_jurusan = rombel.jurusan');
        $builder->join('blok', 'blok.id_blok = absen.blok');
        $builder->join('tahun', 'tahun.id_tahun = absen.tahun');
    
        // Buat kondisi filter berdasarkan input pengguna
        $builder->where('absen.blok', $blok);
        $builder->where('absen.tahun', $tahun);
        $builder->where('absen.rombel', $rombel);
        $builder->where('absen.siswa', $id_siswa);
    
        // Mengelompokkan data berdasarkan ID siswa dan menghitung jumlah status
        $builder->select('siswa.id_siswa, 
                          siswa.nama_siswa, 
                          SUM(CASE WHEN absen.status = "H" THEN 1 ELSE 0 END) AS hadir,
                          SUM(CASE WHEN absen.status = "S" THEN 1 ELSE 0 END) AS sakit,
                          SUM(CASE WHEN absen.status = "I" THEN 1 ELSE 0 END) AS izin,
                          SUM(CASE WHEN absen.status = "TK" THEN 1 ELSE 0 END) AS tanpa_keterangan');
    
        $builder->groupBy('siswa.id_siswa, siswa.nama_siswa');
    
        // Execute the query and return the results
        $query = $builder->get();
    
        // Ambil data absensi berdasarkan siswa
        $result = $query->getRowArray();
    
        if ($result) {
            // Hitung persentase kehadiran jika data absensi ditemukan
            $hadir = $result['hadir'];
            $total = $hadir + $result['sakit'] + $result['izin'] + $result['tanpa_keterangan'];
            $persen = ($total > 0) ? ($hadir / $total) * 100 : 0;
            $result['persen'] = $persen;
        } else {
            // Jika data absensi tidak ditemukan, set persentase kehadiran ke 0
            $result = ['persen' => 0];
        }
    
        return $result;
    }
    


    public function getDataNilai2($tahun, $semester, $rombel, $id_siswa)
    {
        $builder = $this->db->table('nilai');
        
        // Tambahkan kolom yang akan dipilih
        $builder->select('nilai.*, siswa.*, rombel.*, kelas.*, jurusan.*, tahun.*, blok.*, guru.*, mapel.*');
        
        // Tambahkan join dan atur tipe join yang sesuai
        $builder->join('siswa', 'siswa.id_siswa = nilai.siswa');
        $builder->join('tahun', 'tahun.id_tahun = nilai.tahun');
        $builder->join('blok', 'blok.id_blok = nilai.blok');
        $builder->join('guru', 'guru.id_guru = nilai.guru');
        $builder->join('mapel', 'mapel.id_mapel = nilai.mapel');
        $builder->join('rombel', 'rombel.id_rombel = nilai.rombel');
        $builder->join('kelas', 'kelas.id_kelas = rombel.kelas');
        $builder->join('jurusan', 'jurusan.id_jurusan = rombel.jurusan');
        $blokRange = ($semester == 1) ? [2, 3, 4, 5] : [6, 7, 8, 9];
        $builder->whereIn('nilai.blok', $blokRange);
        $builder->where('nilai.rombel', $rombel);
        $builder->where('nilai.tahun', $tahun);
        $builder->where('nilai.siswa', $id_siswa); // Add this line to filter by student ID
        
        // Group by mata pelajaran untuk mendapatkan nilai rata-rata per mata pelajaran
        $builder->groupBy('nilai.mapel');
    
        // Hitung nilai rata-rata pengetahuan dan keterampilan
        $builder->select('nilai.mapel, AVG(nilai.pengetahuan) as rata_pengetahuan, AVG(nilai.keterampilan) as rata_keterampilan');
    
        $query = $builder->get();
        $results = $query->getResult();
        return $results;
    }
    

    public function getIdSemesterBlok($idSemester)
    {
        return $this->db->table('blok')
        ->where('semester', $idSemester)
        ->get()
        ->getResultArray();
    }

    public function getDataByFilter3($blok, $tahun, $rombel, $semester, $idSiswa)
    {
        $builder = $this->db->table('absen');
        
        // Join dengan tabel lain
        $builder->join('siswa', 'siswa.id_siswa = absen.siswa');
        
        $builder->join('rombel', 'rombel.id_rombel = absen.rombel');
        $builder->join('kelas', 'kelas.id_kelas = rombel.kelas');
        $builder->join('jurusan', 'jurusan.id_jurusan = rombel.jurusan');
        
        $builder->join('blok', 'blok.id_blok = absen.blok');
        $builder->join('tahun', 'tahun.id_tahun = absen.tahun');
        
        // Buat kondisi filter berdasarkan input pengguna
        if ($blok) {
            $builder->where('absen.blok', $blok);
        }
        if ($tahun) {
            $builder->where('absen.tahun', $tahun);
        }
        if ($rombel) {
            $builder->where('absen.rombel', $rombel);
        }
        if ($semester) {
        // Ambil ID semester dari blok yang dipilih
            $idBlokResults = $this->getIdSemesterBlok($semester);
            $idBloks = array_column($idBlokResults, 'id_blok');
            $builder->whereIn('absen.blok', $idBloks);
        }
        
        $builder->where('absen.siswa', $idSiswa);

        // Mengelompokkan data berdasarkan ID siswa dan menghitung jumlah status
        $builder->select('siswa.id_siswa, 
          siswa.nama_siswa, 
          SUM(CASE WHEN absen.status = "H" THEN 1 ELSE 0 END) AS hadir,
          SUM(CASE WHEN absen.status = "S" THEN 1 ELSE 0 END) AS sakit,
          SUM(CASE WHEN absen.status = "I" THEN 1 ELSE 0 END) AS izin,
          SUM(CASE WHEN absen.status = "TK" THEN 1 ELSE 0 END) AS tanpa_keterangan');
        
        $builder->groupBy('siswa.id_siswa, siswa.nama_siswa');
        
        $builder->orderBy('siswa.nama_siswa', 'asc');
        
        // Execute the query and return the results
        $query = $builder->get();
        
        $results = $query->getResultArray();
        
        foreach ($results as &$row) {
            $hadir = $row['hadir'];
            $total = $hadir + $row['sakit'] + $row['izin'] + $row['tanpa_keterangan'];
            
            $persen = ($total > 0) ? ($hadir / $total) * 100 : 0;
            $row['persen'] = $persen;
        }
        
        return $results;
    }

    public function getDataByFilter($semester, $tahun, $rombel)
    {
        $builder = $this->db->table('absen');
        // Lakukan penggabungan tabel dengan kriteria tertentu
        $builder->join('siswa', 'siswa.id_siswa = absen.siswa');
        $builder->join('rombel', 'rombel.id_rombel = absen.rombel');
        $builder->join('kelas', 'kelas.id_kelas = rombel.kelas');
        $builder->join('jurusan', 'jurusan.id_jurusan = rombel.jurusan');
        $builder->join('blok', 'blok.id_blok = absen.blok');
        $builder->join('tahun', 'tahun.id_tahun = absen.tahun');
        
        // Tentukan semester yang diinginkan
        if ($semester == 1) {
            $builder->whereIn('absen.blok', [2, 3, 4, 5]);
        } elseif ($semester == 2) {
            $builder->whereIn('absen.blok', [6, 7, 8, 9]);
        }
        
        // Tentukan tahun yang diinginkan
        if ($tahun) {
            $builder->where('absen.tahun', $tahun);
        }
        
        // Tentukan rombel yang diinginkan
        if ($rombel) {
            $builder->where('absen.rombel', $rombel);
        }
        
        // Seleksi data berdasarkan kriteria
        $builder->select('siswa.id_siswa, 
          siswa.nama_siswa, 
          SUM(CASE WHEN absen.status = "H" THEN 1 ELSE 0 END) AS hadir,
          SUM(CASE WHEN absen.status = "S" THEN 1 ELSE 0 END) AS sakit,
          SUM(CASE WHEN absen.status = "I" THEN 1 ELSE 0 END) AS izin,
          SUM(CASE WHEN absen.status = "TK" THEN 1 ELSE 0 END) AS tanpa_keterangan');
        $builder->groupBy('siswa.id_siswa, siswa.nama_siswa');
        $builder->orderBy('siswa.nama_siswa', 'asc');
        
        $query = $builder->get();
        $results = $query->getResultArray();
        
        // Hitung presentase berdasarkan total hadir dan total keseluruhan
        foreach ($results as &$row) {
            $hadir = $row['hadir'];
            $total = $hadir + $row['sakit'] + $row['izin'] + $row['tanpa_keterangan'];
            $persen = ($total > 0) ? ($hadir / $total) * 100 : 0;
            $row['persen'] = $persen;
        }
        
        return $results;
    }
    
    
    
    public function filterAbsensi($table, $blok, $tahun, $rombel)
    {
        $query = "
        SELECT $table.*
        FROM $table
        JOIN tahun ON $table.tahun = tahun.id_tahun
        JOIN blok ON $table.blok = blok.id_blok
        JOIN rombel ON $table.rombel = rombel.id_rombel
        JOIN siswa ON $table.siswa = siswa.id_siswa
        WHERE $table.blok = ? AND $table.tahun = ? AND $table.rombel = ?";
        
        return $this->db->query($query, [$blok, $tahun, $rombel])->getResult();
    }
    
    

    public function filter_hadir($table, $tanggal)
    {
        return $this->db->query("
            SELECT *
            FROM " . $table . "
            LEFT JOIN siswa ON " . $table . ".siswa = siswa.id_siswa
            WHERE " . $table . ".tanggal = '" . $tanggal . "'
            ")->getResult();
    }
    public function filter_hadir_e($table, $tanggal)
    {
        return $this->db->query("
            SELECT *
            FROM " . $table . "
            LEFT JOIN siswa ON " . $table . ".siswa = siswa.id_siswa
            LEFT JOIN mapel ON " . $table . ".mapel = mapel.id_mapel
            WHERE " . $table . ".tanggal = '" . $tanggal . "'
            ORDER BY sesi ASC
            ")->getResult();
    }
    
    
    public function filter_hadir_guru($table, $tanggal, $id_user)
    {
        $builder = $this->db->table($table);
        $builder->select('*');
        $builder->join('siswa', $table . '.siswa = siswa.id_siswa', 'left');
        $builder->join('kelas as kelas_siswa', 'siswa.kelas = kelas_siswa.id_kelas', 'left');
        $builder->join('guru', 'kelas_siswa.id_kelas = guru.kelas', 'left');
        $builder->where('guru.user', $id_user);
        $builder->where($table . '.tanggal', $tanggal);
        $builder->orderBy($table . '.created_at', 'desc');
        
        $query = $builder->get();
        return $query->getResult();
    }
    public function filter_hadir_guru_e($table, $tanggal, $id_user)
    {
        $builder = $this->db->table($table);
        $builder->select('*');
        $builder->join('siswa', $table . '.siswa = siswa.id_siswa', 'left');
        $builder->join('mapel', $table . '.mapel = mapel.id_mapel');
        $builder->join('kelas as kelas_siswa', 'siswa.kelas = kelas_siswa.id_kelas', 'left');
        $builder->join('guru', 'kelas_siswa.id_kelas = guru.kelas', 'left');
        $builder->where('guru.user', $id_user);
        $builder->where($table . '.tanggal', $tanggal);
        $builder->orderBy($table . '.sesi', 'asc');
        
        $query = $builder->get();
        return $query->getResult();
    }
    public function filterrr($table, $awal, $akhir)
    {
        return $this->db->query("
            SELECT *
            FROM ".$table."
            INNER JOIN siswa ON ".$table.".siswa = siswa.id_siswa
            WHERE ".$table.".tanggal BETWEEN '".$awal."' AND '".$akhir."'
            ")->getResult();
    }
    public function getPaymentDataBySiswaId($id_siswa)
    {
        return $this->db->table('pembayaran')
        ->join('siswa', 'pembayaran.siswa = siswa.id_siswa', 'left')
        ->where('pembayaran.siswa', $id_siswa)
        ->where('pembayaran.deleted_at', null)
        ->where('siswa.deleted_at', null)
            ->where('pembayaran.status', 'Uang-Kas') // Add this line to filter by 'Uang-Kas' status
            ->where('pembayaran.status2', 'Lunas')    // Add this line to filter by 'Lunas' status
            ->get()
            ->getResult();
        }
        public function getPaymenttDataBySiswaId($id_siswa)
        {
            return $this->db->table('pembayaran')
            ->join('siswa', 'pembayaran.siswa = siswa.id_siswa', 'left')
            ->where('pembayaran.siswa', $id_siswa)
            ->where('pembayaran.deleted_at', null)
            ->where('siswa.deleted_at', null)
            ->where('pembayaran.status', 'Uang-Kas') // Add this line to filter by 'Uang-Kas' status
            ->where('pembayaran.status2', 'Belum-Lunas')    // Add this line to filter by 'Lunas' status
            ->get()
            ->getResult();
        }
        public function getdenda($id_siswa)
        {
            return $this->db->table('pembayaran')
            ->join('siswa', 'pembayaran.siswa = siswa.id_siswa', 'left')
            ->where('pembayaran.siswa', $id_siswa)
            ->where('pembayaran.deleted_at', null)
            ->where('siswa.deleted_at', null)
            ->where('pembayaran.status', 'Uang-Denda') // Add this line to filter by 'Uang-Kas' status
            ->where('pembayaran.status2', 'Lunas')    // Add this line to filter by 'Lunas' status
            ->get()
            ->getResult();
        }
        
        public function getdendaa($id_siswa)
        {
            return $this->db->table('pembayaran')
            ->join('siswa', 'pembayaran.siswa = siswa.id_siswa', 'left')
            ->where('pembayaran.siswa', $id_siswa)
            ->where('pembayaran.deleted_at', null)
            ->where('siswa.deleted_at', null)
            ->where('pembayaran.status', 'Uang-Denda') // Add this line to filter by 'Uang-Kas' status
            ->where('pembayaran.status2', 'Belum-Lunas')    // Add this line to filter by 'Lunas' status
            ->get()
            ->getResult();
        }

        public function getSiswaWithConditions($on, $on1, $on2, $id_guru)
        {
            $query = $this->db->table('siswa')
            ->join('kelas', $on)
            ->join('jurusan', $on1)
            ->join('rombel', $on2)
            ->where('rombel.guru', $id_guru) 
            ->get()
            ->getResult();
        }


        public function getGuruByUserId($id_user)
        {

            $query = $this->db->table('guru')
            ->where('user', $id_user)
            ->get();
            return $query->getRowArray();
        }
        public function join4_where($table1, $table2, $table3, $table4, $on1, $on2, $on3, $where)
        {
            $builder = $this->db->table($table1);
            $builder->select('*');
            $builder->join($table2, $on1);
            $builder->join($table3, $on2);
            $builder->join($table4, $on3);
            $builder->where($where);
            $query = $builder->get();
            return $query->getResult();
        }
        public function getSiswaByGuruId($id_user)
        {
            $builder = $this->db->table('siswa');
            $builder->select('*');
            $builder->join('kelas as kelas_siswa', 'siswa.kelas = kelas_siswa.id_kelas');
            $builder->join('guru', 'kelas_siswa.id_kelas = guru.kelas');
            $builder->where('guru.user', $id_user);
            $builder->orderBy('siswa.created_at', 'desc');

            $query = $builder->get();
            return $query->getResult();
        }
        public function getSiswaBySiswaId($id_user)
        {
            $builder = $this->db->table('siswa');
            $builder->select(['siswa.*', 'kelas.nama_kelas']);
            $builder->join('kelas', 'siswa.kelas = kelas.id_kelas');
            
    // Ambil ID kelas siswa yang login
            $kelasSiswa = $builder->where('siswa.user', $id_user)->get()->getRow();
            $id_kelas_siswa = $kelasSiswa->kelas;
            
    // Sekarang gunakan ID kelas siswa untuk mengambil semua siswa dengan kelas yang sama
            $builder->resetQuery();
            $builder->select(['siswa.*', 'kelas.nama_kelas']);
            $builder->join('kelas', 'siswa.kelas = kelas.id_kelas');
            $builder->where('siswa.kelas', $id_kelas_siswa);
            $builder->orderBy('siswa.created_at', 'desc');
            
            $query = $builder->get();
            return $query->getResult();
        }

        public function getSiswaBySiswaIdd($id_user)
        {
            $builder = $this->db->table('hadir');
            $builder->select('*');
            
    // Dapatkan ID kelas siswa yang login
            $kelasSiswa = $this->db->table('siswa')
            ->select('kelas')
            ->where('user', $id_user)
            ->get()
            ->getRow();
            $id_kelas_siswa = $kelasSiswa->kelas;

    // Gabungkan tabel hadir dengan tabel siswa berdasarkan kelas yang sama
            $builder->join('siswa', 'hadir.siswa = siswa.id_siswa');
            $builder->where('siswa.kelas', $id_kelas_siswa);
            $builder->orderBy('hadir.created_at', 'desc');

            $query = $builder->get();
            return $query->getResult();
        }
        public function filter_hadir_siswa($table, $tanggal, $id_user)
        {
            $builder = $this->db->table($table);
            $builder->select('*');
            
    // Dapatkan ID kelas siswa yang login
            $kelasSiswa = $this->db->table('siswa')
            ->select('kelas')
            ->where('user', $id_user)
            ->get()
            ->getRow();
            $id_kelas_siswa = $kelasSiswa->kelas;

    // Gabungkan tabel hadir dengan tabel siswa berdasarkan kelas yang sama
            $builder->join('siswa', $table . '.siswa = siswa.id_siswa');
            $builder->where('siswa.kelas', $id_kelas_siswa);
            $builder->where($table . '.tanggal', $tanggal);
            $builder->orderBy($table . '.created_at', 'desc');

            $query = $builder->get();
            return $query->getResult();
        }
        public function filter_hadir_siswa_e($table, $tanggal, $id_user)
        {
            $builder = $this->db->table($table);
            $builder->select('*');

    // Dapatkan ID kelas siswa yang login
            $kelasSiswa = $this->db->table('siswa')
            ->select('kelas')
            ->where('user', $id_user)
            ->get()
            ->getRow();
            $id_kelas_siswa = $kelasSiswa->kelas;

    // Gabungkan tabel hadir dengan tabel siswa berdasarkan kelas yang sama
            $builder->join('siswa', $table . '.siswa = siswa.id_siswa');
            $builder->join('mapel', $table . '.mapel = mapel.id_mapel');
            $builder->where('siswa.kelas', $id_kelas_siswa);
            $builder->where($table . '.tanggal', $tanggal);
            $builder->orderBy($table . '.sesi', 'asc');

            $query = $builder->get();
            return $query->getResult();
        }
        public function getSiswaBySiswaIId($id_user)
        {
            $builder = $this->db->table('pelajaran');
            $builder->select('*');
            
    // Dapatkan ID kelas siswa yang login
            $kelasSiswa = $this->db->table('siswa')
            ->select('kelas')
            ->where('user', $id_user)
            ->get()
            ->getRow();
            $id_kelas_siswa = $kelasSiswa->kelas;

            $builder->join('mapel', 'pelajaran.mapel = mapel.id_mapel');
            $builder->join('siswa', 'pelajaran.siswa = siswa.id_siswa', 'left');
            $builder->where('siswa.kelas', $id_kelas_siswa);
            $builder->orderBy('pelajaran.created_at', 'desc');

            $query = $builder->get();
            return $query->getResult();
        }
        public function getSiswaByGuruId2($id_user)
        {
            $builder = $this->db->table('siswa');
            $builder->select('*');
            $builder->join('kelas as kelas_siswa', 'siswa.kelas = kelas_siswa.id_kelas');
            $builder->join('guru', 'kelas_siswa.id_kelas = guru.kelas');
    $builder->join('user', 'siswa.user = user.id_user'); // Menambahkan join ke tabel users
    $builder->where('user.level', 4); // Menambahkan kondisi WHERE untuk level pengguna
    $builder->where('guru.user', $id_user);
    $builder->orderBy('siswa.created_at', 'desc');

    $query = $builder->get();
    return $query->getResult();
}
public function getSiswaByGuruIdd($id_user)
{
    $builder = $this->db->table('hadir');
    $builder->select('*');
    $builder->join('siswa', 'hadir.siswa = siswa.id_siswa');
    $builder->join('kelas as kelas_siswa', 'siswa.kelas = kelas_siswa.id_kelas');
    $builder->join('guru', 'kelas_siswa.id_kelas = guru.kelas');
    $builder->where('guru.user', $id_user);
    $builder->orderBy('hadir.created_at', 'desc');

    $query = $builder->get();
    return $query->getResult();
}
public function getSiswaByGuruIId($id_user)
{
    $builder = $this->db->table('pelajaran');
    $builder->select('*');
    $builder->join('siswa', 'pelajaran.siswa = siswa.id_siswa', 'left');
    $builder->join('mapel', 'pelajaran.mapel = mapel.id_mapel');
    $builder->join('kelas as kelas_siswa', 'siswa.kelas = kelas_siswa.id_kelas');
    $builder->join('guru', 'kelas_siswa.id_kelas = guru.kelas');
    $builder->where('guru.user', $id_user);
    $builder->orderBy('pelajaran.created_at', 'desc');

    $query = $builder->get();
    return $query->getResult();
}

public function getAllPaymentData()
{
    $builder = $this->db->table('pembayaran');
    $builder->select('*');
    $builder->join('siswa', 'pembayaran.siswa = siswa.id_siswa');
    $builder->where('pembayaran.deleted_at IS NULL');

    $query = $builder->get();
    return $query->getResult();
}

public function getAllPData()
{
    $jenjang = session()->get('jenjang'); // Ambil jenjang dari sesi saat login

    $query = $this->db->table('siswa')
    ->select('rombel.nama_r, user.id_user, user.jenjang, siswa.user, siswa.id_siswa, siswa.nis, siswa.nama_siswa, kelas.nama_kelas, jurusan.nama_jurusan')
    ->join('rombel', 'rombel.id_rombel = siswa.rombel')
    ->join('user', 'user.id_user = siswa.user')
    ->join('kelas', 'kelas.id_kelas = rombel.kelas')
    ->join('jurusan', 'jurusan.id_jurusan = rombel.jurusan')
    ->orderBy('siswa.created_at', 'desc');

    if ($jenjang) {
        // Jika ada jenjang dalam sesi, tambahkan klausa WHERE untuk membatasi berdasarkan jenjang
        $query->where('user.jenjang', $jenjang);
    }

    return $query->get()->getResult();
}
public function getAllPDatat()
{
    $jenjang = session()->get('jenjang'); // Ambil jenjang dari sesi saat login

    $query = $this->db->table('siswa')
    ->select('rombel.nama_r, user.id_user, user.jenjang, siswa.user, siswa.id_siswa, siswa.nis, siswa.nama_siswa, kelas.nama_kelas, jurusan.nama_jurusan')
    ->join('rombel', 'rombel.id_rombel = siswa.rombel')
    ->join('user', 'user.id_user = siswa.user')
    ->join('kelas', 'kelas.id_kelas = rombel.kelas')
    ->join('jurusan', 'jurusan.id_jurusan = rombel.jurusan')
    ->orderBy('siswa.created_at', 'desc');

    if ($jenjang) {
        // Jika ada jenjang dalam sesi, tambahkan klausa WHERE untuk membatasi berdasarkan jenjang
        $query->where('user.jenjang', $jenjang);
    }

    $query->where('user.level', 5); // Menambahkan kondisi untuk user level 5

    return $query->get()->getResult();
}

public function getAllPDatta()
{
    $builder = $this->db->table('pelajaran');
    $builder->select('*');
    $builder->join('siswa', 'pelajaran.siswa = siswa.id_siswa', 'left');
    $builder->join('mapel', 'pelajaran.mapel = mapel.id_mapel');
    
    $builder->orderBy('pelajaran.created_at', 'desc');
    
    $query = $builder->get();
    return $query->getResult();
}
public function getAllPDataa()
{
    $builder = $this->db->table('hadir');
    $builder->select('*');
    $builder->join('siswa', 'hadir.siswa = siswa.id_siswa');
    
    $builder->orderBy('hadir.created_at', 'desc');

    $query = $builder->get();
    return $query->getResult();
}
public function getAllPData2()
{
    $builder = $this->db->table('siswa');
    $builder->select('*');
    $builder->join('kelas', 'siswa.kelas = kelas.id_kelas');
        $builder->join('user', 'siswa.user = user.id_user'); // Menambahkan join ke tabel users
        $builder->where('user.level', 4);
        $builder->orderBy('siswa.created_at', 'desc');

        $query = $builder->get();
        return $query->getResult();
    }
    public function getPaymentDataByUserId($id_user)
    {
        $builder = $this->db->table('pembayaran');
        $builder->select('*');
        $builder->join('siswa', 'pembayaran.siswa = siswa.id_siswa');
        $builder->join('rombel', 'siswa.rombel = rombel.id_rombel');
        $builder->join('guru', 'rombel.guru = guru.id_guru'); // Menyambungkan guru dengan rombel berdasarkan ID user guru.
        $builder->where('guru.user', $id_user); // Memfilter siswa berdasarkan ID user guru yang masuk.

        $query = $builder->get();
        return $query->getResult();
    }

    public function getPaymentDataByLoggedInStudent($userId)
    {
    // Mengambil informasi rombel siswa yang sedang login
        $builder = $this->db->table('siswa');
        $builder->select('rombel');
        $builder->where('user', $userId);
        
        $query = $builder->get();
        $result = $query->getRow();

        if ($result) {
        // Mengambil data pembayaran berdasarkan rombel siswa yang login
            $builder = $this->db->table('pembayaran');
            $builder->select('*');
            $builder->join('siswa', 'pembayaran.siswa = siswa.id_siswa');
            $builder->join('rombel', 'siswa.rombel = rombel.id_rombel');
        $builder->where('siswa.rombel', $result->rombel); // Menggunakan informasi rombel
        
        $query = $builder->get();
        return $query->getResult();
    }

    return []; // Mengembalikan array kosong jika data siswa tidak ditemukan
}
public function getPaymentDataByLoggedInStudentpem($userId)
{
    // Mengambil informasi rombel siswa yang sedang login
    $builder = $this->db->table('siswa');
    $builder->select('rombel');
    $builder->where('user', $userId);
    
    $query = $builder->get();
    $result = $query->getRow();

    if ($result) {
        // Mengambil data siswa berdasarkan rombel siswa yang login
        $builder = $this->db->table('siswa');
        $builder->select('*');
        $builder->join('kelas', 'siswa.kelas = kelas.id_kelas');
        $builder->join('jurusan', 'siswa.jurusan = jurusan.id_jurusan');
        $builder->join('rombel', 'siswa.rombel = rombel.id_rombel');
        $builder->where('rombel.id_rombel', $result->rombel);
        $builder->where('siswa.deleted_at', null); // Menggunakan informasi rombel
        
        $query = $builder->get();
        return $query->getResult();
    }

    return []; // Mengembalikan array kosong jika data siswa tidak ditemukan
}
public function getPaymentDataByLoggedInStudentpen($userId)
{
    $builder = $this->db->table('siswa');
    $builder->select('rombel');
    $builder->where('user', $userId);
    
    $query = $builder->get();
    $result = $query->getRow();

    if ($result) {
        // Mengambil data siswa berdasarkan rombel siswa yang login
        $builder = $this->db->table('siswa');
        $builder->select('*');
        $builder->join('kelas', 'siswa.kelas = kelas.id_kelas');
        $builder->join('jurusan', 'siswa.jurusan = jurusan.id_jurusan');
        $builder->join('rombel', 'siswa.rombel = rombel.id_rombel');
        $builder->where('rombel.id_rombel', $result->rombel);
        $builder->where('siswa.deleted_at', null); // Menggunakan informasi rombel
        
        $query = $builder->get();
        return $query->getResult();
    }

    return []; // Mengembalikan array kosong jika data siswa tidak ditemukan
}

public function getPaymentDataByLoggedInStudentt($userId)
{
  
    $builder = $this->db->table('siswa');
    $builder->select('rombel');
    $builder->where('user', $userId);
    
    $query = $builder->get();
    $result = $query->getRow();

    if ($result) {
        // Mengambil data pembayaran berdasarkan rombel siswa yang login
        $builder = $this->db->table('pengeluaran');
        $builder->select('*');
        $builder->join('siswa', 'pengeluaran.siswa = siswa.id_siswa');
        $builder->join('rombel', 'siswa.rombel = rombel.id_rombel');
        $builder->where('siswa.rombel', $result->rombel); // Menggunakan informasi rombel
        
        $query = $builder->get();
        return $query->getResult();
    }

    return []; // Mengembalikan array kosong jika data siswa tidak ditemukan
}
public function getPaymentDataByUserIdd($id_user)
{
    $builder = $this->db->table('pengeluaran');
    $builder->select('*');
    $builder->join('siswa', 'pengeluaran.siswa = siswa.id_siswa');
    $builder->join('rombel', 'siswa.rombel = rombel.id_rombel');
        $builder->join('guru', 'rombel.guru = guru.id_guru'); // Menyambungkan guru dengan rombel berdasarkan ID user guru.
        $builder->where('guru.user', $id_user); // Memfilter siswa berdasarkan ID user guru yang masuk.

        $query = $builder->get();
        return $query->getResult();
    }
    public function getAllPaymentDataa()
    {
        $builder = $this->db->table('pengeluaran');
        $builder->select('*');
        $builder->join('siswa', 'pengeluaran.siswa = siswa.id_siswa');
        $builder->where('pengeluaran.deleted_at IS NULL');

        $query = $builder->get();
        return $query->getResult();
    }


    

    
}