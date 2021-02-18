<?php 
  $kon = mysqli_connect("localhost","root","","library");
 ?>

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
    <a href="<?php echo base_url() ?>app/kt_tambah">
      <button class="btn btn-default btn-tambah">
        <span class="glyphicon glyphicon-plus"></span> Tambah
      </button>
    </a>
  <?php } ?>
  </div>

  <div class="col-md-9" style="margin-left: 10px; margin-bottom: 0px">
    <form action="<?php echo base_url() ?>app/kt_cari" method="post" 
      enctype="multipart/form-data" name="formcari" onsubmit="return validasi_cari()">
  
      <button class="btn btn-default btn-cari" type="submit">
        <span class="glyphicon glyphicon-search"></span> Cari
      </button>

      <input type="text" maxlength="20" size="80" class="inputcari" 
      placeholder="Masukkan Kode Kartu" name="cari" id="cari" style="" autocomplete="off"/>
      
    </form>
  </div>

</div> 

          <div class="table-responsive" style="margin-top: 0px; border-top: 2px solid #C9C9C9; border-color: #019875;">
            <table class="table table-striped" style="font-size: small;">
              <thead>
                <tr>
                  <th>Kode Kartu</th>
                  <th>Kode Peminjam</th>
                  <th>Nama Peminjam</th>
                  <th>Tgl. Pembuatan</th>
                  <th>Tgl. Akhir</th>
                  <th>Status</th>
                  <th colspan="4">Opsi</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($sql1->result() as $obj1) { ?>
                    <tr>
                      <td><?php echo $obj1->kode_kartu; ?></td>
                      <td><?php echo $obj1->kode_peminjam; ?> </td>
                      <td><?php echo $obj1->nama; ?> </td>
                      <td><?php echo $obj1->tgl_pembuatan; ?> </td>
                      <td><?php echo $obj1->tgl_akhir; ?> </td>
                      <td>
                      <?php 
                        echo $obj1->status;
                        $sta = $obj1->status;
                        if($sta=='Aktif'){
                          $closeopen = '<!--';
                          $closeclose = '-->';
                        } else {
                          $closeopen = '';
                          $closeclose = '';
                        }
                      ?>
                      </td>
                      <td>
                      <a href="<?php echo base_url().'app/kt_ubah/'.sha1(md5($obj1->kode_kartu)); ?>" class="btn btn-success btn-sm btn-cari" data-toggle="tooltip" data-placement="top" title="Ubah">
                        <span class="glyphicon glyphicon-pencil"> </span>
                      </a>
                      </td>
                      <td>
                      <?php echo $closeopen; ?>
                        <a href="<?php echo base_url().'app/kt_status/'.sha1(md5($obj1->kode_kartu)); ?>" class="btn btn-success btn-sm btn-cari" data-toggle="tooltip" data-placement="top" title="Aktifasi Kartu">
                          <span class="glyphicon glyphicon-check"> </span>
                        </a>
                      <?php echo $closeclose; ?>
                      </td>
                      <td>
                      <a target="_blank" href="<?php echo base_url().'app/kt_cetak/'.sha1(md5($obj1->kode_kartu)); ?>" class="btn btn-cari btn-sm" onclick="return confirm('Apakah Anda Ingin Mencetak Kartu Ini ??')" data-toggle="tooltip" data-placement="top" title="Cetak Kartu">
                        <span class="glyphicon glyphicon-print"> </span>
                      </a>
                      </td>
                      <td>
                      <a href="<?php echo base_url().'app/kt_hapus/'.sha1(md5($obj1->kode_kartu)); ?>" class="btn btn-danger btn-sm btn-batal" onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini ??')" data-toggle="tooltip" data-placement="top" title="Hapus">
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