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
    <strong>Adrian Basari Rhesa</strong>
    <br>
    <strong>2311102105</strong>
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

```
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background-color: #4CAF50; color: white; }
        .lulus { color: green; font-weight: bold; }
        .tidak-lulus { color: red; font-weight: bold; }
        .summary { font-size: 16px; font-weight: bold; }
    </style>
</head>
<body>

    <h2>Data Penilaian Mahasiswa</h2>

    <?php
    // 1. Gunakan array Asosiasi untuk menyimpan minimal 3 data mahasiswa
    $data_mahasiswa = [
        [
            "nama" => "Adrian Basari Rhesa",
            "nim" => "2311102105",
            "nilai_tugas" => 80,
            "nilai_uts" => 75,
            "nilai_uas" => 85
        ],
        [
            "nama" => "Megan Sulthon Aryomukti",
            "nim" => "2311102119",
            "nilai_tugas" => 60,
            "nilai_uts" => 55,
            "nilai_uas" => 65
        ],
        [
            "nama" => "Verdi Pangestu",
            "nim" => "2311102100",
            "nilai_tugas" => 90,
            "nilai_uts" => 95,
            "nilai_uas" => 90
        ],
        [
            "nama" => "Naufal Adika Azmi",
            "nim" => "2311102086",
            "nilai_tugas" => 70,
            "nilai_uts" => 65,
            "nilai_uas" => 75
        ]
    ];

    // 2. Gunakan function dan operator aritmatika untuk menghitung nilai akhir
    // Persentase: Tugas 30%, UTS 30%, UAS 40% (Bisa disesuaikan dengan aturan kampus)
    function hitungNilaiAkhir($tugas, $uts, $uas) {
        $nilai = ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
        return $nilai;
    }

    // 3. Gunakan if/else untuk menentukan grade
    function tentukanGrade($nilai_akhir) {
        if ($nilai_akhir >= 85) {
            return 'A';
        } elseif ($nilai_akhir >= 75) {
            return 'B';
        } elseif ($nilai_akhir >= 65) {
            return 'C';
        } elseif ($nilai_akhir >= 50) {
            return 'D';
        } else {
            return 'E';
        }
    }

    // 4. Gunakan operator perbandingan untuk menentukan lulus/tidak
    function tentukanStatus($nilai_akhir) {
        // Asumsi nilai kelulusan minimal adalah 65
        if ($nilai_akhir >= 65) {
            return "Lulus";
        } else {
            return "Tidak Lulus";
        }
    }

    // Variabel untuk perhitungan rata-rata dan nilai tertinggi
    $total_nilai_kelas = 0;
    $nilai_tertinggi = 0;
    $jumlah_mahasiswa = count($data_mahasiswa);
    ?>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Nilai Akhir</th>
                <th>Grade</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            // 5. Gunakan loop (foreach) untuk menampilkan seluruh data
            foreach ($data_mahasiswa as $mhs) {
                // Panggil fungsi untuk setiap mahasiswa
                $nilai_akhir = hitungNilaiAkhir($mhs['nilai_tugas'], $mhs['nilai_uts'], $mhs['nilai_uas']);
                $grade = tentukanGrade($nilai_akhir);
                $status = tentukanStatus($nilai_akhir);

                // Tambahkan class CSS untuk warna status
                $status_class = ($status == "Lulus") ? "lulus" : "tidak-lulus";

                // Update total nilai untuk rata-rata kelas
                $total_nilai_kelas += $nilai_akhir;

                // Cari nilai tertinggi
                if ($nilai_akhir > $nilai_tertinggi) {
                    $nilai_tertinggi = $nilai_akhir;
                }

                // Tampilkan baris tabel
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $mhs['nama'] . "</td>";
                echo "<td>" . $mhs['nim'] . "</td>";
                echo "<td>" . number_format($nilai_akhir, 2) . "</td>"; // Format 2 angka di belakang koma
                echo "<td>" . $grade . "</td>";
                echo "<td class='$status_class'>" . $status . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    // Hitung rata-rata kelas
    $rata_rata_kelas = $jumlah_mahasiswa > 0 ? ($total_nilai_kelas / $jumlah_mahasiswa) : 0;
    ?>

    <div class="summary">
        <p>Rata-rata Kelas: <?php echo number_format($rata_rata_kelas, 2); ?></p>
        <p>Nilai Tertinggi: <?php echo number_format($nilai_tertinggi, 2); ?></p>
    </div>

</body>
</html>
```

## 2. Penjelasan Code

1. Penyimpanan Data (Array Asosiatif Multi-dimensi)
```PHP
$data_mahasiswa = [
    [
        "nama" => "Andi Pratama",
        "nim" => "10101",
        "nilai_tugas" => 80,
        "nilai_uts" => 75,
        "nilai_uas" => 85
    ],
    // ... data lainnya ...
];
```
Penjelasan: Ini adalah array di dalam array (multi-dimensi). Array utama $data_mahasiswa membungkus beberapa array kecil yang masing-masing mewakili satu mahasiswa.

Kita menggunakan Array Asosiatif di sini, artinya alih-alih menggunakan angka urut (0, 1, 2) sebagai indeks, kita menggunakan label teks (kunci/ key) seperti "nama", "nim", dan "nilai_tugas" agar data lebih mudah dibaca dan dipanggil.

