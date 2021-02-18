<?php 
  
  $kon = mysqli_connect('localhost','root','','library');
  $idpenerbit = "";
  $nama = "";
  $almt = "";
  $telp = "";

if($op=="edit"){
    foreach ($sql->result() as $obj1) { 
      $op = "edit";                 
      $idpenerbit = $obj1->kode_penerbit; 
      $nama = $obj1->nama_penerbit;
      $almt = $obj1->alamat; 
      $telp = $obj1->telp;
    }
    
} else {
      $qry =  mysqli_query($kon,"select * from penerbit order by kode_penerbit desc");
      if(mysqli_num_rows($qry)>0){
          $row    =  mysqli_fetch_array($qry);
          $kd_penerbit   = substr($row['kode_penerbit'], -4);
          $kd_penerbit=$kd_penerbit+1;
          if(strlen($kd_penerbit)==1) {$kd_penerbit='000'.$kd_penerbit;}
          else if(strlen($kd_penerbit)==2) {$kd_penerbit='00'.$kd_penerbit;}
          else if(strlen($kd_penerbit)==3) {$kd_penerbit='0'.$kd_penerbit;}
          else {$kd_penerbit=$kd_penerbit;}
          $idpenerbit=  'PN'.$kd_penerbit;
      }
      else {
          $idpenerbit=  'PN0001';
      }
}



?>


<form class="form-horizontal" action="<?php echo base_url() ?>app/pn_simpan" 
        method="post" name="simpanform" onsubmit="return validasi_input()">
  <div class="form-group">
    <label for="idpetugas" class="col-sm-2 control-label">ID Penerbit</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="idpenerbit" name="idpenerbit" placeholder="ID Penerbit" value="<?php echo $idpenerbit ?>" readonly>
      <input type="hidden" name="op" value="<?php echo $op ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="nama" class="col-sm-2 control-label">Nama</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?php echo $nama ?>" autocomplete="off">
    </div>
  </div>
  <div class="form-group">
    <label for="diskripsi" class="col-sm-2 control-label">Alamat</label>
    <div class="col-sm-8">
      <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" rows="4"><?php echo $almt ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="telp" class="col-sm-2 control-label">No Telepon</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="telp" name="telp" placeholder="No Telepon" value="<?php echo $telp ?>"
      onKeyPress="if(this.value.length==13) return false; if(this.value < 0 ) this.value = '';">
    </div>
  </div>
 
  <div class="form-group" >
    <div class="col-sm-offset-1 col-sm-10 line" style="padding: 5px 0px 0px 360px">
      <button type="submit" class="btn btn-default btn-cari" > <span class="glyphicon glyphicon-ok"></span> Simpan</button>
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
        <a href="<?php echo base_url() ?>app/penerbit"><button type="button" class="btn btn-default btn-cari" >Ya</button></a>
      </div>
    </div>
  </div>
</div>

<script>
  function validasi_input()
  {
    if(simpanform.nama.value == ""){
      alert("Nama masih kosong !");
      simpanform.nama.focus();
      return (false);
    }
    if(simpanform.alamat.value == ""){
      alert("Alamat masih kosong !");
      simpanform.alamat.focus();
      return (false);
    }
    if(simpanform.telp.value == ""){
      alert("No Telepon masih kosong !");
      simpanform.telp.focus();
      return (false);
    }
    else {
      alert("Data Berhasil Disimpan !!");
      return (true);
    }
  }
</script>
