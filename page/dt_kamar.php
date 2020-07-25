<?php
//if(empty($_SESSION['username'])){
//    echo "Not found!";
//} else {
    switch ($_GET['act']) {
    // PROSES VIEW Data Kamar Hotel //      
      case 'view':
      ?>

<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Kamar Hotel </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=trk&act=view">Data Kamar Hotel</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
    <div class="box-header">
    <a href="?pg=trk&act=add"> <button type="button" class="btn btn-info"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
    </div><!-- /.box-header -->
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kamar</th>
                        <th>Biaya Sewa</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tampil=mysqli_query($db_conn,"SELECT * FROM tblkamar order by idkamar asc");
                    $no = 1;
                      while ($r=mysqli_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>
                        <td><?php echo "$r[nmkamar]"?></td>
                        <td><?php echo "Rp.". number_format("$r[biayasewa]",'0','.','.')?></td>
                        
                        <td><a href="?pg=trk&act=edit&id=<?php echo $r['idkamar']?>"><button type="button" class="btn bg-orange"><i class="fa fa-pencil-square-o"></i></button></a></td>
                        <td><a href="?pg=trk&act=delete&id=<?php echo $r['idkamar']?>"><button type="button" class="btn btn-info" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
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
      // PROSES TAMBAH Data Kamar Hotel //
      case 'add':
      if (isset($_POST['add'])) {
                $query = mysqli_query($db_conn, "INSERT INTO tblkamar VALUES ('$_POST[idkamar]',
                '$_POST[nmkamar]','$_POST[biayasewa]')");
                echo "<script>window.location='home.php?pg=trk&act=view'</script>";
              }
              ?>

<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Kamar Hotel </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=trk&act=view">Data Kamar Hotel</a></li>
            <li class="active"><a href="#">Tambah Data Kamar Hotel</a></li>
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
                      $sql = mysqli_query($db_conn, "SELECT * FROM tblkamar");
                      
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
                      $kode_jadi = "ROOM$tahun$bikin_kode";

                      ?>
                      <label for="exampleInputEmail1">ID Kamar</label>
                      <input type="text" class="form-control" id="idnsbh" name="idnsbh" placeholder="ID Nasabah" value="<?php echo $kode_jadi?>" required data-fv-notempty-message="Tidak boleh kosong" disabled>
                      <input type="hidden" class="form-control" id="idkamar" name="idkamar" placeholder="Nomor Penjualan" value="<?php echo $kode_jadi?>" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Kamar</label>
                      <input type="text" class="form-control" id="nmkamar" name="nmkamar" placeholder="Nama Kamar" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Biaya Sewa</label>
                      <input type="number" class="form-control" id="biayasewa" name="biayasewa" placeholder="Biaya Sewa" required data-fv-notempty-message="Tidak boleh kosong">
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
      // PROSES EDIT Data Kamar Hotel //
      case 'edit':
      $d = mysqli_fetch_array(mysqli_query($db_conn, "SELECT * FROM tblkamar WHERE idkamar='$_GET[id]'"));
            if (isset($_POST['update'])) {          
              mysqli_query($db_conn, "UPDATE tblkamar SET nmkamar='$_POST[nmkamar]',
               biayasewa='$_POST[biayasewa]' 
               WHERE idkamar='$_POST[id]'");
                echo "<script>window.location='home.php?pg=trk&act=view'</script>";            
          }
              ?>

<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Kamar Hotel </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=trk&act=view">Data Kamar Hotel</a></li>
            <li class="active">Update Data Kamar Hotel</li>
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
                      <label for="exampleInputEmail1">ID Kamar</label>
                      <input type="text" class="form-control" id="idtrk" name="idtrk" placeholder="ID Truk" value= "<?php echo $d[idkamar];?>" required data-fv-notempty-message="Tidak boleh kosong" disabled>
                      <input type="hidden" class="form-control" id="idkamar" name="idkamar" placeholder="ID Truk" value= "<?php echo $d[idkamar];?>" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Kamar</label>
                      <input type="hidden" name="id" value= "<?php echo $d['idkamar'];?>">
                      <input type="text" class="form-control" id="nmkamar" name="nmkamar" placeholder="Nama Kamar" required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['nmkamar'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Biaya Sewa</label>
                      <input type="number" class="form-control" id="biayasewa" name="biayasewa" placeholder="Biaya Sewa" required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['biayasewa'];?>">
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

    // PROSES HAPUS Data Kamar Hotel //
      case 'delete':
      mysqli_query($db_conn, "DELETE FROM tblkamar WHERE idkamar='$_GET[id]'");
      echo "<script>window.location='home.php?pg=trk&act=view'</script>";
      break;

    }
    ?>