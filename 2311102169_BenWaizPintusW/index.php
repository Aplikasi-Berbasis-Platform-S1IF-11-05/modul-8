<?php
$mahasiswa = [
    ["nama"=>"Ben","nim"=>"2311102169","tugas"=>90,"uts"=>80,"uas"=>90],
    ["nama"=>"Qonita","nim"=>"104012300251","tugas"=>90,"uts"=>85,"uas"=>80],
    ["nama"=>"Abel", "nim"=>"2311102163","tugas"=>90,"uts"=>88,"uas"=>95],
    ["nama"=>"Cinta", "nim"=>"2311102164","tugas"=>50,"uts"=>40,"uas"=>65]
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

$totalNilai = 0;
$nilaiTertinggi = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Penilaian Mahasiswa</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <!-- Card -->
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h3>📊 Sistem Penilaian Mahasiswa</h3>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Nilai Akhir</th>
                        <th>Grade</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($mahasiswa as $mhs): 
                    $nilaiAkhir = hitungNilaiAkhir($mhs["tugas"], $mhs["uts"], $mhs["uas"]);
                    $grade = getGrade($nilaiAkhir);
                    $status = ($nilaiAkhir >= 60) ? "Lulus" : "Tidak Lulus";

                    $totalNilai += $nilaiAkhir;
                    if ($nilaiAkhir > $nilaiTertinggi) {
                        $nilaiTertinggi = $nilaiAkhir;
                    }

                    // Badge warna
                    $badge = ($status == "Lulus") ? "success" : "danger";
                ?>
                    <tr>
                        <td><?= $mhs["nama"]; ?></td>
                        <td><?= $mhs["nim"]; ?></td>
                        <td><?= number_format($nilaiAkhir,2); ?></td>
                        <td><span class="badge bg-info"><?= $grade; ?></span></td>
                        <td><span class="badge bg-<?= $badge; ?>"><?= $status; ?></span></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <?php
            $rataRata = $totalNilai / count($mahasiswa);
            ?>

            <!-- Statistik -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="alert alert-primary text-center">
                        <h5>📈 Rata-rata Kelas</h5>
                        <strong><?= number_format($rataRata,2); ?></strong>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="alert alert-success text-center">
                        <h5>🏆 Nilai Tertinggi</h5>
                        <strong><?= number_format($nilaiTertinggi,2); ?></strong>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>