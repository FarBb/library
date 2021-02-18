<?php 
  
  $kon = mysqli_connect('localhost','root','','library');
  $idpetugas = "";
  $username = "";
  $password = "";
  $level = "";
  $admin = "";
  $user = "";
  $readonly = "";

if($op=="edit"){
    foreach ($sql->result() as $obj1) { 
      $op = "edit";                 
      $idpetugas = $obj1->kode_petugas; 
      $username = $obj1->username;
      $password = $obj1->password;
      $level = $obj1->level; 
      if($level=="Admin"){
        $admin = "checked";
        $user = "";
      } else {
        $admin = "";
        $user = "checked";
      }
      $readonly = "readonly";
    }
    
} else {
    
}



?>


<form class="form-horizontal" action="<?php echo base_url() ?>app/u_simpan" 
        method="post" name="simpanform" onsubmit="return validasi_input()" enctype="multipart/form-data">
  <div class="form-group">
    <label for="idpetugas" class="col-sm-2 control-label">ID Petugas</label>
    <div class="col-sm-2">
      <input type="hidden" name="op" id="op" value="<?php echo $op ?>">
      <!-- PENGATURAN SELECT PETUGAS (BEGIN) -->     
       <?php
        
        if($op=="edit"){

          $hspet = mysqli_query($kon,"select * from petugas");
          $arpet = "var prdName = new Array();\n";
          echo '<select class="form-control" name="idpetugas" 
              onchange="document.getElementById(\'idpetugas\').value = prdName[this.value]">';
          while ($rowpet = mysqli_fetch_array($hspet)) { 
            if($idpetugas==$rowpet['kode_petugas']){
              echo '<option value="' . $idpetugas . '" selected="selected">' . $rowpet["kode_petugas"] . '</option>'; 
            } 
            echo '<option value="' . $rowpet['kode_petugas'] . '">' . $rowpet['kode_petugas'] . '</option>';  
            $arpet .= "prdName['" . $rowpet['kode_petugas'] . "'] = '" . addslashes($rowpet['kode_petugas']) . "';\n";  
          }  
        echo '</select>';

        } else {

          $hspet = mysqli_query($kon,"select * from petugas");
          $arpet = "var prdName = new Array();\n";
          echo '<select class="form-control" name="idpetugas" 
                onchange="document.getElementById(\'idpetugas\').value = prdName[this.value]">';  
          echo '<option value="" selected="selected"> ID Petugas </option>';
          while ($rowpet = mysqli_fetch_array($hspet)) {  
            echo '<option value="' . $rowpet['kode_petugas'] . '">' . $rowpet['kode_petugas'] . '</option>';  
            $arpet .= "prdName['" . $rowpet['kode_petugas'] . "'] = '" . addslashes($rowpet['kode_petugas']) . "';\n";  
          }  
        echo '</select>';

        } 
      ?>
      
        <script type="text/javascript">  
          <?php echo $arpet; ?>  
        </script>
<!-- (END OF) PENGATURAN SELECT PETUGAS --> 
    </div>
  </div>
  <div class="form-group">
    <label for="username" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $username ?>" <?php echo $readonly ?> autocomplete="off" >
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-4">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo $password ?>" >
    </div>
    <div class="col-sm-4">
      <input type="password" class="form-control" id="password2" name="password2" placeholder="Konfirmasi Password" value="<?php echo $password ?>" >
    </div>
  </div>
  <div class="form-group">
    <label for="level" class="col-sm-2 control-label">Level</label>
    <div class="col-sm-4">
      <div class="radio">
        <label>
          <input name="level" type="radio" id="admin" value="Admin" <?php echo "$admin";?> /><label for="admin">Admin</label>
        </label>
      </div>
      <div class="radio">
        <label>
          <input name="level" type="radio" id="user" value="User" <?php echo "$user";?>/><label for="user">User</label>
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="filefoto" class="col-sm-2 control-label">Foto</label>
    <div class="col-sm-6">
      <input type="file" name="filefoto" id="filefoto" class="form-control">
    </div>
  </div>
 
  <div class="form-group" >
    <div class="col-sm-offset-1 col-sm-10 line" style="padding: 5px 0px 0px 360px">
      <button type="submit" value="upload" class="btn btn-default btn-cari" > <span class="glyphicon glyphicon-ok"></span> Simpan</button>
      <button type="button" class="btn btn-danger btn-batal"  data-toggle="modal" data-target="#myModal">
      <span class="glyphicon glyphicon-remove"></span> Batal</button>
    </div>
  </div>
</form>

<!-- modal batal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
      </div>
      <div class="modal-body">
        Anda Yakin ingin membatalkan ??<br>
        Data yang diisikan tidak akan diproses !!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-tambah" data-dismiss="modal">Tidak</button>
        <a href="<?php echo base_url() ?>app/user"><button type="button" class="btn btn-default btn-cari" >Ya</button></a>
      </div>
    </div>
  </div>
</div>

<script>
  function validasi_input()
  {
    if(simpanform.idpetugas.value == ""){
      alert("Id Petugas masih kosong !");
      simpanform.idpetugas.focus();
      return (false);
    }
    if(simpanform.username.value == ""){
      alert("Username masih kosong !");
      simpanform.username.focus();
      return (false);
    }
    if(simpanform.password.value == ""){
      alert("Password masih kosong !");
      simpanform.password.focus();
      return (false);
    }
    if(simpanform.level.value == ""){
      alert("Level masih kosong !");
      simpanform.level.focus();
      return (false);
    }
    if(simpanform.password.value != simpanform.password2.value ){
      alert("Password Tidak Sama !");
      simpanform.password2.focus();
      return (false);
    }
    else {
      alert("Data Berhasil Disimpan !!");
      return (true);
    }
  }
</script>
