<div align="center">
  <br />
  <h1>LAPORAN PRAKTIKUM <br> APLIKASI BERBASIS PLATFORM </h1>
  <br />
  <h3>MODUL 8 <br> PHP </h3>
  <br />
  <img width="512" height="512" alt="telyu" src="https://github.com/user-attachments/assets/724a3291-bcf9-448d-a395-3886a8659d79" />
  <br />
  <br />
  <br />
  <h3>Disusun Oleh :</h3>
  <p>
    <strong>Fattah Rizqy Adhipratama</strong>
    <br>
    <strong>2311102019</strong>
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


# Dasar Teori

<p align="justify">
PHP (Hypertext Preprocessor) adalah bahasa pemrograman server-side scripting yang banyak digunakan untuk pengembangan website dinamis. PHP bekerja di sisi server untuk memproses data, mengelola logika aplikasi, dan menghasilkan halaman web yang kemudian ditampilkan pada browser pengguna. Karena dapat disisipkan langsung ke dalam HTML, PHP menjadi salah satu bahasa yang populer untuk membangun sistem berbasis web seperti portal berita, e-commerce, dan aplikasi manajemen data.
</p>

<p align="justify">
Selain mudah dipelajari, PHP juga mendukung berbagai fitur penting seperti pengolahan form, koneksi database, manajemen session, serta integrasi dengan banyak framework seperti Laravel dan CodeIgniter. PHP bersifat open-source sehingga banyak digunakan oleh pengembang karena fleksibel, memiliki komunitas besar, dan kompatibel dengan berbagai server maupun sistem operasi. Hal tersebut membuat PHP tetap menjadi pilihan utama dalam pengembangan aplikasi web modern.
</p>

# Tugas 8 - PHP: Buat Sistem Penilaian Mahasiswa
## 1. Source code index.php
```
<!-- 2311102019
Fattah Rizqy Adhipratama
S1IF-11-05 -->
<?php
$mahasiswa = [
    [
        "nama" => "Alex",
        "nim" => "2311102999",
        "tugas" => 60,
        "uts" => 30,
        "uas" => 40
    ],
    [
        "nama" => "Fattah",
        "nim" => "2311102019",
        "tugas" => 90,
        "uts" => 87,
        "uas" => 86
    ],
    [
        "nama" => "Aji",
        "nim" => "2311102021",
        "tugas" => 90,
        "uts" => 88,
        "uas" => 81
    ],
    [
        "nama" => "Rasyid",
        "nim" => "2311102013",
        "tugas" => 86,
        "uts" => 75,
        "uas" => 70
    ],
    [
        "nama" => "Gery",
        "nim" => "2311102008",
        "tugas" => 100,
        "uts" => 92,
        "uas" => 90
    ]
];

function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

function tentukanGrade($nilaiAkhir) {
    if ($nilaiAkhir >= 85) {
        return "A";
    } elseif ($nilaiAkhir >= 75) {
        return "B";
    } elseif ($nilaiAkhir >= 65) {
        return "C";
    } elseif ($nilaiAkhir >= 50) {
        return "D";
    } else {
        return "E";
    }
}

$totalNilai = 0;
$nilaiTertinggi = 0;
$namaTertinggi = "";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Nilai Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white text-center rounded-top-4">
            <h2 class="mb-0">Data Nilai Mahasiswa</h2>
            <small>Modul 8 - Tugas Praktikum PHP</small>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Nilai Akhir</th>
                            <th>Grade</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mahasiswa as $mhs): ?>
                            <?php
                                $nilaiAkhir = hitungNilaiAkhir($mhs["tugas"], $mhs["uts"], $mhs["uas"]);
                                $grade = tentukanGrade($nilaiAkhir);
                                $status = ($nilaiAkhir >= 65) ? "Lulus" : "Tidak Lulus";

                                $totalNilai += $nilaiAkhir;

                                if ($nilaiAkhir > $nilaiTertinggi) {
                                    $nilaiTertinggi = $nilaiAkhir;
                                    $namaTertinggi = $mhs["nama"];
                                }
                            ?>
                            <tr>
                                <td><?= $mhs["nama"]; ?></td>
                                <td><?= $mhs["nim"]; ?></td>
                                <td><?= number_format($nilaiAkhir, 2); ?></td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        <?= $grade; ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge <?= $status == 'Lulus' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?= $status; ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php $rataRata = $totalNilai / count($mahasiswa); ?>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="alert alert-success shadow-sm">
                        <strong>Rata-rata Kelas:</strong> <?= number_format($rataRata, 2); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-warning shadow-sm">
                        <strong>Nilai Tertinggi:</strong> <?= $namaTertinggi; ?> (<?= number_format($nilaiTertinggi, 2); ?>)
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
```

# Output
![alt text](<Screenshot (1181).png>)

# Penjelasan
<p align="justify">
Program PHP ini digunakan untuk mengelola dan menampilkan data nilai beberapa mahasiswa menggunakan array asosiasi, di mana setiap mahasiswa memiliki atribut nama, NIM, nilai tugas, UTS, dan UAS. Program memanfaatkan function hitungNilaiAkhir() untuk menghitung nilai akhir dengan rumus 30% tugas, 30% UTS, dan 40% UAS, kemudian function tentukanGrade() untuk menentukan grade berdasarkan rentang nilai menggunakan percabangan if/elseif. Seluruh data mahasiswa ditampilkan secara otomatis menggunakan loop foreach ke dalam tabel HTML yang telah dipercantik dengan Bootstrap, sehingga tampil lebih rapi dan responsif. Selain itu, program juga menggunakan operator perbandingan untuk menentukan status kelulusan (lulus jika nilai akhir ≥ 65), menghitung rata-rata kelas, serta mencari nilai tertinggi beserta nama mahasiswa yang mendapatkannya, lalu menampilkannya dalam bentuk alert Bootstrap agar lebih informatif dan menarik.
</p>