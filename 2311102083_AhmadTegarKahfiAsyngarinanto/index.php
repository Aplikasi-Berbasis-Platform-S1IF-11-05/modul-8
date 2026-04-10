<?php
// ============================================================
// 2311102083 - Ahmad Tegar Kahfi Asyngarinanto
// Modul 8 - Sistem Penilaian Mahasiswa
// ============================================================

// Array asosiatif data mahasiswa
$mahasiswa = [
    [
        "nama"        => "Ahmad Tegar Kahfi",
        "nim"         => "2311102083",
        "nilai_tugas" => 85,
        "nilai_uts"   => 78,
        "nilai_uas"   => 82,
    ],
    [
        "nama"        => "Budi Santoso",
        "nim"         => "2311102084",
        "nilai_tugas" => 90,
        "nilai_uts"   => 88,
        "nilai_uas"   => 92,
    ],
    [
        "nama"        => "Citra Dewi",
        "nim"         => "2311102085",
        "nilai_tugas" => 70,
        "nilai_uts"   => 65,
        "nilai_uas"   => 60,
    ],
    [
        "nama"        => "Dian Pratama",
        "nim"         => "2311102086",
        "nilai_tugas" => 55,
        "nilai_uts"   => 50,
        "nilai_uas"   => 48,
    ],
    [
        "nama"        => "Eka Fitriani",
        "nim"         => "2311102087",
        "nilai_tugas" => 95,
        "nilai_uts"   => 92,
        "nilai_uas"   => 96,
    ],
];

// ============================================================
// Function: Menghitung nilai akhir
// Bobot: Tugas 30%, UTS 35%, UAS 35%
// ============================================================
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.30) + ($uts * 0.35) + ($uas * 0.35);
}

