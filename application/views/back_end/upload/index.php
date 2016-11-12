<head>
    <title>Upload Gambar (Image), Rename dan Resize</title> <!-- variabel diambil dari controller -->
    
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet"> <!-- Custom styles for this template -->
<style>

    body{
        margin:20px 10%;
    }
</style>
</head>

<div class="container">
      <!-- Main component for a primary marketing message or call to action -->
<div class="panel panel-default">
  <div class="panel-heading"><b> Daftar File IMage</b></div>
  <div class="panel-body">
    
    <?=$this->session->flashdata('pesan')?>
    <p>
        <a href="<?=base_url()?>upload/add" class="btn btn-success">Tambah</a>
    </p>
  <table class="table table-bordered table-striped">
    <tr>
      <th>Nama File</th>
      <th>Tipe File</th>
      <th>Gambar File</th>
      <th>Keterangan</th>
    </tr>
  <? foreach ($query as $row)
{
  ?>
    <tr>
      <td><?=$row->namafile;?></td>
      <td><?=$row->type;?></td>
      <td><img  src="<?=base_url()?>assets/hasil_resize/<?=$row->namafile;?>"></td>
      <td><?=$row->keterangan;?></td>
    </tr>
}
  </table>

</div>
</div>
</div>