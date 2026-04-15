<?php
/**
 * Tugas Modul 9 - PHP: Sistem Penilaian Mahasiswa
 * Nama: Kartika Pringgo Hutomo
 * NIM: 2311102196
 */
$daftar_mahasiswa = [
    [
        "nama" => "Kartika Pringgo Hutomo",
        "nim" => "2311102196",
        "tugas" => 90,
        "uts" => 85,
        "uas" => 88
    ],
    [
        "nama" => "Darmuji",
        "nim" => "22111022022",
        "tugas" => 80,
        "uts" => 78,
        "uas" => 82
    ],
    [
        "nama" => "Budianto",
        "nim" => "2311102001",
        "tugas" => 70,
        "uts" => 65,
        "uas" => 72
    ],
    [
        "nama" => "Siti Aminah",
        "nim" => "2311102005",
        "tugas" => 95,
        "uts" => 92,
        "uas" => 94
    ]
];

// 2. Function untuk menghitung nilai akhir (Bobot: Tugas 30%, UTS 30%, UAS 40%)
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

// 3. Function untuk menentukan grade
function tentukanGrade($nilai) {
    if ($nilai >= 85) {
        return "A";
    } elseif ($nilai >= 75) {
        return "B";
    } elseif ($nilai >= 65) {
        return "C";
    } elseif ($nilai >= 50) {
        return "D";
    } else {
        return "E";
    }
}

// 4. Function untuk menentukan status kelulusan
function tentukanStatus($nilai) {
    return ($nilai >= 65) ? "Lulus" : "Tidak Lulus";
}

// Variabel pendukung statistik
$total_nilai = 0;
$nilai_tertinggi = 0;
$jumlah_mahasiswa = count($daftar_mahasiswa);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa - Modul 9</title>
    <meta name="description" content="Aplikasi sederhana PHP untuk menghitung nilai mahasiswa, grade, dan status kelulusan.">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --bg-gradient: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            --card-bg: rgba(255, 255, 255, 0.9);
            --text-main: #1e293b;
            --text-muted: #64748b;
            --success: #10b981;
            --danger: #ef4444;
            --border: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: var(--bg-gradient);
            min-height: 100vh;
            color: var(--text-main);
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            animation: fadeIn 0.8s ease-out;
        }

        header {
            text-align: center;
            margin-bottom: 40px;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(to right, #4f46e5, #9333ea);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }

        header p {
            color: var(--text-muted);
            font-size: 1.1rem;
        }

        /* Card Style */
        .card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.5);
            margin-bottom: 30px;
        }

        /* Table Styling */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            text-align: left;
            padding: 18px;
            background-color: #f1f5f9;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border-bottom: 2px solid var(--border);
        }

        td {
            padding: 18px;
            border-bottom: 1px solid var(--border);
            font-size: 0.95rem;
            vertical-align: middle;
        }

        tr:hover {
            background-color: rgba(99, 102, 241, 0.03);
            transition: background 0.3s;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
        }

        .badge-success {
            background-color: #dcfce7;
            color: #166534;
        }

        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .grade {
            font-weight: 700;
            color: var(--primary);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .stat-item {
            background: white;
            padding: 24px;
            border-radius: 18px;
            border: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            gap: 8px;
            transition: transform 0.3s;
        }

        .stat-item:hover {
            transform: translateY(-5px);
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 640px) {
            body { padding: 20px 10px; }
            .card { padding: 15px; }
            h1 { font-size: 1.8rem; }
        }
    </style>
</head>
<body>

    <div class="container">
        <header>
            <h1>Sistem Penilaian Mahasiswa</h1>
            <p>Modul 9 - Praktikum Aplikasi Berbasis Platform</p>
        </header>

        <div class="card">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Mahasiswa</th>
                            <th>NIM</th>
                            <th>Tugas</th>
                            <th>UTS</th>
                            <th>UAS</th>
                            <th>N. Akhir</th>
                            <th>Grade</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // 5. Loop untuk menampilkan data
                        foreach ($daftar_mahasiswa as $mhs) : 
                            $nilai_akhir = hitungNilaiAkhir($mhs['tugas'], $mhs['uts'], $mhs['uas']);
                            $grade = tentukanGrade($nilai_akhir);
                            $status = tentukanStatus($nilai_akhir);
                            
                            // Hitung akumulasi untuk statistik
                            $total_nilai += $nilai_akhir;
                            if ($nilai_akhir > $nilai_tertinggi) {
                                $nilai_tertinggi = $nilai_akhir;
                            }
                        ?>
                        <tr>
                            <td>
                                <div style="font-weight: 600;"><?= $mhs['nama'] ?></div>
                            </td>
                            <td style="color: var(--text-muted);"><?= $mhs['nim'] ?></td>
                            <td><?= $mhs['tugas'] ?></td>
                            <td><?= $mhs['uts'] ?></td>
                            <td><?= $mhs['uas'] ?></td>
                            <td style="font-weight: 600; color: var(--primary);"><?= number_format($nilai_akhir, 2) ?></td>
                            <td><span class="grade"><?= $grade ?></span></td>
                            <td>
                                <span class="badge <?= ($status == 'Lulus') ? 'badge-success' : 'badge-danger' ?>">
                                    <?= $status ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-label">Rata-rata Kelas</span>
                <span class="stat-value">
                    <?= ($jumlah_mahasiswa > 0) ? number_format($total_nilai / $jumlah_mahasiswa, 2) : '0' ?>
                </span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Nilai Tertinggi</span>
                <span class="stat-value"><?= number_format($nilai_tertinggi, 2) ?></span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Total Mahasiswa</span>
                <span class="stat-value"><?= $jumlah_mahasiswa ?> Org</span>
            </div>
        </div>
    </div>

</body>
</html>
