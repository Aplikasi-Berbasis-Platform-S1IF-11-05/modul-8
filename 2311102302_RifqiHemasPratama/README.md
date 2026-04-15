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
    <strong>Rifqi Hemas Pratama</strong>
    <br>
    <strong>2311102302</strong>
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
  <strong>Apri Pandu Wicaksono </strong>
  <br>
  <strong>Hamka Zaenul Ardi</strong>
  <br />
  <h3>LABORATORIUM HIGH PERFORMANCE <br>FAKULTAS INFORMATIKA <br>UNIVERSITAS TELKOM PURWOKERTO <br>2026 </h3>
</div>

<hr>

# Landasan Teori

## 1. Konsep Dasar PHP
PHP (*Hypertext Preprocessor*) adalah bahasa skrip berorientasi *server-side* yang dirancang khusus untuk pengembangan web dinamis. Pada modul ini, PHP diimplementasikan sebagai pemroses utama untuk mengkalkulasi data nilai mahasiswa, menetapkan predikat (grade), dan merender hasilnya ke dalam antarmuka tabel HTML.

---

## 2. Implementasi Array Asosiatif
Berbeda dengan array numerik biasa, array asosiatif memanfaatkan pasangan *key-value* (kunci dan nilai) untuk menyimpan data. Struktur ini digunakan agar atribut mahasiswa seperti Nama, NIM, serta komponen nilai (Tugas, UTS, UAS) dapat disimpan secara terstruktur dan dipanggil dengan lebih intuitif.

---

## 3. Modularitas dengan Function
Dalam PHP, *function* (fungsi) dimanfaatkan untuk memecah algoritma kompleks menjadi beberapa blok kode yang dapat digunakan ulang (*reusable*). Pada praktikum ini, fungsi dibuat khusus untuk menangani proses:
- Kalkulasi perhitungan nilai akhir.
- Konversi nilai angka menjadi *grade* huruf.
- Pengecekan status kelulusan mahasiswa.

---

## 4. Penggunaan Operator
### Operator Aritmatika
Berperan dalam operasi matematis untuk menghitung nilai akhir berdasarkan persentase bobot akademik, yaitu: Tugas (30%), UTS (30%), dan UAS (40%).

### Operator Perbandingan
Berperan untuk mengevaluasi kondisi logika, yang digunakan pada saat membandingkan nilai akhir guna menentukan *grade* dan status akhir (Lulus atau Tidak Lulus).

---

## 5. Struktur Kontrol: Percabangan
Proses penyeleksian kondisi (*conditional statement*) dilakukan menggunakan struktur `if/elseif/else`. Blok percabangan ini bertugas menerjemahkan rentang nilai akhir yang didapat mahasiswa menjadi *grade* yang sesuai.

---

## 6. Struktur Kontrol: Perulangan
Untuk efisiensi penulisan kode, perulangan `foreach` digunakan. Metode ini secara otomatis melakukan iterasi (pengulangan) pada seluruh elemen array mahasiswa dan mencetaknya baris demi baris ke dalam struktur tabel HTML.

## 1. SOURCE CODE PHP
```
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
        .lulus { color: green; font-weight: bold; }
        .tidak-lulus { color: red; font-weight: bold; }
        .statistik { margin-top: 20px; padding: 15px; background-color: #e9ecef; border-radius: 5px; }
    </style>
</head>
<body>

    <h2>Data Penilaian Mahasiswa</h2>

    <?php
    // Rifqi Hemas Pratama
    // 2311102302
    $data_mahasiswa = [
        [
            "nama" => "Andi Saputra",
            "nim" => "1020301",
            "nilai_tugas" => 85,
            "nilai_uts" => 80,
            "nilai_uas" => 90
        ],
        [
            "nama" => "Budi Raharjo",
            "nim" => "1020302",
            "nilai_tugas" => 60,
            "nilai_uts" => 55,
            "nilai_uas" => 50
        ],
        [
            "nama" => "Citra Lestari",
            "nim" => "1020303",
            "nilai_tugas" => 95,
            "nilai_uts" => 88,
            "nilai_uas" => 92
        ],
        [
            "nama" => "Dewi Maharani",
            "nim" => "1020304",
            "nilai_tugas" => 70,
            "nilai_uts" => 75,
            "nilai_uas" => 65
        ]
    ];

    function hitungNilaiAkhir($tugas, $uts, $uas) {
        $nilai_akhir = ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);
        return $nilai_akhir;
    }

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
                <th>Nilai Tugas</th>
                <th>Nilai UTS</th>
                <th>Nilai UAS</th>
                <th>Nilai Akhir</th>
                <th>Grade</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data_mahasiswa as $mhs) {

                $nilai_akhir = hitungNilaiAkhir($mhs['nilai_tugas'], $mhs['nilai_uts'], $mhs['nilai_uas']);

                $grade = tentukanGrade($nilai_akhir);

                $status = ($nilai_akhir >= 60) ? "Lulus" : "Tidak Lulus";
                $class_status = ($nilai_akhir >= 60) ? "lulus" : "tidak-lulus";

                $total_nilai_kelas += $nilai_akhir;

                if ($nilai_akhir > $nilai_tertinggi) {
                    $nilai_tertinggi = $nilai_akhir;
                }

                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $mhs['nama'] . "</td>";
                echo "<td>" . $mhs['nim'] . "</td>";
                echo "<td>" . $mhs['nilai_tugas'] . "</td>";
                echo "<td>" . $mhs['nilai_uts'] . "</td>";
                echo "<td>" . $mhs['nilai_uas'] . "</td>";
                echo "<td><strong>" . number_format($nilai_akhir, 2) . "</strong></td>";
                echo "<td>" . $grade . "</td>";
                echo "<td class='$class_status'>" . $status . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    $rata_rata_kelas = $total_nilai_kelas / $jumlah_mahasiswa;
    ?>

    <div class="statistik">
        <p><strong>Statistik Kelas:</strong></p>
        <ul>
            <li>Rata-rata Nilai Kelas: <strong><?php echo number_format($rata_rata_kelas, 2); ?></strong></li>
            <li>Nilai Tertinggi di Kelas: <strong><?php echo number_format($nilai_tertinggi, 2); ?></strong></li>
        </ul>
    </div>

</body>
</html>

