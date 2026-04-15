<<<<<<< HEAD
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
    <strong>Faqih Abdullah</strong>
    <br>
    <strong>2311102048</strong>
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
PHP (Hypertext Preprocessor) merupakan bahasa pemrograman server-side yang digunakan untuk membangun aplikasi web dinamis. PHP bekerja dengan memproses logika program di sisi server, kemudian menghasilkan output dalam bentuk HTML yang ditampilkan pada browser pengguna. Dengan kemampuannya yang fleksibel, PHP dapat diintegrasikan dengan HTML serta digunakan untuk mengelola dan memproses data secara efisien.
</p>

<p align="justify">
Dalam pengembangan aplikasi web, PHP sering dimanfaatkan untuk mengolah data seperti perhitungan nilai, pengolahan input pengguna, serta penentuan kondisi berdasarkan logika tertentu. Konsep dasar yang sering digunakan dalam PHP meliputi array untuk penyimpanan data, function untuk modularisasi program, serta struktur kontrol seperti percabangan (if-else) dan perulangan (looping).
</p>

<p align="justify">
Pada praktikum ini, PHP digunakan untuk membangun sistem penilaian mahasiswa sederhana. Sistem ini mengolah data mahasiswa yang terdiri dari nilai tugas, UTS, dan UAS, kemudian menghitung nilai akhir berdasarkan bobot tertentu. Selanjutnya, sistem menentukan grade serta status kelulusan mahasiswa, dan menampilkan hasilnya dalam bentuk tabel yang informatif. Dengan demikian, praktikum ini membantu memahami penerapan konsep dasar PHP dalam pengolahan data secara nyata.
</p>


