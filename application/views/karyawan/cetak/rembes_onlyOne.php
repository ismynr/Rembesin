<!DOCTYPE html>
<html>

<?php 
$queryMR = $this->db->query("SELECT * FROM tb_master_rembes WHERE id_master_rembes='$id'")->row();
$getKaryawan = $this->db->query("SELECT * FROM tb_karyawan WHERE id_karyawan = '$queryMR->id_karyawan'")->row();
$getPerusahaan = $this->db->query("SELECT * FROM tb_perusahaan WHERE id_perusahaan = '$getKaryawan->id_perusahaan'")->row();
$getAllR = $this->db->get_where('tb_rembes', ['id_master_rembes'=>$queryMR->id_master_rembes]);
$getSUMR = $this->db->query("SELECT SUM(total_rembes) as total_rembes FROM tb_rembes WHERE id_master_rembes='".$queryMR->id_master_rembes."'")->row();
$getAllRCount = $this->db->get_where('tb_rembes', ['id_master_rembes'=>$queryMR->id_master_rembes])->num_rows();

 ?>

<head>
  <title>Cetak Kuitansi Rembes</title>
  <style>
  	.clearfix:after {
	  content: "";
	  display: table;
	  clear: both;
	}

	body {
	  position: relative;
	  width: 19cm;  
	  height: 29.7cm; 
	  margin: 0 auto;
	  font-size: 13px;
	}
	*{
	  font-family: Verdana, Arial, sans-serif !important;
	}
	table{
	    font-size: 12px;
	}
	tfoot tr td{
	    font-weight: bold;
	    font-size: 12px;
	}
	.gray {
	    background-color: #83E1FF !important;
	}
  </style>

</head>

<body>
	<div class="kotak-header" style="margin-bottom: 0px">
		<div class="kotak-kiri" style="float: left">
			<img src=".\assets\img\web_config\<?= $this->config->item('LOGO') ?>" alt="" width="120"/>
		</div>
		<div class="kotak-kanan"style="margin-left: 20px; width:100%;">
			<h2>Kwitansi Rembesin <br><div class="garis" style="border-top: 1px solid #000000;margin-top: 5px;margin-left: 110px"></div></h2>
			<p>Sebagai bukti pembayaran perusahaan rembesin kegiatan</p>
			<p style="width:60%;">Dari <br>
				Perusahaan <b><?= $getPerusahaan->nama_perusahaan ?></b> <br>
				<?= $getPerusahaan->alamat_perusahaan ?><br>
				Telp. <?= $getPerusahaan->no_telepon ?><br>
				Mail. <?= $getPerusahaan->email_perusahaan ?>
			</p>
		</div>
	</div>
	<div class="wrapper" >
      <div class="wrapper-kiri">
      	<table width="100%">
			<tr>
				<td width="20%%" class="gray" style="padding:3px;vertical-align: top">Kegiatan </td>
				<td width="50%" style="padding:3px;background: #C9F2FF; vertical-align: top"><?= $queryMR->nama_kegiatan ?></td>
			</tr>
			<tr>
				<td class="gray"  style="padding:3px;vertical-align: top">Karyawan</td>
				<td style="padding:3px;background: #C9F2FF; vertical-align: top"><?= $getKaryawan->nama_karyawan ?></td>
			</tr>
			<tr>
				<td class="gray" style="padding:3px;vertical-align: top">Uang Dinas</td>
				<td style="padding:3px;background: #C9F2FF; vertical-align: top"><?= number_format($queryMR->uang_lumpsum,0,',','.') ?></td>
			</tr>
			<tr>
				<td class="gray" style="padding:3px;vertical-align: top">Tanggal Kegiatan</td>
				<td style="padding:3px;background: #C9F2FF; vertical-align: top"><?= TanggalIndonesia($queryMR->tanggal_kegiatan, 'tbt') ?></td>
			</tr>
			<tr>
				<td class="gray" style="padding:3px;vertical-align: top">Tanggal Selesai</td>
				<td style="padding:3px;background: #C9F2FF; vertical-align: top"><?= TanggalIndonesia($queryMR->tanggal_selesai, 'tbt') ?></td>
			</tr>
		  </table>
      </div>
	  <table width="100%">
	    <thead class="gray">
	      <tr>
	        <th style="padding:5px 2px 5px 2px">#</th>
	        <th style="padding:5px 2px 5px 2px">Jenis Nota</th>
	        <th style="padding:5px 2px 5px 2px">Keterangan</th>
	        <th style="padding:5px 2px 5px 2px">Tanggal</th>
	        <th style="padding:5px 2px 5px 2px;text-align: right;">Jumlah</th>
	      </tr>
	    </thead>
	    <tbody>
	      <?php $no = 1; ?>
	      <?php foreach($getAllR->result() as $row): ?>
	      <tr>
	      	<td style="padding:10px 2px 10px 2px"><?= $no ?></td>
	      	<td style="padding:10px 2px 10px 2px"><?= $row->jenis_nota ?></td>
	        <td style="padding:10px 2px 10px 2px"><?= $row->nama_rembes ?></td>
	        <td style="padding:10px 2px 10px 2px"><?= TanggalIndonesia($row->tanggal_rembes, 'tbt') ?></td>
	        <td style="padding:10px 2px 10px 2px;text-align: right;"><?= number_format($row->total_rembes,0,',','.') ?></td>
	      </tr>
	      <?php $no++ ?>
	      <?php endforeach; ?>
	    </tbody>
	    <tfoot>
	        <tr>
	            <td colspan="3" style="padding:5px 2px 5px 2px"; ></td>
	            <td align="right" style="padding:5px 2px 5px 2px"; >SubTotal Rp.</td>
	            <td align="right" style="padding:5px 2px 5px 2px"; class="gray"><?= number_format($getSUMR->total_rembes,0,',','.') ?></td>
	        </tr>
	        <tr>
	            <td colspan="3" style="padding:5px 2px 5px 2px"></td>
	            <td align="right" style="padding:5px 2px 5px 2px">Uang Dinas Rp.</td>
	            <td align="right" style="padding:5px 2px 5px 2px"><?= number_format($queryMR->uang_lumpsum,0,',','.') ?></td>
	        </tr>
	        <tr>
	            <td colspan="3" style="padding:5px 2px 5px 2px"></td>
	            <td align="right" style="padding:5px 2px 5px 2px"><?= $queryMR->uang_lumpsum - $getSUMR->total_rembes < $getSUMR->total_rembes ? "Total Dana Kurang":"Total Dana Lebih" ?> Rp.</td>
	            <td align="right" style="padding:5px 2px 5px 2px" class="gray"><?= number_format($queryMR->uang_lumpsum - $getSUMR->total_rembes,0,',','.') < $getSUMR->total_rembes ? '+'.number_format($queryMR->uang_lumpsum - $getSUMR->total_rembes,0,',','.') : number_format($queryMR->uang_lumpsum - $getSUMR->total_rembes,0,',','.') ?></td>
	        </tr>
	    </tfoot>
	  </table>
	</div>
	<div class="catatan">
		<p>Catatan <br>
			1. Kwitansi ini diserahkan pada pihak perusahaan untuk diklaim sebagai bukti rembes perusahaan<br>
			2. Telah disahkan oleh pihak perusahaan
		</p>
	</div>
	<div class="footer">
		<p style="float: left;">Telah diterima oleh</p>
		<br><br><br><br><br><br>
		<div class="ttd" style="float: left;width:40%;">
			<b><?= $getKaryawan->nama_karyawan ?></b> 
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