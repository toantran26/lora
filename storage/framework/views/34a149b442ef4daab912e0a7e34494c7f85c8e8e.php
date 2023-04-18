<?php $__env->startSection('style'); ?>
    <link rel="stylesheet"
        href="<?php echo e(request()->getSchemeAndHttpHost()); ?>/library/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet"
        href="<?php echo e(request()->getSchemeAndHttpHost()); ?>/library/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo e(request()->getSchemeAndHttpHost()); ?>/library/plugins/jqvmap/jqvmap.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo e(request()->getSchemeAndHttpHost()); ?>/library/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo e(request()->getSchemeAndHttpHost()); ?>/library/plugins/summernote/summernote-bs4.min.css">
    <style>
        
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="card mt-5">
                <div class="card-header">
                    <h3 class="card-title"> Thông số giám sát </h3>
                </div>
                <!-- /.card-header -->
                <div class="">
                    <div class="card-body">
                        <div class="row mt-4">
                            <div class="col-lg-6 max-height-box">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h3 class="card-title">Giám sát gateway1</h3>
                                        <div class="card-tools">
                                            <a href="#" class="btn btn-tool btn-sm">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <a href="#" class="btn btn-tool btn-sm">
                                                <i class="fas fa-bars"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-striped table-valign-middle">
                                            <thead>
                                                <tr>
                                                    <th>Nhiệt độ</th>
                                                    <th>Độ ẩm</th>
                                                    <th>Pin</th>
                                                </tr>
                                            </thead>
                                            <tbody id="gateway1">
                                                <?php $__currentLoopData = $listSensor1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><span class="temp"><?php echo e($item->temperature); ?></span>&deg;C</td>
                                                    <td><span class="hum"><?php echo e($item->humidity); ?></span>%</td>
                                                    <td><span class="bat"><?php echo e($item->acquy); ?> </span>%</td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 max-height-box">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h3 class="card-title">Giám sát gateway 2</h3>
                                        <div class="card-tools">
                                            <a href="#" class="btn btn-tool btn-sm">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <a href="#" class="btn btn-tool btn-sm">
                                                <i class="fas fa-bars"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-striped table-valign-middle">
                                            <thead>
                                                <tr>
                                                    <th>Nhiệt độ</th>
                                                    <th>Độ ẩm</th>
                                                    <th>Pin</th>
                                                </tr>
                                            </thead>
                                            <tbody id="gateway2">
                                                <?php $__currentLoopData = $listSensor2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><span class="temp"><?php echo e($item->temperature); ?></span>&deg;C</td>
                                                    <td><span class="hum"><?php echo e($item->humidity); ?></span>%</td>
                                                    <td><span class="bat"><?php echo e($item->acquy); ?> </span>%</td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="<?php echo e(asset('library/plugins/chart.js/Chart.min.js')); ?>"></script>
    <!-- Sparkline -->
    <script src="<?php echo e(asset('library/plugins/sparklines/sparkline.js')); ?>"></script>
    <!-- JQVMap -->

    

    <!-- jQuery Knob Chart -->
    <script src="<?php echo e(asset('library/plugins/jquery-knob/jquery.knob.min.js')); ?>"></script>
    <!-- daterangepicker -->
    <script src="<?php echo e(asset('library/plugins/moment/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('library/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?php echo e(asset('library/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>
    <!-- Summernote -->
    <script src="<?php echo e(asset('library/plugins/summernote/summernote-bs4.min.js')); ?>"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ap24h/Desktop/iot/resources/views/backend/home.blade.php ENDPATH**/ ?>