## Tugas Modul 9 - PHP: Buat Sistem Penilaian Mahasiswa
### Souce code - index.php
```php
<?php

<?php
// ============================================================
// SISTEM PENILAIAN MAHASISWA
// Faqih Abdullah
// ============================================================

// ---- 1. DATA MAHASISWA ----
$mahasiswa = [
    [
        "nama"        => "Andi Prasetyo",
        "nim"         => "2021001001",
        "nilai_tugas" => 85,
        "nilai_uts"   => 78,
        "nilai_uas"   => 82,
    ],
    [
        "nama"        => "Sari Dewi Lestari",
        "nim"         => "2021001002",
        "nilai_tugas" => 92,
        "nilai_uts"   => 88,
        "nilai_uas"   => 95,
    ],
    [
        "nama"        => "Budi Santoso",
        "nim"         => "2021001003",
        "nilai_tugas" => 60,
        "nilai_uts"   => 55,
        "nilai_uas"   => 58,
    ],
    [
        "nama"        => "Rizky Amalia",
        "nim"         => "2021001004",
        "nilai_tugas" => 75,
        "nilai_uts"   => 70,
        "nilai_uas"   => 68,
    ],
    [
        "nama"        => "Dian Permatasari",
        "nim"         => "2021001005",
        "nilai_tugas" => 45,
        "nilai_uts"   => 50,
        "nilai_uas"   => 42,
    ],
];

// ---- 2. FUNCTION: Hitung Nilai Akhir ----
// Bobot: Tugas 30% | UTS 35% | UAS 35%
function hitungNilaiAkhir(int $tugas, int $uts, int $uas): float {
    return ($tugas * 0.30) + ($uts * 0.35) + ($uas * 0.35);
}

// ---- 3. FUNCTION: Tentukan Grade ----
function tentukanGrade(float $nilai): string {
    if ($nilai >= 85) {
        return "A";
    } elseif ($nilai >= 75) {
        return "B";
    } elseif ($nilai >= 65) {
        return "C";
    } elseif ($nilai >= 55) {
        return "D";
    } else {
        return "E";
    }
}

// ---- 4. FUNCTION: Tentukan Status Kelulusan ----
function tentukanStatus(float $nilai): string {
    return ($nilai >= 60) ? "Lulus" : "Tidak Lulus";
}

// ---- 5. PROSES DATA DENGAN LOOP ----
$hasilNilai    = [];
$totalNilai    = 0;
$nilaiTertinggi = 0;
$mahasiswaTerbaik = "";

foreach ($mahasiswa as $mhs) {
    $nilaiAkhir = hitungNilaiAkhir(
        $mhs["nilai_tugas"],
        $mhs["nilai_uts"],
        $mhs["nilai_uas"]
    );

    $grade  = tentukanGrade($nilaiAkhir);
    $status = tentukanStatus($nilaiAkhir);

    // Kumpulkan hasil
    $hasilNilai[] = [
        "nama"        => $mhs["nama"],
        "nim"         => $mhs["nim"],
        "nilai_tugas" => $mhs["nilai_tugas"],
        "nilai_uts"   => $mhs["nilai_uts"],
        "nilai_uas"   => $mhs["nilai_uas"],
        "nilai_akhir" => $nilaiAkhir,
        "grade"       => $grade,
        "status"      => $status,
    ];

    // Akumulasi untuk statistik
    $totalNilai += $nilaiAkhir;

    if ($nilaiAkhir > $nilaiTertinggi) {
        $nilaiTertinggi   = $nilaiAkhir;
        $mahasiswaTerbaik = $mhs["nama"];
    }
}

// ---- 6. STATISTIK KELAS ----
$jumlahMahasiswa = count($mahasiswa);
$rataRata        = $totalNilai / $jumlahMahasiswa;
$gradeTerbaik    = tentukanGrade($nilaiTertinggi);

// Hitung jumlah lulus & tidak lulus
$jumlahLulus    = 0;
$jumlahTidakLulus = 0;
foreach ($hasilNilai as $h) {
    if ($h["status"] === "Lulus") {
        $jumlahLulus++;
    } else {
        $jumlahTidakLulus++;
    }
}

// ---- HELPER: Warna untuk badge grade ----
function gradeColor(string $grade): string {
    switch ($grade) {
        case "A": return "badge-a";
        case "B": return "badge-b";
        case "C": return "badge-c";
        case "D": return "badge-d";
        default:  return "badge-e";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
/* ============================================================
   SISTEM PENILAIAN MAHASISWA — Inline CSS
   ============================================================ */
:root {
    --bg:        #0d0f14;
    --bg-card:   #13161e;
    --bg-table:  #10121a;
    --border:    #1e2233;
    --border-hi: #2e3450;
    --text-primary:   #e8eaf2;
    --text-secondary: #7b82a0;
    --text-muted:     #40465c;
    --accent:    #5b7cfa;
    --accent-2:  #38d9a9;
    --accent-3:  #ffd166;
    --accent-4:  #ff6b6b;
    --grade-a: #38d9a9;
    --grade-b: #5b7cfa;
    --grade-c: #ffd166;
    --grade-d: #ff9a3c;
    --grade-e: #ff6b6b;
    --radius-sm: 6px;
    --radius:    10px;
    --radius-lg: 16px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }

body {
    background: var(--bg);
    color: var(--text-primary);
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    font-size: 15px;
    line-height: 1.6;
    min-height: 100vh;
}

.container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }

/* ---- HEADER ---- */
.site-header { padding: 40px 0 0; position: relative; overflow: hidden; }
.site-header::before {
    position: absolute; right: -20px; top: -10px;
    font-size: clamp(80px, 14vw, 160px);
    font-weight: 900;
    color: #1a1e2e;
    letter-spacing: -8px; line-height: 1;
    pointer-events: none; user-select: none;
}

.header-inner {
    max-width: 1200px; margin: 0 auto; padding: 0 24px 32px;
    display: flex; align-items: flex-end; justify-content: space-between;
    gap: 24px; flex-wrap: wrap;
}

.header-brand { display: flex; align-items: center; gap: 20px; }

.brand-icon {
    font-size: 48px; color: var(--accent); line-height: 1; display: block;
    animation: spin 10s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }

.brand-sub {
    font-family: 'Courier New', monospace;
    font-size: 11px; color: var(--accent);
    letter-spacing: 0.12em; text-transform: uppercase; margin-bottom: 4px;
}

.brand-title {
    font-size: clamp(28px, 5vw, 46px);
    font-weight: 800; line-height: 1.05;
    letter-spacing: -1.5px; color: var(--text-primary);
}
.brand-title em { font-style: normal; color: var(--accent); }

.header-meta { text-align: right; }

.meta-chip {
    display: inline-flex; align-items: center; gap: 8px;
    background: var(--bg-card); border: 1px solid var(--border);
    padding: 6px 14px; border-radius: 100px;
    font-family: 'Courier New', monospace; font-size: 12px;
    color: var(--text-secondary); margin-bottom: 8px;
}

.meta-dot {
    width: 6px; height: 6px; border-radius: 50%;
    background: var(--accent-2); box-shadow: 0 0 8px var(--accent-2);
    animation: pulse 2s ease-in-out infinite;
}
@keyframes pulse { 0%,100%{opacity:1;} 50%{opacity:0.3;} }

.meta-date { font-family: 'Courier New', monospace; font-size: 11px; color: var(--text-muted); }

.header-bar {
    height: 2px;
    background: linear-gradient(90deg, var(--accent) 0%, var(--accent-2) 40%, var(--accent-3) 70%, transparent 100%);
}

/* ---- STATS ---- */
.stats-section { padding: 40px 0; }

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 16px;
}

.stat-card {
    background: var(--bg-card); border: 1px solid var(--border);
    border-radius: var(--radius-lg); padding: 24px;
    position: relative; overflow: hidden;
    transition: border-color 0.2s, transform 0.2s;
}
.stat-card:hover { transform: translateY(-2px); border-color: var(--border-hi); }

.stat-total { border-left: 3px solid var(--accent); }
.stat-avg   { border-left: 3px solid var(--accent-2); }
.stat-top   { border-left: 3px solid var(--accent-3); }
.stat-pass  { border-left: 3px solid var(--accent-4); }

.stat-label {
    font-family: 'Inter', monospace; font-size: 15px;
    letter-spacing: 0.1em; text-transform: uppercase;
    color: #82B0F5; margin-bottom: 10px;
}

.stat-value {
    font-size: 42px; font-weight: 800; line-height: 1;
    letter-spacing: -2px; margin-bottom: 6px;
}
.stat-total .stat-value { color: var(--accent); }
.stat-avg   .stat-value { color: var(--accent-2); }
.stat-top   .stat-value { color: var(--accent-3); }
.stat-pass  .stat-value { color: var(--accent-4); }

.stat-slash { font-size: 22px; font-weight: 400; color: var(--text-muted); letter-spacing: 0; }
.stat-desc  { font-size: 15px; color: var(--text-secondary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

/* ---- TABLE SECTION ---- */
.table-section { padding: 0 0 60px; }

.table-header {
    display: flex; align-items: flex-end; justify-content: space-between;
    gap: 16px; margin-bottom: 20px; flex-wrap: wrap;
}

.section-title { font-size: 26px; font-weight: 800; letter-spacing: -0.8px; }
.section-sub   { font-family: 'Courier New', monospace; font-size: 17px; color: #82B0F5; margin-top: 4px; }

.legend { display: flex; gap: 10px; flex-wrap: wrap; align-items: center; }
.legend-item {
    display: flex; align-items: center; gap: 5px;
    font-family: 'Courier New', monospace; font-size: 11px; color: var(--text-secondary);
}

/* ---- TABLE ---- */
.table-wrap {
    background: var(--bg-card); border: 1px solid var(--border);
    border-radius: var(--radius-lg); overflow: hidden; overflow-x: auto;
}

.grade-table { width: 100%; border-collapse: collapse; min-width: 800px; }

.grade-table thead {
    background: var(--bg-table);
    border-bottom: 1px solid var(--border-hi);
}

.grade-table th {
    padding: 14px 16px;
    font-family: 'Courier New', monospace; font-size: 19px;
    letter-spacing: 0.08em; text-transform: uppercase;
    color: #cbd5ff; text-align: left;
    white-space: nowrap; font-weight: 500;
}
.th-no, .th-center { text-align: center; }
.th-num  { text-align: right; }

.th-weight {
    display: block; font-size: 19px; color: var(--accent);
    letter-spacing: 0; margin-top: 2px; text-transform: none;
}

.grade-table tbody tr {
    border-bottom: 1px solid var(--border);
    transition: background 0.15s;
}
.grade-table tbody tr:last-child { border-bottom: none; }
.grade-table tbody tr:hover { background: rgba(91,124,250,0.04); }
.grade-table tbody tr.row-top { background: rgba(255,209,102,0.05); }

.grade-table td { padding: 14px 16px; color: var(--text-primary); vertical-align: middle; }

.td-no {
    font-family: 'Courier New', monospace; font-size: 12px;
    color: var(--text-muted); text-align: center; width: 40px;
}

.td-nama { display: flex; align-items: center; gap: 10px; font-weight: 500; white-space: nowrap; }

.avatar {
    width: 32px; height: 32px; border-radius: 8px;
    background: linear-gradient(135deg, var(--accent), var(--accent-2));
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; font-weight: 700; color: #fff; flex-shrink: 0;
}

.crown { font-size: 13px; color: var(--accent-3); }

.td-nim { font-family: 'Courier New', monospace; font-size: 12px; color: var(--text-secondary); white-space: nowrap; }
.td-num, .td-final { text-align: right; font-family: 'Courier New', monospace; }
.td-final { font-size: 15px; font-weight: 600; color: var(--accent-2); }
.td-center { text-align: center; }

.tfoot-row {
    background: var(--bg-table) !important;
    border-top: 2px solid var(--border-hi) !important;
}
.tf-label {
    font-family: 'Courier New', monospace; font-size: 19px;
    letter-spacing: 0.08em; text-transform: uppercase;
    color: #e8eaf2; text-align: right; padding: 14px 16px;
}
.tf-avg { color: var(--accent-3) !important; font-weight: 700; }

/* ---- BADGES ---- */
.badge {
    display: inline-flex; align-items: center; justify-content: center;
    width: 32px; height: 32px; border-radius: 8px;
    font-size: 14px; font-weight: 700;
}
.badge-a { background: rgba(56,217,169,0.15); color: var(--grade-a); border: 1px solid rgba(56,217,169,0.3); }
.badge-b { background: rgba(91,124,250,0.15); color: var(--grade-b); border: 1px solid rgba(91,124,250,0.3); }
.badge-c { background: rgba(255,209,102,0.15); color: var(--grade-c); border: 1px solid rgba(255,209,102,0.3); }
.badge-d { background: rgba(255,154,60,0.15);  color: var(--grade-d); border: 1px solid rgba(255,154,60,0.3); }
.badge-e { background: rgba(255,107,107,0.15); color: var(--grade-e); border: 1px solid rgba(255,107,107,0.3); }

/* ---- STATUS PILLS ---- */
.status-pill {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 4px 12px; border-radius: 100px;
    font-size: 12px; font-weight: 500; white-space: nowrap;
    font-family: 'Courier New', monospace;
}
.pill-lulus { background: rgba(56,217,169,0.12); color: var(--accent-2); border: 1px solid rgba(56,217,169,0.25); }
.pill-tidak { background: rgba(255,107,107,0.12); color: var(--accent-4); border: 1px solid rgba(255,107,107,0.25); }

/* ---- PASS BAR ---- */
.pass-bar-wrap {
    margin-top: 20px; background: var(--bg-card);
    border: 1px solid var(--border); border-radius: var(--radius); padding: 16px 20px;
}
.pass-bar-label {
    display: flex; justify-content: space-between;
    font-family: 'Courier New', monospace; font-size: 19px;
    color: #ffffff; margin-bottom: 10px;
}
.pass-bar-label strong { color: var(--accent-2); }
.pass-bar-track { height: 6px; background: var(--border); border-radius: 100px; overflow: hidden; }
.pass-bar-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--accent-2), var(--accent));
    border-radius: 100px;
    box-shadow: 0 0 10px rgba(56,217,169,0.4);
}

/* ---- FOOTER ---- */
.site-footer { border-top: 1px solid var(--border); padding: 24px 0; margin-top: 20px; }
.footer-inner {
    display: flex; justify-content: space-between; align-items: center;
    font-family: 'Courier New', monospace; font-size: 12px;
    color: var(--text-muted); flex-wrap: wrap; gap: 8px;
}

/* ---- RESPONSIVE ---- */
@media (max-width: 640px) {
    .header-inner { align-items: flex-start; flex-direction: column; }
    .header-meta  { text-align: left; }
    .table-header { flex-direction: column; align-items: flex-start; }
    .stats-grid   { grid-template-columns: repeat(2, 1fr); }
}
    </style>
</head>
<body>

<!-- ========== HEADER ========== -->
<header class="site-header">
    <div class="header-inner">
        <div class="header-brand">
            <span class="brand-icon">◈</span>
            <div>
                <p class="brand-sub">Telkom University</p>
                <h1 class="brand-title">Sistem Penilaian<br><em>Mahasiswa</em></h1>
            </div>
        </div>
        <div class="header-meta">
            <div class="meta-chip">
                <span class="meta-dot"></span>
                Semester Genap 2024/2025
            </div>
            <p class="meta-date"><?= date("d F Y") ?></p>
        </div>
    </div>
    <div class="header-bar"></div>
</header>

<!-- ========== STATS CARDS ========== -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card stat-total">
                <p class="stat-label">Total Mahasiswa</p>
                <p class="stat-value"><?= $jumlahMahasiswa ?></p>
                <p class="stat-desc">terdaftar</p>
            </div>
            <div class="stat-card stat-avg">
                <p class="stat-label">Rata-rata Kelas</p>
                <p class="stat-value"><?= number_format($rataRata, 1) ?></p>
                <p class="stat-desc">nilai akhir</p>
            </div>
            <div class="stat-card stat-top">
                <p class="stat-label">Nilai Tertinggi</p>
                <p class="stat-value"><?= number_format($nilaiTertinggi, 1) ?></p>
                <p class="stat-desc"><?= htmlspecialchars($mahasiswaTerbaik) ?></p>
            </div>
            <div class="stat-card stat-pass">
                <p class="stat-label">Kelulusan</p>
                <p class="stat-value"><?= $jumlahLulus ?><span class="stat-slash">/<?= $jumlahMahasiswa ?></span></p>
                <p class="stat-desc"><?= $jumlahTidakLulus ?> tidak lulus</p>
            </div>
        </div>
    </div>
</section>

<!-- ========== TABEL NILAI ========== -->
<section class="table-section">
    <div class="container">
        <div class="table-header">
            <div>
                <h2 class="section-title">Rekap Nilai</h2>
                <p class="section-sub">Bobot: Tugas 30% · UTS 35% · UAS 35%</p>
            </div>
            <div class="legend">
                <span class="legend-item"><span class="badge badge-a">A</span> ≥ 85</span>
                <span class="legend-item"><span class="badge badge-b">B</span> ≥ 75</span>
                <span class="legend-item"><span class="badge badge-c">C</span> ≥ 65</span>
                <span class="legend-item"><span class="badge badge-d">D</span> ≥ 55</span>
                <span class="legend-item"><span class="badge badge-e">E</span> &lt; 55</span>
            </div>
        </div>

        <div class="table-wrap">
            <table class="grade-table">
                <thead>
                    <tr>
                        <th class="th-no">#</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th class="th-num">Tugas<span class="th-weight">30%</span></th>
                        <th class="th-num">UTS<span class="th-weight">35%</span></th>
                        <th class="th-num">UAS<span class="th-weight">35%</span></th>
                        <th class="th-num">Nilai Akhir</th>
                        <th class="th-center">Grade</th>
                        <th class="th-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($hasilNilai as $i => $row): ?>
                    <tr class="<?= $row['nilai_akhir'] === $nilaiTertinggi ? 'row-top' : '' ?>">
                        <td class="td-no"><?= $i + 1 ?></td>
                        <td class="td-nama">
                            <div class="avatar"><?= mb_substr($row['nama'], 0, 1) ?></div>
                            <span><?= htmlspecialchars($row['nama']) ?></span>
                            <?php if ($row['nilai_akhir'] === $nilaiTertinggi): ?>
                                <span class="crown">★</span>
                            <?php endif; ?>
                        </td>
                        <td class="td-nim"><?= htmlspecialchars($row['nim']) ?></td>
                        <td class="td-num"><?= $row['nilai_tugas'] ?></td>
                        <td class="td-num"><?= $row['nilai_uts'] ?></td>
                        <td class="td-num"><?= $row['nilai_uas'] ?></td>
                        <td class="td-final"><?= number_format($row['nilai_akhir'], 2) ?></td>
                        <td class="td-center">
                            <span class="badge <?= gradeColor($row['grade']) ?>"><?= $row['grade'] ?></span>
                        </td>
                        <td class="td-center">
                            <span class="status-pill <?= $row['status'] === 'Lulus' ? 'pill-lulus' : 'pill-tidak' ?>">
                                <?= $row['status'] === 'Lulus' ? '✓ Lulus' : '✗ Tidak Lulus' ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="tfoot-row">
                        <td colspan="6" class="tf-label">Rata-rata Kelas</td>
                        <td class="td-final tf-avg"><?= number_format($rataRata, 2) ?></td>
                        <td class="td-center">
                            <span class="badge <?= gradeColor(tentukanGrade($rataRata)) ?>">
                                <?= tentukanGrade($rataRata) ?>
                            </span>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Progress Bar Kelulusan -->
        <div class="pass-bar-wrap">
            <div class="pass-bar-label">
                <span>Tingkat Kelulusan</span>
                <strong><?= round(($jumlahLulus / $jumlahMahasiswa) * 100) ?>%</strong>
            </div>
            <div class="pass-bar-track">
                <div
                    class="pass-bar-fill"
                    style="width: <?= ($jumlahLulus / $jumlahMahasiswa) * 100 ?>%"
                ></div>
            </div>
        </div>
    </div>
</section>

<!-- ========== FOOTER ========== -->
<footer class="site-footer">
    <div class="container footer-inner">
        <p>Sistem Penilaian Mahasiswa &mdash; Modul 9 PHP</p>
        <p class="footer-credit">Generated by pakihaaa · <?= date("Y") ?></p>
    </div>
</footer>

</body>
</html>
```

