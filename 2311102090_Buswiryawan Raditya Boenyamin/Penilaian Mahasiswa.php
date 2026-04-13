<?php
// 2311102090_Buswiryawan Raditya Boenyamin_S1IF-11-05

$mahasiswa = [
    [
        'nama'        => 'Andi Saputra',
        'nim'         => '2023001',
        'nilai_tugas' => 85,
        'nilai_uts'   => 78,
        'nilai_uas'   => 82,
    ],
    [
        'nama'        => 'Budi Santoso',
        'nim'         => '2023002',
        'nilai_tugas' => 70,
        'nilai_uts'   => 65,
        'nilai_uas'   => 60,
    ],
    [
        'nama'        => 'Citra Dewi',
        'nim'         => '2023003',
        'nilai_tugas' => 92,
        'nilai_uts'   => 88,
        'nilai_uas'   => 95,
    ],
    [
        'nama'        => 'Dimas Pratama',
        'nim'         => '2023004',
        'nilai_tugas' => 55,
        'nilai_uts'   => 50,
        'nilai_uas'   => 48,
    ],
    [
        'nama'        => 'Eka Rahayu',
        'nim'         => '2023005',
        'nilai_tugas' => 78,
        'nilai_uts'   => 80,
        'nilai_uas'   => 75,
    ],
];

function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);
}

function tentukanGrade($nilaiAkhir) {
    if ($nilaiAkhir >= 85) {
        return 'A';
    } elseif ($nilaiAkhir >= 75) {
        return 'B';
    } elseif ($nilaiAkhir >= 65) {
        return 'C';
    } elseif ($nilaiAkhir >= 55) {
        return 'D';
    } else {
        return 'E';
    }
}

function tentukanStatus($nilaiAkhir) {
    return ($nilaiAkhir >= 60) ? 'LULUS' : 'TIDAK LULUS';
}

$totalNilai     = 0;
$nilaiTertinggi = 0;
$namaTertinggi  = '';

foreach ($mahasiswa as &$mhs) {
    $mhs['nilai_akhir'] = hitungNilaiAkhir(
        $mhs['nilai_tugas'],
        $mhs['nilai_uts'],
        $mhs['nilai_uas']
    );
    $mhs['grade']  = tentukanGrade($mhs['nilai_akhir']);
    $mhs['status'] = tentukanStatus($mhs['nilai_akhir']);

    $totalNilai += $mhs['nilai_akhir'];

    if ($mhs['nilai_akhir'] > $nilaiTertinggi) {
        $nilaiTertinggi = $mhs['nilai_akhir'];
        $namaTertinggi  = $mhs['nama'];
    }
}
unset($mhs);

