<?php
$mahasiswa = [
    [
        'nama'         => 'Gery',
        'nim'          => '1301210001',
        'nilai_tugas'  => 85,
        'nilai_uts'    => 78,
        'nilai_uas'    => 90
    ],
    [
        'nama'         => 'Brian',
        'nim'          => '1301210002',
        'nilai_tugas'  => 70,
        'nilai_uts'    => 65,
        'nilai_uas'    => 72
    ],
    [
        'nama'         => 'Radit',
        'nim'          => '1301210003',
        'nilai_tugas'  => 55,
        'nilai_uts'    => 50,
        'nilai_uas'    => 45
    ],
    [
        'nama'         => 'Rakha',
        'nim'          => '1301210004',
        'nilai_tugas'  => 92,
        'nilai_uts'    => 88,
        'nilai_uas'    => 95
    ],
    [
        'nama'         => 'Reza',
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
    if ($nilai_akhir >= 85) return 'A';
    if ($nilai_akhir >= 75) return 'B';
    if ($nilai_akhir >= 65) return 'C';
    if ($nilai_akhir >= 50) return 'D';
    return 'E';
}

function tentukanStatus($nilai_akhir) {
    return $nilai_akhir >= 60 ? 'Lulus' : 'Tidak Lulus';
}

function getGradientGrade($grade) {
    $gradients = [
        'A' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
        'B' => 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)',
        'C' => 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)',
        'D' => 'linear-gradient(135deg, #fa709a 0%, #fee140 100%)',
        'E' => 'linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%)'
    ];
    return $gradients[$grade] ?? $gradients['E'];
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
    <title>GradeFlow • Smart Academic Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #0a0e27;
            background-image: radial-gradient(circle at 10% 20%, rgba(21, 27, 67, 0.9) 0%, #070b1a 100%);
            min-height: 100vh;
            padding: 2rem;
            position: relative;
        }

        /* floating orbs */
        body::before {
            content: '';
            position: fixed;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(102,126,234,0.3) 0%, rgba(118,75,162,0) 70%);
            top: -100px;
            right: -100px;
            border-radius: 50%;
            pointer-events: none;
        }
        body::after {
            content: '';
            position: fixed;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(244,114,182,0.2) 0%, rgba(0,242,254,0) 70%);
            bottom: -150px;
            left: -150px;
            border-radius: 50%;
            pointer-events: none;
        }

        .dashboard {
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        /* header minimal neumorph */
        .header-flex {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .title-section h2 {
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #a5b4fc;
            margin-bottom: 0.5rem;
        }
        .title-section h1 {
            font-size: 2.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff, #c084fc);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: -0.02em;
        }
        .badge-semester {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(12px);
            padding: 0.6rem 1.4rem;
            border-radius: 60px;
            border: 1px solid rgba(255,255,255,0.1);
            color: #cbd5e1;
            font-weight: 500;
            font-size: 0.9rem;
        }

        /* metric cards horizontal glass */
        .metric-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.2rem;
            margin-bottom: 3rem;
        }
        .metric-card {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(16px);
            border-radius: 32px;
            padding: 1.2rem 1.5rem;
            border: 1px solid rgba(255,255,255,0.08);
            transition: all 0.2s ease;
        }
        .metric-card:hover {
            border-color: rgba(139, 92, 246, 0.4);
            transform: translateY(-3px);
        }
        .metric-icon {
            font-size: 2rem;
            margin-bottom: 0.8rem;
        }
        .metric-value {
            font-size: 2.2rem;
            font-weight: 800;
            color: white;
            line-height: 1;
        }
        .metric-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
            margin-top: 0.4rem;
        }
        .metric-sub {
            font-size: 0.7rem;
            color: #5b6e8c;
            margin-top: 0.5rem;
        }

        /* student cards layout (grid instead of table) */
        .student-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 1.5rem;
        }
        .student-card {
            background: rgba(10, 15, 30, 0.65);
            backdrop-filter: blur(12px);
            border-radius: 28px;
            border: 1px solid rgba(255,255,255,0.08);
            overflow: hidden;
            transition: all 0.25s cubic-bezier(0.2, 0, 0, 1);
        }
        .student-card:hover {
            transform: scale(1.01);
            border-color: rgba(139, 92, 246, 0.5);
            box-shadow: 0 20px 35px -12px rgba(0,0,0,0.5);
        }
        .card-header-student {
            padding: 1.2rem 1.5rem;
            background: rgba(0,0,0,0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .student-name {
            font-weight: 700;
            font-size: 1.2rem;
            color: white;
        }
        .student-nim {
            font-size: 0.7rem;
            font-family: monospace;
            color: #7e8aa8;
            margin-top: 0.2rem;
        }
        .grade-badge {
            width: 48px;
            height: 48px;
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.5rem;
            color: white;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
        .card-body {
            padding: 1.3rem 1.5rem;
        }
        .score-bubbles {
            display: flex;
            gap: 1rem;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }
        .bubble {
            background: rgba(255,255,255,0.05);
            flex: 1;
            text-align: center;
            padding: 0.7rem 0;
            border-radius: 20px;
        }
        .bubble-label {
            font-size: 0.7rem;
            color: #9ca3af;
        }
        .bubble-value {
            font-weight: 800;
            font-size: 1.2rem;
            color: white;
        }
        .final-score-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0.5rem;
            padding-top: 0.8rem;
            border-top: 1px dashed rgba(255,255,255,0.1);
        }
        .final-score-text {
            font-size: 0.75rem;
            color: #a0aec0;
        }
        .final-score-number {
            font-weight: 800;
            font-size: 1.6rem;
            color: #facc15;
        }
        .status-chip {
            padding: 0.4rem 1rem;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 700;
            background: rgba(0,0,0,0.4);
            backdrop-filter: blur(4px);
        }
        .status-lulus {
            color: #4ade80;
            border-left: 2px solid #4ade80;
        }
        .status-tidak {
            color: #f87171;
            border-left: 2px solid #f87171;
        }

        .weight-footer {
            margin-top: 2.5rem;
            text-align: center;
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
            padding: 1rem;
            font-size: 0.75rem;
            color: #5b6e8c;
        }

        @media (max-width: 780px) {
            body { padding: 1rem; }
            .title-section h1 { font-size: 1.8rem; }
        }
    </style>
</head>
<body>
<div class="dashboard">
    <div class="header-flex">
        <div class="title-section">
            <h2><i class="fas fa-chart-line"></i> Analisa Nilai Akhir</h2>
            <h1>Nilai Akhir</h1>
        </div>
        <div class="badge-semester">
            <i class="far fa-calendar-alt"></i> Genap 2025/26 • <i class="fas fa-percent"></i> Bobot: T30 | UTS30 | UAS40
        </div>
    </div>

    <!-- Metrics row modern -->
    <div class="metric-row">
        <div class="metric-card">
            <div class="metric-icon"><i class="fas fa-users"></i></div>
            <div class="metric-value"><?= count($mahasiswa) ?></div>
            <div class="metric-label">Total Peserta</div>
            <div class="metric-sub"><i class="fas fa-user-graduate"></i> 5 program studi</div>
        </div>
        <div class="metric-card">
            <div class="metric-icon"><i class="fas fa-chart-simple"></i></div>
            <div class="metric-value"><?= $rata_rata ?></div>
            <div class="metric-label">Rata-rata Kelas</div>
            <div class="metric-sub">Grade Predikat <?= tentukanGrade($rata_rata) ?></div>
        </div>
        <div class="metric-card">
            <div class="metric-icon"><i class="fas fa-trophy"></i></div>
            <div class="metric-value"><?= $nilai_tertinggi ?></div>
            <div class="metric-label">Tertinggi</div>
            <div class="metric-sub">🏆 <?= htmlspecialchars($mahasiswa_terbaik) ?></div>
        </div>
        <div class="metric-card">
            <div class="metric-icon"><i class="fas fa-check-circle"></i></div>
            <div class="metric-value"><?= $persentase_lulus ?>%</div>
            <div class="metric-label">Kelulusan</div>
            <div class="metric-sub"><?= $jumlah_lulus ?> dari <?= count($mahasiswa) ?> lulus</div>
        </div>
    </div>

    <!-- Student card grid (100% berbeda dari tabel sebelumnya) -->
    <div class="student-grid">
        <?php foreach ($mahasiswa as $idx => $mhs): ?>
        <div class="student-card">
            <div class="card-header-student">
                <div>
                    <div class="student-name"><?= htmlspecialchars($mhs['nama']) ?></div>
                    <div class="student-nim"><i class="fas fa-id-card"></i> <?= $mhs['nim'] ?></div>
                </div>
                <div class="grade-badge" style="background: <?= getGradientGrade($mhs['grade']) ?>">
                    <?= $mhs['grade'] ?>
                </div>
            </div>
            <div class="card-body">
                <div class="score-bubbles">
                    <div class="bubble"><div class="bubble-label"><i class="fas fa-pencil-alt"></i> TUGAS</div><div class="bubble-value"><?= $mhs['nilai_tugas'] ?></div></div>
                    <div class="bubble"><div class="bubble-label"><i class="fas fa-hourglass-half"></i> UTS</div><div class="bubble-value"><?= $mhs['nilai_uts'] ?></div></div>
                    <div class="bubble"><div class="bubble-label"><i class="fas fa-chalkboard-user"></i> UAS</div><div class="bubble-value"><?= $mhs['nilai_uas'] ?></div></div>
                </div>
                <div class="final-score-section">
                    <div>
                        <div class="final-score-text"><i class="fas fa-calculator"></i> NILAI AKHIR</div>
                        <div class="final-score-number"><?= $mhs['nilai_akhir'] ?></div>
                    </div>
                    <div class="status-chip <?= $mhs['status'] == 'Lulus' ? 'status-lulus' : 'status-tidak' ?>">
                        <i class="fas <?= $mhs['status'] == 'Lulus' ? 'fa-check' : 'fa-times' ?>"></i> <?= $mhs['status'] ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="weight-footer">
        <span><i class="fas fa-chart-pie"></i> Komponen Penilaian : Tugas (30%) | UTS (30%) | UAS (40%)</span>
        <span><i class="fas fa-chart-line"></i> Sistem Grade berbasis performa mutlak</span>
    </div>
</div>
</body>
</html>