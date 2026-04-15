<?php

/**
 * Data mahasiswa untuk Sistem Penilaian Mahasiswa.
 *
 * File ini mengembalikan array berisi data mahasiswa beserta nilai
 * tugas, UTS, dan UTS yang akan diproses oleh modul penilaian.
 *
 * Penggunaan:
 *   $mahasiswa = require_once 'app/data.php';
 *
 * @return array<string, mixed>[] Daftar data mahasiswa
 */
$mahasiswa = [
    [
        'nama' => 'Rozhak',
        'nim' => '2311102293',
        'tugas' => 10,
        'uts' => 50,
        'uas' => 30
    ],
    [
        'nama' => 'Mark Zuckerberg',
        'nim' => '2211102294',
        'tugas' => 80,
        'uts' => 85,
        'uas' => 90
    ],
    [
        'nama' => 'Elon Musk',
        'nim' => '2211102295',
        'tugas' => 70,
        'uts' => 75,
        'uas' => 80
    ]
];

/**
 * Mengembalikan array data mahasiswa agar dapat digunakan oleh file lain.
 *
 * @return array<string, mixed>[] Data mahasiswa
 */
return $mahasiswa;