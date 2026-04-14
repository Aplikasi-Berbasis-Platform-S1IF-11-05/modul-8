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
        case 'A': return '#22c55e'; // Emerald
        case 'B': return '#3b82f6'; // Blue
        case 'C': return '#f59e0b'; // Amber
        case 'D': return '#f97316'; // Orange
        case 'E': return '#ef4444'; // Red
        default:  return '#94a3b8'; // Slate
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

$rata_rata = count($mahasiswa) > 0 ? round($total_nilai / count($mahasiswa), 2) : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGrade | Dashboard Penilaian Mahasiswa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #e0e7ff;
            --secondary: #0f172a;
            --success: #22c55e;
            --warning: #f59e0b;
            --danger: #ef4444;
            --background: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
        }

        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--background);
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.1) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(20, 184, 166, 0.1) 0px, transparent 50%);
            color: var(--text-main);
            min-height: 100vh;
            padding: 2.5rem 1.5rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Navbar Area */
        .nav-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .brand-logo {
            width: 45px;
            height: 45px;
            background: var(--primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3);
        }

        .brand-text h1 {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: var(--secondary);
        }

        .brand-text p {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .date-badge {
            background: var(--card-bg);
            padding: 0.6rem 1.25rem;
            border-radius: 100px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-muted);
            border: 1px solid var(--border);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        /* Stats Grid */
        .grid-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        @media (max-width: 768px) {
            .grid-stats { grid-template-columns: 1fr; }
        }

        .card-stat {
            background: var(--card-bg);
            padding: 1.75rem;
            border-radius: 24px;
            border: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            gap: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .card-stat:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
            border-color: var(--primary-light);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .blue-icon { background: rgba(99, 102, 241, 0.1); color: var(--primary); }
        .green-icon { background: rgba(34, 197, 94, 0.1); color: var(--success); }
        .orange-icon { background: rgba(245, 158, 11, 0.1); color: var(--warning); }

        .stat-content .label {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 0.25rem;
        }

        .stat-content .value {
            font-size: 2rem;
            font-weight: 800;
            color: var(--secondary);
            letter-spacing: -0.02em;
        }

        .stat-footer {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--text-muted);
            padding-top: 0.75rem;
            border-top: 1px dashed var(--border);
        }

        /* Main Table Module */
        .content-card {
            background: var(--card-bg);
            border-radius: 28px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 10px 15px -3px rgba(0, 0, 0, 0.03);
            overflow: hidden;
        }

        .card-header {
            padding: 1.75rem 2rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h2 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--secondary);
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        th {
            background: #fcfdfe;
            padding: 1.25rem 1.5rem;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 1.25rem 1.5rem;
            font-size: 0.925rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }

        tr:last-child td { border-bottom: none; }
        
        tr:hover td { background-color: #f8fafc; }

        .mhs-info {
            display: flex;
            flex-direction: column;
        }

        .mhs-name {
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 0.15rem;
        }

        .mhs-nim {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-family: 'JetBrains Mono', monospace;
        }

        .score-pills {
            display: flex;
            gap: 0.5rem;
        }

        .pill {
            padding: 0.25rem 0.6rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 700;
            background: #f1f5f9;
            color: var(--text-muted);
            border: 1px solid var(--border);
        }

        .pill b { color: var(--secondary); }

        .final-score {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--primary);
        }

        .grade-circle {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 1rem;
            border-radius: 100px;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .status-badge.lulus { 
            background: rgba(34, 197, 94, 0.12); 
            color: #16a34a; 
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        .status-badge.gagal { 
            background: rgba(239, 68, 68, 0.12); 
            color: #dc2626; 
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .indicator {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .indicator.lulus { background: #16a34a; }
        .indicator.gagal { background: #dc2626; }

        .weights {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 2rem;
            padding: 1rem 1.5rem;
            background: white;
            border-radius: 16px;
            width: fit-content;
            border: 1px solid var(--border);
        }

        .weight-item {
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .dot { width: 8px; height: 8px; border-radius: 50%; }
    </style>
</head>
<body>

<div class="container">
    <header class="nav-header">
        <div class="brand">
            <div class="brand-logo">📊</div>
            <div class="brand-text">
                <h1>EduGrade Pro</h1>
                <p>System Management & Evaluation</p>
            </div>
        </div>
        <div class="date-badge">
            📅 Semester Genap 2025/2026
        </div>
    </header>

    <div class="weights">
        <div class="weight-item"><span class="dot" style="background:var(--primary)"></span> Tugas: 30%</div>
        <div class="weight-item"><span class="dot" style="background:var(--success)"></span> UTS: 30%</div>
        <div class="weight-item"><span class="dot" style="background:var(--warning)"></span> UAS: 40%</div>
    </div>

    <section class="grid-stats">
        <div class="card-stat">
            <div class="stat-icon blue-icon">👥</div>
            <div class="stat-content">
                <div class="label">Total Mahasiswa</div>
                <div class="value"><?= count($mahasiswa) ?></div>
            </div>
            <div class="stat-footer">Peningkatan 12% dari semester lalu</div>
        </div>
        <div class="card-stat">
            <div class="stat-icon green-icon">📈</div>
            <div class="stat-content">
                <div class="label">Rata-rata Kelas</div>
                <div class="value"><?= $rata_rata ?></div>
            </div>
            <div class="stat-footer">Grade Rata-rata: <strong><?= tentukanGrade($rata_rata) ?></strong></div>
        </div>
        <div class="card-stat">
            <div class="stat-icon orange-icon">🏆</div>
            <div class="stat-content">
                <div class="label">Nilai Tertinggi</div>
                <div class="value"><?= $nilai_tertinggi ?></div>
            </div>
            <div class="stat-footer">Diraih oleh: <strong><?= $mahasiswa_terbaik ?></strong></div>
        </div>
    </section>

    <main class="content-card">
        <div class="card-header">
            <h2>Daftar Nilai Mahasiswa</h2>
            <div style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">
                Modul 9: Array & Functions
            </div>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 60px;">ID</th>
                        <th>Mahasiswa</th>
                        <th>Komponen Nilai</th>
                        <th style="text-align: center;">Skor Akhir</th>
                        <th style="text-align: center;">Grade</th>
                        <th>Status Kelulusan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach ($mahasiswa as $mhs): 
                    ?>
                    <tr>
                        <td style="font-weight: 700; color: var(--text-muted);">#<?= str_pad($no++, 2, '0', STR_PAD_LEFT) ?></td>
                        <td>
                            <div class="mhs-info">
                                <span class="mhs-name"><?= $mhs['nama'] ?></span>
                                <span class="mhs-nim"><?= $mhs['nim'] ?></span>
                            </div>
                        </td>
                        <td>
                            <div class="score-pills">
                                <span class="pill">T <b><?= $mhs['nilai_tugas'] ?></b></span>
                                <span class="pill">U <b><?= $mhs['nilai_uts'] ?></b></span>
                                <span class="pill">A <b><?= $mhs['nilai_uas'] ?></b></span>
                            </div>
                        </td>
                        <td style="text-align: center;">
                            <span class="final-score"><?= $mhs['nilai_akhir'] ?></span>
                        </td>
                        <td style="text-align: center;">
                            <div style="display: flex; justify-content: center;">
                                <div class="grade-circle" style="background: <?= warnaGrade($mhs['grade']) ?>">
                                    <?= $mhs['grade'] ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge <?= $mhs['status'] === 'Lulus' ? 'lulus' : 'gagal' ?>">
                                <span class="indicator <?= $mhs['status'] === 'Lulus' ? 'lulus' : 'gagal' ?>"></span>
                                <?= $mhs['status'] ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

</body>
</html>
