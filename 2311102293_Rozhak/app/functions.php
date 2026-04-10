<?php

/**
 * Menghitung nilai akhir mahasiswa berdasarkan pembobotan nilai.
 *
 * Bobot penilaian:
 *   - Tugas: 30%
 *   - UTS  : 30%
 *   - UAS  : 40%
 *
 * @param float $tugas Nilai tugas mahasiswa
 * @param float $uts   Nilai UTS mahasiswa
 * @param float $uas   Nilai UAS mahasiswa
 * @return float Nilai akhir setelah pembobotan
 */
function hitungNilaiAkhir(float $tugas, float $uts, float $uas): float {
    $bobotTugas = $tugas * 0.30;
    $bobotUts = $uts * 0.30;
    $bobotUas = $uas * 0.40;

    return $bobotTugas + $bobotUts + $bobotUas;
}

/**
 * Menentukan grade huruf berdasarkan nilai akhir mahasiswa.
 *
 * Skala grade:
 *   - A : >= 85
 *   - B : >= 70
 *   - C : >= 60
 *   - D : >= 50
 *   - E : <  50
 *
 * @param float $nilaiAkhir Nilai akhir mahasiswa
 * @return string Grade huruf (A/B/C/D/E)
 */
function tentukanGrade(float $nilaiAkhir): string {
    if ($nilaiAkhir >= 85) {
        return 'A';
    } elseif ($nilaiAkhir >= 70) {
        return 'B';
    } elseif ($nilaiAkhir >= 60) {
        return 'C';
    } elseif ($nilaiAkhir >= 50) {
        return 'D';
    } else {
        return 'E';
    }
}

/**
 * Menentukan status kelulusan mahasiswa berdasarkan nilai akhir.
 *
 * Syarat kelulusan: nilai akhir minimal 60.
 *
 * @param float $nilaiAkhir Nilai akhir mahasiswa
 * @return string Status kelulusan ('Lulus' atau 'Tidak Lulus')
 */
function tentukanStatus(float $nilaiAkhir): string {
    return ($nilaiAkhir >= 60) ? 'Lulus' : 'Tidak Lulus';
}