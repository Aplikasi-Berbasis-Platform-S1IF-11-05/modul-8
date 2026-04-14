<div align="center">
  <br />
  <h1>LAPORAN PRAKTIKUM <br> APLIKASI BERBASIS PLATFORM </h1>
  <br />
  <h3>MODUL 9 <br> PHP </h3>
  <br />
  <img width="512" height="512" alt="telyu" src="https://github.com/user-attachments/assets/724a3291-bcf9-448d-a395-3886a8659d79" />
  <br />
  <br />
  <br />
  <h3>Disusun Oleh :</h3>
  <p>
    <strong>Rakha Yudhistira</strong>
    <br>
    <strong>2311102010</strong>
    <br>
    <strong>S1 IF-11-REG05</strong>
  </p>
  <br />
  <h3>Dosen Pengampu :</h3>
  <p>
    <strong>Dedi Agung Prabowo, S.Kom., M.Kom</strong>
  </p>
  <br />
  <br />
  <h4>Asisten Praktikum :</h4>
  <strong>Apri Pandu Wicaksono </strong>
  <br>
  <strong>Hamka Zaenul Ardi</strong>
  <br />
  <h3>LABORATORIUM HIGH PERFORMANCE <br>FAKULTAS INFORMATIKA <br>UNIVERSITAS TELKOM PURWOKERTO <br>2026 </h3>
</div>

<hr>

# Dasar Teori

<p align="justify">
PHP adalah bahasa pemrograman server-side scripting yang dirancang untuk menciptakan halaman web dinamis dengan mengeksekusi kode di server sebelum dikirimkan ke browser sebagai HTML. Keunggulannya terletak pada kemampuan mengolah data melalui variabel dan array asosiasi, serta fleksibilitas dalam mengintegrasikan logika pemrograman seperti struktur kontrol (perulangan dan pengkondisian) langsung di dalam dokumen web. Dengan dukungan berbagai fungsi bawaan dan kemudahan integrasi dengan database, PHP menjadi standar utama dalam pengembangan aplikasi web berbasis data yang efisien dan interaktif.
</p>


