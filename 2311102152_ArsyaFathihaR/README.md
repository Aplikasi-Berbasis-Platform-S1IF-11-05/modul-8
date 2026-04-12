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

# Dasar Teori

---

# 1. PHP (Hypertext Preprocessor)

PHP merupakan bahasa pemrograman yang berjalan di sisi server (*server-side scripting*) dan digunakan untuk mengembangkan website yang bersifat dinamis. Artinya, PHP dapat mengolah data terlebih dahulu di server sebelum ditampilkan ke pengguna melalui browser.

PHP biasanya digunakan untuk menangani berbagai proses seperti mengelola data, melakukan perhitungan, serta berinteraksi dengan database. Karena dijalankan di server, kode PHP tidak terlihat oleh pengguna, yang terlihat hanya hasil akhirnya dalam bentuk HTML.

Dalam penggunaannya, PHP sering dikombinasikan dengan HTML. Kode PHP dapat disisipkan di dalam file HTML menggunakan tanda `<?php ... ?>`, sehingga memungkinkan halaman web menampilkan data secara dinamis sesuai dengan kondisi atau input yang diberikan.

Contoh sederhana penggunaan PHP:

```php
<?php
$nama = "Arsya";

echo "Halo, " . $nama;
?>
```


Pada contoh tersebut, PHP digunakan untuk menyimpan data ke dalam variabel `$nama`, kemudian menampilkannya ke halaman web menggunakan perintah `echo`.

Dengan adanya PHP, pengembangan website menjadi lebih fleksibel karena dapat mengolah data secara otomatis, seperti pada sistem penilaian mahasiswa yang menghitung nilai, menentukan grade, dan menampilkan hasilnya secara langsung.

---

# Menjalankan PHP dengan XAMPP

Agar program PHP dapat dijalankan di komputer lokal, diperlukan sebuah server lokal seperti XAMPP. XAMPP adalah aplikasi yang menyediakan layanan web server (Apache) sehingga file PHP bisa diproses dan ditampilkan di browser.

Langkah-langkah menjalankan PHP menggunakan XAMPP:

Pastikan aplikasi XAMPP sudah terinstal di komputer.
Jalankan XAMPP, lalu aktifkan Apache.
Simpan file PHP ke dalam folder:
htdocs/
Buka browser, lalu akses:
http://localhost/nama_folder/file.php

Dengan menggunakan XAMPP, file PHP yang dibuat dapat dijalankan seperti website pada umumnya, sehingga memudahkan proses pengembangan dan pengujian program secara lokal.

---

# 3. Variabel dan Tipe Data dalam PHP

Variabel dalam PHP digunakan untuk menyimpan data yang nantinya dapat diolah di dalam program. Penulisan variabel selalu diawali dengan tanda `$`, kemudian diikuti dengan nama variabel, misalnya `$nama`, `$nim`, atau `$nilai`.

PHP memiliki beberapa tipe data yang umum digunakan, seperti string, integer, dan float. String digunakan untuk menyimpan teks, integer untuk angka bulat, dan float untuk angka desimal. Dalam sistem penilaian mahasiswa, tipe data ini digunakan untuk menyimpan informasi seperti nama (string) dan nilai (integer atau float).

Contoh penggunaan variabel dan tipe data:

```php
<?php
$nama = "Arsya";
$nim = 2311102152;
$nilai = 85.5;

echo "Nama: " . $nama;
echo "<br>";
echo "NIM: " . $nim;
echo "<br>";
echo "Nilai: " . $nilai;
?>
```

Pada contoh tersebut, variabel digunakan untuk menyimpan data mahasiswa, kemudian ditampilkan ke halaman web menggunakan perintah `echo`. Dengan adanya variabel, data dapat diolah dengan lebih fleksibel, misalnya untuk perhitungan nilai atau pengolahan data lainnya.

Pemahaman tentang variabel dan tipe data sangat penting karena menjadi dasar dalam pengolahan data di dalam program PHP.


# Tugas 9 — PHP


## 1. Source Code

### a. File Server `penilaianMahasiswa.php`:

<?php
// ================= DATA MAHASISWA =================
$mahasiswa = [
    [
        "nama" => "Arsya Fathiha Rahman",
        "nim" => "2311102152",
        "tugas" => 88,
        "uts" => 84,
        "uas" => 90
    ],
    [
        "nama" => "Charles Leclerc",
        "nim" => "2311102201",
        "tugas" => 78,
        "uts" => 82,
        "uas" => 80
    ],
    [
        "nama" => "Gabriel Guevara",
        "nim" => "2311102202",
        "tugas" => 65,
        "uts" => 70,
        "uas" => 68
    ]
];

// ================= FUNCTION =================
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

function getGrade($nilai) {
    switch (true) {
        case ($nilai >= 85): return "A";
        case ($nilai >= 75): return "B";
        case ($nilai >= 65): return "C";
        case ($nilai >= 50): return "D";
        default: return "E";
    }
}

