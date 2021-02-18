<?php
  $disstart = "<!--";
  $disend = "-->";
  $nama  = "";
  if($this->session->userdata('status')=='loggedin'){
    $disstart = "";
    $disend = "";
    $nama = $this->session->userdata('nama');
  }
?>
<html>

<head>
  <title>ITN Malang One Book</title>
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/img/ico-title.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/bootstrap/css/web.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/bootstrap/css/custom.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/bootstrap/css/carousel.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/css/dataTables.bootstrap4.css" rel="stylesheet">
  
</head>

<body>


<div class="navbar-wrapper" style="margin-top:0;">

<nav class="navbar navbar-inverse navbar-static-top" style="border-radius:0; margin-bottom:0; padding-top:0;">
          <div class="container" style="margin-right: 10px; overflow-x: hidden;">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <img src="<?=base_url()?>assets/img/brand-2.png" alt="" width="140">
            </div>
            <div id="navbar" class="navbar-collapse collapse" style="border: none;">
              <ul class="nav navbar-nav">
                <li><a href="<?= base_url()?>web">Home</a></li>
                <li  class="active"><a href="<?= base_url()?>web/daftar_buku">Daftar Buku</a></li>
                <?=$disstart?>
                <li><a href="<?= base_url()?>web/pinjam_online">Pinjam Online</a></li>
                <li><a href="<?= base_url()?>web/log_out">Log Out</a></li>
                <?=$disend?>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <?=$disstart?>
                <li class="navbar-right"><a href="<?=  base_url()?>">Welcome, <?=$this->session->userdata('nama')?></a></li>
                <?=$disend?>
                <?php if(!empty($disstart)){ ?>
                <li><a href="<?= base_url()?>web/login">Log In</a></li>
                <li><a href="<?= base_url()?>app/login_admin">Admin Log In</a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </nav>
   
</div>

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing" style="margin-top: 20px;">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <h2>Buku Terpopuler</h2>
        <hr>
      </div>
      <div class="row">
      <?php foreach ($sql1->result() as $obj1) { ?>  
        <div class="col-lg-4">
          <img class="img-circle" src="<?=base_url()?>assets/img/ico-title.png" alt="" width="140" height="140">
          <h2><?=$obj1->judul_buku?></h2>
          <p><?=$obj1->diskripsi?></p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      <?php } ?>
      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

    <div class="table-responsive">

  	<table class="table table-striped table-hover" id="tabel">
  		<thead>
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
            <?php 
            $kon = mysqli_connect("localhost","root","","library");
            foreach ($sql2->result() as $obj1) { ?>
            <tr>
                <td><?php echo $obj1->kode_buku; ?> </td>
                <td>
                <?php 
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

  </div>

      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2019 ITN Malang. &middot; <a href="#">Developed By Kelompok 20</a></p>
      </footer>

    </div><!-- /.container -->

<script src="<?php echo base_url(); ?>assets/bootstrap/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/bootstrap/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/bootstrap/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function () {
    $('#tabel').DataTable();
});
</script>
</body>
</html>