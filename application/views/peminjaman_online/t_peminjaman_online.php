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

  <div class="col-md-9" style="margin-left: 10px; margin-bottom: 0px">
    <form action="<?php echo base_url() ?>app/pjonline_cari" method="post" 
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
                  <th>Nama</th>
                  <th>Buku</th>
                  <th>Tgl. Entry</th>
                  <th>Status</th>
                  <th colspan="2">Opsi</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($sql1->result() as $obj1) { ?>
                    <tr>
                      <td><?php echo $obj1->kode_kartu; ?></td>
                      <td>
                       <?php 
                        $ptg = $obj1->kode_kartu;
                        $qry = mysqli_query($kon,"select * from kartu where kode_kartu='$ptg'");
                          while($hs = mysqli_fetch_array($qry)){
                          echo $hs['nama'];
                        }
                       ?> 
                      </td>
                      <td><?php 
                        $bk = $obj1->kode_buku;
                        $qry = mysqli_query($kon,"select * from buku where kode_buku='$bk'");
                          while($hs = mysqli_fetch_array($qry)){
                          echo $hs['judul_buku'];
                        }
                       ?> </td>
                      <td><?php echo $obj1->tgl_entry; ?> </td>
                      <td><?php echo $obj1->status; ?></td>
                      <td>
                      <?php
                        if($obj1->status == 'NOT VALIDATED') { ?>
                        <a href="<?php echo base_url().'app/pjonline_status/'.sha1(md5($obj1->id_peminjaman_online)); ?>" class="btn btn-success btn-sm btn-cari" data-toggle="tooltip" data-placement="top" title="Validasi">
                          <span class="glyphicon glyphicon-pencil"> </span>
                        </a>
                        <?php } ?>
                      </td>
                      <td>
                      <a href="<?php echo base_url().'app/pjonline_hapus/'.sha1(md5($obj1->id_peminjaman_online)); ?>" class="btn btn-danger btn-sm btn-batal" onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini ??')" data-toggle="tooltip" data-placement="top" title="Hapus">
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