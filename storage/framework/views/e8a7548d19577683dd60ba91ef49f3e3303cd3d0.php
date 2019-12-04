<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1>
    REQUEST TICKETING
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
        <li>Ticketing</li>
        <li class="active">Data Request</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                </div>
                <div style="margin-left:10px"><button type="button" class="btn btn-primary" onclick="addRequest()">Tambah Data</button></div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Requestor</th>
                            <th>Kategori Layanan</th>
                            <th>Permintaan</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $request_ticket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$rt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($index+1); ?></td>
                                <td><?php echo e($rt->nama_requestor); ?></td>
                                <td><?php echo e($rt->kategori_layanan); ?></td>
                                <td><?php echo e($rt->permintaan); ?></td>
                                <td><?php echo e($rt->status_doc); ?></td>
                                <td>
                                <a href="/ticketing/request/edit_data/<?php echo e($rt->id); ?>">
                                <img src="<?php echo e(url('adminlte/dist/img/icon-edit.png')); ?>" width="20" height="20" title="Rubah Data">
                                </a> |
                                <a href="#<?php echo e($rt->id); ?>" onclick="deleteData('<?php echo e($rt->id); ?>')">
                                  <img src="<?php echo e(url('adminlte/dist/img/icon-delete.png')); ?>" width="22" height="22" title="Hapus Data">
                                </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function addRequest(){
        window.location.href="<?php echo e(url('/ticketing/request/add_data')); ?>";
    }

    function deleteData(id){
      var tny = confirm("Yakin Akan Menghapus Data Ini ?"+id);
      if(tny == 1){
        window.location.href = "/api/ticketing/request/"+id;
      }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pertamina_hc\resources\views//layouts/ticketing/request_list.blade.php ENDPATH**/ ?>