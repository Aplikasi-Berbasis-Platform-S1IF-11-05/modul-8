<?php
// ================= DATA MAHASISWA =================
$mahasiswa = [
    [
        "nama" => "Arsya Fathiha Rahman",
        "nim" => "2311102152",
        "tugas" => 88,
        "uts" => 84,
        "uas" => 90
    ],
    [
        "nama" => "Charles Leclerc",
        "nim" => "2311102201",
        "tugas" => 78,
        "uts" => 82,
        "uas" => 80
    ],
    [
        "nama" => "Gabriel Guevara",
        "nim" => "2311102202",
        "tugas" => 65,
        "uts" => 70,
        "uas" => 68
    ]
];

// ================= FUNCTION =================
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

function getGrade($nilai) {
    switch (true) {
        case ($nilai >= 85): return "A";
        case ($nilai >= 75): return "B";
        case ($nilai >= 65): return "C";
        case ($nilai >= 50): return "D";
        default: return "E";
    }
}

function getStatus($nilai) {
    return ($nilai >= 70) ? "Lulus" : "Tidak Lulus";
}

// ================= PROSES =================
$totalNilai = 0;
$nilaiTertinggi = 0;

foreach ($mahasiswa as $mhs) {
    $nilai = hitungNilaiAkhir($mhs['tugas'], $mhs['uts'], $mhs['uas']);
    $totalNilai += $nilai;
    $nilaiTertinggi = max($nilaiTertinggi, $nilai);
}

$rataRata = $totalNilai / count($mahasiswa);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #141e30, #243b55);
            margin: 0;
            color: white;
        }

        h1 {
            text-align: center;
            margin-top: 40px;
            letter-spacing: 1px;
        }

        table {
            margin: 30px auto;
            border-collapse: collapse;
            width: 85%;
            background: #ffffff;
            color: #333;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        th {
            background: #243b55;
            color: white;
            padding: 14px;
        }

        td {
            padding: 12px;
            text-align: center;
        }

        tr:nth-child(even) {
            background: #f8f9fa;
        }

        tr:hover {
            background: #e3f2fd;
            transition: 0.3s;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .lulus {
            background: #d4edda;
            color: #155724;
        }

        .tidak {
            background: #f8d7da;
            color: #721c24;
        }

        .container {
            width: 90%;
            margin: auto;
            text-align: center;
        }

        .summary {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background: white;
            color: #333;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
            min-width: 220px;
        }

        .card h3 {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h1>📊 Sistem Penilaian Mahasiswa</h1>

<div class="container">
<table>
    <tr>
        <th>Nama</th>
        <th>NIM</th>
        <th>Nilai Akhir</th>
        <th>Grade</th>
        <th>Status</th>
    </tr>

    <?php foreach ($mahasiswa as $mhs): 
        $nilaiAkhir = hitungNilaiAkhir($mhs['tugas'], $mhs['uts'], $mhs['uas']);
        $grade = getGrade($nilaiAkhir);
        $status = getStatus($nilaiAkhir);
    ?>
    <tr>
        <td><?= $mhs['nama']; ?></td>
        <td><?= $mhs['nim']; ?></td>
        <td><?= number_format($nilaiAkhir, 2); ?></td>
        <td><?= $grade; ?></td>
        <td>
            <span class="badge <?= ($status == 'Lulus') ? 'lulus' : 'tidak'; ?>">
                <?= $status; ?>
            </span>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<div class="summary">
    <div class="card">
        <h3>📌 Rata-rata</h3>
        <p><?= number_format($rataRata, 2); ?></p>
    </div>
    <div class="card">
        <h3>🏆 Tertinggi</h3>
        <p><?= number_format($nilaiTertinggi, 2); ?></p>
    </div>
</div>
</div>

</body>
</html>