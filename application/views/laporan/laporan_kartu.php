<?php 

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=kartu-laporan.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
  	<table>
  		<thead>
        <tr>
           <td colspan="8"><center><h3>Laporan Data Kartu Anggota</h3></center></td>
        </tr>
        <tr></tr>
        <tr>
           <td>Dibuat Tanggal</td>
           <td colspan="7">: <?php echo date('d m Y') ?></td>
        </tr>
        <tr></tr> 
        <tr>
          <th>Kode Kartu</th>
          <th>Kode Peminjam</th>
          <th>Nama Peminjam</th>
          <th>Tgl. Pembuatan</th>
          <th>Tgl. Akhir</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
          <?php foreach ($dt->result() as $obj1) { ?>
            <tr>
              <td><?php echo $obj1->kode_kartu; ?></td>
              <td><?php echo $obj1->kode_peminjam; ?> </td>
              <td><?php echo $obj1->nama; ?> </td>
              <td><?php echo $obj1->tgl_pembuatan; ?> </td>
              <td><?php echo $obj1->tgl_akhir; ?> </td>
              <td><?php echo $obj1->status; ?> </td>
            </tr>
          <?php } ?>
      </tbody>
  	</table>