### Screenshots Output
<img src="ss-modul9.png" alt="preview" style="width:100%; max-width:900px;">

# Penjelasan

<p align="justify">
Program ini merupakan sistem penilaian mahasiswa berbasis PHP yang menggunakan array asosiatif untuk menyimpan data mahasiswa, meliputi nama, NIM, serta nilai tugas, UTS, dan UAS. Data tersebut kemudian diolah menggunakan beberapa function untuk menghitung nilai akhir berdasarkan bobot yang telah ditentukan, yaitu tugas 30%, UTS 35%, dan UAS 35%.
</p>

<p align="justify">
Setelah nilai akhir diperoleh, program menentukan grade menggunakan percabangan (if-else) serta status kelulusan berdasarkan nilai yang dihasilkan. Selain itu, sistem juga menghitung statistik kelas seperti rata-rata nilai, nilai tertinggi, serta jumlah mahasiswa yang lulus dan tidak lulus.
</p>

<p align="justify">
Hasil pengolahan data ditampilkan dalam bentuk antarmuka web menggunakan HTML dan CSS dengan tampilan modern (dark mode). Informasi disajikan dalam bentuk dashboard yang terdiri dari card statistik, tabel rekap nilai mahasiswa, serta visualisasi tingkat kelulusan menggunakan progress bar, sehingga memudahkan pengguna dalam memahami data secara keseluruhan.
</p>
=======
# Modul 8

