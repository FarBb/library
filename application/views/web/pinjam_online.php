<?php
  $disstart = "<!--";
  $disend = "-->";
  $nama  = "";
  if($this->session->userdata('status')=='loggedin'){
    $disstart = "";
    $disend = "";
    $nama = $this->session->userdata('nama');
  } else{
    redirect(base_url());
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
                <li><a href="<?= base_url()?>web/daftar_buku">Daftar Buku</a></li>
                <?=$disstart?>
                <li  class="active"><a href="<?= base_url()?>web/pinjam_online">Pinjam Online</a></li>
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

    <div class="container marketing" style="margin-top: 20px;">
      <div class="container">
           
          <h4>Form Peminjaman Online</h4><br>
          <?php if(isset($msg)){ ?>
            <div class="alert alert-warning" role="alert">
              <p><strong>Perhatian !!</strong><br><?php echo $msg ?></p> 
            </div>
          <?php } ?>
          <form class="form-horizontal" action="<?php echo base_url() ?>web/pinjam_online_validation" 
          method="post" name="simpanform" enctype="multipart/form-data">
            <div class="form-group">
              <label for="kodekartu" class="col-sm-2 control-label">Kode Kartu</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="kodekartu" name="kodekartu" value="<?=$this->session->userdata('kdkartu')?>" radonly>
              </div>
            </div>
            <div class="form-group">
              <label for="idbuku" class="col-sm-2 control-label">ID Buku</label>
              <div class="col-sm-8 form-inline">
              <input type="text" class="form-control" id="idbuku" name="idbuku" placeholder="ID Buku" readonly>
                <button type="button" class="btn btn-default btn-tambah"  data-toggle="modal" data-target="#mpm" id="pp">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </div>
            </div>
            <div class="form-group">
              <label for="judul" class="col-sm-2 control-label">Judul</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" readonly>
              </div>
            </div>
                    
            <div class="form-group" >
              <div class="col-sm-offset-1 col-sm-10 line" style="padding: 5px 0px 0px 360px">
                <button type="submit" class="btn btn-default btn-cari" > <span class="glyphicon glyphicon-ok"></span> Simpan</button>
              </div>
            </div>
          </form>
          <hr>
          <h4>Daftar Peminjaman Online Anda</h4><br>
          
          <table class="table table-striped table-hover" id="tabel">
              <thead>
                <tr>
                  <th>Kode Kartu</th>
                  <th>Nama</th>
                  <th>Buku</th>
                  <th>Tgl. Entry</th>
                  <th>Status</th>
                  <th colspan="2">Opsi</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($sql1->result() as $obj1) { ?>
                    <tr>
                      <td><?php echo $obj1->kode_kartu; ?></td>
                      <td>
                       <?php 
                        $ptg = $obj1->kode_kartu;
                        $qry = mysqli_query($kon,"select * from kartu where kode_kartu='$ptg'");
                          while($hs = mysqli_fetch_array($qry)){
                          echo $hs['nama'];
                        }
                       ?> 
                      </td>
                      <td><?php 
                        $bk = $obj1->kode_buku;
                        $qry = mysqli_query($kon,"select * from buku where kode_buku='$bk'");
                          while($hs = mysqli_fetch_array($qry)){
                          echo $hs['judul_buku'];
                        }
                       ?> </td>
                      <td><?php echo $obj1->tgl_entry; ?> </td>
                      <td><?php echo $obj1->status; ?></td>
                      <td>
                      <a href="<?php echo base_url().'web/pjonline_hapus/'.sha1(md5($obj1->id_peminjaman_online)); ?>" class="btn btn-danger btn-sm btn-batal" onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini ??')" data-toggle="tooltip" data-placement="top" title="Hapus">
                        <span class="glyphicon glyphicon-trash"> </span>
                      </a>
                      </td>
                    </tr>
                  <?php } ?>
              </tbody>
            </table>
    
      </div><!-- /.row --> 	


      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2019 ITN Malang. &middot; <a href="#">Developed By Kelompok 20</a></p>
      </footer>

</div><!-- /.container -->


<!-- modal peminjam -->
<div class="modal fade" id="mpm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width: 80%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
          <span class="glyphicon glyphicon-search"></span> Pilih Data Peminjam
        </h4>
      </div>
      <div class="modal-body table-responsive" style=" height: 75%;">
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
                <th>Opsi</th>
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
                    <td>
                      <button type="button" class="btn btn-success btn-sm btn-cari" data-toggle="tooltip" data-placement="top" title="Pilih Data Ini" onclick="simpanform.idbuku.value = '<?php echo $obj1->kode_buku ?>';simpanform.judul.value = '<?php echo $obj1->judul_buku ?>';" data-dismiss="modal">
                        <span class="glyphicon glyphicon-ok"> </span>
                      </button>
                    </td>
                </tr>
                <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


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