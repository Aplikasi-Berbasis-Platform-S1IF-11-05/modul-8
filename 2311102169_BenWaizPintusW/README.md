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
    <strong>Ben Waiz Pintus Widyosaputro</strong>
    <br>
    <strong>2311102169</strong>
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
PHP (Hypertext Preprocessor) merupakan bahasa pemrograman yang berjalan di sisi server (server-side scripting) dan digunakan untuk mengembangkan aplikasi web dinamis. PHP mampu memproses data, mengelola form, berinteraksi dengan database seperti MySQL, serta menghasilkan halaman web dalam bentuk HTML yang dikirim ke browser pengguna. Bahasa ini bersifat open-source, mudah dipelajari, dan banyak digunakan dalam pengembangan web karena kompatibel dengan berbagai server seperti Apache yang tersedia dalam paket seperti XAMPP.
</p>

<p align="justify">
Dalam implementasinya, PHP mendukung berbagai konsep dasar pemrograman seperti penggunaan variabel, array (termasuk array asosiatif untuk menyimpan data terstruktur), percabangan (if-else, switch) untuk pengambilan keputusan, perulangan (for, while, foreach) untuk memproses data secara berulang, serta fungsi untuk membuat kode lebih modular dan terorganisir. Selain itu, PHP juga mendukung operator aritmatika untuk perhitungan dan operator perbandingan untuk menentukan kondisi tertentu, seperti status kelulusan. Dengan kemampuannya dalam mengolah data dan menghasilkan tampilan dinamis, PHP menjadi salah satu teknologi utama dalam pengembangan sistem informasi berbasis web.
</p>

# Tugas 8 - PHP: Buat Sistem Penilaian Mahasiswa
## 1. Source code index.php
```
<!-- 2311102169
Ben Waiz Pintus W
S1IF-11-05 -->
<?php
$mahasiswa = [
    ["nama"=>"Ben","nim"=>"2311102169","tugas"=>90,"uts"=>80,"uas"=>90],
    ["nama"=>"Qonita","nim"=>"104012300251","tugas"=>90,"uts"=>85,"uas"=>80],
    ["nama"=>"Abel", "nim"=>"2311102163","tugas"=>90,"uts"=>88,"uas"=>95],
    ["nama"=>"Cinta", "nim"=>"2311102164","tugas"=>50,"uts"=>40,"uas"=>65]
];

function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

function getGrade($nilai) {
    if ($nilai >= 85) return "A";
    elseif ($nilai >= 75) return "B";
    elseif ($nilai >= 65) return "C";
    elseif ($nilai >= 50) return "D";
    else return "E";
}

$totalNilai = 0;
$nilaiTertinggi = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Penilaian Mahasiswa</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <!-- Card -->
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h3>📊 Sistem Penilaian Mahasiswa</h3>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Nilai Akhir</th>
                        <th>Grade</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($mahasiswa as $mhs): 
                    $nilaiAkhir = hitungNilaiAkhir($mhs["tugas"], $mhs["uts"], $mhs["uas"]);
                    $grade = getGrade($nilaiAkhir);
                    $status = ($nilaiAkhir >= 60) ? "Lulus" : "Tidak Lulus";

                    $totalNilai += $nilaiAkhir;
                    if ($nilaiAkhir > $nilaiTertinggi) {
                        $nilaiTertinggi = $nilaiAkhir;
                    }

                    // Badge warna
                    $badge = ($status == "Lulus") ? "success" : "danger";
                ?>
                    <tr>
                        <td><?= $mhs["nama"]; ?></td>
                        <td><?= $mhs["nim"]; ?></td>
                        <td><?= number_format($nilaiAkhir,2); ?></td>
                        <td><span class="badge bg-info"><?= $grade; ?></span></td>
                        <td><span class="badge bg-<?= $badge; ?>"><?= $status; ?></span></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <?php
            $rataRata = $totalNilai / count($mahasiswa);
            ?>

            <!-- Statistik -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="alert alert-primary text-center">
                        <h5>📈 Rata-rata Kelas</h5>
                        <strong><?= number_format($rataRata,2); ?></strong>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="alert alert-success text-center">
                        <h5>🏆 Nilai Tertinggi</h5>
                        <strong><?= number_format($nilaiTertinggi,2); ?></strong>
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
![alt text](<p1.png>)

# Penjelasan
<p align="justify">
Program PHP ini digunakan untuk mengelola dan menampilkan data nilai mahasiswa yang disimpan dalam array asosiatif, di mana setiap mahasiswa memiliki atribut nama, NIM, nilai tugas, UTS, dan UAS. Sistem menggunakan fungsi hitungNilaiAkhir() untuk menghitung nilai akhir berdasarkan bobot (30% tugas, 30% UTS, dan 40% UAS), serta fungsi getGrade() untuk menentukan grade menggunakan percabangan if-else. Selanjutnya, data diproses menggunakan perulangan foreach untuk ditampilkan dalam bentuk tabel HTML yang telah dipercantik dengan Bootstrap, termasuk penggunaan komponen seperti card, table, badge, dan alert agar tampilan lebih modern dan responsif. Selain itu, program juga menghitung total nilai untuk mendapatkan rata-rata kelas serta mencari nilai tertinggi menggunakan operator perbandingan, lalu menampilkannya di bagian bawah tabel sebagai informasi tambahan, serta menentukan status kelulusan mahasiswa berdasarkan nilai akhir (≥ 60 dinyatakan lulus).
</p>