<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Kontak Kami </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Kontak</a></li>
             </ol>
        </section>

<section class="content">
	  <!-- Main row -->
    <div class="row">
    <!-- Left col -->
        <section class="col-md-12 connectedSortable">

        <div class="box box-info">
            <div class="box-body">
                <div class="col-md-6">
                <div class="box-body">
                    <div class="form-group">
                        <label for="InputNama">Nama</label>
                        <input type="text" class="form-control" name="nama" required data-fv-notempty-message="Tidak Boleh Kosong">
                    </div> <!-- /.form-group -->

                    <div class="form-group">
                        <label for="InputEmail">Email</label>
                        <input type="email" class="form-control" name="email" required data-fv-notempty-message="Tidak Boleh Kosong">
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label for="InputText">Pesan</label>
                        <textarea class="form-control" id="TextArea" rows="3"></textarea>
                    </div><!-- /.form-group -->

                    <button type="submit" name='kirim' class="btn btn-info">Kirim</button>
                </div> <!-- /.box-body -->
                </div><!-- /.col-md-6 -->

                <div class="col-md-6">
                    <div id="googleMap" style="width:100%;height:380px;"></div>
                </div><!-- /.col.md-6 -->
            </div><!-- /.box-body -->
        </div><!-- /.box-info -->

        </section>
    <!-- right col -->
    </div>

    <!-- /.row (main row) -->
</section> <!-- /.content -->

    </div><!-- /.container -->
</div><!-- /.content-wrapper -->