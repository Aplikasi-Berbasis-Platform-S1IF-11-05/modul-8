<div align="center">
  <h1>LAPORAN PRAKTIKUM</h1>
  <h2>APLIKASI BERBASIS PLATFORM</h2>
  <h3>MODUL 9 - PHP: Buat Sistem Penilaian Mahasiswa</h3>

  <br>

  <img width="250" src="https://github.com/user-attachments/assets/724a3291-bcf9-448d-a395-3886a8659d79" />

  <br><br>

  <h3>Disusun Oleh:</h3>
  <p>
    Fadhil Fauzi Yogatama <br>
    2311102303 <br>
    S1 IF-11-REG05
  </p>

  <br>

  <h3>Dosen Pengampu:</h3>
  <p>Dedi Agung Prabowo, S.Kom., M.Kom</p>

  <br>

  <h4>Asisten Praktikum:</h4>
  Apri Pandu Wicaksono <br>
  Hamka Zaenul Ardi

  <br><br>

  <p>
    LABORATORIUM HIGH PERFORMANCE <br>
    FAKULTAS INFORMATIKA <br>
    UNIVERSITAS TELKOM PURWOKERTO <br>
    2026
  </p>
</div>

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


## 1. Source Code PHP

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
