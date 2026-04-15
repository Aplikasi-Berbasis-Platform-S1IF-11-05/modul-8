<div align="center">
  <br />
  <h1>LAPORAN PRAKTIKUM <br> APLIKASI BERBASIS PLATFORM </h1>
  <br />
  <h3>MODUL 8 <br> PHP: Buat Sistem Penilaian Mahasiswa</h3>
  <br />
  <img width="512" height="512" alt="telyu" src="https://github.com/user-attachments/assets/724a3291-bcf9-448d-a395-3886a8659d79" />
  <br />
  <br />
  <br />
  <h3>Disusun Oleh :</h3>
  <p>
    <strong>Fajar Ario Abdillah</strong>
    <br>
    <strong>2311102114</strong>
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

PHP (Hypertext Preprocessor) merupakan bahasa pemrograman yang digunakan untuk mengembangkan aplikasi berbasis web dan bersifat server-side scripting. Artinya, seluruh proses eksekusi kode PHP dilakukan di sisi server, kemudian hasilnya dikirimkan ke browser dalam bentuk HTML sehingga dapat ditampilkan kepada pengguna.

PHP banyak digunakan dalam pengembangan web karena sifatnya yang dinamis, mudah dipelajari, serta memiliki integrasi yang baik dengan berbagai sistem basis data seperti MySQL. Dengan menggunakan PHP, pengembang dapat mengelola data, memproses input dari pengguna, serta menghasilkan tampilan web yang interaktif.

Dalam konteks praktikum ini, PHP digunakan untuk mengolah data mahasiswa seperti nama, NIM, dan nilai. PHP juga berperan dalam melakukan perhitungan nilai akhir, menentukan grade, serta menampilkan hasil dalam bentuk tabel HTML. Dengan demikian, PHP memungkinkan pembuatan sistem penilaian mahasiswa yang sederhana namun fungsional.

---

## 2. Struktur Data Array dalam PHP

Array merupakan salah satu struktur data dalam PHP yang digunakan untuk menyimpan lebih dari satu nilai dalam satu variabel. Dengan menggunakan array, data yang memiliki keterkaitan dapat dikelompokkan sehingga lebih mudah untuk dikelola dan diproses.

Dalam PHP, terdapat beberapa jenis array, yaitu *indexed array*, *associative array*, dan *multidimensional array*. *Indexed array* menggunakan indeks berupa angka sebagai penanda elemen, sedangkan associative array menggunakan pasangan *key-value* yang lebih deskriptif. Sementara itu, *multidimensional array* merupakan array yang berisi array lainnya.

Penggunaan array sangat penting dalam pengolahan data, khususnya ketika menangani banyak data seperti data mahasiswa. Dengan array, data seperti nama, NIM, dan nilai dapat disimpan dalam satu struktur yang terorganisir.

#### Contoh penggunaan array dalam PHP:

```html
<?php
// Contoh indexed array
$namaMahasiswa = ["Andi", "Budi", "Citra"];

// Menampilkan salah satu data
echo $namaMahasiswa[0]; // Output: Andi
?>
```

---

## 3. Array Asosiatif

Array asosiatif merupakan jenis array dalam PHP yang menggunakan pasangan key-value sebagai indeksnya. Berbeda dengan *indexed array* yang menggunakan angka sebagai indeks, array asosiatif menggunakan kata kunci (key) yang bersifat deskriptif sehingga memudahkan dalam memahami isi data.

Array asosiatif sangat cocok digunakan untuk menyimpan data yang memiliki atribut tertentu, seperti data mahasiswa yang terdiri dari nama, NIM, nilai tugas, nilai UTS, dan nilai UAS. Dengan menggunakan key yang jelas, data menjadi lebih terstruktur dan mudah diakses.

#### Contoh penggunaan array asosiatif dalam PHP:

```html
<?php
$mahasiswa = [
    "nama" => "Andi",
    "nim" => "12345",
    "nilai_tugas" => 80,
    "nilai_uts" => 85,
    "nilai_uas" => 90
];

// Mengakses data
echo $mahasiswa["nama"]; // Output: Andi
echo $mahasiswa["nilai_uts"]; // Output: 85
?>
```

---

## 4. Function dalam PHP

Function merupakan sekumpulan perintah atau kode program yang dibuat untuk melakukan tugas tertentu dan dapat dipanggil kembali saat dibutuhkan. Penggunaan function dalam PHP bertujuan untuk membuat kode lebih terstruktur, mudah dibaca, serta dapat digunakan kembali *(reusable)*.

Dengan menggunakan function, program dapat dibagi menjadi beberapa bagian kecil yang memiliki fungsi spesifik. Hal ini sangat membantu dalam pengembangan aplikasi, terutama ketika terdapat proses yang dilakukan berulang, seperti perhitungan nilai akhir mahasiswa.