Silahkan upload tugas yang sudah diberikan beserta source code nya di folder masing masing

## Task

- Buat laporan dalam format Markdown file dengan penamaan README.md
- Upload Source Code dengan format yang sudah ditentukan sebelum nya (tugas-1, tugas-2, etc)
- Tambahkan watermark pada source code dan juga laporan (harus mengandung nim dan nama)

## Langkah Langkah Membuat Folder (khusus windows)

Membuat Folder terlebih dahulu dengan format NIM_Nama

~~~bash
mkdir "2311102081_Apri Pandu Wicaksono"
~~~

Pindah ke folder yang sudah di buat

~~~bash
cd "2311102081_Apri Pandu Wicaksono"
~~~

Lanjut Membuat File README

~~~bash
echo "" >> README.md
~~~

## Note

- Upload harus lewat github CLI, bukan menggunakan fitur drag and drop atau by platform github langsung
- Laporan praktikum berisi kan nama, logo, identitas, dan cover dan di upload dengan format README.md
- Di dalam folder masing masing mahasiswa harus berisi laporan (README.md, source code, dan file screenshot)

## Reference

- [Akses Materi](https://artk.my.id/modul-praktikum-abp)
- [Akun Github](https://artk.my.id/akun-github-abp-05)
>>>>>>> 5fc2f3f0da0978ff164f4d5af4495abde594231d
