<?php $__env->startSection('content'); ?>
	<section class="content-header">
      <h1>
        KATEGORI LAYANAN
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data Kategori Layanan</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Kategori Layanan</h3>
            </div>
            <div style="margin-left:10px"><button type="button" class="btn btn-primary" onclick="addKategoriLayanan()">Tambah Data</button></div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Layanan</th>
                  <th>Description</th>
                  <th>HC Support Group</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Trident</td>
                  <td>Internet
                    Explorer 4.0
                  </td>
                  <td>Win 95+</td>
                  <td>
                  <a href="/master/kategori_layanan"><img src="<?php echo e(url('adminlte/dist/img/icon-edit.png')); ?>" width="20" height="20" title="Rubah Data"></a> | 
                  <img src="<?php echo e(url('adminlte/dist/img/icon-delete.png')); ?>" width="25" height="25" title="Hapus Data">
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>Internet
                    Explorer 5.0
                  </td>
                  <td>Win 95+</td>
                  <td>
                  <img src="<?php echo e(url('adminlte/dist/img/icon-edit.png')); ?>" width="20" height="20"> | 
                  <img src="<?php echo e(url('adminlte/dist/img/icon-delete.png')); ?>" width="25" height="25">
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>Internet
                    Explorer 5.5
                  </td>
                  <td>Win 95+</td>
                  <td>
                  <img src="<?php echo e(url('adminlte/dist/img/icon-edit.png')); ?>" width="20" height="20"> | 
                  <img src="<?php echo e(url('adminlte/dist/img/icon-delete.png')); ?>" width="25" height="25">
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>Internet
                    Explorer 6
                  </td>
                  <td>Win 98+</td>
                  <td>
                  <img src="<?php echo e(url('adminlte/dist/img/icon-edit.png')); ?>" width="20" height="20"> | 
                  <img src="<?php echo e(url('adminlte/dist/img/icon-delete.png')); ?>" width="25" height="25">
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>Internet Explorer 7</td>
                  <td>Win XP SP2+</td>
                  <td>
                  <img src="<?php echo e(url('adminlte/dist/img/icon-edit.png')); ?>" width="20" height="20"> | 
                  <img src="<?php echo e(url('adminlte/dist/img/icon-delete.png')); ?>" width="25" height="25">
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>AOL browser (AOL desktop)</td>
                  <td>Win XP</td>
                  <td>
                  <img src="<?php echo e(url('adminlte/dist/img/icon-edit.png')); ?>" width="20" height="20"> | 
                  <img src="<?php echo e(url('adminlte/dist/img/icon-delete.png')); ?>" width="25" height="25">
                  </td>
                </tr>                
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->      
    </section>
    <script>
    	function addKategoriLayanan(){
    		window.location.href="/master/kategori_layanan";
    	}
    </script>
<?php $__env->stopSection(); ?>    
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\belajar_laravel\resources\views//layouts/master/kategori_layanan_list.blade.php ENDPATH**/ ?>