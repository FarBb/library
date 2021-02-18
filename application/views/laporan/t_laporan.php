<br><br>
<div class="col-md-12">

<form clas="row" action="<?php echo base_url() ?>Laporan/generate" method="POST" name="simpanform" enctype="multipart/form-data">

  <div class="form-group row">
    <label for="laporan_data" class="col-md-2 col-sm-2 col-form-label">Data Laporan</label>
    <div class="col-md-4 col-sm-10">
      <select class="form-control" id="laporan_data" name="laporan_data" required>
        <option value="buku"> Data Buku</option>
        <option value="kartu"> Data Kartu Anggota</option>
        <option value="kategori"> Data Kategori Buku</option>
        <option value="peminjam"> Data Peminjam</option>
        <option value="peminjaman"> Data Peminjaman</option>
        <option value="penerbit"> Data Penerbit</option>
        <option value="petugas"> Data Petugas</option>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="tanggal_start" class="col-md-2 col-sm-2 col-form-label">Dari Tanggal</label>
    <div class="col-md-3 col-sm-10">
      <input type="date" class="form-control" id="tanggal_start" name="tanggal_start">
    </div>
  </div>

  <div class="form-group row">
    <label for="tgl_now" class="col-md-2 col-sm-2 col-form-label">Sampai Tanggal</label>
    <div class="col-md-3 col-sm-10">
      <input type="date" class="form-control" id="tgl_now" name="tanggal_end">
    </div>
  </div>

  <div class="form-group" style="width: 100%;border-top: 1px solid #6c757d; padding: 5px;">

    <div class="btni" style="float: right;">
      <button type="submit" class="btn btn-default btn-cari" >
        <span class="glyphicon glyphicon-check"></span> Buat Laporan
      </button>
    </div>
  </div>
</form>

</div>

<script>
  function gettgl(){
    var d, nowdate, year, month;
    d = new Date();
    nowdate = d.getDate();
    month = d.getMonth()+1; 
    year = d.getFullYear();

    document.getElementById("tgl_rekam").value =  year + '-' + month + '-' + nowdate;
  };
</script>
