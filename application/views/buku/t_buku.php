<?php $kon = mysqli_connect("localhost","root","","library"); ?>

<div class="row" style="margin-top: 30px;">
  
<?php 
if (isset($c) && $c=='cari'){ ?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong><?php echo count($sql1); ?></strong> data ditemukan dengan katakunci <strong><?php echo $carijudul; ?></strong>
</div> 
<?php } ?>

  <div class="col-md-1">
  <?php 
  if (isset($c) && $c=='cari'){ ?>
      <button class="btn btn-default btn-tambah" onclick="history.back()">
        <span class="glyphicon glyphicon-arrow-left"></span> Kembali
      </button>
  <?php } else { ?>
    <a href="<?php echo base_url() ?>app/b_tambah">
      <button class="btn btn-default btn-tambah">
        <span class="glyphicon glyphicon-plus"></span> Tambah
      </button>
    </a>
  <?php } ?>
  </div>

  <div class="col-md-9" style="margin-left: 10px; margin-bottom: 0px">
    <form action="<?php echo base_url() ?>app/b_cari" method="post" 
      enctype="multipart/form-data" name="formcari" onsubmit="return validasi_cari()">
  
      <button class="btn btn-default btn-cari" type="submit">
        <span class="glyphicon glyphicon-search"></span> Cari
      </button>

      <input type="text" maxlength="20" size="80" class="inputcari" 
      placeholder="Masukkan Judul atau ID Buku" name="cari" id="cari" style="" autocomplete="off"/>
      
    </form>
  </div>

</div> 

          <div class="table-responsive" style="margin-top: 0px; border-top: 2px solid #C9C9C9; border-color: #019875;">
            <table class="table table-striped" style="font-size: small;">
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
                  <?php foreach ($sql1->result() as $obj1) { ?>
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
                        <a href="<?php echo base_url().'app/b_ubah/'.sha1(md5($obj1->kode_buku)); ?>" class="btn btn-success btn-sm btn-cari" data-toggle="tooltip" data-placement="top" title="Ubah">
                          <span class="glyphicon glyphicon-pencil"> </span>
                        </a>
                      </td>
                      <td>
                      <a href="<?php echo base_url().'app/b_hapus/'.sha1(md5($obj1->kode_buku)); ?>" class="btn btn-danger btn-sm btn-batal" onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini ??')" data-toggle="tooltip" data-placement="top" title="Hapus">
                        <span class="glyphicon glyphicon-trash"> </span>
                      </a>
                      </td>
                    </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>
          
<?php 
  if (empty($c)){ ?>
    <div class="pag row">
      <center><?php echo $pagination; ?></center>
    </div>
<?php  } ?>

<script>
  function validasi_cari()
  {
    if(formcari.cari.value == ""){
      alert("Kata kunci pencarian masih kosong !");
      formcari.cari.focus();
      return (false);
    }
    else {
      return (true);
    }
  }
</script>