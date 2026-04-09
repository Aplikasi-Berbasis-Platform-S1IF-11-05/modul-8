<?php
// Data mahasiswa menggunakan array asosiatif
$mahasiswa = [
    [
        "nama" => "Fajar Ario",
        "nim" => "2311102114",
        "tugas" => 90,
        "uts" => 85,
        "uas" => 95
    ],
    [
        "nama" => "Megan Sulthon",
        "nim" => "2311102119",
        "tugas" => 70,
        "uts" => 65,
        "uas" => 75
    ],
    [
        "nama" => "Adrian Basari",
        "nim" => "2311102105",
        "tugas" => 90,
        "uts" => 85,
        "uas" => 90
    ]
];

// Function menghitung nilai akhir
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas + $uts + $uas) / 3;
}

// Function menentukan grade
function tentukanGrade($nilaiAkhir) {
    if ($nilaiAkhir >= 85) {
        return "A";
    } elseif ($nilaiAkhir >= 70) {
        return "B";
    } elseif ($nilaiAkhir >= 60) {
        return "C";
    } elseif ($nilaiAkhir >= 50) {
        return "D";
    } else {
        return "E";
    }
}

// Function menentukan status kelulusan
function tentukanStatus($nilaiAkhir) {
    if ($nilaiAkhir >= 60) {
        return "Lulus";
    } else {
        return "Tidak Lulus";
    }
}

$totalNilai = 0;
$nilaiTertinggi = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        h2, p {
            margin: 10px 0;
        }
    </style>
</head>
<body>

    <h2>Data Penilaian Mahasiswa</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Nilai Akhir</th>
            <th>Grade</th>
            <th>Status</th>
        </tr>

        <?php foreach ($mahasiswa as $index => $mhs): ?>
            <?php
                $nilaiAkhir = hitungNilaiAkhir($mhs["tugas"], $mhs["uts"], $mhs["uas"]);
                $grade = tentukanGrade($nilaiAkhir);
                $status = tentukanStatus($nilaiAkhir);

                $totalNilai += $nilaiAkhir;

                if ($nilaiAkhir > $nilaiTertinggi) {
                    $nilaiTertinggi = $nilaiAkhir;
                }
            ?>
            <tr>
                <td><?= $index + 1; ?></td>
                <td><?= $mhs["nama"]; ?></td>
                <td><?= $mhs["nim"]; ?></td>
                <td><?= number_format($nilaiAkhir, 2); ?></td>
                <td><?= $grade; ?></td>
                <td><?= $status; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php
        $rataRataKelas = $totalNilai / count($mahasiswa);
    ?>

    <p><strong>Rata-rata Kelas:</strong> <?= number_format($rataRataKelas, 2); ?></p>
    <p><strong>Nilai Tertinggi:</strong> <?= number_format($nilaiTertinggi, 2); ?></p>

</body>
</html>