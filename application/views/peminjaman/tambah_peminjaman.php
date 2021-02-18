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
  $tambah = mktime(0,0,0,date('m')+0,date('d')+3,date('Y')+0);
  $tbh = date('Y-m-d',$tambah);

  $qry =  mysqli_query($kon,"select * from peminjaman order by kode_peminjaman desc");
  if(mysqli_num_rows($qry)>0){
    $row    =  mysqli_fetch_array($qry);
    $kd_peminjaman   = substr($row['kode_peminjaman'], -4);
    $kd_peminjaman=$kd_peminjaman+1;
      if(strlen($kd_peminjaman)==1) {$kd_peminjaman='000'.$kd_peminjaman;}
      else if(strlen($kd_peminjaman)==2) {$kd_peminjaman='00'.$kd_peminjaman;}
      else if(strlen($kd_peminjaman)==3) {$kd_peminjaman='0'.$kd_peminjaman;}
      else {$kd_peminjaman=$kd_peminjaman;}
      $idpeminjaman=  date('ymd').$kd_peminjaman;

  } else {
      $idpeminjaman=  date('ymd').'0001';
  }

//$data = $this->db->get_where('peminjam', array('status =' => 'Aktif'));
$data = $this->db->get('peminjam');
$data2 = $this->db->get('buku');

?>


<form class="form-horizontal" action="<?php echo base_url() ?>app/pj_simpan" 
        method="post" name="simpanform" onsubmit="return validasi_input()">
  <div class="form-group">
    <label for="idpeminjaman" class="col-sm-2 control-label">ID Peminjaman</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="idpeminjaman" name="idpeminjaman" placeholder="ID Peminjaman" value="<?php echo $idpeminjaman ?>" readonly>
    </div>
  </div>

  <div class="form-group">
    <label for="petugas" class="col-sm-2 control-label">Petugas</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="petugas" name="petugas" value="<?php echo $petugas ?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="peminjam" class="col-sm-2 control-label">Peminjam</label>
    <div class="col-sm-8 form-inline">
    <input type="text" class="form-control" id="peminjam" name="peminjam" readonly>
      <button type="button" class="btn btn-default btn-tambah"  data-toggle="modal" data-target="#mpm" id="pp">
        <span class="glyphicon glyphicon-search"></span>
      </button>
    </div>
  </div>
  <div class="form-group">
    <label for="kartu" class="col-sm-2 control-label">Kode Kartu*</label>
    <div class="col-sm-4">
     <input type="text" class="form-control" id="kartu" name="kartu" placeholder="Kartu Anggota" maxlength="16">
    </div>
  </div>
  <div class="form-group">
    <label for="buku" class="col-sm-2 control-label">Buku</label>
    <div class="col-sm-8 form-inline">
    <input type="text" class="form-control" id="buku" name="buku" readonly>
      <button type="button" class="btn btn-default btn-tambah"  data-toggle="modal" data-target="#mb" id="bb">
        <span class="glyphicon glyphicon-search"></span>
      </button>
    </div>
  </div>
  <div class="form-group">
    <label for="isbn" class="col-sm-2 control-label">ISBN*</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN" maxlength="20">
    </div>
  </div>
  <div class="form-group">
    <label for="tglpinjam" class="col-sm-2 control-label">Tgl Pinjam</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="tglpinjam" name="tglpinjam" value="<?php echo $tanggal_now ?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="tglkembali" class="col-sm-2 control-label">Tgl Kembali</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="tglkembali" name="tglkembali"  value="<?php echo $tbh ?>" readonly>
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
        <a href="<?php echo base_url() ?>app/peminjaman"><button type="button" class="btn btn-default btn-cari" >Ya</button></a>
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
                        <button type="button" class="btn btn-success btn-sm btn-cari" data-toggle="tooltip" data-placement="top" title="Pilih Data Ini" onclick="simpanform.peminjam.value = '<?php echo $obj1->kode_peminjam ?>';" data-dismiss="modal">
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

<!-- modal buku -->
<div class="modal fade" id="mb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width: 80%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
          <span class="glyphicon glyphicon-search"></span> Pilih Data Buku
        </h4>
      </div>
      <div class="modal-body table-responsive" style=" height: 75%;">
         <table class="table table-striped" style="font-size: small; height: 80%;">
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
                  <th colspan="2">Opsi</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($data2->result() as $obj1) { ?>
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
                        <button type="button" class="btn btn-success btn-sm btn-cari" data-toggle="tooltip" data-placement="top" title="Pilih Data Ini" onclick="simpanform.buku.value = '<?php echo $obj1->kode_buku ?>';" data-dismiss="modal">
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
    if(simpanform.peminjam.value == "" && simpanform.kartu.value == ""){
      alert("Isi salah satu field, PEMINJAM atau KODE KARTU !");
      simpanform.pp.focus();
      return (false);
    }
    if(simpanform.peminjam.value != "" && simpanform.kartu.value != ""){
      alert("Hapus salah satu field, PEMINJAM atau KODE KARTU !");
      simpanform.kartu.focus();
      return (false);
    }
    if(simpanform.buku.value == "" && simpanform.isbn.value == ""){
      alert("Isi salah satu field, BUKU atau ISBN !");
      simpanform.bb.focus();
      return (false);
    }
    if(simpanform.buku.value != "" && simpanform.isbn.value != ""){
      alert("Hapus salah satu field, BUKU atau ISBN !");
      simpanform.isbn.focus();
      return (false);
    }
    else {
      alert("Data Berhasil Disimpan !!");
      return (true);
    }
  }

  $(document).ready(function() {
    /*
      $('#peminjam').change(function(){
        simpanform.kartu.setAttribute('disabled','disabled');
      });

      $('#isbn').keyup(function(){
        simpanform.bb.setAttribute('disabled','disabled');
        simpanform.buku.value = '';
      });
      $('#isbn').blur(function(){
        alert('heelo');
        simpanform.bb.disabled = false;
      });
  */
  });
</script>