#### Struktur dasar function dalam PHP:

```html
<?php
function namaFunction() {
    // kode program
}
?>
```

---

## 5. Operator dalam PHP

Operator dalam PHP merupakan simbol yang digunakan untuk melakukan operasi terhadap variabel atau nilai. Dalam praktikum ini, operator digunakan untuk melakukan perhitungan nilai akhir serta menentukan status kelulusan mahasiswa.

### 2.5.1 Operator Aritmatika

Operator aritmatika digunakan untuk melakukan operasi matematika seperti penjumlahan, pengurangan, perkalian, dan pembagian. Operator ini sangat penting dalam proses perhitungan nilai akhir mahasiswa.

Beberapa operator aritmatika dalam PHP antara lain:

* `+` (penjumlahan)
* `-` (pengurangan)
* `*` (perkalian)
* `/` (pembagian)

#### Contoh penggunaan operator aritmatika:

```html
<?php
$tugas = 80;
$uts = 85;
$uas = 90;

// Menghitung nilai akhir
$nilaiAkhir = ($tugas + $uts + $uas) / 3;

echo $nilaiAkhir; // Output: 85
?>
```

### 2.5.2 Operator Perbandingan

Operator perbandingan digunakan untuk membandingkan dua nilai dan menghasilkan nilai boolean (true atau false). Operator ini digunakan dalam pengambilan keputusan, seperti menentukan apakah mahasiswa lulus atau tidak.

Beberapa operator perbandingan dalam PHP antara lain:

* `>` (lebih besar dari)
* `<` (lebih kecil dari)
* `>=` (lebih besar atau sama dengan)
* `<=` (lebih kecil atau sama dengan)
* `==` (sama dengan)
* `!=` (tidak sama dengan)

#### Contoh penggunaan operator perbandingan:

```html
<?php
$nilaiAkhir = 75;

// Menentukan status kelulusan
if ($nilaiAkhir >= 70) {
    echo "Lulus";
} else {
    echo "Tidak Lulus";
}
?>
```

---

## 6. Percabangan (Conditional Statement)

Percabangan (conditional statement) merupakan struktur kontrol dalam pemrograman yang digunakan untuk mengambil keputusan berdasarkan kondisi tertentu. Dalam PHP, percabangan memungkinkan program untuk menjalankan kode yang berbeda tergantung pada hasil evaluasi suatu kondisi.

Beberapa bentuk percabangan yang umum digunakan dalam PHP adalah `if`, `if...else`, `if...elseif...else`, dan `switch`. Struktur ini sangat penting dalam pengolahan data, terutama ketika menentukan kategori atau klasifikasi tertentu.

#### Struktur dasar percabangan `if...else`:

```html
<?php
if (kondisi) {
    // kode jika kondisi benar
} else {
    // kode jika kondisi salah
}
?>
```

---

## 7. Perulangan (Looping)

Perulangan (looping) merupakan struktur kontrol dalam pemrograman yang digunakan untuk menjalankan suatu blok kode secara berulang selama kondisi tertentu terpenuhi. Dalam PHP, perulangan sangat berguna untuk mengolah dan menampilkan data dalam jumlah banyak secara efisien.

Beberapa jenis perulangan yang umum digunakan dalam PHP antara lain `for`, `while`, dan `foreach`. Dalam konteks pengolahan array, perulangan `foreach` paling sering digunakan karena lebih sederhana dan mudah dipahami.

#### Struktur dasar perulangan `foreach`:

```html
<?php
foreach ($array as $key => $value) {
    // kode yang dijalankan berulang
}
?>
```

---

# Tugas 9 — PHP: Buat Sistem Penilaian Mahasiswa

## 1. Source Code PHP

