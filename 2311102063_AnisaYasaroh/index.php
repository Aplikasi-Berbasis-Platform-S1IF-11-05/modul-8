<?php
// 2311102063
// Anisa Yasaroh
// IF-11-REG05

$mahasiswa = [
    ["nama"=>"Anisa","nim"=>"2023001","tugas"=>80,"uts"=>80,"uas"=>85],
    ["nama"=>"Yasa","nim"=>"2023002","tugas"=>90,"uts"=>85,"uas"=>90],
    ["nama"=>"Nisa","nim"=>"2023003","tugas"=>90,"uts"=>88,"uas"=>75],
    ["nama"=>"Sara","nim"=>"2023005","tugas"=>50,"uts"=>55,"uas"=>65]
];

function hitungNilaiAkhir($t,$u,$a){
    return ($t*0.3)+($u*0.3)+($a*0.4);
}

function getGrade($n){
    if($n>=85)return "A";
    elseif($n>=75)return "B";
    elseif($n>=65)return "C";
    elseif($n>=50)return "D";
    else return "E";
}

$totalNilai=0;
$nilaiTertinggi=0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Sistem Penilaian Mahasiswa</title>
<style>
body{
    font-family:'Segoe UI',sans-serif;
    margin:0;
    background: linear-gradient(135deg, #1e3c72, #2a5298);
}

.container{
    width:85%;
    margin:40px auto;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    padding:25px;
    border-radius:15px;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
    color:white;
    text-align:center; 
}

h2{
    margin-bottom:5px;
}

.sub{
    text-align:center;
    font-size:14px;
    margin-bottom:20px;
    color:#dbeafe;
}

table{
    width:100%;
    border-collapse: collapse;
    border-radius:10px;
    overflow:hidden;
}

th{
    background:rgba(0,0,0,0.6);
    padding:12px;
    border:1px solid rgba(255,255,255,0.3);
}

td{
    padding:10px;
    text-align:center;
    border:1px solid rgba(255,255,255,0.2);
}

tr:nth-child(even){
    background:rgba(255,255,255,0.1);
}

tr:hover{
    background:rgba(255,255,255,0.2);
}

.lulus{
    color:#00ff9d;
    font-weight:bold;
}

.tidak{
    color:#ff6b6b;
    font-weight:bold;
}

.summary{
    margin-top:20px;
    display:flex;
    gap:20px;
}

.card{
    flex:1;
    background:rgba(0,0,0,0.4);
    padding:15px;
    border-radius:10px;
}

.card p{
    font-size:22px;
    font-weight:bold;
}
</style>
</head>

<body>

<div class="container">
<h2>Sistem Penilaian Mahasiswa</h2>
<div class="sub">Daftar Nilai dan Hasil Evaluasi Mahasiswa</div>

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

<?php
foreach($mahasiswa as $m){
    $na = hitungNilaiAkhir($m["tugas"],$m["uts"],$m["uas"]);
    $g = getGrade($na);
    $s = ($na >= 60) ? "Lulus" : "Tidak Lulus";

    $totalNilai += $na;
    if($na > $nilaiTertinggi) $nilaiTertinggi = $na;

    $cls = ($s == "Lulus") ? "lulus" : "tidak";

    echo "<tr>
    <td>{$m['nama']}</td>
    <td>{$m['nim']}</td>
    <td>{$m['tugas']}</td>
    <td>{$m['uts']}</td>
    <td>{$m['uas']}</td>
    <td>".number_format($na,2)."</td>
    <td>$g</td>
    <td class='$cls'>$s</td>
    </tr>";
}

$rata = $totalNilai / count($mahasiswa);
?>
</table>

<div class="summary">
<div class="card">
<h3>Rata-rata</h3>
<p><?=number_format($rata,2)?></p>
</div>

<div class="card">
<h3>Nilai Tertinggi</h3>
<p><?=number_format($nilaiTertinggi,2)?></p>
</div>
</div>

</div>

</body>
</html>