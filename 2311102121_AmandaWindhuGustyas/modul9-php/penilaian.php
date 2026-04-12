<?php
$mahasiswa = [
    ["nama"=>"Amanda","nim"=>"2311102121","tugas"=>85,"uts"=>80,"uas"=>90],
    ["nama"=>"Budi","nim"=>"2311104013","tugas"=>70,"uts"=>75,"uas"=>72],
    ["nama"=>"Citra","nim"=>"2311104014","tugas"=>60,"uts"=>65,"uas"=>68]
];

function hitungNilaiAkhir($t,$u,$a){
    return ($t*0.3)+($u*0.3)+($a*0.4);
}

function grade($n){
    if($n>=85)return "A";
    elseif($n>=75)return "B";
    elseif($n>=65)return "C";
    elseif($n>=50)return "D";
    else return "E";
}

function status($n){
    return ($n>=65)?"Lulus":"Tidak Lulus";
}

$total=0;
$max=0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Sistem Penilaian</title>

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #ff9a9e, #fad0c4);
    margin: 0;
    padding: 40px;
}

h2 {
    text-align: center;
    color: #fff;
    margin-bottom: 30px;
}

.container {
    width: 70%;
    margin: auto;
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

table {
    width: 100%;
    border-collapse: collapse;
    overflow: hidden;
    border-radius: 15px;
}

th {
    background: #ff6f91;
    color: white;
    padding: 12px;
}

td {
    padding: 12px;
    text-align: center;
    background: rgba(255,255,255,0.7);
}

tr:nth-child(even) td {
    background: rgba(255,255,255,0.5);
}

tr:hover td {
    background: #ffe0ea;
    transition: 0.3s;
}

.lulus {
    color: #00b894;
    font-weight: bold;
}

.tidak {
    color: #d63031;
    font-weight: bold;
}

.result {
    text-align: center;
    margin-top: 20px;
    font-size: 18px;
    color: white;
}
</style>

</head>
<body>

<h2>💖 Sistem Penilaian Mahasiswa 💖</h2>

<div class="container">

<table>
<tr>
<th>Nama</th>
<th>NIM</th>
<th>Nilai Akhir</th>
<th>Grade</th>
<th>Status</th>
</tr>

<?php foreach($mahasiswa as $m): 
$na = hitungNilaiAkhir($m['tugas'],$m['uts'],$m['uas']);
$g = grade($na);
$s = status($na);

$total += $na;
if($na > $max) $max = $na;
?>

<tr>
<td><?= $m['nama'] ?></td>
<td><?= $m['nim'] ?></td>
<td><?= number_format($na,2) ?></td>
<td><?= $g ?></td>
<td class="<?= ($s=='Lulus')?'lulus':'tidak' ?>">
<?= $s ?>
</td>
</tr>

<?php endforeach; ?>
</table>

<?php $avg = $total / count($mahasiswa); ?>

<div class="result">
<p>✨ Rata-rata Kelas: <b><?= number_format($avg,2) ?></b></p>
<p>🏆 Nilai Tertinggi: <b><?= number_format($max,2) ?></b></p>
</div>

</div>

</body>
</html>