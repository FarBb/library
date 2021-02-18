
<html>

<head>
  <title>ITN Malang One Book</title>
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/img/ico-title.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
</head>
<style>
	@media print {
	body * {
		visibility: hidden;
	}
	#printarea, #printarea * {
		visibility: visible;
	}
	#printarea {
		position: absolute;
		left: 0;
		top: 0;
	}
	}
</style>
<body>
<div class="col-md-5" style="border: 1px solid black; border-radius: 20px;" id="printarea">
<?php foreach ($sql1->result() as $obj1) { ?>
<table class="table table-striped" style="border-radius: 15px;">
	<tr>
		<td colspan="2">
			<img src="<?php echo base_url(); ?>assets/img/brand-2.png" width="200">
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<center><b>Kartu Anggota</b></center>
		</td>
	</tr>
	<tr>
		<td>Kode Kartu</td>
		<td><?php echo $obj1->kode_kartu ?></td>
	</tr>
	<tr>	
		<td>Kode Peminjam</td>
		<td><?php echo $obj1->kode_peminjam ?></td>
	</tr>
	<tr>	
		<td>Nama</td>
		<td><?php echo $obj1->nama ?></td>
	</tr>
	<tr>	
		<td>Berlaku s/d</td>
		<td><?php echo $obj1->tgl_akhir ?></td>
	</tr>
</table>
<?php } ?>
</div>
<script type="text/javascript">
  window.print();
  window.onfocus=function(){ window.close();}
</script>
</body>
</html>