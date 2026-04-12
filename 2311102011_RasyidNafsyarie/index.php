<?php
$mahasiswa = [
    [
        'nama'         => 'Ahmad Fauzi',
        'nim'          => '1301210001',
        'nilai_tugas'  => 85,
        'nilai_uts'    => 78,
        'nilai_uas'    => 90
    ],
    [
        'nama'         => 'Bunga Citra',
        'nim'          => '1301210002',
        'nilai_tugas'  => 70,
        'nilai_uts'    => 65,
        'nilai_uas'    => 72
    ],
    [
        'nama'         => 'Charlie Dwi',
        'nim'          => '1301210003',
        'nilai_tugas'  => 55,
        'nilai_uts'    => 50,
        'nilai_uas'    => 45
    ],
    [
        'nama'         => 'Diana Putri',
        'nim'          => '1301210004',
        'nilai_tugas'  => 92,
        'nilai_uts'    => 88,
        'nilai_uas'    => 95
    ],
    [
        'nama'         => 'Eko Prasetyo',
        'nim'          => '1301210005',
        'nilai_tugas'  => 60,
        'nilai_uts'    => 72,
        'nilai_uas'    => 68
    ]
];

function hitungNilaiAkhir($tugas, $uts, $uas) {
    $nilai_akhir = ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);
    return round($nilai_akhir, 2);
}

function tentukanGrade($nilai_akhir) {
    if ($nilai_akhir >= 85) {
        return 'A';
    } elseif ($nilai_akhir >= 75) {
        return 'B';
    } elseif ($nilai_akhir >= 65) {
        return 'C';
    } elseif ($nilai_akhir >= 50) {
        return 'D';
    } else {
        return 'E';
    }
}

function tentukanStatus($nilai_akhir) {
    if ($nilai_akhir >= 60) {
        return 'Lulus';
    } else {
        return 'Tidak Lulus';
    }
}

function warnaGrade($grade) {
    switch ($grade) {
        case 'A': return '#10b981';
        case 'B': return '#3b82f6';
        case 'C': return '#f59e0b';
        case 'D': return '#f97316';
        case 'E': return '#ef4444';
        default:  return '#6b7280';
    }
}

$total_nilai = 0;
$nilai_tertinggi = 0;
$mahasiswa_terbaik = '';

for ($i = 0; $i < count($mahasiswa); $i++) {
    $na = hitungNilaiAkhir(
        $mahasiswa[$i]['nilai_tugas'],
        $mahasiswa[$i]['nilai_uts'],
        $mahasiswa[$i]['nilai_uas']
    );
    $mahasiswa[$i]['nilai_akhir'] = $na;
    $mahasiswa[$i]['grade']       = tentukanGrade($na);
    $mahasiswa[$i]['status']      = tentukanStatus($na);

    $total_nilai += $na;

    if ($na > $nilai_tertinggi) {
        $nilai_tertinggi = $na;
        $mahasiswa_terbaik = $mahasiswa[$i]['nama'];
    }
}

