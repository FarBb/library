<?php 

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=petugas-laporan.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<table>
  		<thead>
        <tr>
           <td colspan="8"><center><h3>Laporan Data Petugas</h3></center></td>
        </tr>
        <tr></tr>
        <tr>
           <td>Dibuat Tanggal</td>
           <td colspan="7">: <?php echo date('d m Y') ?></td>
        </tr>
        <tr></tr> 
        <tr>
			<th>ID Petugas</th>
			<th>Nama</th>
			<th>Gender</th>
			<th>Alamat</th>
			<th>No Telepon</th>
			<th>Foto</th>
		</tr>
		</thead>
		<tbody>
			<?php foreach ($dt->result() as $obj1) { ?>
			<tr>
				<td><?php echo $obj1->kode_petugas; ?> </td>
				<td><?php echo $obj1->nama_petugas; ?> </td>
				<td><?php echo $obj1->gender; ?> </td>
				<td><?php echo $obj1->alamat; ?> </td>
				<td><?php echo $obj1->no_telepon; ?> </td>
				<td>
				<?php
				if($obj1->userpic == ''){ ?>
					<img width="50px" height="50px" src="<?php echo base_url().'assets/imgpath/default.png'; ?>">
				<?php
				} else { ?>
					<img width="50px" height="50px" src="<?php echo base_url().'assets/imgpath/'.$obj1->userpic; ?>">
				<?php
				} ?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
</table>