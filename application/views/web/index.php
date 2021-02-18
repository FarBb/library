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
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/jquery.js"></script>
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
<!-- modal logout -->
<div class="modal fade" id="logoutmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
          <span  class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;Konfirmasi
        </h4>
      </div>
      <div class="modal-body">
        Anda Yakin ingin Logout ?
      </div>
      <div class="modal-footer">
        <div class="button-group" role="group">
          <a role="button" class="btn btn-default btn-tambah" data-dismiss="modal">Tidak</button>
          <a role="button" class="btn btn-default btn-cari" href="<?php echo base_url() ?>web/log_out">Ya</a>
        </div>
      </div>
    </div>
  </div>
</div>

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
                <li class="active"><a href="<?= base_url()?>web">Home</a></li>
                <li><a href="<?= base_url()?>web/daftar_buku">Daftar Buku</a></li>
                <?=$disstart?>
                <li><a href="<?= base_url()?>web/pinjam_online">Pinjam Online</a></li>
                <li>
                    <a data-toggle="modal" data-target="#logoutmodal" href="" >Log Out</a>
                </li>
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


    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide" src="<?=base_url()?>assets/img/car1.png" alt="First slide">
        </div>
        <div class="item">
          <img class="second-slide" src="<?=base_url()?>assets/img/car2.png" alt="Second slide">
        </div>
        <div class="item">
          <img class="third-slide" src="<?=base_url()?>assets/img/car3.png" alt="Third slide">
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
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
        </div>
      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->
      <hr class="featurette-divider">
      <!-- /END THE FEATURETTES -->

      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2019 ITN Malang. &middot; <a href="#">Developed By Kelompok 20</a></p>
      </footer>

    </div><!-- /.container -->


<script>
$(function (){
  $('[data-toggle="tooltip"]').tooltip()
  })
</script>
</body>
</html>