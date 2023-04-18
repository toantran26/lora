


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login </title>

    <link href="<?php echo e(asset('backend/dist/img/logo.jpeg')); ?>" rel="shortcut icon" type="image/x-icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(request()->getSchemeAndHttpHost()); ?>/library/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo e(request()->getSchemeAndHttpHost()); ?>/library/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(request()->getSchemeAndHttpHost()); ?>/backend/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page" style="background-image: url(<?php echo e(asset('backend/dist/img/image_login.png')); ?>);background-repeat: no-repeat; background-size: cover; min-height: 366px;">
<div class="login-box">
    <div class="card card-outline pt-4 ">
        <div class="text-center">
            <img style="width: 100px;height: auto;margin-bottom: 10px;" src="<?php echo e(asset('backend/dist/img/logo_2.jpeg')); ?>">
            <p style="font-weight: 700; color: #666" class="h5 pb-3">Hệ thống điều khiển</p>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('action-login')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <label style="color: red; font-size: 14px">* <?php echo e($message); ?></label>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="input-group mb-4">
                    <input type="text" name="username" class="form-control " style="height: 40px;" placeholder="Tên đăng nhập">
                    <div class="input-group-append">
                        <div class="input-group-text" style="background: none; border: none; position: absolute;right: 0;top: 0;bottom: 0;">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <label style="color: red; font-size: 14px">* <?php echo e($message); ?></label>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="input-group mb-4" >
                    <input type="password" name="password" style="height: 40px;" class="form-control" placeholder="Mật khẩu">
                    <div class="input-group-append">
                        <div class="input-group-text" style="background: none; border: none;position: absolute;right: 0;top: 0;bottom: 0;">
                            <span class="fas fa-key"></span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-info btn-block">Đăng nhập</button>
                </div>
            </form>

            

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo e(request()->getSchemeAndHttpHost()); ?>/library/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(request()->getSchemeAndHttpHost()); ?>/library/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(request()->getSchemeAndHttpHost()); ?>/backend/dist/js/adminlte.min.js"></script>
</body>
</html>
<?php /**PATH /Users/ap24h/Desktop/iot/resources/views/backend/authenticate/login.blade.php ENDPATH**/ ?>