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