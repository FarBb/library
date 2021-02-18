<?php 

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=peminjam-laporan.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
  	<table>
  		<thead>
        <tr>
           <td colspan="8"><center><h3>Laporan Data Peminjam</h3></center></td>
        </tr>
        <tr></tr>
        <tr>
           <td>Dibuat Tanggal</td>
           <td colspan="7">: <?php echo date('d m Y') ?></td>
        </tr>
        <tr></tr> 
        <tr>
          <th>ID Peminjam</th>
          <th>No. KTP</th>
          <th>Nama</th>
          <th>Gender</th>
          <th>Alamat</th>
          <th>No Telepon</th>
        </tr>
      </thead>
      <tbody>
          <?php foreach ($dt->result() as $obj1) { ?>
            <tr>
              <td><?php echo $obj1->kode_peminjam; ?> </td>
              <td><?php echo $obj1->ktp; ?> </td>
              <td><?php echo $obj1->nama; ?> </td>
              <td><?php echo $obj1->gender; ?> </td>
              <td><?php echo $obj1->alamat; ?> </td>
              <td><?php echo $obj1->telp; ?> </td>
            </tr>
          <?php } ?>
      </tbody>
  	</table>