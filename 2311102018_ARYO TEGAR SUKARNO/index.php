<?php
// ===================================
// SISTEM PENILAIAN MAHASISWA - MODUL 6
// ===================================

// Array Asosiatif untuk menyimpan data mahasiswa
$mahasiswa = [
    [
        "nama" => "Aryadi Kusuma",
        "nim" => "2023001",
        "nilai_tugas" => 85,
        "nilai_uts" => 78,
        "nilai_uas" => 80
    ],
    [
        "nama" => "Budi Santoso",
        "nim" => "2023002",
        "nilai_tugas" => 90,
        "nilai_uts" => 85,
        "nilai_uas" => 88
    ],
    [
        "nama" => "Citra Dewi",
        "nim" => "2023003",
        "nilai_tugas" => 75,
        "nilai_uts" => 70,
        "nilai_uas" => 68
    ],
    [
        "nama" => "Doni Pratama",
        "nim" => "2023004",
        "nilai_tugas" => 65,
        "nilai_uts" => 55,
        "nilai_uas" => 60
    ],
    [
        "nama" => "Eka Putra",
        "nim" => "2023005",
        "nilai_tugas" => 95,
        "nilai_uts" => 92,
        "nilai_uas" => 94
    ]
];

// ===================================
// FUNCTION MENGHITUNG NILAI AKHIR
// ===================================
function hitungNilaiAkhir($tugas, $uts, $uas) {
    // Rumus: (tugas * 0.2) + (uts * 0.35) + (uas * 0.45)
    // Menggunakan operator aritmatika
    $nilai_akhir = ($tugas * 0.2) + ($uts * 0.35) + ($uas * 0.45);
    return round($nilai_akhir, 2);
}

// ===================================
// FUNCTION MENENTUKAN GRADE
// ===================================
function tentukanGrade($nilai) {
    // Menggunakan if/else untuk menentukan grade
    if ($nilai >= 85) {
        $grade = "A";
    } elseif ($nilai >= 70) {
        $grade = "B";
    } elseif ($nilai >= 60) {
        $grade = "C";
    } elseif ($nilai >= 45) {
        $grade = "D";
    } else {
        $grade = "E";
    }
    return $grade;
}

// ===================================
// FUNCTION MENENTUKAN STATUS KELULUSAN
// ===================================
function tentukanStatus($nilai) {
    // Menggunakan operator perbandingan untuk menentukan lulus/tidak
    if ($nilai >= 60) {
        return "LULUS";
    } else {
        return "TIDAK LULUS";
    }
}

// ===================================
// PROSES DATA MAHASISWA
// ===================================
$data_hasil = [];
$total_nilai = 0;
$nilai_tertinggi = 0;

// Loop untuk mengolah setiap mahasiswa
foreach ($mahasiswa as $siswa) {
    $nilai_akhir = hitungNilaiAkhir(
        $siswa["nilai_tugas"],
        $siswa["nilai_uts"],
        $siswa["nilai_uas"]
    );
    
    $grade = tentukanGrade($nilai_akhir);
    $status = tentukanStatus($nilai_akhir);
    
    // Simpan hasil
    $data_hasil[] = [
        "nama" => $siswa["nama"],
        "nim" => $siswa["nim"],
        "nilai_tugas" => $siswa["nilai_tugas"],
        "nilai_uts" => $siswa["nilai_uts"],
        "nilai_uas" => $siswa["nilai_uas"],
        "nilai_akhir" => $nilai_akhir,
        "grade" => $grade,
        "status" => $status
    ];
    
    // Hitung total untuk rata-rata
    $total_nilai += $nilai_akhir;
    
    // Tentukan nilai tertinggi
    if ($nilai_akhir > $nilai_tertinggi) {
        $nilai_tertinggi = $nilai_akhir;
    }
}

// Hitung rata-rata kelas
$rata_rata_kelas = round($total_nilai / count($data_hasil), 2);

