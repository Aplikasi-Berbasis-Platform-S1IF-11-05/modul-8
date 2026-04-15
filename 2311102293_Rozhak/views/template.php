<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Rozhak">
    <meta name="nim" content="2311102293">
    <meta name="description" content="Tugas Modul 9 - PHP: Buat Sistem Penilaian Mahasiswa">
    <title> SiPeMa - Sistem Penilaian Mahasiswa</title>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container" style="max-width: 900px;">
        
        <!-- Header -->
        <header class="mb-5">
            <h1 class="page-title">Nilai Mahasiswa.</h1>
            <p class="page-subtitle">Modul 9 Praktikum Pemrograman Web &mdash; Evaluasi Akhir</p>
        </header>

        <!-- Stats Section -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="v-card">
                    <div class="metric-title">Rata-Rata Kelas</div>
                    <!-- PHP Output -->
                    <div class="metric-value">
                        <?= number_format($rataRataKelas, 2, ',', '.') ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="v-card">
                    <div class="metric-title">Nilai Tertinggi</div>
                    <!-- PHP Output -->
                    <div class="metric-value">
                        <?= number_format($nilaiTertinggi, 2, ',', '.') ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="v-table-container">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="30%">Nama</th>
                            <th width="20%">NIM</th>
                            <th width="15%">Nilai Akhir</th>
                            <th width="10%">Grade</th>
                            <th width="20%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($dataDiproses)): ?>
                            <?php $no = 1; foreach ($dataDiproses as $row): ?>
                                <tr>
                                    <td class="text-muted"><?= $no++ ?></td>
                                    <td class="fw-medium"><?= htmlspecialchars($row['nama']) ?></td>
                                    <td class="text-muted" style="font-family: monospace; font-size: 0.85rem;">
                                        <?= htmlspecialchars($row['nim']) ?>
                                    </td>
                                    <td class="fw-semibold">
                                        <?= number_format($row['nilaiAkhir'], 2, ',', '.') ?>
                                    </td>
                                    <td>
                                        <span class="v-badge v-badge-neutral"><?= $row['grade'] ?></span>
                                    </td>
                                    <td>
                                        <?php if ($row['status'] === 'Lulus'): ?>
                                            <span class="v-badge v-badge-success">Lulus</span>
                                        <?php else: ?>
                                            <span class="v-badge v-badge-danger">Tidak Lulus</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    Data mahasiswa tidak ditemukan.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>