# Source Code index.html
```
<?php
/**
 * SISTEM PENILAIAN MAHASISWA
 * Tugas Modul 9 - PHP Dasar
 */

// --- 1. FUNGSI LOGIKA ---

function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.2) + ($uts * 0.35) + ($uas * 0.45);
}

function tentukanGrade($nilai) {
    if ($nilai >= 85) return "A";
    elseif ($nilai >= 75) return "B";
    elseif ($nilai >= 60) return "C";
    elseif ($nilai >= 50) return "D";
    else return "E";
}

function tentukanStatus($nilai) {
    return ($nilai >= 60) ? "Lulus" : "Tidak Lulus";
}

function dapatkanWarnaGrade($grade) {
    switch ($grade) {
        case 'A': return 'bg-primary';       // Biru
        case 'B': return 'bg-success';       // Hijau
        case 'C': return 'bg-warning text-dark'; // Kuning
        case 'D': 
        case 'E': return 'bg-danger';        // Merah
        default: return 'bg-secondary';
    }
}

// --- 2. DATA MAHASISWA (Array Asosiasi) ---

$daftar_mahasiswa = [
    ["nama" => "Rakha Yudhistira", "nim" => "4873", "tugas" => 95, "uts" => 90, "uas" => 92],
    ["nama" => "Nonoon", "nim" => "3556", "tugas" => 78, "uts" => 82, "uas" => 75],
    ["nama" => "Budi", "nim" => "3557", "tugas" => 55, "uts" => 60, "uas" => 58],
    ["nama" => "Ddodo Santoso", "nim" => "3660", "tugas" => 88, "uts" => 75, "uas" => 80],
    ["nama" => "Siti", "nim" => "3661", "tugas" => 70, "uts" => 65, "uas" => 68],
    ["nama" => "Fitri", "nim" => "7892", "tugas" => 60, "uts" => 65, "uas" => 68],
    ["nama" => "Agus", "nim" => "2321", "tugas" => 50, "uts" => 45, "uas" => 60],
];

// --- 3. PENGOLAHAN DATA & STATISTIK ---

$total_nilai = 0;
$nilai_tertinggi = 0;
$nilai_terendah = 100;
$jumlah_lulus = 0;

foreach ($daftar_mahasiswa as $key => $mhs) {
    $akhir = hitungNilaiAkhir($mhs['tugas'], $mhs['uts'], $mhs['uas']);
    $grade = tentukanGrade($akhir);
    $status = tentukanStatus($akhir);

    // Simpan hasil perhitungan kembali ke array asli
    $daftar_mahasiswa[$key]['akhir'] = $akhir;
    $daftar_mahasiswa[$key]['grade'] = $grade;
    $daftar_mahasiswa[$key]['status'] = $status;

    // Akumulasi Statistik
    $total_nilai += $akhir;
    if ($akhir > $nilai_tertinggi) $nilai_tertinggi = $akhir;
    if ($akhir < $nilai_terendah) $nilai_terendah = $akhir;
    if ($status == "Lulus") $jumlah_lulus++;
}
$rata_rata = $total_nilai / count($daftar_mahasiswa);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; font-family: 'Inter', sans-serif; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .table-container { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .badge-status-lulus { background-color: #e6fffa; color: #234e52; border: 1px solid #b2f5ea; }
        .badge-status-gagal { background-color: #fff5f5; color: #822727; border: 1px solid #feb2b2; }
        .stat-icon { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.9; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row mb-5">
        <div class="col-md-8">
            <h1 class="fw-bold text-dark">Laporan Nilai Akademik</h1>
            <p class="text-muted">Hasil evaluasi akhir semester mahasiswa Informatika.</p>
        </div>
        <div class="col-md-4 text-md-end align-self-center">
            <span class="badge bg-dark px-3 py-2">Modul 9 - PHP</span>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card p-3 bg-white border-start border-primary border-4">
                <span class="stat-icon text-primary fw-bold">Rata-rata</span>
                <h2 class="fw-bold mt-1 mb-0"><?= number_format($rata_rata, 1) ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 bg-white border-start border-success border-4">
                <span class="stat-icon text-success fw-bold">Tertinggi</span>
                <h2 class="fw-bold mt-1 mb-0"><?= number_format($nilai_tertinggi, 1) ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 bg-white border-start border-danger border-4">
                <span class="stat-icon text-danger fw-bold">Terendah</span>
                <h2 class="fw-bold mt-1 mb-0"><?= number_format($nilai_terendah, 1) ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 bg-white border-start border-warning border-4">
                <span class="stat-icon text-warning fw-bold">Kelulusan</span>
                <h2 class="fw-bold mt-1 mb-0"><?= $jumlah_lulus ?>/<?= count($daftar_mahasiswa) ?></h2>
            </div>
        </div>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th class="py-3">NIM</th>
                        <th class="py-3">Nama Mahasiswa</th>
                        <th class="py-3 text-center">Tugas</th>
                        <th class="py-3 text-center">UTS</th>
                        <th class="py-3 text-center">UAS</th>
                        <th class="py-3 text-center">Akhir</th>
                        <th class="py-3 text-center">Grade</th>
                        <th class="py-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($daftar_mahasiswa as $mhs) : ?>
                    <tr>
                        <td class="fw-medium"><?= $mhs['nim'] ?></td>
                        <td><?= $mhs['nama'] ?></td>
                        <td class="text-center"><?= $mhs['tugas'] ?></td>
                        <td class="text-center"><?= $mhs['uts'] ?></td>
                        <td class="text-center"><?= $mhs['uas'] ?></td>
                        <td class="text-center fw-bold text-primary"><?= number_format($mhs['akhir'], 1) ?></td>
                        <td class="text-center">
                            <span class="badge <?= dapatkanWarnaGrade($mhs['grade']) ?> px-3 py-2">
                                <?= $mhs['grade'] ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <?php if ($mhs['status'] == "Lulus"): ?>
                                <span class="badge badge-status-lulus px-3 py-2 w-75">Lulus</span>
                            <?php else: ?>
                                <span class="badge badge-status-gagal px-3 py-2 w-75">Gagal</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="mt-5 text-center">
        <p class="text-muted small">Rakha Yudhistira - 2311102010 &bull; 2026</p>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

```


# Screenshoot Program
<img width="1901" height="961" alt="image" src="Screenshot (724).png"/>




# Penjelasan
<p align="justify">

Program Sistem Penilaian Mahasiswa ini menggunakan PHP untuk mengolah data dari array asosiasi multidimensi secara dinamis. Melalui fungsi khusus, sistem menghitung nilai akhir, menentukan grade, dan status kelulusan mahasiswa secara otomatis. Tampilannya dipercantik dengan Bootstrap 5, yang menyajikan ringkasan statistik (rata-rata, nilai tertinggi/terendah) dalam bentuk kartu informasi serta tabel responsif. Penggunaan logika switch case dan kondisional memungkinkan pemberian warna indikator yang berbeda pada setiap grade, sehingga laporan menjadi lebih informatif dan profesional.
</p>