// ============================================================
// Function: Menentukan grade berdasarkan nilai akhir
// ============================================================
function tentukanGrade($nilai) {
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

// ============================================================
// Function: Menentukan status kelulusan
// ============================================================
function tentukanStatus($nilai) {
    return $nilai >= 60 ? "Lulus" : "Tidak Lulus";
}

// ============================================================
// Proses data: hitung nilai akhir, grade, status tiap mahasiswa
// ============================================================
$totalNilai   = 0;
$nilaiTertinggi = 0;
$namaTertinggi  = "";

foreach ($mahasiswa as &$mhs) {
    $mhs["nilai_akhir"] = hitungNilaiAkhir(
        $mhs["nilai_tugas"],
        $mhs["nilai_uts"],
        $mhs["nilai_uas"]
    );
    $mhs["grade"]  = tentukanGrade($mhs["nilai_akhir"]);
    $mhs["status"] = tentukanStatus($mhs["nilai_akhir"]);

    $totalNilai += $mhs["nilai_akhir"];

    if ($mhs["nilai_akhir"] > $nilaiTertinggi) {
        $nilaiTertinggi = $mhs["nilai_akhir"];
        $namaTertinggi  = $mhs["nama"];
    }
}
unset($mhs);

$rataRata  = $totalNilai / count($mahasiswa);
$jumlahLulus = 0;
foreach ($mahasiswa as $mhs) {
    if ($mhs["status"] === "Lulus") $jumlahLulus++;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Sistem Penilaian Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet"/>
</head>
<body class="bg-light">

<div class="container py-5">

    <!-- Header -->
    <div class="text-center mb-4">
        <h3 class="fw-bold"><i class="bi bi-mortarboard-fill text-primary me-2"></i>Sistem Penilaian Mahasiswa</h3>
        <p class="text-muted mb-0">Aplikasi Berbasis Platform — Modul 8</p>
        <p class="text-muted small">2311102083 — Ahmad Tegar Kahfi Asyngarinanto</p>
    </div>

    <!-- Statistik -->
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm text-center p-3">
                <div class="text-primary fs-2 fw-bold"><?= count($mahasiswa) ?></div>
                <div class="text-muted small">Total Mahasiswa</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm text-center p-3">
                <div class="text-success fs-2 fw-bold"><?= number_format($rataRata, 2) ?></div>
                <div class="text-muted small">Rata-rata Kelas</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm text-center p-3">
                <div class="text-warning fs-2 fw-bold"><?= number_format($nilaiTertinggi, 2) ?></div>
                <div class="text-muted small">Nilai Tertinggi</div>
                <div class="text-muted" style="font-size:11px"><?= $namaTertinggi ?></div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm text-center p-3">
                <div class="text-danger fs-2 fw-bold"><?= $jumlahLulus ?>/<?= count($mahasiswa) ?></div>
                <div class="text-muted small">Mahasiswa Lulus</div>
            </div>
        </div>
    </div>

    <!-- Tabel -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white fw-semibold">
            <i class="bi bi-table me-2"></i>Data Penilaian Mahasiswa
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th>#</th>
                            <th class="text-start">Nama</th>
                            <th>NIM</th>
                            <th>Tugas (30%)</th>
                            <th>UTS (35%)</th>
                            <th>UAS (35%)</th>
                            <th>Nilai Akhir</th>
                            <th>Grade</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($mahasiswa as $mhs): ?>
                        <tr class="text-center">
                            <td><?= $no++ ?></td>
                            <td class="text-start fw-semibold"><?= $mhs["nama"] ?></td>
                            <td><code><?= $mhs["nim"] ?></code></td>
                            <td><?= $mhs["nilai_tugas"] ?></td>
                            <td><?= $mhs["nilai_uts"] ?></td>
                            <td><?= $mhs["nilai_uas"] ?></td>
                            <td class="fw-bold"><?= number_format($mhs["nilai_akhir"], 2) ?></td>
                            <td>
                                <?php
                                $badgeColor = match($mhs["grade"]) {
                                    "A" => "success",
                                    "B" => "primary",
                                    "C" => "warning",
                                    "D" => "orange",
                                    default => "danger"
                                };
                                ?>
                                <span class="badge bg-<?= $badgeColor ?> fs-6 px-3">
                                    <?= $mhs["grade"] ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($mhs["status"] === "Lulus"): ?>
                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Lulus</span>
                                <?php else: ?>
                                    <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Tidak Lulus</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="table-secondary fw-semibold">
                        <tr class="text-center">
                            <td colspan="6" class="text-end">Rata-rata Kelas</td>
                            <td><?= number_format($rataRata, 2) ?></td>
                            <td><?= tentukanGrade($rataRata) ?></td>
                            <td><?= tentukanStatus($rataRata) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Keterangan Grade -->
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header bg-secondary text-white fw-semibold">
            <i class="bi bi-info-circle me-2"></i>Keterangan Grade & Bobot Penilaian
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-sm table-bordered mb-0">
                        <thead class="table-light">
                            <tr><th>Grade</th><th>Rentang Nilai</th><th>Keterangan</th></tr>
                        </thead>
                        <tbody>
                            <tr><td><span class="badge bg-success">A</span></td><td>85 – 100</td><td>Sangat Baik</td></tr>
                            <tr><td><span class="badge bg-primary">B</span></td><td>75 – 84</td><td>Baik</td></tr>
                            <tr><td><span class="badge bg-warning text-dark">C</span></td><td>65 – 74</td><td>Cukup</td></tr>
                            <tr><td><span class="badge bg-secondary">D</span></td><td>55 – 64</td><td>Kurang</td></tr>
                            <tr><td><span class="badge bg-danger">E</span></td><td>0 – 54</td><td>Tidak Lulus</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-bordered mb-0">
                        <thead class="table-light">
                            <tr><th>Komponen</th><th>Bobot</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>Tugas</td><td>30%</td></tr>
                            <tr><td>UTS</td><td>35%</td></tr>
                            <tr><td>UAS</td><td>35%</td></tr>
                            <tr class="table-success fw-bold"><td>Total</td><td>100%</td></tr>
                        </tbody>
                    </table>
                    <p class="text-muted small mt-2 mb-0">
                        <i class="bi bi-calculator me-1"></i>
                        Rumus: <code>(Tugas × 0.30) + (UTS × 0.35) + (UAS × 0.35)</code>
                    </p>
                    <p class="text-muted small mb-0">
                        <i class="bi bi-check-circle me-1"></i>
                        Batas lulus: Nilai Akhir ≥ 60
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
