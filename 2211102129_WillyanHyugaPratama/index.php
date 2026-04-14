<?php
$mahasiswa = [
    [
        'nama'         => 'Salsabila Maharani',
        'nim'          => '1301221001',
        'nilai_tugas'  => 88,
        'nilai_uts'    => 92,
        'nilai_uas'    => 85
    ],
    [
        'nama'         => 'Dimas Pratama',
        'nim'          => '1301221002',
        'nilai_tugas'  => 78,
        'nilai_uts'    => 80,
        'nilai_uas'    => 82
    ],
    [
        'nama'         => 'Chelsea Amanda',
        'nim'          => '1301221003',
        'nilai_tugas'  => 95,
        'nilai_uts'    => 88,
        'nilai_uas'    => 91
    ],
    [
        'nama'         => 'Farel Octavian',
        'nim'          => '1301221004',
        'nilai_tugas'  => 65,
        'nilai_uts'    => 70,
        'nilai_uas'    => 68
    ],
    [
        'nama'         => 'Nadira Putri',
        'nim'          => '1301221005',
        'nilai_tugas'  => 82,
        'nilai_uts'    => 78,
        'nilai_uas'    => 84
    ],
    [
        'nama'         => 'Rangga Aditya',
        'nim'          => '1301221006',
        'nilai_tugas'  => 58,
        'nilai_uts'    => 62,
        'nilai_uas'    => 55
    ]
];

function hitungNilaiAkhir($tugas, $uts, $uas) {
    $nilai_akhir = ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);
    return round($nilai_akhir, 2);
}

function tentukanGrade($nilai_akhir) {
    if ($nilai_akhir >= 85) return 'A';
    if ($nilai_akhir >= 75) return 'B';
    if ($nilai_akhir >= 65) return 'C';
    if ($nilai_akhir >= 50) return 'D';
    return 'E';
}

function tentukanStatus($nilai_akhir) {
    return $nilai_akhir >= 60 ? 'Lulus' : 'Tidak Lulus';
}

// Warna solid untuk grade (tanpa gradien)
function warnaGrade($grade) {
    $warna = [
        'A' => '#2dd4bf',
        'B' => '#3b82f6',
        'C' => '#f59e0b',
        'D' => '#f97316',
        'E' => '#ef4444'
    ];
    return $warna[$grade] ?? '#94a3b8';
}

$total_nilai = 0;
$nilai_tertinggi = 0;
$mahasiswa_terbaik = '';
$jumlah_lulus = 0;

foreach ($mahasiswa as $index => $mhs) {
    $na = hitungNilaiAkhir($mhs['nilai_tugas'], $mhs['nilai_uts'], $mhs['nilai_uas']);
    $mahasiswa[$index]['nilai_akhir'] = $na;
    $mahasiswa[$index]['grade'] = tentukanGrade($na);
    $mahasiswa[$index]['status'] = tentukanStatus($na);
    
    $total_nilai += $na;
    if ($na > $nilai_tertinggi) {
        $nilai_tertinggi = $na;
        $mahasiswa_terbaik = $mhs['nama'];
    }
    if ($mahasiswa[$index]['status'] == 'Lulus') $jumlah_lulus++;
}

$rata_rata = count($mahasiswa) > 0 ? round($total_nilai / count($mahasiswa), 2) : 0;
$persentase_lulus = count($mahasiswa) > 0 ? round(($jumlah_lulus / count($mahasiswa)) * 100, 1) : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTrack | Laporan Nilai Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f1f5f9;
            padding: 2rem;
            color: #0f172a;
        }

        /* Container utama */
        .app-wrapper {
            max-width: 1300px;
            margin: 0 auto;
        }

        /* Header dengan gaya modern minimalis */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e2e8f0;
        }
        .title-area h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.3px;
        }
        .title-area p {
            font-size: 0.85rem;
            color: #475569;
            margin-top: 4px;
        }
        .semester-badge {
            background: white;
            padding: 0.5rem 1.2rem;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 500;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
            color: #1e293b;
        }

        /* Kartu statistik dengan gaya datar & bayangan halus */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.2rem;
            margin-bottom: 2.5rem;
        }
        .stat-card {
            background: white;
            border-radius: 1rem;
            padding: 1.2rem 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
            transition: all 0.2s;
        }
        .stat-card:hover {
            box-shadow: 0 10px 20px -5px rgba(0,0,0,0.08);
            transform: translateY(-2px);
        }
        .stat-icon {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            color: #3b82f6;
        }
        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.2;
        }
        .stat-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
            font-weight: 600;
        }
        .stat-sub {
            font-size: 0.7rem;
            color: #94a3b8;
            margin-top: 0.3rem;
        }

        /* Tabel modern dengan desain bersih */
        .table-container {
            background: white;
            border-radius: 1.2rem;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            box-shadow: 0 1px 2px rgba(0,0,0,0.03);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            text-align: left;
            padding: 1rem 1.2rem;
            background: #f8fafc;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #475569;
            border-bottom: 1px solid #e2e8f0;
        }
        td {
            padding: 1rem 1.2rem;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.85rem;
            vertical-align: middle;
        }
        tr:last-child td {
            border-bottom: none;
        }
        tr:hover td {
            background-color: #fefce8;
        }

        .nama-mhs {
            font-weight: 600;
            color: #0f172a;
        }
        .nim-mhs {
            font-size: 0.7rem;
            color: #64748b;
            font-family: monospace;
        }
        .nilai-bubble {
            display: inline-block;
            background: #f1f5f9;
            padding: 0.2rem 0.7rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
            color: #1e293b;
        }
        .grade-circle {
            display: inline-block;
            width: 36px;
            height: 36px;
            line-height: 36px;
            text-align: center;
            border-radius: 12px;
            font-weight: 800;
            color: white;
            background: #94a3b8;
        }
        .status-lulus {
            color: #10b981;
            font-weight: 600;
        }
        .status-tidak {
            color: #ef4444;
            font-weight: 600;
        }
        .footer-note {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.7rem;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 1rem;
        }

        @media (max-width: 700px) {
            body { padding: 1rem; }
            th, td { padding: 0.75rem; }
            .stat-number { font-size: 1.5rem; }
        }
    </style>
