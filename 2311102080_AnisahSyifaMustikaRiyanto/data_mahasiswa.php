<?php
$mahasiswa = [
    [
        "nama" => "Anisah",
        "nim" => "221001",
        "tugas" => 80,
        "uts" => 75,
        "uas" => 85
    ],
    [
        "nama" => "Syifa",
        "nim" => "221002",
        "tugas" => 70,
        "uts" => 65,
        "uas" => 60
    ],
    [
        "nama" => "Mustika",
        "nim" => "221003",
        "tugas" => 90,
        "uts" => 88,
        "uas" => 92
    ],
    [
        "nama" => "Riyanto",
        "nim" => "221004",
        "tugas" => 98,
        "uts" => 100,
        "uas" => 87
    ]
];

function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

function getGrade($nilai) {
    if ($nilai >= 85) return "A";
    elseif ($nilai >= 75) return "B";
    elseif ($nilai >= 65) return "C";
    elseif ($nilai >= 50) return "D";
    else return "E";
}

function getStatus($nilai) {
    return ($nilai >= 70) ? "Lulus" : "Tidak Lulus";
}

$totalNilai = 0;
$nilaiTertinggi = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            text-align: center;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
        }
        th {
            background-color: #d6509e;
            color: white;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Sistem Penilaian Mahasiswa</h2>

<table>
    <tr>
        <th>Nama</th>
        <th>NIM</th>
        <th>Tugas</th>
        <th>UTS</th>
        <th>UAS</th>
        <th>Nilai Akhir</th>
        <th>Grade</th>
        <th>Status</th>
    </tr>

    <?php foreach ($mahasiswa as $mhs): 
        $nilaiAkhir = hitungNilaiAkhir($mhs['tugas'], $mhs['uts'], $mhs['uas']);
        $grade = getGrade($nilaiAkhir);
        $status = getStatus($nilaiAkhir);

        $totalNilai += $nilaiAkhir;
        if ($nilaiAkhir > $nilaiTertinggi) {
            $nilaiTertinggi = $nilaiAkhir;
        }
    ?>
    <tr>
        <td><?= $mhs['nama']; ?></td>
        <td><?= $mhs['nim']; ?></td>
        <td><?= $mhs['tugas']; ?></td>
        <td><?= $mhs['uts']; ?></td>
        <td><?= $mhs['uas']; ?></td>
        <td><?= number_format($nilaiAkhir, 2); ?></td>
        <td><?= $grade; ?></td>
        <td><?= $status; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php
$rataRata = $totalNilai / count($mahasiswa);
?>

<div style="width:80%; margin:auto;">
    <p><b>Rata-rata kelas:</b> <?= number_format($rataRata, 2); ?></p>
    <p><b>Nilai tertinggi:</b> <?= number_format($nilaiTertinggi, 2); ?></p>
</div>

</body>
</html>