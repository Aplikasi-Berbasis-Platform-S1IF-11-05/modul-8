<?php
require_once 'data.php';
require_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa | Telkom University Purwokerto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <header>
        <h1>🎓 Sistem Penilaian Mahasiswa</h1>
        <p class="subtitle">Telkom University Purwokerto<br>Program Studi Teknik Informatika - Semester Genap 2025/2026</p>
    </header>

    <div class="content">

        <table>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th>Nilai Tugas</th>
                <th>Nilai UTS</th>
                <th>Nilai UAS</th>
                <th>Nilai Akhir</th>
                <th>Grade</th>
                <th>Status</th>
            </tr>

            <?php
            $total_nilai = 0;
            $nilai_tertinggi = 0;
            $mahasiswa_tertinggi = "";

            foreach ($mahasiswa as $index => $m) {
                $nilai_akhir = hitungNilaiAkhir($m['tugas'], $m['uts'], $m['uas']);
                $grade = tentukanGrade($nilai_akhir);
                $status = tentukanStatus($nilai_akhir);

                $total_nilai += $nilai_akhir;

                if ($nilai_akhir > $nilai_tertinggi) {
                    $nilai_tertinggi = $nilai_akhir;
                    $mahasiswa_tertinggi = $m['nama'];
                }

                $status_class = ($status === "Lulus") ? "lulus" : "tidak-lulus";
            ?>

            <tr>
                <td><?= $index + 1 ?></td>
                <td class="nama"><?= htmlspecialchars($m['nama']) ?></td>
                <td><?= $m['nim'] ?></td>
                <td><?= $m['tugas'] ?></td>
                <td><?= $m['uts'] ?></td>
                <td><?= $m['uas'] ?></td>
                <td><strong><?= formatNilai($nilai_akhir) ?></strong></td>
                <td><?= $grade ?></td>
                <td class="<?= $status_class ?>"><?= $status ?></td>
            </tr>

            <?php } ?>

        </table>

        <?php
        $rata_rata = $total_nilai / count($mahasiswa);
        ?>

        <div class="stat">
            <div class="stat-card">
                <h3>Jumlah Mahasiswa</h3>
                <div class="highlight"><?= count($mahasiswa) ?> Orang</div>
            </div>
            <div class="stat-card">
                <h3>Rata-rata Kelas</h3>
                <div class="highlight"><?= formatNilai($rata_rata) ?></div>
            </div>
            <div class="stat-card">
                <h3>Nilai Tertinggi</h3>
                <div class="highlight"><?= formatNilai($nilai_tertinggi) ?></div>
                <small>Oleh: <strong><?= htmlspecialchars($mahasiswa_tertinggi) ?></strong></small>
            </div>
        </div>

    </div>

    <footer>
        &copy; <?= date("Y") ?> Telkom University Purwokerto - Sistem Penilaian Mahasiswa<br>
    </footer>
</div>

</body>
</html>
