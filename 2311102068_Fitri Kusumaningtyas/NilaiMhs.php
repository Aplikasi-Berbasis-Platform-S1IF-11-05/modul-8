<?php
// Fitri Kusumaningtyas
// 2311102068
$mahasiswa = [
    [
        "nama"        => "Fitri Kusumaningtyas",
        "nim"         => "2311102068",
        "nilai_tugas" => 85,
        "nilai_uts"   => 78,
        "nilai_uas"   => 82,
    ],
    [
        "nama"        => "Anisah Yasaroh",
        "nim"         => "2311102063",
        "nilai_tugas" => 70,
        "nilai_uts"   => 65,
        "nilai_uas"   => 60,
    ],
    [
        "nama"        => "Trie Nabilla Farhah",
        "nim"         => "2311102071",
        "nilai_tugas" => 92,
        "nilai_uts"   => 88,
        "nilai_uas"   => 95,
    ],
    [
        "nama"        => "Dian Rahayu",
        "nim"         => "2011102008",
        "nilai_tugas" => 55,
        "nilai_uts"   => 50,
        "nilai_uas"   => 48,
    ],
    [
        "nama"        => "Anisah Syifa M.R.",
        "nim"         => "2311102080",
        "nilai_tugas" => 76,
        "nilai_uts"   => 80,
        "nilai_uas"   => 74,
    ],
];

//Menghitung nilai akhir (Bobot: Tugas 30% | UTS 35% | UAS 35%)
function hitungNilaiAkhir($tugas, $uts, $uas) {
    $nilai_akhir = ($tugas * 0.30) + ($uts * 0.35) + ($uas * 0.35);
    return round($nilai_akhir, 2);
}

//Grade
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

//Status
function tentukanStatus($nilai_akhir) {
    if ($nilai_akhir >= 60) {
        return "LULUS";
    } else {
        return "TIDAK LULUS";
    }
}

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

    //Total Nilai
    $total_nilai += $mhs["nilai_akhir"];

    //Cek Nilai Tertinggi
    if ($mhs["nilai_akhir"] > $nilai_tertinggi) {
        $nilai_tertinggi = $mhs["nilai_akhir"];
        $nama_tertinggi  = $mhs["nama"];
    }
}
unset($mhs);

