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
        <strong>Sya'bananta Faqih M Lizbar</strong>
        <br>
        <strong>2311102097</strong>
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

## Dasar Teori

PHP (Hypertext Preprocessor) adalah bahasa pemrograman server-side scripting yang digunakan untuk mengembangkan aplikasi web dinamis. PHP dijalankan di sisi server, sehingga kode PHP tidak terlihat oleh pengguna, melainkan diproses terlebih dahulu oleh server dan hasilnya dikirim ke browser dalam bentuk HTML.

PHP sangat populer dalam pengembangan web karena sifatnya yang open-source, mudah dipelajari, serta memiliki integrasi yang kuat dengan berbagai database seperti MySQL dan PostgreSQL. PHP juga mendukung berbagai paradigma pemrograman, termasuk procedural dan object-oriented programming (OOP), sehingga fleksibel untuk berbagai skala aplikasi, mulai dari website sederhana hingga sistem enterprise.

Dalam arsitektur web, PHP biasanya digunakan sebagai bagian dari stack backend, seperti pada arsitektur LAMP (Linux, Apache, MySQL, PHP). PHP bertugas menangani logika bisnis, pengolahan data, autentikasi pengguna, serta komunikasi dengan database melalui query SQL.

## Tugas Modul 9 - PHP: Buat Sistem Penilaian Mahasiswa

### Source Code

```php
<?php
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

// Function menentukan status
function tentukanStatus($nilai) {
    return ($nilai >= 60) ? "Lulus" : "Tidak Lulus";
}

// Data mahasiswa (array asosiatif)
$mahasiswa = [
    [
        "nama" => "Faqih",
        "nim" => "2311102097",
        "tugas" => 80,
        "uts" => 75,
        "uas" => 90
    ],
    [
        "nama" => "Zaki",
        "nim" => "2311102098",
        "tugas" => 60,
        "uts" => 70,
        "uas" => 65
    ],
    [
        "nama" => "Ghana",
        "nim" => "2311102098",
        "tugas" => 50,
        "uts" => 55,
        "uas" => 60
    ]
];

// Variabel untuk rata-rata & nilai tertinggi
$totalNilai = 0;
$nilaiTertinggi = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Penilaian Mahasiswa</title>
</head>
<body>

<h2>Data Nilai Mahasiswa</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Nama</th>
        <th>NIM</th>
        <th>Nilai Akhir</th>
        <th>Grade</th>
        <th>Status</th>
    </tr>

    <?php foreach ($mahasiswa as $mhs): ?>
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
            <td><?= $mhs["nama"]; ?></td>
            <td><?= $mhs["nim"]; ?></td>
            <td><?= number_format($nilaiAkhir, 2); ?></td>
            <td><?= $grade; ?></td>
            <td><?= $status; ?></td>
        </tr>
    <?php endforeach; ?>

</table>

<?php
$rataRata = $totalNilai / count($mahasiswa);
?>

<h3>Rata-rata Kelas: <?= number_format($rataRata, 2); ?></h3>
<h3>Nilai Tertinggi: <?= number_format($nilaiTertinggi, 2); ?></h3>

</body>
</html>
```

**Kode Lengkap:** [index.php](index.php)

Output:
<img src="Screenshot 2026-04-14 183755.png" alt="preview" style="width:100%; max-width:900px;">

### Penjelasan

Website tersebut adalah Sistem Penilaian Mahasiswa berbasis PHP yang digunakan untuk menghitung nilai akhir, menentukan grade, dan status kelulusan.
Selain itu, website ini juga menampilkan statistik kelas seperti rata-rata nilai dan mahasiswa dengan nilai tertinggi.
