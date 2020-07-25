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
        <h1> Data Transaksi </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=trs&act=view">Data Transaksi</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
    <div class="box-header">
    <a href="?pg=trs&act=add"> <button type="button" class="btn btn-info"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
    </div><!-- /.box-header -->
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tanggal ChekIN</th>
                        <th>Pelanggan</th>
                        <th>Nama Kamar</th>
                        <th>Tanggal ChekOut</th>
                        <th>Total Biaya Sewa</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tampil=mysqli_query($db_conn, "SELECT * FROM tbltransaksi s join tblkamar t
                    on (s.idkamar=t.idkamar) join tblpelanggan p
                    on (s.idpelanggan=p.idpelanggan)  order by idtransaksi desc");
                    $no = 1;
                      while ($r=mysqli_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>
                        
                        <?php 
                        $tgltransaksi=tgl_indo($r['tgltransaksi']);
                        $tglcheckout=tgl_indo($r['tglcheckout']);
                        ?>

                        <td><?php echo "$tgltransaksi"?></td>
                        <td><?php echo "$r[nmpelanggan]"?></td>
                        <td><?php echo "$r[nmkamar]"?></td>
                        <td><?php echo "$tglcheckout"?></td>
                        <td><?php echo "Rp.". number_format("$r[totalbiayasewa]",'0','.','.')?></td>
                        <td><a href="?pg=trs&act=delete&id=<?php echo $r['idtransaksi']?>"><button type="button" class="btn btn-info" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
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
      // PROSES TAMBAH Data Transaksi //
      case 'add':
      if (isset($_POST['add'])) {

        $tgltransaksi = $_POST[tgltransaksi];
        $tglcheckout = $_POST[tglcheckout];
        $selisihHari = (strtotime($tglcheckout)-strtotime($tgltransaksi))/(60*60*24);

        $data = mysqli_fetch_array(mysqli_query($db_conn, "SELECT * from tblkamar where idkamar = '$_POST[idkamar]'"));          
        $biayasewa = $selisihHari * $data[biayasewa];

        
                $query = mysqli_query($db_conn, "INSERT INTO tbltransaksi VALUES ('$_POST[idtransaksi]',
                '$_POST[idPelanggan]','$_POST[idkamar]','$_POST[tgltransaksi]',
                '$_POST[tglcheckout]','$biayasewa')");
                echo "<script>window.location='home.php?pg=trs&act=view'</script>";
              }
              ?>

<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Transaksi </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=trs&act=view">Data Transaksi</a></li>
            <li class="active"><a href="#">Tambah Data Transaksi</a></li>
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
                      <?php
                      //memulai mengambil datanya
                      $sql = mysqli_query($db_conn, "SELECT * FROM tbltransaksi");
                      
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
                      $kode_jadi = "TRS$tahun$bikin_kode";

                      ?>
                      <label for="exampleInputEmail1">ID Transaksi</label>
                      <input type="text" class="form-control" id="idtrs" name="idtrs" placeholder="ID Transaksi" value="<?php echo $kode_jadi?>" required data-fv-notempty-message="Tidak boleh kosong" disabled>
                      <input type="hidden" class="form-control" id="idtransaksi" name="idtransaksi" placeholder="ID Transaksi" value="<?php echo $kode_jadi?>" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">ID Pelanggan</label>
                      <select class="form-control select2" name="idPelanggan" style="width: 100%;">
                      <option value="">--- Silahkan Pilih ---</option>
                      <optgroup label="--- Silahkan Pilih ---">
                      <?php
                      $tampil=mysqli_query($db_conn, "SELECT * FROM tblPelanggan  ORDER BY idpelanggan");
                      while($r=mysqli_fetch_array($tampil)){
                      ?>
                      <option value="<?php echo $r['idpelanggan']?>"><?php echo $r['nmpelanggan'] ?></option>
                      <?php
                    }
                    ?>
                    </optgroup>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">ID Kamar</label>
                      <select class="form-control select2" name="idkamar" style="width: 100%;">
                      <option value="">--- Silahkan Pilih ---</option>
                      <optgroup label="--- Silahkan Pilih ---">
                      <?php
                      $tampil=mysqli_query($db_conn, "SELECT * FROM tblkamar  ORDER BY idkamar");
                      while($r=mysqli_fetch_array($tampil)){
                      ?>
                      <option value="<?php echo $r['idkamar']?>"><?php echo $r['idkamar'] ?> || <?php echo $r['nmkamar'] ?></option>
                      <?php
                    }
                    ?>
                    </optgroup>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal CheckIN</label>
                      <input class="form-control" id="date" name="tgltransaksi" placeholder="MM/DD/YYY" type="text" required/>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Checkout</label>
                      <input class="form-control" id="date" name="tglcheckout" placeholder="MM/DD/YYY" type="text" required/>
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
      
      

    // PROSES HAPUS Data Transaksi //
      case 'delete':
      mysqli_query($db_conn, "DELETE FROM tbltransaksi WHERE idtransaksi='$_GET[id]'");
      echo "<script>window.location='home.php?pg=trs&act=view'</script>";
      break;

    }
    ?>