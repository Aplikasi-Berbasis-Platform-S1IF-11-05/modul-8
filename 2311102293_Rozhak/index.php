<?php

/**
 * Berkas utama Sistem Penilaian Mahasiswa (SiPeMa).
 *
 * Alur kerja:
 * 1. Memuat data mahasiswa dan fungsi-fungsi bantu.
 * 2. Menghitung nilai akhir, grade, dan status kelulusan setiap mahasiswa.
 * 3. Menghitung statistik kelas (rata-rata dan nilai tertinggi).
 * 4. Meneruskan data yang telah diproses ke template tampilan.
 */

$mahasiswa = require_once 'app/data.php';
require_once 'app/functions.php';

$dataDiproses = [];
$totalNilaiKelas = 0;
$nilaiTertinggi = 0;

if (!empty($mahasiswa) && is_array($mahasiswa)) {
    foreach ($mahasiswa as $mhs) {
        $nilaiAkhir = hitungNilaiAkhir($mhs['tugas'], $mhs['uts'], $mhs['uas']);
        $grade = tentukanGrade($nilaiAkhir);
        $status = tentukanStatus($nilaiAkhir);
    

        if ($nilaiAkhir > $nilaiTertinggi) {
            $nilaiTertinggi = $nilaiAkhir;
        }

        $totalNilaiKelas += $nilaiAkhir;

        $dataDiproses[] = [
            'nama' => $mhs['nama'],
            'nim' => $mhs['nim'],
            'nilaiAkhir' => $nilaiAkhir,
            'grade' => $grade,
            'status' => $status
        ];
    }
}

$jumlahMahasiswa = count($mahasiswa);
$rataRataKelas = ($jumlahMahasiswa > 0) ? ($totalNilaiKelas / $jumlahMahasiswa) : 0;

require_once 'views/template.php';