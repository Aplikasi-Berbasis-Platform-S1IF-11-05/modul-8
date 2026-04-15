<?php
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

// Function menentukan status
function tentukanStatus($nilai) {
    return ($nilai >= 60) ? "Lulus" : "Tidak Lulus";
}

// Data mahasiswa (array asosiatif)
$mahasiswa = [
    [
        "nama" => "Faqih",
        "nim" => "2311102097",
        "tugas" => 80,
        "uts" => 75,
        "uas" => 90
    ],
    [
        "nama" => "Zaki",
        "nim" => "2311102098",
        "tugas" => 60,
        "uts" => 70,
        "uas" => 65
    ],
    [
        "nama" => "Ghana",
        "nim" => "2311102098",
        "tugas" => 50,
        "uts" => 55,
        "uas" => 60
    ]
];

// Variabel untuk rata-rata & nilai tertinggi
$totalNilai = 0;
$nilaiTertinggi = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Penilaian Mahasiswa</title>
</head>
<body>

<h2>Data Nilai Mahasiswa</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Nama</th>
        <th>NIM</th>
        <th>Nilai Akhir</th>
        <th>Grade</th>
        <th>Status</th>
    </tr>

    <?php foreach ($mahasiswa as $mhs): ?>
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
            <td><?= $mhs["nama"]; ?></td>
            <td><?= $mhs["nim"]; ?></td>
            <td><?= number_format($nilaiAkhir, 2); ?></td>
            <td><?= $grade; ?></td>
            <td><?= $status; ?></td>
        </tr>
    <?php endforeach; ?>

</table>

<?php
$rataRata = $totalNilai / count($mahasiswa);
?>

<h3>Rata-rata Kelas: <?= number_format($rataRata, 2); ?></h3>
<h3>Nilai Tertinggi: <?= number_format($nilaiTertinggi, 2); ?></h3>

</body>
</html>