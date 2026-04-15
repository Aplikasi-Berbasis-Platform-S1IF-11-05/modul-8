<?php
$mahasiswa = [
	[
		'nama' => 'Muhammad Aulia Muzzaki Nugraha',
		'nim' => '2311102051',
		'nilai_tugas' => 82,
		'nilai_uts' => 78,
		'nilai_uas' => 85,
	],
	[
		'nama' => 'Apri Pandu Wicaksono',
		'nim' => '2311102081',
		'nilai_tugas' => 90,
		'nilai_uts' => 88,
		'nilai_uas' => 92,
	],
	[
		'nama' => 'Suki Liar',
		'nim' => '2311102011',
		'nilai_tugas' => 70,
		'nilai_uts' => 74,
		'nilai_uas' => 72,
	],
	[
		'nama' => 'Perjekian',
		'nim' => '23111020001',
		'nilai_tugas' => 58,
		'nilai_uts' => 62,
		'nilai_uas' => 60,
	],
    [
		'nama' => 'Suki Damai',
		'nim' => '2411020001',
		'nilai_tugas' => 20,
		'nilai_uts' => 25,
		'nilai_uas' => 65,
	],
];

function hitungNilaiAkhir(float $nilaiTugas, float $nilaiUts, float $nilaiUas): float
{
	return ($nilaiTugas * 0.30) + ($nilaiUts * 0.30) + ($nilaiUas * 0.40);
}

function tentukanGrade(float $nilaiAkhir): string
{
	if ($nilaiAkhir >= 85) {
		return 'A';
	}

	if ($nilaiAkhir >= 70) {
		return 'B';
	}

	if ($nilaiAkhir >= 60) {
		return 'C';
	}

	if ($nilaiAkhir >= 50) {
		return 'D';
	}

	return 'E';
}

function tentukanStatus(float $nilaiAkhir): string
{
	return $nilaiAkhir >= 60 ? 'Lulus' : 'Tidak Lulus';
}

$totalNilaiAkhir = 0.0;
$nilaiTertinggi = -1.0;
$namaNilaiTertinggi = '-';
$nimNilaiTertinggi = '-';

foreach ($mahasiswa as $index => $data) {
	$nilaiAkhir = hitungNilaiAkhir(
		(float) $data['nilai_tugas'],
		(float) $data['nilai_uts'],
		(float) $data['nilai_uas']
	);

	$mahasiswa[$index]['nilai_akhir'] = $nilaiAkhir;
	$mahasiswa[$index]['grade'] = tentukanGrade($nilaiAkhir);
	$mahasiswa[$index]['status'] = tentukanStatus($nilaiAkhir);

	$totalNilaiAkhir += $nilaiAkhir;

	if ($nilaiAkhir > $nilaiTertinggi) {
		$nilaiTertinggi = $nilaiAkhir;
		$namaNilaiTertinggi = $data['nama'];
		$nimNilaiTertinggi = $data['nim'];
	}
}

$jumlahMahasiswa = count($mahasiswa);
$rataRataKelas = $jumlahMahasiswa > 0 ? $totalNilaiAkhir / $jumlahMahasiswa : 0.0;

$response = [
	'mahasiswa' => $mahasiswa,
	'ringkasan' => [
		'jumlah_mahasiswa' => $jumlahMahasiswa,
		'rata_rata_kelas' => $rataRataKelas,
		'nilai_tertinggi' => [
			'nilai' => $nilaiTertinggi,
			'nama' => $namaNilaiTertinggi,
			'nim' => $nimNilaiTertinggi,
		],
	],
];

header('Content-Type: application/json; charset=UTF-8');
echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
