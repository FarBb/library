<?php 

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=kategori-laporan.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
  	<table>
  		<thead>
        <tr>
           <td colspan="8"><center><h3>Laporan Data Kategori</h3></center></td>
        </tr>
        <tr></tr>
        <tr>
           <td>Dibuat Tanggal</td>
           <td colspan="7">: <?php echo date('d m Y') ?></td>
        </tr>
        <tr></tr> 
        <tr>
          <th>ID Kategori</th>
          <th>Nama Kategori</th>
        </tr>
      </thead>
      <tbody>
          <?php foreach ($dt->result() as $obj1) { ?>
            <tr>
              <td><?php echo $obj1->kode_kategori; ?> </td>
              <td><?php echo $obj1->nama_kategori; ?> </td>
            </tr>
          <?php } ?>
      </tbody>
  	</table>