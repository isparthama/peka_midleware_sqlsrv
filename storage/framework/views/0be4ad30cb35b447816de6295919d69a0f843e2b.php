<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1>DATA PEKERJA</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Master</a></li>
            <li class="active">Data Pekerja</li>
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
                                        <label>Nama Pekerja</label>
                                        <select class="form-control select2" style="width: 100%;">
                                            <option selected="selected">[Nama Pekerja]</option>
                                            <option>Sigit Kurniawan</option>
                                            <option>I Ketut Sakho</option>
                                            <option>Muh Istian</option>
                                            <option>Hendra Setiawan</option>
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
                                    <th>No.Pekerja</th>
                                    <th>Assign</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>DOB</th>
                                    <th>Gender</th>
                                    <th>Position ID</th>
                                    <th>Position Name</th>
                                    <th>Parent Position ID</th>
                                    <th>Company Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Trident</td>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>user1@test.com</td>
                                    <td>1231231</td>
                                    <td>1</td>
                                    <td>120001</td>
                                    <td>Analyst Control</td>
                                    <td>130011</td>
                                    <td>12220</td>
                                </tr>                                            
                            </tbody>
                        </table>                              
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pertamina_hc\resources\views//layouts/master/data_pekerja.blade.php ENDPATH**/ ?>