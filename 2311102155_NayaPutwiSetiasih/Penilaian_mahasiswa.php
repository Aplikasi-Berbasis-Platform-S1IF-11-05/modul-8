<?php
// ============================================================
// Sistem Penilaian Mahasiswa - Modul 9 PHP
// ============================================================

// Array asosiatif data mahasiswa (minimal 3)
$mahasiswa = [
    [
        "nama"         => "Andi Pratama",
        "nim"          => "2301010001",
        "nilai_tugas"  => 85,
        "nilai_uts"    => 78,
        "nilai_uas"    => 82,
    ],
    [
        "nama"         => "Budi Santoso",
        "nim"          => "2301010002",
        "nilai_tugas"  => 70,
        "nilai_uts"    => 65,
        "nilai_uas"    => 60,
    ],
    [
        "nama"         => "Citra Dewi",
        "nim"          => "2301010003",
        "nilai_tugas"  => 92,
        "nilai_uts"    => 88,
        "nilai_uas"    => 95,
    ],
    [
        "nama"         => "Dian Rahayu",
        "nim"          => "2301010004",
        "nilai_tugas"  => 55,
        "nilai_uts"    => 50,
        "nilai_uas"    => 48,
    ],
    [
        "nama"         => "Eka Nugraha",
        "nim"          => "2301010005",
        "nilai_tugas"  => 78,
        "nilai_uts"    => 80,
        "nilai_uas"    => 75,
    ],
];

// ============================================================
// Function: Hitung Nilai Akhir
// Bobot: Tugas 30%, UTS 35%, UAS 35%
// ============================================================
function hitungNilaiAkhir($tugas, $uts, $uas) {
    $nilai_akhir = ($tugas * 0.30) + ($uts * 0.35) + ($uas * 0.35);
    return round($nilai_akhir, 2);
}

// ============================================================
// Function: Tentukan Grade
// ============================================================
function tentukanGrade($nilai_akhir) {
    if ($nilai_akhir >= 85) {
        return "A";
    } elseif ($nilai_akhir >= 75) {
        return "B";
    } elseif ($nilai_akhir >= 65) {
        return "C";
    } elseif ($nilai_akhir >= 55) {
        return "D";
    } else {
        return "E";
    }
}

// ============================================================
// Function: Tentukan Status Kelulusan
// ============================================================
function tentukanStatus($nilai_akhir) {
    if ($nilai_akhir >= 60) {
        return "LULUS";
    } else {
        return "TIDAK LULUS";
    }
}

// ============================================================
// Proses data: hitung nilai akhir, grade, status tiap mahasiswa
// ============================================================
$total_nilai   = 0;
$nilai_tertinggi = 0;
$nama_tertinggi  = "";

foreach ($mahasiswa as &$mhs) {
    $mhs["nilai_akhir"] = hitungNilaiAkhir(
        $mhs["nilai_tugas"],
        $mhs["nilai_uts"],
        $mhs["nilai_uas"]
    );
    $mhs["grade"]  = tentukanGrade($mhs["nilai_akhir"]);
    $mhs["status"] = tentukanStatus($mhs["nilai_akhir"]);

    // Akumulasi untuk statistik kelas
    $total_nilai += $mhs["nilai_akhir"];

    if ($mhs["nilai_akhir"] > $nilai_tertinggi) {
        $nilai_tertinggi = $mhs["nilai_akhir"];
        $nama_tertinggi  = $mhs["nama"];
    }
}
unset($mhs); // lepas referensi