2. Fungsi Perhitungan Nilai (Fungsi & Aritmatika)
```PHP
function hitungNilaiAkhir($tugas, $uts, $uas) {
    $nilai = ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
    return $nilai;
}
```
Penjelasan: Kita membuat sebuah wadah fungsi bernama hitungNilaiAkhir. Fungsi ini meminta 3 bahan (parameter): nilai tugas, UTS, dan UAS.

Di dalamnya terdapat Operator Aritmatika. Nilai tugas dikali (*) 30% (0.3), UTS 30%, dan UAS 40%. Hasil penjumlahannya (+) kemudian dikembalikan (return) untuk digunakan nanti.

3. Penentuan Grade (Percabangan If/Else)
```PHP
function tentukanGrade($nilai_akhir) {
    if ($nilai_akhir >= 85) {
        return 'A';
    } elseif ($nilai_akhir >= 75) {
        return 'B';
    } // ... dan seterusnya ...
}
```
Penjelasan: Fungsi ini bertugas mengubah angka menjadi huruf. Ia menerima data $nilai_akhir.

Menggunakan struktur If/Else, program mengecek dari nilai paling atas. Jika nilainya lebih dari atau sama dengan (>=) 85, maka dapat A. Jika tidak, ia akan mengecek kondisi di bawahnya secara berurutan.

4. Penentuan Kelulusan (Operator Perbandingan)
```PHP
function tentukanStatus($nilai_akhir) {
    if ($nilai_akhir >= 65) {
        return "Lulus";
    } else {
        return "Tidak Lulus";
    }
}
```
Penjelasan: Fungsi ini sangat sederhana. Menggunakan Operator Perbandingan (>=), program mengecek apakah nilai akhir mencapai batas minimal kelulusan (dalam contoh ini 65). Jika ya, statusnya "Lulus", jika kurang dari itu maka "Tidak Lulus".

5. Menyiapkan Variabel untuk Rata-rata dan Nilai Tertinggi
```PHP
$total_nilai_kelas = 0;
$nilai_tertinggi = 0;
$jumlah_mahasiswa = count($data_mahasiswa);
```
Penjelasan: Sebelum memulai proses menampilkan data, kita membuat variabel kosong (0) untuk menampung total seluruh nilai mahasiswa dan mencari siapa yang nilainya paling besar. Fungsi count() digunakan untuk menghitung otomatis berapa jumlah mahasiswa yang ada di dalam array (dalam kasus kita ada 4).

6. Proses Menampilkan Data (Perulangan Foreach)
```PHP
foreach ($data_mahasiswa as $mhs) {
    $nilai_akhir = hitungNilaiAkhir($mhs['nilai_tugas'], $mhs['nilai_uts'], $mhs['nilai_uas']);
    // ... memanggil fungsi lainnya ...
```
Penjelasan: Perulangan foreach ini adalah jantung dari program. Ia akan membongkar isi $data_mahasiswa satu per satu dan menyimpannya sementara ke variabel $mhs.

Di dalam loop ini, kita memanggil fungsi-fungsi yang sudah dibuat sebelumnya (hitung nilai, grade, status) dengan memasukkan data dari array $mhs.

7. Mencari Rata-rata dan Nilai Tertinggi (Di dalam Loop)
```PHP
$total_nilai_kelas += $nilai_akhir;

if ($nilai_akhir > $nilai_tertinggi) {
    $nilai_tertinggi = $nilai_akhir;
}
```
Penjelasan: Masih di dalam loop, nilai akhir mahasiswa yang sedang diproses ditambahkan ke $total_nilai_kelas.

Lalu ada pengecekan: Apakah nilai mahasiswa ini lebih besar dari nilai tertinggi saat ini? Jika iya, maka nilai tertinggi akan diperbarui dengan nilai mahasiswa tersebut.

8. Mencetak ke HTML (Output)
```PHP
echo "<tr>";
echo "<td>" . $no++ . "</td>";
echo "<td>" . $mhs['nama'] . "</td>";
// ... dst ...
echo "</tr>";
```
Penjelasan: Perintah echo digunakan untuk mencetak tag HTML. Tanda titik (.) digunakan untuk menyambungkan teks HTML dengan variabel PHP (proses ini disebut Concatenation).

$no++ berfungsi untuk mencetak nomor urut (1, 2, 3...) yang akan selalu bertambah setiap kali loop berjalan.

9. Menampilkan Hasil Akhir
```PHP
$rata_rata_kelas = $jumlah_mahasiswa > 0 ? ($total_nilai_kelas / $jumlah_mahasiswa) : 0;
// ... (lalu di-echo di bawah tabel)
```
Penjelasan: Setelah loop selesai (semua baris tabel tercetak), kita tinggal menghitung rata-rata dengan membagi total nilai dengan jumlah mahasiswa. Hasilnya dan nilai tertinggi kemudian dicetak di bagian paling bawah tabel.


## 3. Output

<img width="1919" height="968" alt="Screenshot 2026-04-10 215946" src="https://github.com/user-attachments/assets/71b54c77-3372-4be5-9c9e-9e91b7d3bd73" />
