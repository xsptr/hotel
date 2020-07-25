<?php
//if(empty($_SESSION['username'])){
//    echo "Not found!";
//} else {
    switch ($_GET['act']) {
    // PROSES VIEW DATA USER //      
      case 'view':
      ?>

<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Admin </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=adm&act=view">Data Admin</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
    <div class="box-header">
    <a href="?pg=adm&act=add"> <button type="button" class="btn btn-info"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
    </div><!-- /.box-header -->
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tampil=mysqli_query($db_conn, "SELECT * FROM tbladmin order by idadmin asc");
                    $no = 1;
                      while ($r=mysqli_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>
                        <td><?php echo "$r[username]"?></td>
                        
                        <?php
                        if ($r['status']=="Y"){
                          $status = "AKTIF";
                        } else {
                          $status = "TIDAK AKTIF";
                        }
                        ?>

                        <td><?php echo "$status"?></td>
                        <td><a href="?pg=adm&act=edit&id=<?php echo $r['idadmin']?>"><button type="button" class="btn bg-orange"><i class="fa fa-pencil-square-o"></i></button></a></td>
                        <td><a href="?pg=adm&act=delete&id=<?php echo $r['idadmin']?>"><button type="button" class="btn btn-info" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
                        </tr>

                    <?php
                    $no++;
                    }
                    ?>
                    </tbody>
                  </table>
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
      // PROSES TAMBAH DATA PENGGUNA //
      case 'add':
      if (isset($_POST['add'])) {
                $query = mysqli_query($db_conn, "INSERT INTO tbladmin VALUES ('','$_POST[username]',
                md5('$_POST[password]'),'$_POST[status]')");
                echo "<script>window.location='home.php?pg=adm&act=view'</script>";
              }
              ?>

<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Pengguna </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=adm&act=view">Data Admin</a></li>
            <li class="active"><a href="#">Tambah Data Admin</a></li>
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
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" class="form-control" id="username" name="username" placeholder="Username" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label> <br>
                      <label class="radio-inline">
                      <input type="radio" name="status" id="status" value="Y" required data-fv-notempty-message="Tidak boleh kosong"> Aktif 
                      </label>
                      <label class="radio-inline">
                      <input type="radio" name="status" id="status" value="N" required data-fv-notempty-message="Tidak boleh kosong"> Tidak Aktif
                      </label>
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
      // PROSES EDIT DATA PENGGUNA //
      case 'edit':
      $d = mysqli_fetch_array(mysqli_query($db_conn, "SELECT * FROM tbladmin WHERE idadmin='$_GET[id]'"));
            if (isset($_POST['update'])) {

            if (empty($_POST[password])) {

                mysqli_query($db_conn, "UPDATE tbladmin SET username='$_POST[username]',
                  status='$_POST[status]'
                  WHERE idadmin='$_POST[id]'");
                echo "<script>window.location='home.php?pg=adm&act=view'</script>";
            } else {
              mysql_query("UPDATE tbladmin SET username='$_POST[username]', 
                password=md5('$_POST[password]'), status='$_POST[status]'
                WHERE idadmin='$_POST[id]'");
                echo "<script>window.location='home.php?pg=adm&act=view'</script>";
            }
          }
              ?>

<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Pengguna </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=adm&act=view">Data Admin</a></li>
            <li class="active">Update Data Admin</li>
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
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" class="form-control" id="username" name="username" placeholder="Username" required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['username'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                      <input type="hidden" class="form-control" id="id" name="id" required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['idadmin'];?>">
                      <p class="text-red">Apabila password tidak diubah dikosongkan saja</p>
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label> <br>
                      <?php
                      if ($d['status'] == 'Y'){
                      ?>
                      <label class="radio-inline">
                      <input type="radio" name="status" id="status" value="Y" required data-fv-notempty-message="Tidak boleh kosong" checked> Aktif 
                      </label>
                      <label class="radio-inline">
                      <input type="radio" name="status" id="status" value="N" required data-fv-notempty-message="Tidak boleh kosong"> Tidak Aktif
                      </label>
                      <?php
                      } else if ($d['status'] == 'N') {
                      ?>
                      <label class="radio-inline">
                      <input type="radio" name="status" id="status" value="Y" required data-fv-notempty-message="Tidak boleh kosong"> Aktif 
                      </label>
                      <label class="radio-inline">
                      <input type="radio" name="status" id="status" value="N" required data-fv-notempty-message="Tidak boleh kosong" checked> Tidak Aktif
                      </label>
                      <?php
                      }
                      ?>
                    </div>
                    
                  </div><!-- /.box-body -->

              </div><!-- /.box -->
              </div> <!-- /.col -->

              </div> <!-- /.row -->

          
            <!-- Tombol Bagian Bawah -->

            <div class="row">
            <!-- left column -->
              <div class="col-md-4 col-md-offset-5">

              <button type="submit" name = 'update' class="btn btn-info">Simpan</button>
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

    // PROSES HAPUS DATA PENGGUNA //
      case 'delete':
      mysqli_query($db_conn, "DELETE FROM tbladmin WHERE idadmin='$_GET[id]'");
      echo "<script>window.location='home.php?pg=adm&act=view'</script>";
      break;

    }
    ?>