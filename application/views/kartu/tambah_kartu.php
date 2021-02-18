<?php 
  
  $kon = mysqli_connect('localhost','root','','library');
  $user = $this->session->userdata('username');

  $qryuser =  mysqli_query($kon,"select * from user where username='$user'");
    if(mysqli_num_rows($qryuser)>0){
      $rowuser    =  mysqli_fetch_array($qryuser);
      $petugas   = $rowuser['kode_petugas'];
    }

  date_default_timezone_get('asia/jakarta');
  $tanggal_now = date('Y-m-d');
  $tambah = mktime(0,0,0,date('m')+6,date('d')+0,date('Y')+0);
  $tbh = date('Y-m-d',$tambah);

  $qry =  mysqli_query($kon,"select * from kartu order by kode_kartu desc");
  if(mysqli_num_rows($qry)>0){
    $row    =  mysqli_fetch_array($qry);
    $kd_kartu = substr($row['kode_kartu'], -4);
    $kd_kartu = $kd_kartu+1;
      if(strlen($kd_kartu)==1) {$kd_kartu='000'.$kd_kartu;}
      else if(strlen($kd_kartu)==2) {$kd_kartu='00'.$kd_kartu;}
      else if(strlen($kd_kartu)==3) {$kd_kartu='0'.$kd_kartu;}
      else {$kd_kartu=$kd_kartu;}
      $idkartu=  'A'.date('ymd').$kd_kartu;

  } else {
      $idkartu=  'A'.date('ymd').'0001';
  }

$data = $this->db->get('peminjam');
$data2 = $this->db->get('buku');

$kon = mysqli_connect('localhost','root','','library');
  $kdpeminjam = "";
  $nama = "";
  $status = "Aktif";
  $password ="";
  $aktif ="";
  $nonaktif ="";
  $readonly = "";

if($op=="edit"){
    foreach ($dtkartu->result() as $obj1) { 
      $op = "edit";                 
      $idkartu = $obj1->kode_kartu; 
      $kdpeminjam = $obj1->kode_peminjam;
      $nama = $obj1->nama;
      $status = $obj1->status;
      $password = $obj1->password; 
      if($status=="Aktif"){
        $aktif = "checked";
        $nonaktif = "";
      } else {
        $aktif = "";
        $nonaktif = "checked";
      }
      $readonly = "readonly";
    }
    
} else {
    
}
?>


<form class="form-horizontal" action="<?php echo base_url() ?>app/kt_simpan" 
        method="post" name="simpanform" onsubmit="return validasi_input()">
  <div class="form-group">
    <label for="idkartu" class="col-sm-2 control-label">Kode Kartu</label>
    <div class="col-sm-2">
      <input type="hidden" name="op" value="<?=$op?>">
      <input type="text" class="form-control" id="idkartu" name="idkartu" placeholder="Kode Kartu" value="<?php echo $idkartu ?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="peminjam" class="col-sm-2 control-label">Kode Peminjam</label>
    <div class="col-sm-8 form-inline">
    <input type="text" class="form-control" id="peminjam" name="peminjam" placeholder="Kode Peminjam" value="<?php echo $kdpeminjam?>" readonly>
      <button type="button" class="btn btn-default btn-tambah"  data-toggle="modal" data-target="#mpm" id="pp">
        <span class="glyphicon glyphicon-search"></span>
      </button>
    </div>
  </div>
  <div class="form-group">
    <label for="nama" class="col-sm-2 control-label">Nama Peminjam</label>
    <div class="col-sm-4">
     <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Peminjam" value="<?=$nama?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-4">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo $password ?>" maxlength="10" required>
    </div>
    <div class="col-sm-4">
      <input type="password" class="form-control" id="password2" name="password2" placeholder="Konfirmasi Password" value="<?php echo $password ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="tglbuat" class="col-sm-2 control-label">Tgl Pembuatan</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="tglbuat" name="tglbuat" value="<?php echo $tanggal_now ?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="tglakhir" class="col-sm-2 control-label">Tgl Akhir</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="tglakhir" name="tglakhir"  value="<?php echo $tbh ?>" readonly>
    </div>
  </div>
  <?php if ($op == 'edit'){ ?>
  <div class="form-group">
    <label for="level" class="col-sm-2 control-label">Status</label>
    <div class="col-sm-4">
      <div class="radio">
        <label>
          <input name="rbstatus" type="radio" id="aktif" value="Aktif" <?php echo "$aktif";?> /><label for="aktif">Aktif</label>
        </label>
      </div>
      <div class="radio">
        <label>
          <input name="rbstatus" type="radio" id="nonaktif" value="Non Aktif" <?php echo "$nonaktif";?>/><label for="nonaktif">Non Aktif</label>
        </label>
      </div>
    </div>
  </div>
  <?php } ?>
 
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
        <a href="<?php echo base_url() ?>app/kartu"><button type="button" class="btn btn-default btn-cari" >Ya</button></a>
      </div>
    </div>
  </div>
</div>

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
         <table class="table table-striped" style="font-size: small; height: 80%;">
              <thead>
                <tr>
                  <th>ID Peminjam</th>
                  <th>No. KTP</th>
                  <th>Nama</th>
                  <th>Gender</th>
                  <th>Alamat</th>
                  <th>No Telepon</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($data->result() as $obj1) { ?>
                    <tr>
                      <td><?php echo $obj1->kode_peminjam; ?> </td>
                      <td><?php echo $obj1->ktp; ?> </td>
                      <td><?php echo $obj1->nama; ?> </td>
                      <td><?php echo $obj1->gender; ?> </td>
                      <td><?php echo $obj1->alamat; ?> </td>
                      <td><?php echo $obj1->telp; ?> </td>
                      <td>
                        <button type="button" class="btn btn-success btn-sm btn-cari" data-toggle="tooltip" data-placement="top" title="Pilih Data Ini" onclick="simpanform.peminjam.value = '<?php echo $obj1->kode_peminjam ?>';simpanform.nama.value = '<?php echo $obj1->nama ?>';" data-dismiss="modal">
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

<script>
  function validasi_input()
  {
    if(simpanform.idkartu.value == ""){
      alert("Kode Kartu Belum diisi !");
      simpanform.idkartu.focus();
      return (false);
    }
    if(simpanform.peminjam.value == ""){
      alert("Kode Peminjam Belum Diisi");
      simpanform.peminjam.focus();
      return (false);
    }if(simpanform.password.value != simpanform.password2.value ){
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