</head>
<body>
<div class="app-wrapper">
    <div class="page-header">
        <div class="title-area">
            <h1><i class="fas fa-graduation-cap" style="color:#3b82f6; margin-right: 8px;"></i> EduTrack</h1>
            <p>Rekap Nilai Akhir Mahasiswa · Sistem Penilaian Terintegrasi</p>
        </div>
        <div class="semester-badge">
            <i class="far fa-calendar-alt"></i> Semester Genap 2025/2026
        </div>
    </div>

    <!-- Statistik ringkas -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-user-friends"></i></div>
            <div class="stat-number"><?= count($mahasiswa) ?></div>
            <div class="stat-label">Total Mahasiswa</div>
            <div class="stat-sub">Aktif terdaftar</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
            <div class="stat-number"><?= $rata_rata ?></div>
            <div class="stat-label">Rata-rata Kelas</div>
            <div class="stat-sub">Grade: <?= tentukanGrade($rata_rata) ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-crown"></i></div>
            <div class="stat-number"><?= $nilai_tertinggi ?></div>
            <div class="stat-label">Nilai Tertinggi</div>
            <div class="stat-sub">🏆 <?= htmlspecialchars($mahasiswa_terbaik) ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-check-double"></i></div>
            <div class="stat-number"><?= $persentase_lulus ?>%</div>
            <div class="stat-label">Tingkat Kelulusan</div>
            <div class="stat-sub"><?= $jumlah_lulus ?> dari <?= count($mahasiswa) ?> mahasiswa</div>
        </div>
    </div>

    <!-- Tabel data mahasiswa (desain berbeda dari sebelumnya) -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mahasiswa</th>
                    <th>Tugas</th>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th>Nilai Akhir</th>
                    <th>Grade</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($mahasiswa as $mhs): ?>
                <tr>
                    <td style="font-weight: 500; color: #475569;"><?= $no++ ?></td>
                    <td>
                        <div class="nama-mhs"><?= htmlspecialchars($mhs['nama']) ?></div>
                        <div class="nim-mhs"><?= $mhs['nim'] ?></div>
                    </td>
                    <td><span class="nilai-bubble"><?= $mhs['nilai_tugas'] ?></span></td>
                    <td><span class="nilai-bubble"><?= $mhs['nilai_uts'] ?></span></td>
                    <td><span class="nilai-bubble"><?= $mhs['nilai_uas'] ?></span></td>
                    <td><strong><?= $mhs['nilai_akhir'] ?></strong></td>
                    <td>
                        <div class="grade-circle" style="background: <?= warnaGrade($mhs['grade']) ?>">
                            <?= $mhs['grade'] ?>
                        </div>
                    </td>
                    <td class="<?= $mhs['status'] == 'Lulus' ? 'status-lulus' : 'status-tidak' ?>">
                        <i class="fas <?= $mhs['status'] == 'Lulus' ? 'fa-check-circle' : 'fa-times-circle' ?>"></i>
                        <?= $mhs['status'] ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="footer-note">
        <i class="fas fa-chart-simple"></i> Bobot penilaian: Tugas 30% | UTS 30% | UAS 40% &nbsp;|&nbsp;
        <i class="fas fa-database"></i> Data diperbarui secara real-time
    </div>
</div>
</body>
</html>