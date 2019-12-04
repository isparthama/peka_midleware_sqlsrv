<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1>MITRA KERJA</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Master</a></li>
            <li class="active">Mitra Kerja</li>
        </ol>
    </section>

    <section class="content">
        
        <div class="row">
            <div class="col-md-6">
                <div class="box box-default">           
                    <div class="box-body">
                        <div class="row">                        
                            <div class="col-md-12">
                                <form role="form">
                                    <div class="form-group">
                                        <label>Mitra Kerja</label>
                                        <select class="form-control select2" style="width: 100%;">
                                            <option selected="selected">[Mitra Kerja]</option>
                                            <option>PT. Agung Berkah Jaya</option>
                                            <option>PT. Mulia Anugerah Putera</option>
                                            <option>PT. Multimedia Infokom</option>
                                            <option>CV. Perkasa Mulia Abadi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Fungsi</label>
                                        <select class="form-control select2" style="width: 100%;">
                                            <option selected="selected">[Pilih Fungsi]</option>
                                            <option></option>
                                        </select>
                                    </div>    
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Search</button>
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
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Perusahaan</th>
                                    <th>Gender</th>
                                    <th>Cost Center Name</th>
                                    <th>Cost Center</th>
                                    <th>Position</th>
                                    <th>Address</th>
                                    <th>KTP ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Trident</td>
                                    <td>user1@test.com</td>
                                    <td>PT. Agung Berkah Jaya</td>
                                    <td>1</td>
                                    <td>SCM Manager</td>
                                    <td>130011</td>
                                    <td></td>
                                    <td>Jakarta Barat</td>
                                    <td>1213124124141</td>
                                </tr>                                            
                            </tbody>
                        </table>                              
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pertamina_hc\resources\views//layouts/master/mitra_kerja.blade.php ENDPATH**/ ?>