function getStatus($nilai) {
    return ($nilai >= 70) ? "Lulus" : "Tidak Lulus";
}

// ================= PROSES =================
$totalNilai = 0;
$nilaiTertinggi = 0;

foreach ($mahasiswa as $mhs) {
    $nilai = hitungNilaiAkhir($mhs['tugas'], $mhs['uts'], $mhs['uas']);
    $totalNilai += $nilai;
    $nilaiTertinggi = max($nilaiTertinggi, $nilai);
}

$rataRata = $totalNilai / count($mahasiswa);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #141e30, #243b55);
            margin: 0;
            color: white;
        }

        h1 {
            text-align: center;
            margin-top: 40px;
            letter-spacing: 1px;
        }

        table {
            margin: 30px auto;
            border-collapse: collapse;
            width: 85%;
            background: #ffffff;
            color: #333;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        th {
            background: #243b55;
            color: white;
            padding: 14px;
        }

        td {
            padding: 12px;
            text-align: center;
        }

        tr:nth-child(even) {
            background: #f8f9fa;
        }

        tr:hover {
            background: #e3f2fd;
            transition: 0.3s;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .lulus {
            background: #d4edda;
            color: #155724;
        }

        .tidak {
            background: #f8d7da;
            color: #721c24;
        }

        .container {
            width: 90%;
            margin: auto;
            text-align: center;
        }

        .summary {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background: white;
            color: #333;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
            min-width: 220px;
        }

        .card h3 {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h1>📊 Sistem Penilaian Mahasiswa</h1>

<div class="container">
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
        $grade = getGrade($nilaiAkhir);
        $status = getStatus($nilaiAkhir);
    ?>
    <tr>
        <td><?= $mhs['nama']; ?></td>
        <td><?= $mhs['nim']; ?></td>
        <td><?= number_format($nilaiAkhir, 2); ?></td>
        <td><?= $grade; ?></td>
        <td>
            <span class="badge <?= ($status == 'Lulus') ? 'lulus' : 'tidak'; ?>">
                <?= $status; ?>
            </span>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<div class="summary">
    <div class="card">
        <h3>📌 Rata-rata</h3>
        <p><?= number_format($rataRata, 2); ?></p>
    </div>
    <div class="card">
        <h3>🏆 Tertinggi</h3>
        <p><?= number_format($nilaiTertinggi, 2); ?></p>
    </div>
</div>
</div>

</body>
</html>
```

#### 🧠 Penjelasan Program

Program ini dibuat untuk mengolah data nilai mahasiswa menggunakan PHP. Data mahasiswa disimpan dalam bentuk array asosiatif yang berisi nama, NIM, serta nilai tugas, UTS, dan UAS.

Pada awal program, data mahasiswa diinisialisasi dalam array. Setiap mahasiswa memiliki beberapa komponen nilai yang nantinya akan digunakan dalam proses perhitungan nilai akhir.

Selanjutnya, dibuat beberapa function untuk memproses data tersebut. Function pertama digunakan untuk menghitung nilai akhir dengan cara mengalikan setiap komponen nilai dengan bobotnya, kemudian dijumlahkan. Bobot yang digunakan yaitu 30% untuk tugas, 30% untuk UTS, dan 40% untuk UAS.

Setelah nilai akhir diperoleh, program akan menentukan grade menggunakan percabangan. Nilai yang lebih tinggi akan mendapatkan grade yang lebih baik, mulai dari A hingga E. Selain itu, program juga menentukan status kelulusan menggunakan operator perbandingan, di mana mahasiswa dengan nilai di atas atau sama dengan 70 dinyatakan lulus.

Untuk menampilkan data, digunakan perulangan `foreach` agar seluruh data mahasiswa dapat diproses dan ditampilkan secara otomatis ke dalam tabel HTML. Setiap mahasiswa ditampilkan dalam satu baris tabel yang berisi nama, NIM, nilai akhir, grade, dan status.

Selain menampilkan data individu, program juga menghitung rata-rata nilai kelas dengan menjumlahkan seluruh nilai akhir lalu dibagi dengan jumlah mahasiswa. Program juga mencari nilai tertinggi menggunakan fungsi bawaan PHP.

Dengan alur tersebut, program dapat bekerja secara sistematis mulai dari penyimpanan data, proses perhitungan, hingga menampilkan hasil akhir dalam bentuk tabel yang rapi dan mudah dibaca.

### Cara Menjalankan Program

Agar program dapat dijalankan dengan mudah, digunakan XAMPP sebagai server lokal.

1. Simpan folder project ke dalam direktori berikut:

```bash
htdocs/praktikum-abp/modul-9/praktikum-abp/Nama_NIM
```

2. Jalankan layanan Apache melalui aplikasi XAMPP.

3. Buka browser yang tersedia di perangkat.

4. Akses program melalui alamat:

```bash
http://localhost/praktikum-abp/modul-9/praktikum-abp/Nama_NIM
```



## 3. Output


