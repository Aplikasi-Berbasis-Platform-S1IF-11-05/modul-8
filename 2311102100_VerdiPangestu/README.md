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
    <strong>Verdi Pangestu</strong>
    <br>
    <strong>2311102100</strong>
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

1. Pengenalan PHP (Hypertext Preprocessor)
PHP adalah bahasa pemrograman skrip berbasis server-side yang dirancang khusus untuk pengembangan web. PHP dapat disisipkan langsung ke dalam dokumen HTML. Berbeda dengan HTML yang bersifat statis, PHP memungkinkan pembuatan halaman web yang dinamis dan interaktif, di mana konten dapat berubah sesuai dengan logika pemrograman, input pengguna, maupun data dari database. Proses eksekusi kode PHP dilakukan di server, dan hasilnya dikirimkan ke browser klien (pengguna) dalam bentuk HTML murni.

2. Array Asosiatif (Associative Array)
Array adalah struktur data yang digunakan untuk menyimpan kumpulan nilai dalam satu variabel tunggal. Dalam PHP, terdapat jenis Array Asosiatif, yaitu array yang menggunakan kunci (key) berupa string (teks) yang didefinisikan secara manual untuk mengakses nilainya (value), bukan menggunakan indeks numerik (0, 1, 2, dst). Array jenis ini sangat ideal untuk merepresentasikan struktur data yang memiliki atribut spesifik, seperti entitas "Mahasiswa" yang memiliki kunci berupa nama, nim, dan nilai.

