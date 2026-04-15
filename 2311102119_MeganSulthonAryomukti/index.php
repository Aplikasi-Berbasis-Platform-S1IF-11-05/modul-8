<?php
// Data mahasiswa (array asosiatif)
$mahasiswa = [
    [
        "nama" => "Andi",
        "nim" => "12345",
        "tugas" => 80,
        "uts" => 75,
        "uas" => 85
    ],
    [
        "nama" => "Budi",
        "nim" => "12346",
        "tugas" => 60,
        "uts" => 65,
        "uas" => 40
    ],
    [
        "nama" => "Citra",
        "nim" => "12347",
        "tugas" => 90,
        "uts" => 88,
        "uas" => 95
    ]
];

// Function hitung nilai akhir
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

// Function menentukan grade
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

// Function menentukan status kelulusan
function tentukanStatus($nilai) {
    return ($nilai >= 60) ? "Lulus" : "Tidak Lulus";
}

// Variabel untuk rata-rata & nilai tertinggi
$totalNilai = 0;
$nilaiTertinggi = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 70%;
            margin: 20px auto;
            background-color: white;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #ddd;
        }
        .lulus {
            color: green;
            font-weight: bold;
        }
        .tidak-lulus {
            color: red;
            font-weight: bold;
        }
        h2, h3 {
            text-align: center;
        }
    </style>
</head>
<body>

<h2>Sistem Penilaian Mahasiswa</h2>

<table>
    <tr>
        <th>Nama</th>
        <th>NIM</th>
        <th>Nilai Akhir</th>
        <th>Grade</th>
        <th>Status</th>
    </tr>

<?php
foreach ($mahasiswa as $mhs) {
    $nilaiAkhir = hitungNilaiAkhir($mhs["tugas"], $mhs["uts"], $mhs["uas"]);
    $grade = tentukanGrade($nilaiAkhir);
    $status = tentukanStatus($nilaiAkhir);

    // Tentukan class status
    $classStatus = ($status == "Lulus") ? "lulus" : "tidak-lulus";

    // Hitung total & nilai tertinggi
    $totalNilai += $nilaiAkhir;
    if ($nilaiAkhir > $nilaiTertinggi) {
        $nilaiTertinggi = $nilaiAkhir;
    }

    echo "<tr>
            <td>{$mhs['nama']}</td>
            <td>{$mhs['nim']}</td>
            <td>" . number_format($nilaiAkhir, 2) . "</td>
            <td>$grade</td>
            <td class='$classStatus'>$status</td>
          </tr>";
}
?>

</table>

<?php
// Rata-rata
$rataRata = $totalNilai / count($mahasiswa);

echo "<h3>Rata-rata Kelas: " . number_format($rataRata, 2) . "</h3>";
echo "<h3>Nilai Tertinggi: " . number_format($nilaiTertinggi, 2) . "</h3>";
?>

</body>
</html>