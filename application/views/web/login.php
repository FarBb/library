<?php
    if ($this->session->userdata('msg')!=""){ ?>
      <script>
      alert("Username atau Password salah !");
      document.getElementById("username").focus();
      </script><?php
      $this->session->set_userdata('msg','');
      $this->session->unset_userdata('msg');
    } else {
      $this->session->set_userdata('msg','');
      $this->session->unset_userdata('msg');
    }
    $this->session->sess_destroy(); 
?>
<html>

<head>
  <title>ITN Malang One Book</title>
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/img/ico-title.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/bootstrap/css/dashboard.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/bootstrap/css/custom.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/jquery.js"></script>
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
</head>

<body class="login" style="background: url('<?php echo base_url(); ?>assets/img/irongrip.png') repeat #444;">

  <div class="form-signin">
    <div class="text-center">
        <img src="<?php echo base_url(); ?>assets/img/team.png" alt="Skensa Library">
    </div>
    <div class="text-center t">
        Member Login
    </div>
    <!-- alert messages -->
  <div class='alert alert-danger' role='alert' id='alertuname' style="display: none">
    <strong>Warning!</strong> Kode Kartu Belum Diisi
  </div>
  <div class='alert alert-danger' role='alert' id='alertpass' style="display: none">
    <strong>Warning!</strong> Password Belum Diisi
  </div>
    <div class="tab-content">
        <div>
            <form action="<?php echo base_url() ?>index.php/web/validate_login" method="post" name="formlogin">
                <p class="text-muted text-center" id="pandu"  style="margin-bottom: 5px;">
                    Enter your card code and password
                </p>
                <input type="text" placeholder="Kode Kartu" class="form-control top" name="kodekartu" autocomplete="off" required>
                <input type="password" placeholder="Password" class="form-control bottom" name="password" required>
                <button type="submit" class="btn btn-lg btn-default btn-block btn-login" name="login" >Sign in</button>
                <a role="button" href="<?=base_url()?>web" class="btn btn-sm btn-default btn-block">Home</a>
            </form>
        </div>
    </div>
    <hr style="margin-bottom: 5px;">
    <div class="text-muted text-center" style="margin-bottom: -10px; padding: 0;">
        &copy;2017 Skeys
    </div>
  </div>
  
</body> 

</html>