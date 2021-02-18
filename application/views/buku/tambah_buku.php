<?php 
  
  $kon = mysqli_connect('localhost','root','','library');
  $idbuku = "";
  $ktg = "";
  $penerbit = "";
  $judul = "";
  $jumlah = "";
  $des = "";
  $pengarang = "";
  $th = "";

if($op=="edit"){
    foreach ($sql->result() as $obj1) { 
      $op = "edit";                 
      $idbuku = $obj1->kode_buku; 
      $ktg = $obj1->kode_kategori;
      $penerbit = $obj1->kode_penerbit;
      $judul = $obj1->judul_buku; 
      $jumlah = $obj1->jumlah_buku;
      $des = $obj1->diskripsi;
      $pengarang = $obj1->pengarang;
      $th = $obj1->tahun_terbit;
    }
    
} else {
      $qry =  mysqli_query($kon,"select * from buku order by kode_buku desc");
      if(mysqli_num_rows($qry)>0){
          $row    =  mysqli_fetch_array($qry);
          $kd_buku   = substr($row['kode_buku'], -4);
          $kd_buku=$kd_buku+1;
          if(strlen($kd_buku)==1) {$kd_buku='000'.$kd_buku;}
          else if(strlen($kd_buku)==2) {$kd_buku='00'.$kd_buku;}
          else if(strlen($kd_buku)==3) {$kd_buku='0'.$kd_buku;}
          else {$kd_buku=$kd_buku;}
          $idbuku=  'BK'.$kd_buku;
      }
      else {
          $idbuku=  'BK0001';
      }
}

$data = $this->db->get('kategori');
$data2 = $this->db->get('penerbit');

?>


<form class="form-horizontal" action="<?php echo base_url() ?>app/b_simpan" 
        method="post" name="simpanform" onsubmit="return validasi_input()">
  <div class="form-group">
    <label for="idbuku" class="col-sm-2 control-label">ID Buku</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="idbuku" name="idbuku" placeholder="ID Buku" value="<?php echo $idbuku ?>" readonly>
      <input type="hidden" name="op" value="<?php echo $op ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="kategori" class="col-sm-2 control-label">Kategori</label>
    <div class="col-sm-4 form-inline">
    <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo $ktg ?>" readonly>
      <button type="button" class="btn btn-default btn-tambah"  data-toggle="modal" data-target="#mk">
        <span class="glyphicon glyphicon-search"></span>
      </button>
    </div>
  </div>
  <div class="form-group">
    <label for="penerbit" class="col-sm-2 control-label">Penerbit</label>
    <div class="col-sm-4 form-inline">
    <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?php echo $penerbit ?>" readonly>
      <button type="button" class="btn btn-default btn-tambah"  data-toggle="modal" data-target="#mpn">
        <span class="glyphicon glyphicon-search"></span>
      </button>
    </div>
  </div>
  <div class="form-group">
    <label for="judul" class="col-sm-2 control-label">Judul</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" value="<?php echo $judul ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="jumlah" class="col-sm-2 control-label">Jumlah</label>
    <div class="col-sm-2">
      <input type="number" class="form-control" id="jumlah" name="jumlah"  placeholder="Jumlah / pcs" value="<?php echo $jumlah ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="diskripsi" class="col-sm-2 control-label">Deskripsi</label>
    <div class="col-sm-8">
      <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi" rows="4"><?php echo $des ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="pengarang" class="col-sm-2 control-label">Pengarang</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="pengarang" name="pengarang" placeholder="Pengarang" value="<?php echo $pengarang ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="thterbit" class="col-sm-2 control-label">Th. Terbit</label>
    <div class="col-sm-2">
      <input type="number" class="form-control" id="thterbit" name="thterbit" placeholder="Tahun Terbit" value="<?php echo $th ?>" onKeyPress="if(this.value.length==4) return false; if(this.value < 0 ) this.value = '';">
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
        <a href="<?php echo base_url() ?>app/buku"><button type="button" class="btn btn-default btn-cari" >Ya</button></a>
      </div>
    </div>
  </div>
</div>


<!-- modal kategori -->
<div class="modal fade" id="mk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width: 80%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
          <span class="glyphicon glyphicon-search"></span> Pilih Data Kategori
        </h4>
      </div>
      <div class="modal-body table-responsive" style=" height: 75%;">
         <table class="table table-striped" style="font-size: small; height: 80%;">
              <thead>
                <tr>
                  <th>ID Kategori</th>
                  <th>Nama Kategori</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($data->result() as $obj1) { ?>
                    <tr>
                      <td><?php echo $obj1->kode_kategori; ?> </td>
                      <td><?php echo $obj1->nama_kategori; ?> </td>
                      <td>
                        <button type="button" class="btn btn-success btn-sm btn-cari" data-toggle="tooltip" data-placement="top" title="Pilih Data Ini" onclick="simpanform.kategori.value = '<?php echo $obj1->kode_kategori ?>';" data-dismiss="modal">
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


<!-- modal penerbit -->
<div class="modal fade" id="mpn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width: 80%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
          <span class="glyphicon glyphicon-search"></span> Pilih Data Penerbit
        </h4>
      </div>
      <div class="modal-body table-responsive" style=" height: 75%;">
         <table class="table table-striped" style="font-size: small; height: 80%;">
              <thead>
                <tr>
                  <th>ID Penerbit</th>
                  <th>Nama Penerbit</th>
                  <th>Alamat</th>
                  <th>No Telepon</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($data2->result() as $obj1) { ?>
                    <tr>
                      <td><?php echo $obj1->kode_penerbit; ?> </td>
                      <td><?php echo $obj1->nama_penerbit; ?> </td>
                      <td><?php echo $obj1->alamat; ?> </td>
                      <td><?php echo $obj1->telp; ?> </td>
                      <td>
                        <button type="button" class="btn btn-success btn-sm btn-cari" data-toggle="tooltip" data-placement="top" title="Pilih Data Ini" onclick="simpanform.penerbit.value = '<?php echo $obj1->kode_penerbit ?>';" data-dismiss="modal">
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
    if(simpanform.kategori.value == ""){
      alert("Kategori masih kosong !");
      simpanform.kategori.focus();
      return (false);
    }
    if(simpanform.penerbit.value == ""){
      alert("Penerbit masih kosong !");
      simpanform.penerbit.focus();
      return (false);
    }
    if(simpanform.judul.value == ""){
      alert("Judul masih kosong !");
      simpanform.judul.focus();
      return (false);
    }
    if(simpanform.jumlah.value == ""){
      alert("Jumlah masih kosong !");
      simpanform.jumlah.focus();
      return (false);
    }
    if(simpanform.deskripsi.value == ""){
      alert("Deskripsi masih kosong !");
      simpanform.deskripsi.focus();
      return (false);
    }
    if(simpanform.pengarang.value == ""){
      alert("Pengarang masih kosong !");
      simpanform.pengarang.focus();
      return (false);
    }
    if(simpanform.thterbit.value == ""){
      alert("Tahun masih kosong !");
      simpanform.thterbit.focus();
      return (false);
    }
    else {
      alert("Data Berhasil Disimpan !!");
      return (true);
    }
  }
</script>
