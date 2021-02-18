<?php 

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=peminjaman-laporan.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
  	<table>
  		<thead>
        <tr>
           <td colspan="8"><center><h3>Laporan Data Peminjaman</h3></center></td>
        </tr>
        <tr></tr>
        <tr>
           <td>Dibuat Tanggal</td>
           <td colspan="7">: <?php echo date('d m Y') ?></td>
        </tr>
        <tr></tr> 
        <tr>
          <th>Kode Peminjaman</th>
          <th>Petugas</th>
          <th>Kode Peminjam</th>
          <th>Kode Kartu</th>
          <th>Buku</th>
          <th>Tgl. Pinjam</th>
          <th>Tgl. Kembali</th>
          <th>Status</th>
          <th>Terlambat</th>
          <th>Denda</th>
        </tr>
      </thead>
      <tbody>
          <?php foreach ($dt->result() as $obj1) { ?>
            <tr>
              <td><?php echo $obj1->kode_peminjaman; ?></td>
              <td>
                <?php 
                $ptg = $obj1->kode_petugas;
                $qry = mysqli_query($kon,"select * from petugas where kode_petugas='$ptg'");
                  while($hs = mysqli_fetch_array($qry)){
                  echo $hs['nama_petugas'];
                }
                ?> 
              </td>
              <td><?php echo $obj1->kode_peminjam; ?></td>
              <td><?php echo $obj1->kode_kartu; ?></td>
              <td><?php 
                $bk = $obj1->kode_buku;
                $qry = mysqli_query($kon,"select * from buku where kode_buku='$bk'");
                  while($hs = mysqli_fetch_array($qry)){
                  echo $hs['judul_buku'];
                }
                ?> </td>
              <td><?php echo $obj1->tgl_pinjam; ?> </td>
              <td><?php echo $obj1->tgl_kembali; ?> </td>
              <td>
              <?php 
                echo $obj1->status;
                $sta = $obj1->status;
                if($sta=='Sudah'){
                  $closeopen = '<!--';
                  $closeclose = '-->';
                  $terlambat = '0';
                } else {
                  $tgk = $obj1->tgl_kembali;
                  $tglnow = date('Y-m-d');
                  if($tglnow > $tgk){
                    $dt1 = new DateTime($tgk);
                    $dt2 = new DateTime($tglnow);
                    $tgkur = $dt2->diff($dt1);
                    $terlambat = $tgkur->days;
                  } else {
                    $terlambat = '0';
                  }
                  $closeopen = '';
                  $closeclose = '';
                }
              ?> Kembali 
              </td>
              <td>
              <?php
                
                echo $terlambat;
              ?> Hari</td>
              <td>Rp. <?php echo 5000*$terlambat; ?> ,-</td>
            </tr>
          <?php } ?>
      </tbody>
  	</table>