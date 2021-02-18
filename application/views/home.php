<?php
  if($this->session->userdata('status') == 'loggedin'){
  
    $user = $this->session->userdata('username');
    $level = $this->session->userdata('level');
    $upic = $this->session->userdata('userpic');

    if(empty($upic)){
      $upic="default.png";
    }

    if ($level=="User"){ 
      $dis = "<!--"; 
      $adis = "--!>"; 
    } else { 
      $dis = ""; 
      $adis = ""; 
    }

  } else {
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
  <link href="<?php echo base_url(); ?>assets/bootstrap/css/dashboard.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/bootstrap/css/custom.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/jquery.js"></script>
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>

 <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">

          <div class="brand">
            <a href="<?php echo base_url() ?>app/home">
                <img src="<?php echo base_url().'assets/img/brand-2.png';?>" class="img-responsive" alt="SKEYS">
            </a>
          </div>

          <div class="profilewrapper">
            <center>
            <div class="upic">
              <img src="<?php echo base_url().'assets/imgpath/'. $upic; ?>" class="img-responsive uimg">
            </div>
            </center>
            <div class="profile_info">
                <center>Welcome, <?php echo $user; ?></center>
            </div>
          </div>

          <ul class="nav nav-sidebar">
            <li class="active"><a href="<?php echo base_url() ?>app/home"><span class="glyphicon glyphicon-home"> </span> Dashboard</a></li>
          </ul>
          <ul class="nav nav-sidebar" style="margin-bottom:50px;">
            <li><a href="<?php echo base_url() ?>app/petugas"><span class="glyphicon glyphicon-user"></span> Petugas</a></li>
            <?php echo $dis ?><li><a href="<?php echo base_url() ?>app/user"><span class="glyphicon glyphicon-user"></span> User</a></li><?php echo $adis ?>
            <li><a href="<?php echo base_url() ?>app/buku"><span class="glyphicon glyphicon-book"> </span> Buku</a></li>
            <li><a href="<?php echo base_url() ?>app/kategori"><span class="glyphicon glyphicon-list"> </span> Kategori </a></li>
            <li><a href="<?php echo base_url() ?>app/penerbit"><span class="glyphicon glyphicon-tags"> </span> Penerbit</a></li>
            <li><a href="<?php echo base_url() ?>app/peminjam"><span class="glyphicon glyphicon-user"> </span> Peminjam</a></li>
            <li><a href="<?php echo base_url() ?>app/kartu"><span class="glyphicon glyphicon-credit-card"> </span> Kartu Anggota</a></li>
            <li><a href="<?php echo base_url() ?>app/peminjaman"><span class="glyphicon glyphicon-shopping-cart"> </span> Peminjaman</a></li>
            <li><a href="<?php echo base_url() ?>app/peminjaman_online"><span class="glyphicon glyphicon-shopping-cart"> </span> Peminjaman Online</a></li>
            <li><a href="<?php echo base_url() ?>app/laporan"><span class="glyphicon glyphicon-list-alt"> </span> Laporan</a></li>
          </ul>
          <div class="sidebar-footer col-sm-3 col-md-2">
              <a data-toggle="tooltip" data-placement="top" title="Help & Info" 
              href="<?php echo base_url() ?>app/help">
                <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Manage Profile" 
              href="<?php echo base_url().'app/manageprofile/'.sha1(md5($user)); ?>">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Fullscreen Mode" id="tfs">
                <span  class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <span data-toggle="modal" data-target="#logoutmodal">
                <a data-toggle="tooltip" data-placement="top" title="Logout">
                  <span  class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                </a>
              </span>
          </div>
         
        </div>
        
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="sub-header page-header"><span class="glyphicon glyphicon-home"> </span> Dashboard</h1>

        <div class="placeholders" >
          <a href="<?php echo base_url() ?>app/buku" style="width: 30%;">
          <span  class="glyphicon glyphicon-book" aria-hidden="true"></span>&nbsp;
          Data Buku
          </a>
        </div>

        <div class="placeholders">
          <a href="<?php echo base_url() ?>app/petugas" style="width: 15%;">
          <span  class="glyphicon glyphicon-user" aria-hidden="true" style="font-size: 26px;"></span>
          Petugas
          </a>
        </div>

        <div class="placeholders">
          <a href="<?php echo base_url() ?>app/penerbit" style="width: 23.5%;">
          <span  class="glyphicon glyphicon-tags" aria-hidden="true"></span>&nbsp;
          Penerbit
          </a>
        </div>
        <?=$dis?>
        <div class="placeholders">
          <a href="<?php echo base_url() ?>app/user" style="width: 23.5%;">
          <span  class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;
          User
          </a>
        </div>
        <?=$adis?>

        <div class="placeholders">
          <a href="<?php echo base_url() ?>app/kategori" style="width: 15%; font-size: 26px;">
          <span  class="glyphicon glyphicon-list" aria-hidden="true"></span>
          Kategori
          </a>
        </div>

        <div class="placeholders">
          <a href="<?php echo base_url() ?>app/kartu" style="width: 30%;">
          <span  class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>&nbsp;
          Kartu Anggota
          </a>
        </div>

        <div class="placeholders">
          <a href="<?php echo base_url() ?>app/peminjam" style="width: 15.4%; font-size: 26px;">
          <span  class="glyphicon glyphicon-user" aria-hidden="true"></span>
          Peminjam
          </a>
        </div>

        <div class="placeholders">
          <a href="<?php echo base_url() ?>app/laporan" style="width: 15.5%; font-size: 26px;">
          <span  class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
          Laporan
          </a>
        </div>

        <div class="placeholders">
          <a href="<?php echo base_url() ?>app/dbmanage" style="width: 15.4%; font-size: 26px;">
          <span  class="glyphicon glyphicon-compressed" aria-hidden="true"></span>
          DB
          </a>
        </div>

        <div class="placeholders">
          <a href="<?php echo base_url() ?>app/help" style="width: 22.5%;">
          <span  class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
          Help/Info
          </a>
        </div>

        <div class="placeholders">
          <a href="<?php echo base_url().'app/manageprofile/'.sha1(md5($user)); ?>" style="width: 22.5%;">
          <span  class="glyphicon glyphicon-cog" aria-hidden="true"></span>
          MyProfile
          </a>
        </div>

        <div class="placeholders">
          <a href="<?php echo base_url() ?>app/peminjaman" style="width: 47.5%;">
          <span  class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>&nbsp;Peminjaman
          </a>
        </div>

      </div>


      </div>
</div>

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
        <button type="button" class="btn btn-default btn-tambah" data-dismiss="modal">Tidak</button>
        <a href="<?php echo base_url() ?>app/log_out">
          <button type="button" class="btn btn-default btn-cari" >Ya</button>
        </a>
      </div>
    </div>
  </div>
</div>

<script>
  $(function () { $('[data-toggle="tooltip"]').tooltip() });


  function requestFullScreen(){
    var el = document.documentElement;
    var requsetMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || ms.RequestFullScreen;

    if(requsetMethod){
      requsetMethod.call(el);
    } else if(typeof window.ActiveXObject !== "undefined"){
      var wscript = new ActiveXObject("wscript.shell");

      if(wscript!==null){
        wscript.SendKeys("{F11}");
      }
    }

  }

  if (
    document.fullscreenEnabled || 
    document.webkitFullscreenEnabled || 
    document.mozFullScreenEnabled ||
    document.msFullscreenEnabled
) {

    var i = document.getElementById("tfs");
    var el = document.documentElement;

    i.onclick = function() {

        //* in full-screen?
        if (
            document.fullscreenElement ||
            document.webkitFullscreenElement ||
            document.mozFullScreenElement ||
            document.msFullscreenElement
        ) {

            // exit full-screen
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }

        }
        else {

            // go full-screen
            if (i.requestFullscreen) {
                el.requestFullscreen();
            } else if (i.webkitRequestFullscreen) {
                el.webkitRequestFullscreen();
            } else if (i.mozRequestFullScreen) {
                el.mozRequestFullScreen();
            } else if (i.msRequestFullscreen) {
                el.msRequestFullscreen();
            }

        }

    } 

} 


</script>
</body>
</html>
