<?php
// ================================================
// Sistem Penilaian Mahasiswa
// Nama  : Grashela Ayudia Prameswari
// NIM   : 2311102318
// Kelas : S1 IF-11-REG05
// ================================================

// Data mahasiswa menggunakan array asosiatif
$mahasiswa = [
    [
        "nama" => "Grashela Ayudia Prameswari",
        "nim" => "2311102318",
        "tugas" => 88,
        "uts" => 82,
        "uas" => 90
    ],
    [
        "nama" => "Rina Kartika Sari",
        "nim" => "2311102320",
        "tugas" => 75,
        "uts" => 68,
        "uas" => 70
    ],
    [
        "nama" => "Dimas Prasetyo",
        "nim" => "2311102321",
        "tugas" => 92,
        "uts" => 88,
        "uas" => 95
    ],
    [
        "nama" => "Laila Nur Azizah",
        "nim" => "2311102322",
        "tugas" => 55,
        "uts" => 60,
        "uas" => 50
    ],
    [
        "nama" => "Fadhil Rahman",
        "nim" => "2311102323",
        "tugas" => 80,
        "uts" => 76,
        "uas" => 82
    ]
];

// Fungsi menghitung nilai akhir (Tugas 30%, UTS 30%, UAS 40%)
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

// Fungsi menentukan grade menggunakan if/else
function getGrade($nilai) {
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

// Fungsi menentukan status kelulusan menggunakan operator perbandingan
function getStatus($nilai) {
    return ($nilai >= 70) ? "Lulus" : "Tidak Lulus";
}

// Proses perhitungan statistik menggunakan loop
$totalNilai = 0;
$nilaiTertinggi = 0;
$nilaiTerendah = 100;
$jumlahLulus = 0;

foreach ($mahasiswa as $mhs) {
    $nilai = hitungNilaiAkhir($mhs['tugas'], $mhs['uts'], $mhs['uas']);
    $totalNilai += $nilai;
    $nilaiTertinggi = max($nilaiTertinggi, $nilai);
    $nilaiTerendah = min($nilaiTerendah, $nilai);
    if (getStatus($nilai) === "Lulus") {
        $jumlahLulus++;
    }
}

$rataRata = $totalNilai / count($mahasiswa);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a1a2e, #16213e, #0f3460);
            min-height: 100vh;
            color: #333;
            padding: 30px 20px;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            color: #fff;
            margin-bottom: 8px;
            font-size: 28px;
        }

        .watermark {
            text-align: center;
            color: #a8b2d1;
            font-size: 13px;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        th {
            background: #16213e;
            color: #fff;
            padding: 14px 12px;
            font-size: 14px;
        }

        td {
            padding: 12px;
            text-align: center;
            font-size: 14px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #e8f0fe;
        }

        .badge {
            display: inline-block;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .lulus {
            background: #d4edda;
            color: #155724;
        }

        .tidak-lulus {
            background: #f8d7da;
            color: #721c24;
        }

        .grade-a { color: #155724; font-weight: bold; }
        .grade-b { color: #0c5460; font-weight: bold; }
        .grade-c { color: #856404; font-weight: bold; }
        .grade-d { color: #721c24; font-weight: bold; }
        .grade-e { color: #721c24; font-weight: bold; }

        .summary {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 16px;
            margin-top: 24px;
        }

        .card {
            background: #fff;
            padding: 18px 28px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            min-width: 180px;
        }

        .card h3 {
            font-size: 14px;
            color: #555;
            margin-bottom: 6px;
        }

        .card p {
            font-size: 22px;
            font-weight: bold;
            color: #16213e;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Sistem Penilaian Mahasiswa</h1>
    <p class="watermark">Grashela Ayudia Prameswari | 2311102318 | S1 IF-11-REG05</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
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
            <?php $no = 1; foreach ($mahasiswa as $mhs):
                $nilaiAkhir = hitungNilaiAkhir($mhs['tugas'], $mhs['uts'], $mhs['uas']);
                $grade = getGrade($nilaiAkhir);
                $status = getStatus($nilaiAkhir);
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td style="text-align:left;"><?= $mhs['nama']; ?></td>
                <td><?= $mhs['nim']; ?></td>
                <td><?= $mhs['tugas']; ?></td>
                <td><?= $mhs['uts']; ?></td>
                <td><?= $mhs['uas']; ?></td>
                <td><strong><?= number_format($nilaiAkhir, 2); ?></strong></td>
                <td class="grade-<?= strtolower($grade); ?>"><?= $grade; ?></td>
                <td>
                    <span class="badge <?= ($status === 'Lulus') ? 'lulus' : 'tidak-lulus'; ?>">
                        <?= $status; ?>
                    </span>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="summary">
        <div class="card">
            <h3>Rata-rata Kelas</h3>
            <p><?= number_format($rataRata, 2); ?></p>
        </div>
        <div class="card">
            <h3>Nilai Tertinggi</h3>
            <p><?= number_format($nilaiTertinggi, 2); ?></p>
        </div>
        <div class="card">
            <h3>Nilai Terendah</h3>
            <p><?= number_format($nilaiTerendah, 2); ?></p>
        </div>
        <div class="card">
            <h3>Jumlah Lulus</h3>
            <p><?= $jumlahLulus; ?> / <?= count($mahasiswa); ?></p>
        </div>
    </div>
</div>

</body>
</html>
