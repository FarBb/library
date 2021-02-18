<?php 

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=buku-laporan.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
  	<table>
  		<thead>
        <tr>
           <td colspan="8"><center><h3>Laporan Data Buku</h3></center></td>
        </tr>
        <tr></tr>
        <tr>
           <td>Dibuat Tanggal</td>
           <td colspan="7">: <?php echo date('d m Y') ?></td>
        </tr>
        <tr></tr> 
        <tr>
         <th>ID Buku</th>
         <th>Kategori</th>
         <th>Penerbit</th>
         <th>Judul</th>
         <th>Stok</th>
         <th>Deskripsi</th>
         <th>Pengarang</th>
         <th>Th.Terbit</th>
        </tr>
      </thead>
      <tbody>
         <?php foreach ($dt->result() as $obj1) { ?>
            <tr>
               <td><?php echo $obj1->kode_buku; ?> </td>
               <td>
               <?php
                  $kon = mysqli_connect('localhost','root','','library'); 
                  $ktg = $obj1->kode_kategori; 
                  $qry = mysqli_query($kon,"select * from kategori where kode_kategori='$ktg'");
                  while($hs = mysqli_fetch_array($qry)){
                  echo $hs['nama_kategori'];
                  }
               ?>    
               </td>
               <td>
               <?php 
                  $pnb = $obj1->kode_penerbit; 
                  $qry2 = mysqli_query($kon,"select * from penerbit where kode_penerbit='$pnb'");
                  while($hs2 = mysqli_fetch_array($qry2)){
                  echo $hs2['nama_penerbit'];
                  }
               ?> 
               </td>
               <td><?php echo $obj1->judul_buku; ?> </td>
               <td><?php echo $obj1->jumlah_buku; ?> </td>
               <td><?php echo $obj1->diskripsi; ?> </td>
               <td><?php echo $obj1->pengarang; ?> </td>
               <td><?php echo $obj1->tahun_terbit; ?> </td>
               
            </tr>
         <?php } ?>
      </tbody>
  	</table>