```html
<?php
// Data mahasiswa menggunakan array asosiatif
$mahasiswa = [
    [
        "nama" => "Fajar Ario",
        "nim" => "2311102114",
        "tugas" => 90,
        "uts" => 85,
        "uas" => 95
    ],
    [
        "nama" => "Megan Sulthon",
        "nim" => "2311102119",
        "tugas" => 70,
        "uts" => 65,
        "uas" => 75
    ],
    [
        "nama" => "Adrian Basari",
        "nim" => "2311102105",
        "tugas" => 90,
        "uts" => 85,
        "uas" => 90
    ]
];

// Function menghitung nilai akhir
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas + $uts + $uas) / 3;
}

// Function menentukan grade
function tentukanGrade($nilaiAkhir) {
    if ($nilaiAkhir >= 85) {
        return "A";
    } elseif ($nilaiAkhir >= 70) {
        return "B";
    } elseif ($nilaiAkhir >= 60) {
        return "C";
    } elseif ($nilaiAkhir >= 50) {
        return "D";
    } else {
        return "E";
    }
}

// Function menentukan status kelulusan
function tentukanStatus($nilaiAkhir) {
    if ($nilaiAkhir >= 60) {
        return "Lulus";
    } else {
        return "Tidak Lulus";
    }
}

$totalNilai = 0;
$nilaiTertinggi = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        h2, p {
            margin: 10px 0;
        }
    </style>
</head>
<body>

    <h2>Data Penilaian Mahasiswa</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Nilai Akhir</th>
            <th>Grade</th>
            <th>Status</th>
        </tr>

        <?php foreach ($mahasiswa as $index => $mhs): ?>
            <?php
                $nilaiAkhir = hitungNilaiAkhir($mhs["tugas"], $mhs["uts"], $mhs["uas"]);
                $grade = tentukanGrade($nilaiAkhir);
                $status = tentukanStatus($nilaiAkhir);

                $totalNilai += $nilaiAkhir;

                if ($nilaiAkhir > $nilaiTertinggi) {
                    $nilaiTertinggi = $nilaiAkhir;
                }
            ?>
            <tr>
                <td><?= $index + 1; ?></td>
                <td><?= $mhs["nama"]; ?></td>
                <td><?= $mhs["nim"]; ?></td>
                <td><?= number_format($nilaiAkhir, 2); ?></td>
                <td><?= $grade; ?></td>
                <td><?= $status; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php
        $rataRataKelas = $totalNilai / count($mahasiswa);
    ?>

    <p><strong>Rata-rata Kelas:</strong> <?= number_format($rataRataKelas, 2); ?></p>
    <p><strong>Nilai Tertinggi:</strong> <?= number_format($nilaiTertinggi, 2); ?></p>

</body>
</html>
```

## 2. Penjelasan Code

### a. Array Asosiatif

Bagian ini digunakan untuk menyimpan data mahasiswa

```html
// Data mahasiswa menggunakan array asosiatif
$mahasiswa = [
    [
        "nama" => "Fajar Ario",
        "nim" => "2311102114",
        "tugas" => 90,
        "uts" => 85,
        "uas" => 95
    ],
    [
        "nama" => "Megan Sulthon",
        "nim" => "2311102119",
        "tugas" => 70,
        "uts" => 65,
        "uas" => 75
    ],
    [
        "nama" => "Adrian Basari",
        "nim" => "2311102105",
        "tugas" => 90,
        "uts" => 85,
        "uas" => 90
    ]
];
```

Setiap mahasiswa memiliki pasangan *key-value* seperti `nama`, `nim`, `tugas`, `uts`, dan `uas`.

### b. Function HItung Nilai Akhir

```html
// Function menghitung nilai akhir
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas + $uts + $uas) / 3;
}
```

Function di atas menggunakan operator aritmatika di antaranya:

* `+` untuk penjumlahan
* `/` untuk pembagian

### c. Function Menentukan Grade

```html
// Function menentukan grade
function tentukanGrade($nilaiAkhir) {
    if ($nilaiAkhir >= 85) {
        return "A";
    } elseif ($nilaiAkhir >= 70) {
        return "B";
    } elseif ($nilaiAkhir >= 60) {
        return "C";
    } elseif ($nilaiAkhir >= 50) {
        return "D";
    } else {
        return "E";
    }
}
```

Function menggunakan percabangan `if/elseif/else` yang berfungsi untuk menentukan grade berdasarkan nilai akhir.

### d. Function Menentukan Status

```html
// Function menentukan status kelulusan
function tentukanStatus($nilaiAkhir) {
    if ($nilaiAkhir >= 60) {
        return "Lulus";
    } else {
        return "Tidak Lulus";
    }
}
```

Function menentukan status menggunakan operator perbandingan `>=` untuk menentukan kelulusan.

### e. Loop untuk Menampilkan Data

```html
<?php foreach ($mahasiswa as $index => $mhs): ?>
```

Perulangan `foreach` yang digunakan untuk menampilkan seluruh data mahasiswa.

### f. Menghitung Rata-Rata Kelas

```html
$rataRataKelas = $totalNilai / count($mahasiswa);
```

Fungsi ini membuat dimana semua nilai dijumlahkan, kemudian dibagi dengan jumlah mahasiswanya.

### g. Menentukan Nilai Tertinggi

```html
if ($nilaiAkhir > $nilaiTertinggi) {
    $nilaiTertinggi = $nilaiAkhir;
}
```

Menggunakan operator perbandingan `>` untuk mencari nilai terbesar.

## 3. Output

![Bukti](assets/Screenshot%202026-04-09%20165113.png)