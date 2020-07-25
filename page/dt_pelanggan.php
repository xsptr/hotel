<?php
//if(empty($_SESSION['username'])){
//    echo "Not found!";
//} else {
    switch ($_GET['act']) {
    // PROSES VIEW Data Pelanggan //      
      case 'view':
      ?>

<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Pelanggan </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=pytr&act=view">Data Pelanggan</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
    <div class="box-header">
    <a href="?pg=pytr&act=add"> <button type="button" class="btn btn-info"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
    </div><!-- /.box-header -->
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>jenis Kelamin</th>
                        <th>Usia</th>
                        <th>Alamat</th>
                        <th>Pekerjaan</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tampil=mysqli_query($db_conn, "SELECT * FROM tblpelanggan order by idpelanggan asc");
                    $no = 1;
                      while ($r=mysqli_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>
                        <td><?php echo "$r[nmpelanggan]"?></td>
                        
                        <?php
                        if ($r['jenkel']=="L"){
                          $jenkel = "Laki-laki";
                        } else {
                          $jenkel = "Perempuan";
                        }
                        ?>

                        <td><?php echo "$jenkel"?></td>
                        <td><?php echo "$r[usia]"?></td>
                        <td><?php echo "$r[alamat]"?></td>
                        <td><?php echo "$r[pekerjaan]"?></td>
                        
                        <td><a href="?pg=pytr&act=edit&id=<?php echo $r['idpelanggan']?>"><button type="button" class="btn bg-orange"><i class="fa fa-pencil-square-o"></i></button></a></td>
                        <td><a href="?pg=pytr&act=delete&id=<?php echo $r['idpelanggan']?>"><button type="button" class="btn btn-info" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
                        </tr>

                    <?php
                    $no++;
                    }
                    ?>
                    </tbody>
                  </table>
                  </div><!-- /.box-body -->
              </div>
              </div><!-- /.box -->
              </div> <!-- /.col -->
	</div>
    <!-- /.row (main row) -->
</section> <!-- /.content -->
    </div><!-- /.container -->
</div><!-- /.content-wrapper -->

      <?php
      break;
      // PROSES TAMBAH Data Pelanggan //
      case 'add':
      if (isset($_POST['add'])) {
                $query = mysqli_query($db_conn, "INSERT INTO tblpelanggan VALUES ('$_POST[idpelanggan]',
                '$_POST[nmpelanggan]','$_POST[usia]','$_POST[jenkel]',
                '$_POST[alamat]','$_POST[pekerjaan]','$_POST[contact]')");
                echo "<script>window.location='home.php?pg=pytr&act=view'</script>";
              }
              ?>

<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Pelanggan </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=pytr&act=view">Data Pelanggan</a></li>
            <li class="active"><a href="#">Tambah Data Pelanggan</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <!-- form start -->
                <form role="form" method = "POST" action="">
                  <div class="box-body">
                  <div class="box-body">
                    <div class="form-group">
                      <?php
                      //memulai mengambil datanya
                      $sql = mysqli_query($db_conn, "SELECT * FROM tblpelanggan");
                      
                      $num = mysqli_num_rows($sql);
                      
                      if($num <> 0)
                      {
                      $kode = $num + 1;
                      }else
                      {
                      $kode = 1;
                      }
                      
                      //mulai bikin kode
                      $bikin_kode = str_pad($kode, 4, "0", STR_PAD_LEFT);
                      $tahun = date('Ym');
                      $kode_jadi = "Pelanggan$tahun$bikin_kode";

                      ?>
                      <label for="exampleInputEmail1">ID Penyetor</label>
                      <input type="text" class="form-control" id="idnsbh" name="idnsbh" placeholder="ID Penyetor" value="<?php echo $kode_jadi?>" required data-fv-notempty-message="Tidak boleh kosong" disabled>
                      <input type="hidden" class="form-control" id="idpelanggan" name="idpelanggan" placeholder="Nomor Penjualan" value="<?php echo $kode_jadi?>" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Pelanggan</label>
                      <input type="text" class="form-control" id="nmpelanggan" name="nmpelanggan" placeholder="Nama Pelanggan" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">jenis Kelamin</label> <br>
                      <label class="radio-inline">
                      <input type="radio" name="jenkel" id="jenkel" value="L" required data-fv-notempty-message="Tidak boleh kosong"> Laki-laki 
                      </label>
                      <label class="radio-inline">
                      <input type="radio" name="jenkel" id="jenkel" value="P" required data-fv-notempty-message="Tidak boleh kosong"> Perempuan
                      </label>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Usia</label>
                      <select class="form-control" name="usia">
                      <option>--- USIA ---</option>
                      <?php
                      for ($i = 1 ; $i<=99 ; $i++){
                      ?>
                      <option value = "<?php echo $i ?>"><?php echo $i?> Tahun</option>
                      <?php
                      }
                      ?>
                      </select>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Alamat</label>
                    <textarea class="form-control" name="alamat" rows="5" placeholder="Alamat" required data-fv-notempty-message="Tidak boleh kosong"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Pekerjaan</label>
                      <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Contact Person</label>
                      <input type="number" class="form-control" id="contact" name="contact" placeholder="Contact Person" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    
                  </div><!-- /.box-body -->

              </div><!-- /.box -->
              </div> <!-- /.col -->

              </div> <!-- /.row -->

          
            <!-- Tombol Bagian Bawah -->

            <div class="row">
            <!-- left column -->
              <div class="col-md-4 col-md-offset-5">

              <button type="submit" name = 'add' class="btn btn-info">Simpan</button>
              &nbsp;
              <button type="reset" class="btn btn-success">Reset</button>
                  
            </form>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div> <!-- /.col -->
  </div>
    <!-- /.row (main row) -->
</section> <!-- /.content -->
    </div><!-- /.container -->
</div><!-- /.content-wrapper -->


      <?php
      break;
      // PROSES EDIT Data Pelanggan //
      case 'edit':
      $d = mysqli_fetch_array(mysqli_query($db_conn, "SELECT * FROM tblpelanggan WHERE idpelanggan='$_GET[id]'"));
            if (isset($_POST['update'])) {          
              mysqli_query($db_conn, "UPDATE tblpelanggan SET nmpelanggan='$_POST[nmpelanggan]',
               usia='$_POST[usia]',jenkel='$_POST[jenkel]',alamat='$_POST[alamat]',
               pekerjaan='$_POST[pekerjaan]',cperson='$_POST[contact]' 
               WHERE idpelanggan='$_POST[id]'");
                echo "<script>window.location='home.php?pg=pytr&act=view'</script>";            
          }
              ?>

<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Pelanggan </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=pytr&act=view">Data Pelanggan</a></li>
            <li class="active">Update Data Pelanggan</li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <!-- form start -->
                <form role="form" method = "POST" action="">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">ID Penyetor</label>
                      <input type="text" class="form-control" id="idnsbh" name="idnsbh" placeholder="ID Penyetor" value= "<?php echo $d[idpelanggan];?>" required data-fv-notempty-message="Tidak boleh kosong" disabled>
                      <input type="hidden" class="form-control" id="idpelanggan" name="idpelanggan" placeholder="ID Penyetor" value= "<?php echo $d[idpelanggan];?>" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Pelanggan</label>
                      <input type="hidden" name="id" value= "<?php echo $d['idpelanggan'];?>">
                      <input type="text" class="form-control" id="nmpelanggan" name="nmpelanggan" placeholder="Nama Pelanggan" required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['nmpelanggan'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jenis Kelamin</label> <br>
                      <?php
                      if ($d['jenkel'] == 'L'){
                      ?>
                      <label class="radio-inline">
                      <input type="radio" name="jenkel" id="jenkel" value="L" required data-fv-notempty-message="Tidak boleh kosong" checked> Laki-laki 
                      </label>
                      <label class="radio-inline">
                      <input type="radio" name="jenkel" id="jenkel" value="P" required data-fv-notempty-message="Tidak boleh kosong"> Perempuan
                      </label>
                      <?php
                      } else {
                      ?>
                      <label class="radio-inline">
                      <input type="radio" name="jenkel" id="jenkel" value="L" required data-fv-notempty-message="Tidak boleh kosong"> Laki-laki 
                      </label>
                      <label class="radio-inline">
                      <input type="radio" name="jenkel" id="jenkel" value="P" required data-fv-notempty-message="Tidak boleh kosong" checked> Perempuan
                      </label>
                      <?php
                      }
                      ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Usia</label>
                      <select class="form-control" name="usia">
                      <option>--- USIA ---</option>

                      <?php
                      for ($i = 1 ; $i<=99 ; $i++){
                        if ($i==$d[usia]) {
                      ?>
                      <option value = "<?php echo $d[usia] ?>" selected><?php echo $d[usia]?> Tahun</option>
                      <?php
                      } else {
                      ?>
                      <option value = "<?php echo $i?>"><?php echo $i?> Tahun</option>
                      <?php
                      }
                    }
                      ?>
                      
                      </select>
                    </div>
                    
                    <div class="form-group">
                    <label for="exampleInputEmail1">Alamat</label>
                    <textarea class="form-control" name="alamat" rows="5" placeholder="Alamat" required data-fv-notempty-message="Tidak boleh kosong"><?php echo $d[alamat]?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Pekerjaan</label>
                      <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan" required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['pekerjaan'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Contact Person</label>
                      <input type="number" class="form-control" id="contact" name="contact" placeholder="Contact Person" required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['cperson'];?>">
                    </div>
                    
                  </div><!-- /.box-body -->

              </div><!-- /.box -->
              </div> <!-- /.col -->

              </div> <!-- /.row -->

          
            <!-- Tombol Bagian Bawah -->

            <div class="row">
            <!-- left column -->
              <div class="col-md-4 col-md-offset-5">

              <button type="submit" name = 'update' class="btn btn-info">Update</button>
              &nbsp;
              <button type="reset" class="btn btn-success">Reset</button>
                  
            </form>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div> <!-- /.col -->
  </div>
    <!-- /.row (main row) -->
</section> <!-- /.content -->
    </div><!-- /.container -->
</div><!-- /.content-wrapper -->


    <?php
    break;

    // PROSES HAPUS Data Pelanggan //
      case 'delete':
      mysqli_query($db_conn, "DELETE FROM tblpelanggan WHERE idpelanggan='$_GET[id]'");
      echo "<script>window.location='home.php?pg=pytr&act=view'</script>";
      break;

    }
    ?>