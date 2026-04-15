<?php

// Hitung Nilai Akhir (30% Tugas + 30% UTS + 40% UAS)
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

// Tentukan Grade
function tentukanGrade($nilai) {
    if ($nilai >= 85) return "A";
    if ($nilai >= 75) return "B";
    if ($nilai >= 65) return "C";
    if ($nilai >= 55) return "D";
    return "E";
}

// Tentukan Status Kelulusan (KKM = 65)
function tentukanStatus($nilai) {
    return $nilai >= 65 ? "Lulus" : "Tidak Lulus";
}

// Format tampilan nilai
function formatNilai($nilai) {
    return number_format($nilai, 2);
}
?>