$rata_rata = round($total_nilai / count($mahasiswa), 2);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            color: #e2e8f0;
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .header h1 {
            font-size: 2.2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #c7d2fe, #818cf8, #6366f1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .header p {
            color: #94a3b8;
            font-size: 0.95rem;
            max-width: 500px;
            margin: 0 auto;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(148, 163, 184, 0.1);
            border-radius: 16px;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            border-radius: 16px 16px 0 0;
        }

        .stat-card:nth-child(1)::before { background: linear-gradient(90deg, #6366f1, #818cf8); }
        .stat-card:nth-child(2)::before { background: linear-gradient(90deg, #10b981, #34d399); }
        .stat-card:nth-child(3)::before { background: linear-gradient(90deg, #f59e0b, #fbbf24); }

        .stat-label {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #94a3b8;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 800;
            line-height: 1.2;
        }

        .stat-card:nth-child(1) .stat-value { color: #818cf8; }
        .stat-card:nth-child(2) .stat-value { color: #34d399; }
        .stat-card:nth-child(3) .stat-value { color: #fbbf24; }

        .stat-sub {
            font-size: 0.8rem;
            color: #64748b;
            margin-top: 0.25rem;
        }

        .table-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(148, 163, 184, 0.1);
            border-radius: 16px;
            overflow: hidden;
        }

        .table-card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(148, 163, 184, 0.08);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .table-card-header .icon {
            width: 36px;
            height: 36px;
            background: rgba(99, 102, 241, 0.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .table-card-header h2 {
            font-size: 1rem;
            font-weight: 700;
            color: #e2e8f0;
        }

        .table-card-header span {
            font-size: 0.8rem;
            color: #64748b;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background: rgba(15, 23, 42, 0.6);
            padding: 0.85rem 1.25rem;
            text-align: left;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #94a3b8;
            border-bottom: 1px solid rgba(148, 163, 184, 0.08);
            white-space: nowrap;
        }

        thead th:first-child {
            padding-left: 1.5rem;
        }

        tbody td {
            padding: 1rem 1.25rem;
            font-size: 0.88rem;
            border-bottom: 1px solid rgba(148, 163, 184, 0.05);
            white-space: nowrap;
        }

        tbody td:first-child {
            padding-left: 1.5rem;
        }

        tbody tr {
            transition: background 0.2s ease;
        }

        tbody tr:hover {
            background: rgba(99, 102, 241, 0.04);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .nama-cell {
            font-weight: 600;
            color: #f1f5f9;
        }

        .nim-cell {
            color: #94a3b8;
            font-family: 'Courier New', monospace;
            font-size: 0.82rem;
        }

        .nilai-cell {
            font-weight: 600;
            text-align: center;
        }

        .nilai-akhir-cell {
            font-weight: 700;
            font-size: 1rem;
            color: #f1f5f9;
            text-align: center;
        }

        .grade-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 800;
            color: #fff;
        }

        .status-badge {
            display: inline-block;
            padding: 0.3rem 0.85rem;
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .status-lulus {
            background: rgba(16, 185, 129, 0.12);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.25);
        }

        .status-tidak {
            background: rgba(239, 68, 68, 0.12);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.25);
        }

        .nilai-detail {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .nilai-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.2rem 0.55rem;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 600;
            background: rgba(148, 163, 184, 0.08);
            color: #94a3b8;
        }

        .nilai-chip strong {
            color: #cbd5e1;
        }

        .bobot-info {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .bobot-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            color: #94a3b8;
        }

        .bobot-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .bobot-dot.tugas { background: #818cf8; }
        .bobot-dot.uts   { background: #34d399; }
        .bobot-dot.uas   { background: #fbbf24; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Sistem Penilaian Mahasiswa</h1>
        <p>Menghitung nilai akhir, grade, dan status kelulusan menggunakan array asosiatif, function, dan operator PHP</p>
    </div>
    <div class="bobot-info">
        <div class="bobot-item">
            <div class="bobot-dot tugas"></div>
            Tugas: 30%
        </div>
        <div class="bobot-item">
            <div class="bobot-dot uts"></div>
            UTS: 30%
        </div>
        <div class="bobot-item">
            <div class="bobot-dot uas"></div>
            UAS: 40%
        </div>
    </div>
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Jumlah Mahasiswa</div>
            <div class="stat-value"><?= count($mahasiswa) ?></div>
            <div class="stat-sub">Data terdaftar</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Rata-rata Kelas</div>
            <div class="stat-value"><?= $rata_rata ?></div>
            <div class="stat-sub">Grade: <?= tentukanGrade($rata_rata) ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Nilai Tertinggi</div>
            <div class="stat-value"><?= $nilai_tertinggi ?></div>
            <div class="stat-sub">🏆 <?= $mahasiswa_terbaik ?></div>
        </div>
    </div>
    <div class="table-card">
        <div class="table-card-header">
            <div class="icon">📋</div>
            <div>
                <h2>Data Penilaian Mahasiswa</h2>
                <span>Semester Genap 2025/2026</span>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Nilai Komponen</th>
                        <th style="text-align:center;">Nilai Akhir</th>
                        <th style="text-align:center;">Grade</th>
                        <th style="text-align:center;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($mahasiswa as $mhs) :
                    ?>
                    <tr>
                        <td style="color:#64748b; font-weight:600;"><?= $no++ ?></td>
                        <td class="nama-cell"><?= $mhs['nama'] ?></td>
                        <td class="nim-cell"><?= $mhs['nim'] ?></td>
                        <td>
                            <div class="nilai-detail">
                                <span class="nilai-chip">T: <strong><?= $mhs['nilai_tugas'] ?></strong></span>
                                <span class="nilai-chip">UTS: <strong><?= $mhs['nilai_uts'] ?></strong></span>
                                <span class="nilai-chip">UAS: <strong><?= $mhs['nilai_uas'] ?></strong></span>
                            </div>
                        </td>
                        <td class="nilai-akhir-cell"><?= $mhs['nilai_akhir'] ?></td>
                        <td style="text-align:center;">
                            <span class="grade-badge" style="background:<?= warnaGrade($mhs['grade']) ?>;">
                                <?= $mhs['grade'] ?>
                            </span>
                        </td>
                        <td style="text-align:center;">
                            <span class="status-badge <?= $mhs['status'] === 'Lulus' ? 'status-lulus' : 'status-tidak' ?>">
                                <?= $mhs['status'] ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