// Hitung jumlah yang lulus
$jumlah_lulus = 0;
foreach ($data_hasil as $hasil) {
    if ($hasil["status"] == "LULUS") {
        $jumlah_lulus++;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa - Modul 9</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 1.1em;
            opacity: 0.9;
        }

        .content {
            padding: 30px;
        }

        .statistics {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-card h3 {
            font-size: 0.9em;
            opacity: 0.9;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .stat-card .value {
            font-size: 2.5em;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table thead {
            background: #f8f9fa;
        }

        table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #333;
            border-bottom: 2px solid #667eea;
        }

        table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e9ecef;
        }

        table tbody tr:hover {
            background: #f8f9fa;
        }

        table tbody tr:last-child td {
            border-bottom: none;
        }

        .nim {
            color: #667eea;
            font-weight: 500;
        }

        .nilai {
            text-align: center;
            font-weight: 600;
        }

        .grade {
            text-align: center;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
            min-width: 40px;
        }

        .grade.a {
            background: #28a745;
            color: white;
        }

        .grade.b {
            background: #20c997;
            color: white;
        }

        .grade.c {
            background: #ffc107;
            color: #333;
        }

        .grade.d {
            background: #fd7e14;
            color: white;
        }

        .grade.e {
            background: #dc3545;
            color: white;
        }

        .status {
            text-align: center;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
            min-width: 100px;
        }

        .status.lulus {
            background: #d4edda;
            color: #155724;
        }

        .status.tidak-lulus {
            background: #f8d7da;
            color: #721c24;
        }

        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666;
            border-top: 1px solid #e9ecef;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 1.8em;
            }

            .statistics {
                grid-template-columns: 1fr;
            }

            table {
                font-size: 0.9em;
            }

            table th, table td {
                padding: 8px 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📊 Sistem Penilaian Mahasiswa</h1>
            <p>Modul 9 - PHP Programming</p>
        </div>

        <div class="content">
            <!-- STATISTIK KELAS -->
            <div class="statistics">
                <div class="stat-card">
                    <h3>Rata-rata Kelas</h3>
                    <div class="value"><?php echo $rata_rata_kelas; ?></div>
                </div>
                <div class="stat-card">
                    <h3>Nilai Tertinggi</h3>
                    <div class="value"><?php echo $nilai_tertinggi; ?></div>
                </div>
                <div class="stat-card">
                    <h3>Total Mahasiswa</h3>
                    <div class="value"><?php echo count($data_hasil); ?></div>
                </div>
                <div class="stat-card">
                    <h3>Jumlah Lulus</h3>
                    <div class="value"><?php echo $jumlah_lulus; ?> / <?php echo count($data_hasil); ?></div>
                </div>
            </div>

            <!-- TABEL DATA MAHASISWA -->
            <h2 style="margin-top: 30px; margin-bottom: 20px; color: #333;">Data Hasil Penilaian</h2>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th class="nilai">Tugas</th>
                        <th class="nilai">UTS</th>
                        <th class="nilai">UAS</th>
                        <th class="nilai">Nilai Akhir</th>
                        <th class="nilai">Grade</th>
                        <th class="nilai">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop menampilkan data mahasiswa -->
                    <?php foreach ($data_hasil as $index => $hasil) { 
                        $grade_class = strtolower($hasil["grade"]);
                        $status_class = $hasil["status"] == "LULUS" ? "lulus" : "tidak-lulus";
                    ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $hasil["nama"]; ?></td>
                        <td class="nim"><?php echo $hasil["nim"]; ?></td>
                        <td class="nilai"><?php echo $hasil["nilai_tugas"]; ?></td>
                        <td class="nilai"><?php echo $hasil["nilai_uts"]; ?></td>
                        <td class="nilai"><?php echo $hasil["nilai_uas"]; ?></td>
                        <td class="nilai"><strong><?php echo $hasil["nilai_akhir"]; ?></strong></td>
                        <td class="nilai"><span class="grade <?php echo $grade_class; ?>"><?php echo $hasil["grade"]; ?></span></td>
                        <td class="nilai"><span class="status <?php echo $status_class; ?>"><?php echo $hasil["status"]; ?></span></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="footer">
            <p>© 2026 - Sistem Penilaian Mahasiswa | Modul 9 PHP Programming</p>
            <p style="font-size: 0.9em; margin-top: 10px;">
                <strong>Rumus Nilai Akhir:</strong> (Tugas × 0.2) + (UTS × 0.35) + (UAS × 0.45)
            </p>
        </div>
    </div>
</body>
</html>