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