$jumlah_mahasiswa = count($mahasiswa);
$rata_rata_kelas  = round($total_nilai / $jumlah_mahasiswa, 2);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap');

        :root {
            --bg:         #fff0f5;
            --surface:    #ffffff;
            --surface-2:  #fce7f0;
            --border:     #f9c6d8;
            --accent:     #e8607a;
            --accent-glow:#d4405e;
            --gold:       #e07b5a;
            --green:      #2d9e6b;
            --red:        #e05a5a;
            --text:       #4a2535;
            --muted:      #b07a8e;
            --radius:     12px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Sora', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 48px;
            animation: fadeDown .6s ease both;
        }

        .header .badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--accent), var(--accent-glow));
            color: #fff;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 4px 14px;
            border-radius: 20px;
            margin-bottom: 16px;
        }

        .header h1 {
            font-size: clamp(28px, 5vw, 46px);
            font-weight: 800;
            background: linear-gradient(135deg, #c0315a 30%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.15;
        }

        .header p {
            color: var(--muted);
            margin-top: 10px;
            font-size: 14px;
            letter-spacing: .5px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            max-width: 900px;
            margin: 0 auto 40px;
            animation: fadeUp .6s .2s ease both;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px 24px;
            position: relative;
            overflow: hidden;
            transition: transform .2s, border-color .2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            border-color: var(--accent);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent), var(--accent-glow));
            border-radius: var(--radius) var(--radius) 0 0;
        }

        .stat-label {
            font-size: 11px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 8px;
        }

        .stat-value {
            font-family: 'JetBrains Mono', monospace;
            font-size: 28px;
            font-weight: 600;
            color: var(--accent);
        }

        .stat-sub {
            font-size: 12px;
            color: var(--muted);
            margin-top: 4px;
        }

        .stat-card.gold .stat-value { color: var(--gold); }
        .stat-card.gold::before { background: linear-gradient(90deg, var(--gold), #d97706); }

        .table-wrapper {
            max-width: 1100px;
            margin: 0 auto;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            animation: fadeUp .6s .4s ease both;
        }

        .table-header-bar {
            padding: 20px 28px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-header-bar h2 {
            font-size: 16px;
            font-weight: 600;
        }

        .dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: var(--accent);
            box-shadow: 0 0 8px var(--accent);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background: var(--surface-2);
            padding: 14px 20px;
            text-align: left;
            font-size: 11px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--muted);
            font-weight: 600;
        }

        tbody tr {
            border-top: 1px solid var(--border);
            transition: background .15s;
        }

        tbody tr:hover { background: var(--surface-2); }

        tbody td {
            padding: 16px 20px;
            font-size: 14px;
        }

        .nama { font-weight: 600; }
        .nim  { font-family: 'JetBrains Mono', monospace; font-size: 12px; color: var(--muted); }

        .nilai-box {
            font-family: 'JetBrains Mono', monospace;
            font-size: 15px;
            font-weight: 600;
        }

        /* Grade badges */
        .grade {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px; height: 34px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 15px;
        }

        .grade-A { background: #d1fae5; color: #065f46; }
        .grade-B { background: #dbeafe; color: #1e40af; }
        .grade-C { background: #fef3c7; color: #92400e; }
        .grade-D { background: #ffedd5; color: #9a3412; }
        .grade-E { background: #fee2e2; color: #991b1b; }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .8px;
            text-transform: uppercase;
        }

        .status-lulus       { background: #d1fae5; color: #065f46; border: 1px solid #6ee7b7; }
        .status-tidak-lulus { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }

        .status-dot { width: 6px; height: 6px; border-radius: 50%; }
        .status-lulus       .status-dot { background: var(--green); box-shadow: 0 0 6px var(--green); }
        .status-tidak-lulus .status-dot { background: var(--red);   box-shadow: 0 0 6px var(--red);   }

        .bobot-info {
            max-width: 1100px;
            margin: 20px auto 0;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            animation: fadeUp .6s .5s ease both;
        }

        .bobot-tag {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 8px 16px;
            font-size: 12px;
            color: var(--muted);
        }

        .bobot-tag span { color: var(--accent); font-weight: 600; }

        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .top-row { border-left: 3px solid var(--gold) !important; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Sistem Penilaian Mahasiswa</h1>
        <p>Rekap nilai akhir, grade, dan status kelulusan seluruh mahasiswa</p>
    </div>

    <div class="stats">
        <div class="stat-card">
            <div class="stat-label">Total Mahasiswa</div>
            <div class="stat-value"><?= $jumlah_mahasiswa ?></div>
            <div class="stat-sub">Terdaftar</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Rata-rata Kelas</div>
            <div class="stat-value"><?= $rata_rata_kelas ?></div>
            <div class="stat-sub">Nilai Akhir</div>
        </div>
        <div class="stat-card gold">
            <div class="stat-label">Nilai Tertinggi</div>
            <div class="stat-value"><?= $nilai_tertinggi ?></div>
            <div class="stat-sub"><?= htmlspecialchars($nama_tertinggi) ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Mahasiswa Lulus</div>
            <div class="stat-value" style="color:var(--green)">
                <?= count(array_filter($mahasiswa, fn($m) => $m['status'] === 'LULUS')) ?>
            </div>
            <div class="stat-sub">dari <?= $jumlah_mahasiswa ?> mahasiswa</div>
        </div>
    </div>

    <div class="table-wrapper">
        <div class="table-header-bar">
            <div class="dot"></div>
            <h2>Data Nilai Mahasiswa</h2>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
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
                <?php foreach ($mahasiswa as $i => $mhs): ?>
                <tr <?= $mhs['nilai_akhir'] == $nilai_tertinggi ? 'class="top-row"' : '' ?>>
                    <td style="color:var(--muted); font-size:12px"><?= $i + 1 ?></td>
                    <td>
                        <div class="nama"><?= htmlspecialchars($mhs['nama']) ?></div>
                        <div class="nim"><?= htmlspecialchars($mhs['nim']) ?></div>
                    </td>
                    <td class="nilai-box"><?= $mhs['nilai_tugas'] ?></td>
                    <td class="nilai-box"><?= $mhs['nilai_uts'] ?></td>
                    <td class="nilai-box"><?= $mhs['nilai_uas'] ?></td>
                    <td class="nilai-box" style="color:var(--accent)"><?= $mhs['nilai_akhir'] ?></td>
                    <td>
                        <span class="grade grade-<?= $mhs['grade'] ?>">
                            <?= $mhs['grade'] ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($mhs['status'] === 'LULUS'): ?>
                            <span class="status status-lulus">
                                <span class="status-dot"></span>Lulus
                            </span>
                        <?php else: ?>
                            <span class="status status-tidak-lulus">
                                <span class="status-dot"></span>Tidak Lulus
                            </span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="bobot-info">
        <div class="bobot-tag">Bobot Tugas: <span>30%</span></div>
        <div class="bobot-tag">Bobot UTS: <span>35%</span></div>
        <div class="bobot-tag">Bobot UAS: <span>35%</span></div>
        <div class="bobot-tag">Lulus jika Nilai Akhir <span>&ge; 60</span></div>
        <div class="bobot-tag">A &ge; 85 &nbsp;|&nbsp; B &ge; 75 &nbsp;|&nbsp; C &ge; 65 &nbsp;|&nbsp; D &ge; 55 &nbsp;|&nbsp; E &lt; 55</div>
    </div>

</body>
</html>