$rataRataKelas = $totalNilai / count($mahasiswa);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700&family=JetBrains+Mono:wght@400;600&display=swap');

        :root {
            --bg:        #0d0f14;
            --surface:   #161a23;
            --border:    #252a38;
            --accent:    #4f8ef7;
            --accent2:   #a78bfa;
            --green:     #34d399;
            --red:       #f87171;
            --yellow:    #fbbf24;
            --text:      #e2e8f0;
            --muted:     #64748b;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Sora', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container { max-width: 1100px; margin: 0 auto; }

        header {
            text-align: center;
            margin-bottom: 48px;
        }

        header .label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 12px;
        }

        header h1 {
            font-size: 2.4rem;
            font-weight: 700;
            background: linear-gradient(135deg, #e2e8f0 30%, var(--accent2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.2;
        }

        header p {
            color: var(--muted);
            margin-top: 10px;
            font-size: 0.9rem;
        }

        /* Stats cards */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 36px;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px 24px;
        }

        .stat-card .stat-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 8px;
        }

        .stat-card .stat-value {
            font-family: 'JetBrains Mono', monospace;
            font-size: 2rem;
            font-weight: 600;
            color: var(--accent);
        }

        .stat-card .stat-sub {
            font-size: 0.78rem;
            color: var(--muted);
            margin-top: 4px;
        }

        /* Table */
        .table-wrapper {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background: rgba(79, 142, 247, 0.08);
            border-bottom: 1px solid var(--border);
        }

        th {
            padding: 14px 18px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--muted);
            text-align: left;
        }

        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
        }

        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: rgba(255,255,255,0.03); }

        td {
            padding: 16px 18px;
            font-size: 0.88rem;
        }

        .nim {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            color: var(--muted);
        }

        .nilai-akhir {
            font-family: 'JetBrains Mono', monospace;
            font-weight: 600;
            font-size: 1rem;
            color: var(--text);
        }

        /* Grade badges */
        .grade {
            display: inline-block;
            width: 32px;
            height: 32px;
            line-height: 32px;
            text-align: center;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .grade-A { background: rgba(52,211,153,0.15); color: var(--green); }
        .grade-B { background: rgba(79,142,247,0.15); color: var(--accent); }
        .grade-C { background: rgba(251,191,36,0.15);  color: var(--yellow); }
        .grade-D { background: rgba(248,113,113,0.15); color: var(--red); }
        .grade-E { background: rgba(248,113,113,0.2);  color: var(--red); }

        /* Status badges */
        .status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-lulus {
            background: rgba(52,211,153,0.1);
            color: var(--green);
            border: 1px solid rgba(52,211,153,0.25);
        }

        .status-tidak {
            background: rgba(248,113,113,0.1);
            color: var(--red);
            border: 1px solid rgba(248,113,113,0.25);
        }

        .formula-note {
            text-align: center;
            color: var(--muted);
            font-size: 0.78rem;
            margin-top: 20px;
            font-family: 'JetBrains Mono', monospace;
        }
    </style>
</head>
<body>
<div class="container">

    <header>
        <div class="label"></div>
        <h1>Sistem Penilaian Mahasiswa</h1>
        <p>Rekap nilai akhir, grade, dan status kelulusan</p>
    </header>

    <!-- Statistik Kelas -->
    <div class="stats">
        <div class="stat-card">
            <div class="stat-label">Jumlah Mahasiswa</div>
            <div class="stat-value"><?= count($mahasiswa) ?></div>
            <div class="stat-sub">terdaftar</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Rata-rata Kelas</div>
            <div class="stat-value"><?= number_format($rataRataKelas, 1) ?></div>
            <div class="stat-sub">nilai akhir</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Nilai Tertinggi</div>
            <div class="stat-value"><?= number_format($nilaiTertinggi, 1) ?></div>
            <div class="stat-sub"><?= htmlspecialchars($namaTertinggi) ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Lulus</div>
            <div class="stat-value" style="color:var(--green)">
                <?php
                    $jumlahLulus = count(array_filter($mahasiswa, fn($m) => $m['status'] === 'LULUS'));
                    echo $jumlahLulus;
                ?>
            </div>
            <div class="stat-sub">dari <?= count($mahasiswa) ?> mahasiswa</div>
        </div>
    </div>

    <!-- Tabel Nilai -->
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Tugas</th>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th>Nilai Akhir</th>
                    <th>Grade</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mahasiswa as $i => $mhs): ?>
                <tr>
                    <td style="color:var(--muted)"><?= $i + 1 ?></td>
                    <td><strong><?= htmlspecialchars($mhs['nama']) ?></strong></td>
                    <td class="nim"><?= htmlspecialchars($mhs['nim']) ?></td>
                    <td><?= $mhs['nilai_tugas'] ?></td>
                    <td><?= $mhs['nilai_uts'] ?></td>
                    <td><?= $mhs['nilai_uas'] ?></td>
                    <td class="nilai-akhir"><?= number_format($mhs['nilai_akhir'], 1) ?></td>
                    <td>
                        <span class="grade grade-<?= $mhs['grade'] ?>">
                            <?= $mhs['grade'] ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($mhs['status'] === 'LULUS'): ?>
                            <span class="status status-lulus">✓ Lulus</span>
                        <?php else: ?>
                            <span class="status status-tidak">✗ Tidak Lulus</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <p class="formula-note">
        Formula: Nilai Akhir = (Tugas × 30%) + (UTS × 30%) + (UAS × 40%)
        &nbsp;|&nbsp; Lulus jika Nilai Akhir ≥ 60
    </p>

</div>
</body>
</html>