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
        <strong>Rasyid Nafsyarie</strong>
        <br>
        <strong>2311102011</strong>
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
$mahasiswa = [
    [
        'nama'         => 'Ahmad Fauzi',
        'nim'          => '1301210001',
        'nilai_tugas'  => 85,
        'nilai_uts'    => 78,
        'nilai_uas'    => 90
    ],
    [
        'nama'         => 'Bunga Citra',
        'nim'          => '1301210002',
        'nilai_tugas'  => 70,
        'nilai_uts'    => 65,
        'nilai_uas'    => 72
    ],
    [
        'nama'         => 'Charlie Dwi',
        'nim'          => '1301210003',
        'nilai_tugas'  => 55,
        'nilai_uts'    => 50,
        'nilai_uas'    => 45
    ],
    [
        'nama'         => 'Diana Putri',
        'nim'          => '1301210004',
        'nilai_tugas'  => 92,
        'nilai_uts'    => 88,
        'nilai_uas'    => 95
    ],
    [
        'nama'         => 'Eko Prasetyo',
        'nim'          => '1301210005',
        'nilai_tugas'  => 60,
        'nilai_uts'    => 72,
        'nilai_uas'    => 68
    ]
];

function hitungNilaiAkhir($tugas, $uts, $uas) {
    $nilai_akhir = ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);
    return round($nilai_akhir, 2);
}

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

function tentukanStatus($nilai_akhir) {
    if ($nilai_akhir >= 60) {
        return 'Lulus';
    } else {
        return 'Tidak Lulus';
    }
}
```

**Kode Lengkap:** [index.php](index.php)

Output:
<img src="Screenshot (1131).png" alt="preview" style="width:100%; max-width:900px;">

### Penjelasan

Website tersebut adalah Sistem Penilaian Mahasiswa berbasis PHP yang digunakan untuk menghitung nilai akhir, menentukan grade, dan status kelulusan.
Selain itu, website ini juga menampilkan statistik kelas seperti rata-rata nilai dan mahasiswa dengan nilai tertinggi.