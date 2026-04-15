<?php
/**
 * Tugas Modul 9 - PHP: Sistem Penilaian Mahasiswa
 * Nama : Muhammad Zaki Fauzan
 * NIM  : 2311102084
 */
$daftar_mahasiswa = [
    [
        "nama" => "Muhammad Zaki Fauzan",
        "nim" => "2311102084",
        "tugas" => 85,
        "uts" => 82,
        "uas" => 90
    ],
    [
        "nama" => "Mas Aimar",
        "nim" => "2311102001",
        "tugas" => 78,
        "uts" => 75,
        "uas" => 80
    ],
    [
        "nama" => "Pak Cik",
        "nim" => "2311102002",
        "tugas" => 60,
        "uts" => 55,
        "uas" => 58
    ]
];

function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

function tentukanGrade($nilai) {
    if ($nilai >= 80) return "A";
    elseif ($nilai >= 70) return "B";
    elseif ($nilai >= 60) return "C";
    elseif ($nilai >= 50) return "D";
    else return "E";
}

$total_nilai_kelas = 0;
$nilai_tertinggi = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa | Modul 9</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --bg: #f8fafc;
            --text: #1e293b;
        }
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--bg); 
            color: var(--text);
            margin: 0; padding: 40px 20px;
        }
        .container { max-width: 900px; margin: auto; }
        h2 { text-align: center; margin-bottom: 30px; color: var(--primary); }
        
        .card { 
            background: white; 
            padding: 24px; 
            border-radius: 12px; 
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background: #f1f5f9; text-align: left; padding: 12px; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; }
        td { padding: 14px 12px; border-bottom: 1px solid #e2e8f0; font-size: 0.95rem; }
        tr:last-child td { border-bottom: none; }
        tr:hover { background-color: #f8fafc; }

        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .bg-lulus { background: #dcfce7; color: #166534; }
        .bg-gagal { background: #fee2e2; color: #991b1b; }

        .stats-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 25px; border-top: 2px solid #f1f5f9; pt: 20px; padding-top: 20px;}
        .stat-item { 
            background: #f8fafc; padding: 15px; border-radius: 10px; 
            border: 1px solid #e2e8f0;
        }
        .stat-label { font-size: 0.8rem; color: #64748b; display: block; margin-bottom: 5px; }
        .stat-value { font-size: 1.25rem; font-weight: 600; color: var(--primary); }
    </style>
</head>
<body>

<div class="container">
    <h2>Sistem Penilaian Mahasiswa</h2>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Mahasiswa</th>
                    <th>NIM</th>
                    <th>Nilai Akhir</th>
                    <th>Grade</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($daftar_mahasiswa as $mhs) : 
                    $na = hitungNilaiAkhir($mhs['tugas'], $mhs['uts'], $mhs['uas']);
                    $grade = tentukanGrade($na);
                    
                    // 5. Operator Perbandingan untuk status kelulusan
                    $lulus = ($na >= 60);
                    
                    // Akumulasi statistik
                    $total_nilai_kelas += $na;
                    if ($na > $nilai_tertinggi) {
                        $nilai_tertinggi = $na;
                    }
                ?>
                <tr>
                    <td><strong><?= $mhs['nama']; ?></strong></td>
                    <td style="color: #64748b; font-family: monospace;"><?= $mhs['nim']; ?></td>
                    <td><?= number_format($na, 1); ?></td>
                    <td><strong><?= $grade; ?></strong></td>
                    <td>
                        <span class="badge <?= $lulus ? 'bg-lulus' : 'bg-gagal'; ?>">
                            <?= $lulus ? 'Lulus' : 'Tidak Lulus'; ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-label">Rata-rata Kelas</span>
                <span class="stat-value">
                    <?php 
                        $rata_rata = $total_nilai_kelas / count($daftar_mahasiswa);
                        echo number_format($rata_rata, 2); 
                    ?>
                </span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Nilai Tertinggi</span>
                <span class="stat-value"><?= number_format($nilai_tertinggi, 1); ?></span>
            </div>
        </div>
    </div>
</div>

</body>
</html>