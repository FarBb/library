<?php 
  
  $kon = mysqli_connect('localhost','root','','library');
  $idkategori = "";
  $namakategori = "";

if($op=="edit"){
    foreach ($sql->result() as $obj1) { 
      $op = "edit";                 
      $idkategori = $obj1->kode_kategori; 
      $namakategori = $obj1->nama_kategori;
    }
    
} else {
      $qry =  mysqli_query($kon,"select * from kategori order by kode_kategori desc");
      if(mysqli_num_rows($qry)>0){
          $row    =  mysqli_fetch_array($qry);
          $kd_kategori   = substr($row['kode_kategori'], -4);
          $kd_kategori=$kd_kategori+1;
          if(strlen($kd_kategori)==1) {$kd_kategori='000'.$kd_kategori;}
          else if(strlen($kd_kategori)==2) {$kd_kategori='00'.$kd_kategori;}
          else if(strlen($kd_kategori)==3) {$kd_kategori='0'.$kd_kategori;}
          else {$kd_kategori=$kd_kategori;}
          $idkategori=  'K'.$kd_kategori;
      }
      else {
          $idkategori=  'K0001';
      }
}



?>


<form class="form-horizontal" action="<?php echo base_url() ?>app/k_simpan" 
        method="post" name="simpanform" onsubmit="return validasi_input()">
  <div class="form-group">
    <label for="idpetugas" class="col-sm-2 control-label">ID Kategori</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="idkategori" name="idkategori" placeholder="ID Kategori" value="<?php echo $idkategori ?>" readonly>
      <input type="hidden" name="op" value="<?php echo $op ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="nama" class="col-sm-2 control-label">Nama Kategori</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="namakategori" name="namakategori" placeholder="Nama Kategori" value="<?php echo $namakategori ?>" autocomplete="off">
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
        <a href="<?php echo base_url() ?>app/kategori"><button type="button" class="btn btn-default btn-cari" >Ya</button></a>
      </div>
    </div>
  </div>
</div>

<script>
  function validasi_input()
  {
    if(simpanform.namakategori.value == ""){
      alert("Nama Kategori masih kosong !");
      simpanform.namakategori.focus();
      return (false);
    }
    else {
      alert("Data Berhasil Disimpan !!");
      return (true);
    }
  }
</script>