3. Fungsi (Function) dalam PHP
Fungsi adalah blok kode terstruktur yang dirancang untuk melakukan tugas tertentu dan dapat dipanggil berulang kali di berbagai bagian program. Penggunaan fungsi mendukung prinsip pemrograman DRY (Don't Repeat Yourself), sehingga kode menjadi lebih rapi, efisien, dan mudah dipelihara. Fungsi dapat menerima parameter (input) dan mengembalikan suatu nilai (return value) setelah melakukan pemrosesan, seperti pada perhitungan nilai akhir mahasiswa.

4. Struktur Kontrol Percabangan (If/Else dan Switch)
Struktur kontrol percabangan digunakan untuk menentukan alur eksekusi program berdasarkan evaluasi suatu kondisi (menghasilkan nilai True atau False).

If/Else: Mengevaluasi kondisi secara berurutan. Jika kondisi pertama benar, maka blok kodenya dieksekusi. Jika salah, akan lanjut ke kondisi berikutnya (elseif atau else). Sangat cocok untuk rentang nilai (misal: menentukan grade A, B, C berdasarkan rentang angka).

Switch: Digunakan untuk membandingkan satu variabel dengan banyak nilai spesifik (case). Cocok untuk kondisi yang nilainya pasti, bukan berupa rentang (range).

5. Struktur Perulangan (Foreach Loop)
Perulangan (looping) digunakan untuk mengeksekusi blok kode secara berulang selama kondisi tertentu terpenuhi. PHP menyediakan perulangan khusus bernama foreach yang dioptimalkan untuk memproses elemen di dalam array atau objek. foreach secara otomatis akan membaca elemen dari indeks pertama hingga terakhir tanpa perlu mendefinisikan batas perulangan secara manual, sehingga sangat efisien untuk merender data tabel HTML secara dinamis.

6. Operator Aritmatika dan Perbandingan

Operator Aritmatika: Digunakan untuk melakukan operasi matematika dasar seperti penjumlahan (+), pengurangan (-), perkalian (*), dan pembagian (/). Dalam praktikum ini, operator aritmatika digunakan untuk menghitung persentase bobot nilai dan rata-rata kelas.

Operator Perbandingan: Digunakan untuk membandingkan dua buah nilai, menghasilkan nilai boolean (Benar/Salah). Contoh operator ini adalah Lebih Besar Dari (>), Lebih Besar Sama Dengan (>=), atau Sama Dengan (==). Operator ini menjadi penentu dalam struktur logika If/Else.

7. Integrasi PHP dan HTML
Salah satu keunggulan utama PHP adalah kemampuannya untuk berkolaborasi dengan HTML. Logika pemrosesan data (seperti perhitungan dan perulangan data mahasiswa) dikerjakan menggunakan blok kode PHP <?php ... ?>, dan hasilnya dicetak langsung menggunakan perintah echo ke dalam struktur tag HTML, seperti elemen tabel (<table>, <tr>, <td>).


# Tugas 9 — PHP: Buat Sistem Penilaian Mahasiswa

## 1. Source Code PHP

```PHP
<!-- 2311102100-Verdi Pangesu-->
<?php
// 1. Data Mahasiswa dalam Array Asosiasi
$daftar_mahasiswa = [
    [
        "nama" => "Verdi Pangestu",
        "nim" => "2311102100",
        "tugas" => 85,
        "uts" => 78,
        "uas" => 80
    ],
    [
        "nama" => "Megan Sulthon",
        "nim" => "2311102119",
        "tugas" => 90,
        "uts" => 88,
        "uas" => 92
    ],
    [
        "nama" => "Adrian Bashari",
        "nim" => "2311102105",
        "tugas" => 60,
        "uts" => 55,
        "uas" => 50
    ],
    [
        "nama" => "Fajar Ario",
        "nim" => "2311102114",
        "tugas" => 75,
        "uts" => 70,
        "uas" => 72
    ]
];

// 2. Function untuk menghitung nilai akhir
// Bobot: Tugas 30%, UTS 30%, UAS 40%
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

// 3. Function untuk menentukan Grade
function tentukanGrade($nilai) {
    if ($nilai >= 85) {
        return "A";
    } elseif ($nilai >= 75) {
        return "B";
    } elseif ($nilai >= 60) {
        return "C";
    } elseif ($nilai >= 50) {
        return "D";
    } else {
        return "E";
    }
}

// Inisialisasi variabel statistik
$total_seluruh_nilai = 0;
$nilai_tertinggi = 0;
$jumlah_mahasiswa = count($daftar_mahasiswa);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #333; }
        th, td { padding: 10px; text-align: center; }
        th { background-color: #f2f2f2; }
        .lulus { color: green; font-weight: bold; }
        .tidak-lulus { color: red; font-weight: bold; }
        .stats { background: #e9ecef; padding: 15px; border-radius: 5px; }
    </style>
</head>
<body>

    <h2>Daftar Nilai Mahasiswa</h2>

    <table>
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
            <?php 
            // 4. Loop untuk menampilkan data
            foreach ($daftar_mahasiswa as $mhs) : 
                $nilai_akhir = hitungNilaiAkhir($mhs['tugas'], $mhs['uts'], $mhs['uas']);
                $grade = tentukanGrade($nilai_akhir);
                
                // Tentukan status kelulusan (Operator Perbandingan)
                $status = ($nilai_akhir >= 60) ? "LULUS" : "TIDAK LULUS";
                $class_status = ($status == "LULUS") ? "lulus" : "tidak-lulus";

                // Update statistik
                $total_seluruh_nilai += $nilai_akhir;
                if ($nilai_akhir > $nilai_tertinggi) {
                    $nilai_tertinggi = $nilai_akhir;
                }
            ?>
            <tr>
                <td><?= $mhs['nama']; ?></td>
                <td><?= $mhs['nim']; ?></td>
                <td><?= number_format($nilai_akhir, 2); ?></td>
                <td><?= $grade; ?></td>
                <td class="<?= $class_status; ?>"><?= $status; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="stats">
        <?php 
            // Hitung rata-rata
            $rata_rata = $total_seluruh_nilai / $jumlah_mahasiswa;
        ?>
        <p><strong>Rata-rata Kelas:</strong> <?= number_format($rata_rata, 2); ?></p>
        <p><strong>Nilai Tertinggi:</strong> <?= number_format($nilai_tertinggi, 2); ?></p>
    </div>

</body>
</html>
```

## 2. Penjelasan Code

Program PHP tersebut merupakan aplikasi sederhana untuk menampilkan dan mengolah data nilai mahasiswa secara otomatis. Data mahasiswa disimpan dalam bentuk array asosiatif yang memuat informasi nama, NIM, serta nilai tugas, UTS, dan UAS. Program menghitung nilai akhir berdasarkan bobot tertentu menggunakan fungsi khusus, kemudian menentukan grade dan status kelulusan berdasarkan nilai akhir tersebut. Hasil perhitungan ditampilkan dalam bentuk tabel yang memuat nilai akhir, grade, dan keterangan lulus atau tidak lulus, serta dilengkapi informasi rata-rata nilai kelas dan nilai tertinggi untuk memberikan gambaran performa keseluruhan mahasiswa.

## 3. Output

<img width="1919" height="973" alt="Cuplikan layar 2026-04-14 171301" src="https://github.com/user-attachments/assets/61fc3f82-9db0-4b2f-ad26-4da33dfdac68" />
