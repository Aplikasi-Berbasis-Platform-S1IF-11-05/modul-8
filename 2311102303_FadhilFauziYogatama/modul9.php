<?php
// Data Mahasiswa (Array Asosiatif)
$mahasiswa = [
    [
        "nama" => "agus",
        "nim" => "212323231",
        "tugas" => 90,
        "uts" => 90,
        "uas" => 70
    ],
    [
        "nama" => "cipto",
        "nim" => "3223434212",
        "tugas" => 80,
        "uts" => 90,
        "uas" => 90
    ],
    [
        "nama" => "ocaa",
        "nim" => "2334353",
        "tugas" => 60,
        "uts" => 50,
        "uas" => 75
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

// Variabel tambahan
$totalNilai = 0;
$nilaiTertinggi = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Penilaian Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>📊 Sistem Penilaian Mahasiswa</h2>

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
            $grade = tentukanGrade($nilaiAkhir);
            $status = ($nilaiAkhir >= 60) ? "Lulus" : "Tidak Lulus";

            $totalNilai += $nilaiAkhir;

            if ($nilaiAkhir > $nilaiTertinggi) {
                $nilaiTertinggi = $nilaiAkhir;
            }
        ?>
        <tr>
            <td><?= $mhs['nama']; ?></td>
            <td><?= $mhs['nim']; ?></td>
            <td><?= number_format($nilaiAkhir, 2); ?></td>
            <td><?= $grade; ?></td>
            <td class="<?= ($status == 'Lulus') ? 'lulus' : 'tidak'; ?>">
                <?= $status; ?>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>

    <?php 
    $rataRata = $totalNilai / count($mahasiswa);
    ?>

    <div class="summary">
        <p><strong>Rata-rata kelas:</strong> <?= number_format($rataRata, 2); ?></p>
        <p><strong>Nilai tertinggi:</strong> <?= number_format($nilaiTertinggi, 2); ?></p>
    </div>
</div>

</body>
</html>