$jumlah_mahasiswa = count($mahasiswa);
$rata_rata_kelas  = round($total_nilai / $jumlah_mahasiswa, 2);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        /* ─── CSS Variables ─────────────────────────────── */
        :root {
            --bg:        #0d0f14;
            --surface:   #161a22;
            --card:      #1c2130;
            --border:    #262d3d;
            --accent:    #4fffb0;
            --accent2:   #5bc8ff;
            --warn:      #ff6b6b;
            --text:      #e8eaf0;
            --muted:     #6b7694;
            --font-disp: 'Syne', sans-serif;
            --font-mono: 'DM Mono', monospace;
        }

        /* ─── Reset & Base ──────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: var(--font-disp);
            min-height: 100vh;
            padding: 2.5rem 1.5rem 4rem;
            background-image:
                radial-gradient(ellipse 80% 50% at 50% -20%, rgba(79,255,176,.12) 0%, transparent 70%),
                radial-gradient(ellipse 60% 40% at 80% 100%, rgba(91,200,255,.08) 0%, transparent 60%);
        }

        /* ─── Header ────────────────────────────────────── */
        .header {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeDown .6s ease both;
        }
        .header .badge {
            display: inline-block;
            font-family: var(--font-mono);
            font-size: .72rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--accent);
            border: 1px solid rgba(79,255,176,.35);
            border-radius: 2rem;
            padding: .3rem .9rem;
            margin-bottom: 1rem;
        }
        .header h1 {
            font-size: clamp(1.8rem, 5vw, 3rem);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -.02em;
        }
        .header h1 span { color: var(--accent); }
        .header p {
            margin-top: .6rem;
            color: var(--muted);
            font-family: var(--font-mono);
            font-size: .85rem;
        }

        /* ─── Stats Cards ───────────────────────────────── */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 1rem;
            margin-bottom: 2.5rem;
            animation: fadeUp .6s .15s ease both;
        }
        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.2rem 1.5rem;
            position: relative;
            overflow: hidden;
            transition: transform .2s, border-color .2s;
        }
        .stat-card:hover { transform: translateY(-3px); border-color: var(--accent); }
        .stat-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(79,255,176,.06) 0%, transparent 60%);
        }
        .stat-label {
            font-family: var(--font-mono);
            font-size: .72rem;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: var(--muted);
            margin-bottom: .4rem;
        }
        .stat-value {
            font-size: 1.9rem;
            font-weight: 700;
            color: var(--accent);
            line-height: 1;
        }
        .stat-sub {
            margin-top: .3rem;
            font-size: .78rem;
            color: var(--muted);
            font-family: var(--font-mono);
        }

        /* ─── Table Wrapper ─────────────────────────────── */
        .table-wrap {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            animation: fadeUp .6s .3s ease both;
        }
        .table-title {
            padding: 1.2rem 1.8rem;
            border-bottom: 1px solid var(--border);
            font-size: .9rem;
            font-weight: 600;
            letter-spacing: .04em;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .table-title span { color: var(--accent); }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead th {
            padding: .9rem 1.4rem;
            font-family: var(--font-mono);
            font-size: .72rem;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--muted);
            text-align: left;
            background: rgba(255,255,255,.02);
            border-bottom: 1px solid var(--border);
        }
        tbody tr {
            border-bottom: 1px solid rgba(38,45,61,.6);
            transition: background .15s;
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: rgba(79,255,176,.04); }
        tbody td {
            padding: 1rem 1.4rem;
            font-size: .9rem;
            vertical-align: middle;
        }
        .td-nim {
            font-family: var(--font-mono);
            font-size: .8rem;
            color: var(--muted);
        }
        .td-nama { font-weight: 600; }
        .td-score {
            font-family: var(--font-mono);
            font-size: .85rem;
        }
        .td-final {
            font-family: var(--font-mono);
            font-weight: 700;
            font-size: 1rem;
            color: var(--accent2);
        }

        /* ─── Grade Badge ───────────────────────────────── */
        .grade-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border-radius: 6px;
            font-weight: 700;
            font-size: .9rem;
        }
        .grade-A { background: rgba(79,255,176,.18); color: #4fffb0; border: 1px solid rgba(79,255,176,.3); }
        .grade-B { background: rgba(91,200,255,.18); color: #5bc8ff; border: 1px solid rgba(91,200,255,.3); }
        .grade-C { background: rgba(255,196,0,.18);  color: #ffc400; border: 1px solid rgba(255,196,0,.3); }
        .grade-D { background: rgba(255,150,50,.18); color: #ff9632; border: 1px solid rgba(255,150,50,.3); }
        .grade-E { background: rgba(255,107,107,.18);color: #ff6b6b; border: 1px solid rgba(255,107,107,.3); }

        /* ─── Status Badge ──────────────────────────────── */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .3rem .75rem;
            border-radius: 2rem;
            font-family: var(--font-mono);
            font-size: .72rem;
            font-weight: 500;
            letter-spacing: .05em;
        }
        .status-lulus {
            background: rgba(79,255,176,.12);
            color: #4fffb0;
            border: 1px solid rgba(79,255,176,.25);
        }
        .status-tidak {
            background: rgba(255,107,107,.12);
            color: #ff6b6b;
            border: 1px solid rgba(255,107,107,.25);
        }
        .dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        /* ─── Footer ────────────────────────────────────── */
        footer {
            text-align: center;
            margin-top: 2.5rem;
            font-family: var(--font-mono);
            font-size: .75rem;
            color: var(--muted);
            animation: fadeUp .6s .45s ease both;
        }
        footer span { color: var(--accent); }

        /* ─── Keyframes ─────────────────────────────────── */
        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-18px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ─── Responsive ────────────────────────────────── */
        @media (max-width: 640px) {
            thead th:nth-child(3),
            thead th:nth-child(4),
            thead th:nth-child(5),
            tbody td:nth-child(3),
            tbody td:nth-child(4),
            tbody td:nth-child(5) { display: none; }
        }
    </style>
</head>
<body>

<!-- ── Header ─────────────────────────────────────────── -->
<div class="header">
    <div class="badge">&#x2F; Modul 9 &mdash; PHP</div>
    <h1>Sistem Penilaian <span>Mahasiswa</span></h1>
    <p>Bobot: Tugas 30% &bull; UTS 35% &bull; UAS 35%</p>
</div>

<!-- ── Stats ──────────────────────────────────────────── -->
<div class="stats">
    <div class="stat-card">
        <div class="stat-label">Total Mahasiswa</div>
        <div class="stat-value"><?= $jumlah_mahasiswa ?></div>
        <div class="stat-sub">terdaftar</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Rata-rata Kelas</div>
        <div class="stat-value"><?= $rata_rata_kelas ?></div>
        <div class="stat-sub">nilai akhir</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Nilai Tertinggi</div>
        <div class="stat-value"><?= $nilai_tertinggi ?></div>
        <div class="stat-sub"><?= htmlspecialchars($nama_tertinggi) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Lulus</div>
        <div class="stat-value">
            <?php
                $lulus = array_filter($mahasiswa, fn($m) => $m["status"] === "LULUS");
                echo count($lulus);
            ?>
        </div>
        <div class="stat-sub">dari <?= $jumlah_mahasiswa ?> mahasiswa</div>
    </div>
</div>

<!-- ── Table ──────────────────────────────────────────── -->
<div class="table-wrap">
    <div class="table-title">
        &#x25A3;&nbsp; <span>Data Penilaian</span> &mdash; Semester Genap 2024/2025
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama / NIM</th>
                <th>Tugas</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Nilai Akhir</th>
                <th>Grade</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($mahasiswa as $mhs):
                $is_lulus = ($mhs["status"] === "LULUS");
            ?>
            <tr>
                <td class="td-nim"><?= $no++ ?></td>
                <td>
                    <div class="td-nama"><?= htmlspecialchars($mhs["nama"]) ?></div>
                    <div class="td-nim"><?= htmlspecialchars($mhs["nim"]) ?></div>
                </td>
                <td class="td-score"><?= $mhs["nilai_tugas"] ?></td>
                <td class="td-score"><?= $mhs["nilai_uts"] ?></td>
                <td class="td-score"><?= $mhs["nilai_uas"] ?></td>
                <td class="td-final"><?= $mhs["nilai_akhir"] ?></td>
                <td>
                    <span class="grade-badge grade-<?= $mhs["grade"] ?>">
                        <?= $mhs["grade"] ?>
                    </span>
                </td>
                <td>
                    <span class="status-badge <?= $is_lulus ? 'status-lulus' : 'status-tidak' ?>">
                        <span class="dot"></span>
                        <?= $mhs["status"] ?>
                    </span>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- ── Footer ─────────────────────────────────────────── -->
<footer>
    &copy; 2025 &mdash; Tugas <span>Modul 9</span> PHP &bull; Sistem Penilaian Mahasiswa
</footer>

</body>
</html>