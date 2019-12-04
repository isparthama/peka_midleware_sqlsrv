<?php $__env->startSection('content'); ?>
	<section class="content-header">
      <h1>
        MANAGE GROUPING LAYANAN HC 
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Master</a></li>
        <li class="active">Manage Grouping Layanan HC</li>
      </ol>
    </section>
    
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="kategoriLayanan" class="col-sm-2 control-label">Kategori Layanan</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="kategori_layanana" name="kategori_layanana" placeholder="Kategori Layanan">
                  </div>
                </div>
                <div class="form-group">
                  <label for="deskripsiLayanan" class="col-sm-2 control-label">Deskripsi Layanan</label>

                  <div class="col-sm-10">
                    <textarea class="form-control" id="deskripsi_layanan" name="deskripsi_layanan" placeholder="Deskripsi Layanan"></textarea>
                  </div>
                </div>
              </div>            
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
       </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\belajar_laravel\resources\views//layouts/master/kategori_layanan.blade.php ENDPATH**/ ?>