<div align="center">
  <br />
  <h1>LAPORAN PRAKTIKUM <br> APLIKASI BERBASIS PLATFORM </h1>
  <br />
  <h3>MODUL 9 <br> PHP </h3>
  <br />
  <img width="512" height="512" alt="telyu" src="https://github.com/user-attachments/assets/724a3291-bcf9-448d-a395-3886a8659d79" />
  <br />
  <br />
  <br />
  <h3>Disusun Oleh :</h3>
  <p>
    <strong>Arsya Fathiha Rahman</strong>
    <br>
    <strong>2311102152</strong>
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

# 📚 Dasar Teori

## 1. PHP (Hypertext Preprocessor)

PHP merupakan bahasa pemrograman yang berjalan di sisi server (*server-side scripting*) dan digunakan untuk membuat website dinamis. Artinya, data akan diproses terlebih dahulu di server sebelum ditampilkan ke pengguna dalam bentuk HTML.

PHP banyak digunakan untuk mengelola data, melakukan perhitungan, serta berinteraksi dengan database. Kode PHP tidak terlihat oleh pengguna karena hanya hasil akhirnya saja yang ditampilkan di browser.

Contoh sederhana:

```php
<?php
$nama = "Arsya";
echo "Halo, " . $nama;
?>
```

---

## 2. Menjalankan PHP dengan XAMPP

Langkah-langkah:

1. Install XAMPP
2. Jalankan Apache
3. Simpan file di folder `htdocs/`
4. Akses di browser:

   ```
   http://localhost/nama_folder
   ```

---

## 3. Variabel dan Tipe Data

Variabel digunakan untuk menyimpan data dan diawali dengan simbol `$`.

Contoh:

```php
<?php
$nama = "Arsya";
$nim = 2311102152;
$nilai = 85.5;
?>
```

Tipe data:

* String → teks
* Integer → angka
* Float → desimal

---

# 🧩 Tugas Modul 9 — PHP

## 🎯 Deskripsi

Program ini dibuat untuk:

* Mengolah data mahasiswa
* Menghitung nilai akhir
* Menentukan grade
* Menentukan status kelulusan

---

## 💻 Source Code

```php
<?php
$mahasiswa = [
    ["nama"=>"Arsya Fathiha Rahman","nim"=>"2311102152","tugas"=>88,"uts"=>84,"uas"=>90],
    ["nama"=>"Charles Leclerc","nim"=>"2311102201","tugas"=>78,"uts"=>82,"uas"=>80],
    ["nama"=>"Gabriel Guevara","nim"=>"2311102202","tugas"=>65,"uts"=>70,"uas"=>68]
];

function hitungNilaiAkhir($tugas,$uts,$uas){
    return ($tugas*0.3)+($uts*0.3)+($uas*0.4);
}

function getGrade($nilai){
    if($nilai>=85) return "A";
    elseif($nilai>=75) return "B";
    elseif($nilai>=65) return "C";
    elseif($nilai>=50) return "D";
    else return "E";
}

function getStatus($nilai){
    return ($nilai>=70)?"Lulus":"Tidak Lulus";
}

$total=0;
$tertinggi=0;

foreach($mahasiswa as $mhs){
    $nilai = hitungNilaiAkhir($mhs['tugas'],$mhs['uts'],$mhs['uas']);
    $total += $nilai;
    $tertinggi = max($tertinggi,$nilai);
}

$rata = $total / count($mahasiswa);
?>

<!DOCTYPE html>
<html>
<head>
<title>Sistem Penilaian Mahasiswa</title>
</head>
<body>

<h2>Sistem Penilaian Mahasiswa</h2>

<table border="1">
<tr>
<th>Nama</th>
<th>NIM</th>
<th>Nilai Akhir</th>
<th>Grade</th>
<th>Status</th>
</tr>

<?php foreach($mahasiswa as $mhs):
$nilai=hitungNilaiAkhir($mhs['tugas'],$mhs['uts'],$mhs['uas']);
?>

<tr>
<td><?= $mhs['nama'] ?></td>
<td><?= $mhs['nim'] ?></td>
<td><?= number_format($nilai,2) ?></td>
<td><?= getGrade($nilai) ?></td>
<td><?= getStatus($nilai) ?></td>
</tr>

<?php endforeach; ?>
</table>

<p>Rata-rata: <?= number_format($rata,2) ?></p>
<p>Nilai Tertinggi: <?= number_format($tertinggi,2) ?></p>

</body>
</html>
```

---

## 🧠 Penjelasan Program

Program ini digunakan untuk mengolah data nilai mahasiswa menggunakan PHP. Data disimpan dalam bentuk array asosiatif yang berisi nama, NIM, serta nilai tugas, UTS, dan UAS.

Program menggunakan function untuk menghitung nilai akhir berdasarkan bobot yang telah ditentukan. Setelah itu, nilai akhir digunakan untuk menentukan grade serta status kelulusan.

Perulangan digunakan untuk menampilkan seluruh data mahasiswa ke dalam tabel HTML. Selain itu, program juga menghitung rata-rata nilai kelas dan menentukan nilai tertinggi.

Dengan demikian, program dapat menampilkan hasil pengolahan data secara otomatis dan terstruktur.

---

## ▶️ Cara Menjalankan Program

1. Simpan file ke:

   ```
   C:\xampp\htdocs\modul-9-php
   ```

2. Jalankan Apache di XAMPP

3. Buka browser:

   ```
   http://localhost/modul-9-php
   ```

---

## 📸 Output

Tambahkan screenshot hasil program di sini:

<img width="1920" height="1080" alt="penilaianMahasiswa" src="https://github.com/user-attachments/assets/0226e217-c2b9-451b-9eb4-e7a5096f052c" />




