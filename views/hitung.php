<?php
require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Perhitungan";
$_SESSION["page-url"] = "hitung";
// Mendapatkan data mahasiswa dari tabel "mahasiswa"
$sql = "SELECT * FROM mahasiswa";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $idMahasiswa = $row['id_mahasiswa'];
        $nim = $row['nim'];
        $namaMahasiswa = $row['nama_mahasiswa'];
        $prodi = $row['prodi'];

        // Mengambil nilai IPK, absensi, dan keaktifan dari tabel "sub_kriteria"
        $sqlSubKriteria = "SELECT * FROM sub_kriteria";
        $resultSubKriteria = mysqli_query($conn, $sqlSubKriteria);

        $ipk = '';
        $absensi = '';
        $keaktifan = '';

        while ($rowSubKriteria = mysqli_fetch_assoc($resultSubKriteria)) {
            if ($rowSubKriteria['id_kriteria'] == 1) {
                if ($rowSubKriteria['sub_kriteria'] == 'sedang') {
                    $ipk = $rowSubKriteria['nilai_sub'];
                } elseif ($rowSubKriteria['sub_kriteria'] == 'tinggi') {
                    $ipk = $rowSubKriteria['nilai_sub'];
                }
            } elseif ($rowSubKriteria['id_kriteria'] == 2) {
                if ($rowSubKriteria['sub_kriteria'] == 'rendah') {
                    $absensi = $rowSubKriteria['nilai_sub'];
                } elseif ($rowSubKriteria['sub_kriteria'] == 'sedang') {
                    $absensi = $rowSubKriteria['nilai_sub'];
                } elseif ($rowSubKriteria['sub_kriteria'] == 'tinggi') {
                    $absensi = $rowSubKriteria['nilai_sub'];
                }
            } elseif ($rowSubKriteria['id_kriteria'] == 3) {
                if ($rowSubKriteria['sub_kriteria'] == 'rendah') {
                    $keaktifan = $rowSubKriteria['nilai_sub'];
                } elseif ($rowSubKriteria['sub_kriteria'] == 'sedang') {
                    $keaktifan = $rowSubKriteria['nilai_sub'];
                } elseif ($rowSubKriteria['sub_kriteria'] == 'tinggi') {
                    $keaktifan = $rowSubKriteria['nilai_sub'];
                }
            }
        }

        // Menghitung bobot keputusan menggunakan metode Tsukamoto
        $bobotRendah = min($ipk, $absensi, $keaktifan);
        $bobotSedang = min($ipk, $absensi, $keaktifan);
        $bobotTinggi = min($ipk, $absensi, $keaktifan);

        // Defuzzifikasi menggunakan metode rata-rata tertimbang
        $hasilAkhir = (($bobotRendah * 40) + ($bobotSedang * 70) + ($bobotTinggi * 100)) / ($bobotRendah + $bobotSedang + $bobotTinggi);

        // Menyimpan hasil akhir ke dalam database atau melakukan tindakan sesuai kebutuhan Anda
        $sqlSimpanHasil = "INSERT INTO hasil_spk (id_mahasiswa, hasil_spk) VALUES ('$idMahasiswa', '$hasilAkhir')";
        mysqli_query($conn, $sqlSimpanHasil);
    }
} else {
    echo "Tidak ada data mahasiswa.";
}

?>
