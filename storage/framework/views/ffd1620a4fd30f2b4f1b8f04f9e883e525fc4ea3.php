<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1>
        MANAGE GROUPING LAYANAN HC
    </h1>
    <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Master</a></li>
        <li class="active">Manage Grouping Layanan HC</li>
    </ol>
</section>

<section class="content">    
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Input Kategori Layanan</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
            
                <div class="box-body">
                    <div class="row">                        
                        <div class="col-md-12">
                            <form method="post">
                            <div class="form-group">
                                <label>Kategori Layanan</label>
                                <input type="email" class="form-control" id="kategori_layanana" name="kategori_layanana" placeholder="Kategori Layanan">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Layanan</label>                  
                                <textarea class="form-control" id="deskripsi_layanan" name="deskripsi_layanan" placeholder="Deskripsi Layanan"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>&nbsp;
                                <button type="reset" class="btn btn-primary">Cancel</button>
                            </div>
                            </form>
                        </div>            
                    </div>                
                </div>            
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
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
                            <td>Internet Explorer 4.0</td>
                            <td>Win 95+</td>
                            <td>
                            <a href="/master/kategori_layanan"><img src="<?php echo e(url('adminlte/dist/img/icon-edit.png')); ?>" width="20" height="20" title="Rubah Data"></a> | 
                            <img src="<?php echo e(url('adminlte/dist/img/icon-delete.png')); ?>" width="25" height="25" title="Hapus Data">
                            </td>
                        </tr>
                        <tr>
                            <td>Trident</td>
                            <td>Internet Explorer 5.0</td>
                            <td>Win 95+</td>
                            <td>
                            <img src="<?php echo e(url('adminlte/dist/img/icon-edit.png')); ?>" width="20" height="20"> | 
                            <img src="<?php echo e(url('adminlte/dist/img/icon-delete.png')); ?>" width="25" height="25">
                            </td>
                        </tr>
                        <tr>
                            <td>Trident</td>
                            <td>Internet Explorer 5.5</td>
                            <td>Win 95+</td>
                            <td>
                            <img src="<?php echo e(url('adminlte/dist/img/icon-edit.png')); ?>" width="20" height="20"> | 
                            <img src="<?php echo e(url('adminlte/dist/img/icon-delete.png')); ?>" width="25" height="25">
                            </td>
                        </tr>
                        <tr>
                            <td>Trident</td>
                            <td>Internet Explorer 6</td>
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
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pertamina_hc\resources\views//layouts/master/kategori_layanan.blade.php ENDPATH**/ ?>