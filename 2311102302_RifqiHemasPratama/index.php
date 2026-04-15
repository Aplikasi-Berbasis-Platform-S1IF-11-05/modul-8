
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