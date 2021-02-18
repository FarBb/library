<?php 
  
  $kon = mysqli_connect('localhost','root','','library');
  $idpeminjam = "";
  $nama = "";
  $alamat = "";
  $telp = "";
  $rbpria = "";
  $rbwanita = "";
  $ktp = "";

if($op=="edit"){
    foreach ($sql->result() as $obj1) { 
      $op = "edit";                 
      $idpeminjam = $obj1->kode_peminjam;
      $ktp = $obj1->ktp; 
      $nama = $obj1->nama;
      $alamat = $obj1->alamat;
      $telp = $obj1->telp;
      $gender = $obj1->gender;
      if($gender=="Laki - Laki"){
        $rbpria = "checked";
        $rbwanita = "";
      } else {
        $rbpria = "";
        $rbwanita = "checked";
      }
    }
    
} else {
    $qry =  mysqli_query($kon,"select * from peminjam order by kode_peminjam desc");
      if(mysqli_num_rows($qry)>0){
          $row    =  mysqli_fetch_array($qry);
          $kd_peminjam   = substr($row['kode_peminjam'], -4);
          $kd_peminjam=$kd_peminjam+1;
          if(strlen($kd_peminjam)==1) {$kd_peminjam='000'.$kd_peminjam;}
          else if(strlen($kd_peminjam)==2) {$kd_peminjam='00'.$kd_peminjam;}
          else if(strlen($kd_peminjam)==3) {$kd_peminjam='0'.$kd_peminjam;}
          else {$kd_peminjam=$kd_peminjam;}
          $idpeminjam=  'PJ'.$kd_peminjam;
      }
      else {
          $idpeminjam=  'PJ0001';
      }
}



?>

<form class="form-horizontal" action="<?php echo base_url() ?>app/pm_simpan" 
        method="post" name="simpanform" onsubmit="return validasi_input()" enctype="multipart/form-data">
  <div class="form-group">
    <label for="idpeminjam" class="col-sm-2 control-label">ID peminjam</label>
    <div class="col-sm-2">
      <input type="hidden" name="op" id="op" value="<?php echo $op ?>">
      <input type="text" class="form-control" id="idpeminjam" name="idpeminjam" placeholder="ID Peminjam" value="<?php echo $idpeminjam ?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="ktp" class="col-sm-2 control-label">No KTP / Pelajar</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="ktp" name="ktp" placeholder="No KTP atau Kartu Pelajar" value="<?php echo $ktp ?>"
      onKeyPress="if(this.value.length==16) return false; if(this.value < 0 ) this.value = '';">
    </div>
  </div>
  <div class="form-group">
    <label for="nama" class="col-sm-2 control-label">Nama</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?php echo $nama ?>" autocomplete="off">
    </div>
  </div>
  <div class="form-group">
    <label for="gender" class="col-sm-2 control-label">Gender</label>
    <div class="col-sm-4">
      <div class="radio">
        <label>
          <input name="gender" type="radio" id="rbpria" value="Laki - Laki" <?php echo "$rbpria";?> /><label for="rbpria">Laki - Laki</label>
        </label>&emsp;&emsp;&emsp;
        <label>
          <input name="gender" type="radio" id="rbwanita" value="Perempuan" <?php echo "$rbwanita";?>/><label for="rbwanita">Perempuan</label>
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="alamat" class="col-sm-2 control-label">Alamat</label>
    <div class="col-sm-8">
      <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" rows="4"><?php echo $alamat ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="telp" class="col-sm-2 control-label">No Telepon</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="telp" name="telp" placeholder="No Telepon" value="<?php echo $telp ?>"
      onSubmit="if(this.value.length==13) return false; if(this.value < 0 ) this.value = '';">
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
        <a href="<?php echo base_url() ?>app/peminjam"><button type="button" class="btn btn-default btn-cari" >Ya</button></a>
      </div>
    </div>
  </div>
</div>

<script>
  function validasi_input()
  {
    if(simpanform.ktp.value == ""){
      alert("KTP masih kosong !");
      simpanform.ktp.focus();
      return (false);
    }
    if(simpanform.nama.value == ""){
      alert("Nama masih kosong !");
      simpanform.nama.focus();
      return (false);
    }
    if(simpanform.gender.value == ""){
      alert("Gender masih kosong !");
      simpanform.gender.focus();
      return (false);
    }
    if(simpanform.alamat.value == ""){
      alert("Alamat masih kosong !");
      simpanform.alamat.focus();
      return (false);
    }
    if(simpanform.telp.value == ""){
      alert("Telepon masih kosong !");
      simpanform.telp.focus();
      return (false);
    }
    else {
      alert("Data Berhasil Disimpan !!");
      return (true);
    }
  }
</script>
