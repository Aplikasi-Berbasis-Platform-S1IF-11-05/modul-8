<div align="center">
  <br />
  <h1>LAPORAN PRAKTIKUM <br> APLIKASI BERBASIS PLATFORM </h1>
  <br />
  <h3>MODUL 9 <br> PHP: Buat Sistem Penilaian Mahasiswa</h3>
  <br />
  <img width="512" height="512" alt="telyu" src="https://github.com/user-attachments/assets/724a3291-bcf9-448d-a395-3886a8659d79" />
  <br />
  <br />
  <br />
  <h3>Disusun Oleh :</h3>
  <p>
    <strong>Megan Sulthon Aryomukti</strong>
    <br>
    <strong>2311102119</strong>
    <br>
    <strong>S1 IF-11-REG05</strong>
  </p>
  <br />
  <h3>Dosen Pengampu :</h3>
  <p>
    <strong>Dedi Agung Prabowo, S.Kom., M.Kom</strong>
  </p>
  <br />
  <br />
  <h4>Asisten Praktikum :</h4>
  <strong>Apri Pandu Wicaksono</strong>
  <br>
  <strong>Hamka Zaenul Ardi</strong>
  <br />
  <h3>LABORATORIUM HIGH PERFORMANCE <br>FAKULTAS INFORMATIKA <br>UNIVERSITAS TELKOM PURWOKERTO <br>2026 </h3>
</div>

<hr>

# Dasar Teori

## 1. PHP (Hypertext Preprocessor)

PHP merupakan bahasa pemrograman server-side yang digunakan untuk membangun aplikasi web dinamis. Dalam praktikum ini, PHP digunakan untuk mengolah data mahasiswa, menghitung nilai akhir, menentukan grade, serta menampilkan hasil dalam bentuk tabel HTML.

---

## 2. Array Asosiatif

Array asosiatif digunakan untuk menyimpan data mahasiswa seperti nama, NIM, nilai tugas, UTS, dan UAS dalam bentuk key-value sehingga lebih terstruktur dan mudah diakses.

---

## 3. Function dalam PHP

Function digunakan untuk memecah program menjadi bagian yang lebih kecil seperti:
- Menghitung nilai akhir
- Menentukan grade
- Menentukan status kelulusan

---

## 4. Operator dalam PHP

### Operator Aritmatika
Digunakan untuk menghitung nilai akhir dengan bobot:
- Tugas: 30%
- UTS: 30%
- UAS: 40%

### Operator Perbandingan
Digunakan untuk menentukan:
- Grade
- Status kelulusan (Lulus / Tidak Lulus)

---

## 5. Percabangan

Digunakan dalam penentuan grade menggunakan `if/elseif/else`.

---

## 6. Perulangan (Looping)

Menggunakan `foreach` untuk menampilkan seluruh data mahasiswa ke dalam tabel HTML.

---

# Tugas Modul 9 — Sistem Penilaian Mahasiswa

## 1. Source Code PHP

```html
<?php
$mahasiswa = [
    [
        "nama" => "Andi",
        "nim" => "12345",
        "tugas" => 80,
        "uts" => 75,
        "uas" => 85
    ],
    [
        "nama" => "Budi",
        "nim" => "12346",
        "tugas" => 60,
        "uts" => 65,
        "uas" => 40
    ],
    [
        "nama" => "Citra",
        "nim" => "12347",
        "tugas" => 90,
        "uts" => 88,
        "uas" => 95
    ]
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

function tentukanStatus($nilai) {
    return ($nilai >= 60) ? "Lulus" : "Tidak Lulus";
}

$totalNilai = 0;
$nilaiTertinggi = 0;
?>

<!DOCTYPE html>
<html>
<head>
<style>
.lulus { color: green; font-weight: bold; }
.tidak-lulus { color: red; font-weight: bold; }
</style>
</head>
<body>

<table border="1">
<tr>
<th>Nama</th>
<th>NIM</th>
<th>Nilai Akhir</th>
<th>Grade</th>
<th>Status</th>
</tr>

<?php
foreach ($mahasiswa as $mhs) {
    $nilaiAkhir = hitungNilaiAkhir($mhs["tugas"], $mhs["uts"], $mhs["uas"]);
    $grade = tentukanGrade($nilaiAkhir);
    $status = tentukanStatus($nilaiAkhir);

    $classStatus = ($status == "Lulus") ? "lulus" : "tidak-lulus";

    $totalNilai += $nilaiAkhir;
    if ($nilaiAkhir > $nilaiTertinggi) {
        $nilaiTertinggi = $nilaiAkhir;
    }

    echo "<tr>
            <td>{$mhs['nama']}</td>
            <td>{$mhs['nim']}</td>
            <td>" . number_format($nilaiAkhir, 2) . "</td>
            <td>$grade</td>
            <td class='$classStatus'>$status</td>
          </tr>";
}
?>

</table>

<?php
$rataRata = $totalNilai / count($mahasiswa);
echo "<p>Rata-rata Kelas: " . number_format($rataRata, 2) . "</p>";
echo "<p>Nilai Tertinggi: " . number_format($nilaiTertinggi, 2) . "</p>";
?>

</body>
</html>