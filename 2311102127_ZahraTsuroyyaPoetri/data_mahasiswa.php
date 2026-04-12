<?php
$mahasiswa = [
    ["nama" => "Zahra", "nim" => "231110201", "tugas" => 85, "uts" => 90, "uas" => 88],
    ["nama" => "Tsuroyya", "nim" => "231110202", "tugas" => 80, "uts" => 75, "uas" => 90],
    ["nama" => "Poetri", "nim" => "231110203", "tugas" => 50, "uts" => 55, "uas" => 58]
];

function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

function tentukanGrade($nilai) {
    if ($nilai >= 85) return "A";
    elseif ($nilai >= 75) return "B";
    elseif ($nilai >= 65) return "C";
    elseif ($nilai >= 50) return "D";
    else return "E";
}

$totalNilai = 0;
$nilaiTertinggi = 0;
$rows = "";

foreach ($mahasiswa as $m) {

    $nilaiAkhir = hitungNilaiAkhir($m["tugas"], $m["uts"], $m["uas"]);
    $grade = tentukanGrade($nilaiAkhir);
    $status = ($nilaiAkhir >= 60) ? "Lulus" : "Tidak Lulus";
    $class  = ($nilaiAkhir >= 60) ? "lulus" : "tidak";

    $totalNilai += $nilaiAkhir;

    if ($nilaiAkhir > $nilaiTertinggi) {
        $nilaiTertinggi = $nilaiAkhir;
    }

    $rows .= "
        <tr>
            <td>{$m['nama']}</td>
            <td>{$m['nim']}</td>
            <td>" . number_format($nilaiAkhir, 2) . "</td>
            <td>$grade</td>
            <td class='$class'>$status</td>
        </tr>
    ";
}

$rataRata = $totalNilai / count($mahasiswa);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modul 9 - PHP</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to right, #a18cd1, #fbc2eb);
            margin: 0;
            padding: 40px;
        }

        .container {
            width: 80%;
            margin: auto;
            background: rgba(255,255,255,0.65);
            padding: 30px 0;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            backdrop-filter: blur(12px);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        .cards {
            display: flex;
            gap: 20px;
            margin: 0 30px 25px;
        }

        .card {
            flex: 1;
            background: rgba(255,255,255,0.7);
            padding: 20px;
            border-radius: 12px;
            text-align: center;
        }

        .card p {
            font-size: 24px;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 16px;
            text-align: center;
        }

        th {
            background: rgba(255,255,255,0.3);
        }

        tr {
            border-bottom: 1px solid rgba(255,255,255,0.6);
        }

        .lulus {
            color: green;
            font-weight: bold;
        }

        .tidak {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Sistem Penilaian Mahasiswa</h2>

    <div class="cards">
        <div class="card">
            <h3>Rata-rata Nilai</h3>
            <p><?= number_format($rataRata, 2) ?></p>
        </div>

        <div class="card">
            <h3>Nilai Tertinggi</h3>
            <p><?= number_format($nilaiTertinggi, 2) ?></p>
        </div>
    </div>

    <table>
        <tr>
            <th>Nama</th>
            <th>NIM</th>
            <th>Nilai Akhir</th>
            <th>Grade</th>
            <th>Status</th>
        </tr>

        <?= $rows ?>

    </table>
</div>

</body>
</html>
