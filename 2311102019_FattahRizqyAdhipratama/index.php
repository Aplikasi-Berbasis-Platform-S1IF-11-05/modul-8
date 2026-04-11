<!-- 2311102019
Fattah Rizqy Adhipratama
S1IF-11-05 -->
<?php
$mahasiswa = [
    [
        "nama" => "Alex",
        "nim" => "2311102999",
        "tugas" => 60,
        "uts" => 30,
        "uas" => 40
    ],
    [
        "nama" => "Fattah",
        "nim" => "2311102019",
        "tugas" => 90,
        "uts" => 87,
        "uas" => 86
    ],
    [
        "nama" => "Aji",
        "nim" => "2311102021",
        "tugas" => 90,
        "uts" => 88,
        "uas" => 81
    ],
    [
        "nama" => "Rasyid",
        "nim" => "2311102013",
        "tugas" => 86,
        "uts" => 75,
        "uas" => 70
    ],
    [
        "nama" => "Gery",
        "nim" => "2311102008",
        "tugas" => 100,
        "uts" => 92,
        "uas" => 90
    ]
];

function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

function tentukanGrade($nilaiAkhir) {
    if ($nilaiAkhir >= 85) {
        return "A";
    } elseif ($nilaiAkhir >= 75) {
        return "B";
    } elseif ($nilaiAkhir >= 65) {
        return "C";
    } elseif ($nilaiAkhir >= 50) {
        return "D";
    } else {
        return "E";
    }
}

$totalNilai = 0;
$nilaiTertinggi = 0;
$namaTertinggi = "";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Nilai Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white text-center rounded-top-4">
            <h2 class="mb-0">Data Nilai Mahasiswa</h2>
            <small>Modul 8 - Tugas Praktikum PHP</small>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Nilai Akhir</th>
                            <th>Grade</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mahasiswa as $mhs): ?>
                            <?php
                                $nilaiAkhir = hitungNilaiAkhir($mhs["tugas"], $mhs["uts"], $mhs["uas"]);
                                $grade = tentukanGrade($nilaiAkhir);
                                $status = ($nilaiAkhir >= 65) ? "Lulus" : "Tidak Lulus";

                                $totalNilai += $nilaiAkhir;

                                if ($nilaiAkhir > $nilaiTertinggi) {
                                    $nilaiTertinggi = $nilaiAkhir;
                                    $namaTertinggi = $mhs["nama"];
                                }
                            ?>
                            <tr>
                                <td><?= $mhs["nama"]; ?></td>
                                <td><?= $mhs["nim"]; ?></td>
                                <td><?= number_format($nilaiAkhir, 2); ?></td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        <?= $grade; ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge <?= $status == 'Lulus' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?= $status; ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php $rataRata = $totalNilai / count($mahasiswa); ?>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="alert alert-success shadow-sm">
                        <strong>Rata-rata Kelas:</strong> <?= number_format($rataRata, 2); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-warning shadow-sm">
                        <strong>Nilai Tertinggi:</strong> <?= $namaTertinggi; ?> (<?= number_format($nilaiTertinggi, 2); ?>)
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>