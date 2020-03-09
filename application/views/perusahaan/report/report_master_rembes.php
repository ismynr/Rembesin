
<!DOCTYPE html>
<html>
<head>
  <title><?=$title?></title>
  <style>
    body{
      font-family: Arial;
    }
  table{
      border-collapse: collapse;
      width: 100%;
      margin: 0 auto;
  }
  table th{
      /*border:1px solid #000;*/
      padding: 5px;
      font-weight: bold;
      text-align: center;
  }
  table td{
      /*border:1px solid #000;*/
      padding: 5px;
      vertical-align: top;
  }
  </style>
</head>
<body>
<p style="text-align: center">Report Rembes Perusahaan</p>
<table>
    <tr>
        <th width="3%" style="background: #5C5C5C; color: #fff">#</th>
        <th style="background: #5C5C5C; color: #fff">Nama Kegiatan</th>
        <th style="background: #5C5C5C; color: #fff">Karyawan</th>
        <th width="10%" style="background: #5C5C5C; color: #fff">Tgl Kegiatan</th>
        <th width="10%" style="background: #5C5C5C; color: #fff">Tgl Selesai</th>
        <th width="10%" style="background: #5C5C5C; color: #fff">Tgl Klaim</th>
        <th width="10%" style="background: #5C5C5C; color: #fff">Uang Dinas</th>
        <th width="10%" style="background: #5C5C5C; color: #fff">Total Rembes</th>
        <th width="10%" style="background: #5C5C5C; color: #fff">Sisa / Lebih</th>
    </tr>
    <?php $no=0;  ?>
    <?php foreach($fetch->result() as $rowData):
    $no++;
    $getSumRembes = $this->db->query('SELECT SUM(total_rembes) as total_rembes FROM tb_rembes WHERE id_master_rembes = "'.$rowData->id_master_rembes.'"')->row();
    ?>
      <tr>
          <td style="background: #9DE7FF"><?= $no;?></td>
          <td style="background: #9DE7FF"><?= $rowData->nama_kegiatan;?></td>
          <td style="background: #9DE7FF"><?= $rowData->nama_karyawan ?></td>
          <td style="background: #9DE7FF"><?= date("d, M Y", strtotime($rowData->tanggal_kegiatan))?></td>
          <td style="background: #9DE7FF"><?= date("d, M Y", strtotime($rowData->tanggal_selesai))?></td>
          <td style="background: #9DE7FF"><?= date("d, M Y", strtotime($rowData->tanggal_klaim))?></td>
          <td style="background: #9DE7FF"><?= number_format($rowData->uang_lumpsum,0,',','.') ?></td>
          <td style="background: #9DE7FF"><?= number_format($getSumRembes->total_rembes,0,',','.') ?></td>
          <td style="background: #9DE7FF"><?= number_format($rowData->uang_lumpsum - $getSumRembes->total_rembes,0,',','.') ?></td>
      </tr>
      <tr>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th style="background: #5C5C5C; color: #fff">#</th>
          <th style="background: #5C5C5C; color: #fff">Jenis Rembes</th>
          <th style="background: #5C5C5C; color: #fff">Keterangan</th>
          <th style="background: #5C5C5C; color: #fff">Tgl Rembes</th>
          <th style="background: #5C5C5C; color: #fff">Jumlah</th>
      </tr>
      <?php $noRembes=0;  ?>
      <?php $queryResult = $this->db->query("SELECT * FROM tb_rembes WHERE id_master_rembes = '".$rowData->id_master_rembes."' "); ?>
      <?php foreach($queryResult->result() as $rowDataRembes):
      $noRembes++;
      ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="background: #DEF7FF"><?= $noRembes ?></td>
            <td style="background: #DEF7FF"><?= $rowDataRembes->jenis_nota ?></td>
            <td style="background: #DEF7FF"><?= $rowDataRembes->nama_rembes ?></td>
            <td style="background: #DEF7FF"><?= date("d, M Y", strtotime($rowDataRembes->tanggal_rembes)) ?></td>
            <td style="background: #DEF7FF"><?= number_format($rowDataRembes->total_rembes,0,',','.') ?></td>
        </tr>
      <?php endforeach; ?>
      <tr>
            <td>-</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    <?php endforeach;?>

</table>
<?php $id_user = $this->session->userdata('id_user'); ?>
<?php $getPerusahaan = $this->db->query("SELECT * FROM tb_perusahaan WHERE id_user = '".$id_user."' ")->row(); ?>
<div class="footer">
    <!-- <p style="float: left;">Telah diterima oleh</p> -->
    <br><br><br>
    <div class="ttd" style="float: left;width:40%;">
    </div>
    <div class="ttd" style="float: right;">
      <b><?= $getPerusahaan->nama_perusahaan ?></b> 
    </div>
  </div><br><br>

<div class="garis-bawah" style="border-top: 1px solid #000000"></div>
  <div class="pinggir-kanan" style="float:left;padding-top:1px;">
    <small><?= TanggalIndonesia(date("Y-m-d"), 'htbt') ?></small>
  </div>
  <div class="pinggir-kanan" style="float:right;padding-top:1px;">
    <small><?= $this->config->item("SITE_NAME") ?> - rembesin.rembes@gmail.com</small>
  </div>
</body>
</html>

<?php 
function TanggalIndonesia($date, $tipe) {
    $date = date('Y-m-d',strtotime($date));
    if($date == '0000-00-00')
        return 'Tanggal Kosong';
 
    $tgl = substr($date, 8, 2);
    $bln = substr($date, 5, 2);
    $thn = substr($date, 0, 4);
 
    switch ($bln) {
        case 1 : {
                $bln = 'Januari';
            }break;
        case 2 : {
                $bln = 'Februari';
            }break;
        case 3 : {
                $bln = 'Maret';
            }break;
        case 4 : {
                $bln = 'April';
            }break;
        case 5 : {
                $bln = 'Mei';
            }break;
        case 6 : {
                $bln = "Juni";
            }break;
        case 7 : {
                $bln = 'Juli';
            }break;
        case 8 : {
                $bln = 'Agustus';
            }break;
        case 9 : {
                $bln = 'September';
            }break;
        case 10 : {
                $bln = 'Oktober';
            }break;
        case 11 : {
                $bln = 'November';
            }break;
        case 12 : {
                $bln = 'Desember';
            }break;
        default: {
                $bln = 'UnKnown';
            }break;
    }
 
    $hari = date('N', strtotime($date));
    switch ($hari) {
        case 0 : {
                $hari = 'Minggu';
            }break;
        case 1 : {
                $hari = 'Senin';
            }break;
        case 2 : {
                $hari = 'Selasa';
            }break;
        case 3 : {
                $hari = 'Rabu';
            }break;
        case 4 : {
                $hari = 'Kamis';
            }break;
        case 5 : {
                $hari = "Jum'at";
            }break;
        case 6 : {
                $hari = 'Sabtu';
            }break;
        default: {
                $hari = 'UnKnown';
            }break;
    }
  if($tipe == 'htbt'){
    $tanggalIndonesia = $hari.", ".$tgl . " " . $bln . " " . $thn;
  }elseif($tipe == 'tbt'){
    $tanggalIndonesia = $tgl . " " . $bln . " " . $thn;
  }
    return $tanggalIndonesia;
}

 ?>