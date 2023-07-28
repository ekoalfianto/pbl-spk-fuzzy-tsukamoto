<?php require_once("../controller/script.php");
require_once __DIR__ . '/../assets/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$mpdf->SetTitle("Laporan Penerima Beasiswa Program Studi Rekayasa Keamanan Siber");
$mpdf->WriteHTML('<div style="border-bottom: 3px solid black;width: 100%;">
  <table border="0" style="width: 100%;">
    <tbody>
      <tr>
        <th style="text-align: center;">
          <img src="../assets/images/logo-kiri.png" alt="" style="width: 100px;height: 100px;">
        </th>
        <td style="text-align: center;">
          <h3>POLITEKNIK BHAKTI SEMESTA</h3>
          <p style="font-size: 14px;">Jl. Argoluwih No. 15, Kel.Ledok, Kec.Argomulyo, Kota Salatiga, Jawa Tengah 50732</p>
        </td>
        <th style="text-align: center;">
          <img src="../assets/images/logo-kanan.png" alt="" style="width: 100px;height: 100px;">
        </th>
      </tr>
    </tbody>
  </table>
</div>');
// Output the first table for Prodi A
$tableA = '<div style="text-align: center; margin: auto;">
  <h4 style="margin-top: 50px;text-align: center;margin-bottom: -20px;">Laporan Penerima Beasiswa Prodi RKS 2021/2022</h4>
  <div style="width: 210px;border-bottom: 1px solid black;margin: auto;"></div>
  <table class="table table-striped table-hover table-borderless table-sm display" id="datatable_prodi_a" border="1">
    <thead>
      <tr>
        <th scope="col" class="text-center">#Rank</th>
        <th scope="col" class="text-center">NIM</th>
        <th scope="col" class="text-center">Nama mahasiswa</th>
        <th scope="col" class="text-center">Angkatan</th>
        <th scope="col" class="text-center">Nilai Penerima</th>
      </tr>
    </thead>
    <tbody>';

if (mysqli_num_rows($daftarPenerima) > 0) {
    $no = 1;
    while ($row = mysqli_fetch_assoc($daftarPenerima)) {
        if ($row["prodi"] == "RKS 2021/2022") {
            $tableA .= '<tr>
                <th scope="row" class="text-center">' . $no . '</th>
                <td class="text-center">' . $row["nim"] . '</td>
                <td>' . $row["nama_mahasiswa"] . '</td>
                <td class="text-center">' . $row["prodi"] . '</td>
                <td class="text-center">' . $row["nilai_total"] . '</td>
              </tr>';
            $no++;
        }
    }
}

$tableA .= '</tbody></table></div>';

$mpdf->WriteHTML($tableA);

// Output the second table for Prodi B

$tableB = '<div style="text-align: center; margin: auto;">
  <h4 style="margin-top: 50px;text-align: center;margin-bottom: -20px;">Laporan Penerima Beasiswa Prodi RKS 2022/2023</h4>
  <div style="width: 210px;border-bottom: 1px solid black;margin: auto;"></div>
  <table class="table table-striped table-hover table-borderless table-sm display" id="datatable_prodi_b" border="1">
    <thead>
      <tr>
        <th scope="col" class="text-center">#Rank</th>
        <th scope="col" class="text-center">NIM</th>
        <th scope="col" class="text-center">Nama mahasiswa</th>
        <th scope="col" class="text-center">Angkatan</th>
        <th scope="col" class="text-center">Nilai Penerima</th>
      </tr>
    </thead>
    <tbody>';

if (mysqli_num_rows($daftarPenerima) > 0) {
    $no = 1;
    mysqli_data_seek($daftarPenerima, 0); // Reset the pointer to the beginning of the data
    while ($row = mysqli_fetch_assoc($daftarPenerima)) {
        if ($row["prodi"] == "RKS 2022/2023") {
            $tableB .= '<tr>
                <th scope="row" class="text-center">' . $no . '</th>
                <td class="text-center">' . $row["nim"] . '</td>
                <td>' . $row["nama_mahasiswa"] . '</td>
                <td class="text-center">' . $row["prodi"] . '</td>
                <td class="text-center">' . $row["nilai_total"] . '</td>
              </tr>';
            $no++;
        }
    }
}

$tableB .= '</tbody></table></div>';

$mpdf->WriteHTML($tableB);

// $mpdf->Output();
$mpdf->OutputHttpDownload('Laporan-Penerima-Beasiswa-Program-Studi-Rekayasa-Keamanan-Siber-' . date("Y-m-d") . '.pdf');
header("Location: perhitungan");
exit;
