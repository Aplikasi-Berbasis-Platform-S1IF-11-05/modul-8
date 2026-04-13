<?php
// ================= DATA MAHASISWA =================
$data = [
    ["nama"=>"Agus","nim"=>"11111111","tugas"=>60,"uts"=>30,"uas"=>40],
    ["nama"=>"Husen","nim"=>"22222222","tugas"=>90,"uts"=>87,"uas"=>86],
    ["nama"=>"Muji","nim"=>"33333333","tugas"=>90,"uts"=>88,"uas"=>81],
    ["nama"=>"Sirin","nim"=>"44444444","tugas"=>86,"uts"=>75,"uas"=>70],
    ["nama"=>"Nonon","nim"=>"55555555","tugas"=>100,"uts"=>92,"uas"=>90]
];

// ================= FUNCTION =================
function hitungAkhir($t, $u, $a){
    return ($t*0.3) + ($u*0.3) + ($a*0.4);
}

function grade($n){
    if($n >= 85) return "A";
    elseif($n >= 75) return "B";
    elseif($n >= 65) return "C";
    elseif($n >= 50) return "D";
    else return "E";
}


$total = 0;
$max = 0;
$top = "";

foreach($data as $m){
    $na = hitungAkhir($m["tugas"],$m["uts"],$m["uas"]);
    $total += $na;
    if($na > $max){
        $max = $na;
        $top = $m["nama"];
    }
}
$rata = $total / count($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Sistem Penilaian</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-light">

<div class="container mt-5">

<h2 class="text-center mb-4">Sistem Penilaian Mahasiswa</h2>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card bg-success text-white text-center">
            <div class="card-body">
                <h5>Rata-rata Kelas</h5>
                <h2><?= number_format($rata,2) ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card bg-warning text-dark text-center">
            <div class="card-body">
                <h5>Nilai Tertinggi</h5>
                <h2><?= $top ?> (<?= number_format($max,2) ?>)</h2>
            </div>
        </div>
    </div>
</div>

<table class="table table-dark table-striped table-hover text-center">
<thead>
<tr>
    <th>Nama</th>
    <th>NIM</th>
    <th>Nilai Akhir</th>
    <th>Grade</th>
    <th>Status</th>
</tr>
</thead>

<tbody>
<?php foreach($data as $m): 
    $na = hitungAkhir($m["tugas"],$m["uts"],$m["uas"]);
    $g = grade($na);
    $status = ($na >= 65) ? "Lulus" : "Tidak Lulus";
?>
<tr>
    <td><?= $m["nama"] ?></td>
    <td><?= $m["nim"] ?></td>
    <td><?= number_format($na,2) ?></td>
    <td>
        <span class="badge bg-info text-dark"><?= $g ?></span>
    </td>
    <td>
        <span class="badge <?= $status=="Lulus" ? "bg-success" : "bg-danger" ?>">
            <?= $status ?>
        </span>
    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

</div>

</body>
</html>