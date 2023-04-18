<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sửa tài khoản </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin')); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="<?php echo e(route('account-list')); ?>">Nhân sự</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                
                <form action="<?php echo e(route('post-account-edit',['id'=>$data['user']->id])); ?>" method="post" id="submitForm" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="<?php echo e($data['user']->id); ?>">
                    <div class="row">
                        <div class="col-md-11" style="margin: auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="row">
                                                        <div class="form-group col-sm-6">
                                                            <div class="wrap-count field-news-title has-success">
                                                                <label class="control-label" for="f_name">Họ và Tên <span
                                                                        style="color: red">*</span></label>
                                                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span style="color: red; font-size: 14px"><?php echo e($message); ?>

                                                                    </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                <input type="text" id="name" value="<?php echo e(old('name',$data['user']->name)); ?>"
                                                                    class="form-control" name="name" aria-invalid="false">
                                                                <div class="help-block"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <div class="wrap-count field-news-title has-success">
                                                                <label class="control-label" for="f_username">Tên đăng nhập<span
                                                                        style="color: red">*</span></label>
                                                                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span style="color: red; font-size: 14px"><?php echo e($message); ?>

                                                                    </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                <input type="text" id="username" value="<?php echo e(old('username',$data['user']->username)); ?>"
                                                                    class="form-control" name="username" aria-invalid="false">
                                                                <div class="help-block"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <div class="wrap-count field-news-title has-success">
                                                                <label class="control-label" for="f_password">Password <span
                                                                        style="color: red">*</span></label>
                                                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span style="color: red; font-size: 14px"><?php echo e($message); ?>

                                                                    </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                <input type="password" id="password" value=""
                                                                    class="form-control" name="password" aria-invalid="false">
                                                                <div class="help-block"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <div class="wrap-count field-news-title has-success">
                                                                <label class="control-label" for="f_email">Email <span
                                                                        style="color: red">*</span></label>
                                                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span style="color: red; font-size: 14px"><?php echo e($message); ?>

                                                                    </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                <input type="email" id="email" value="<?php echo e(old('email',$data['user']->email)); ?>"
                                                                    class="form-control" name="email" aria-invalid="false">
                                                                <div class="help-block"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="wrap-count field-news-description has-success">
                                                                <label class="d-block control-label" for="content">Ảnh đại diện </label>
                                                                <?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <p style="color: red; font-size: 14px">* <?php echo e($message); ?></p>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                <div class="img__avatar text-center position-relative"  style="width: 250px;margin: auto">
                                                                    <img  id ="avatar-show" src="<?php echo e($data['user']->avatar ?? asset('backend/dist/img/default.jpg')); ?>" alt="" style="width: 100%">
                                                                    <div class="input__file ">
                                                                        <input class="position-absolute" style="width: 100%;height: 100%;top: 0;left: 0;opacity: 0" type="file" id="avatar" name="avatar"  >
                                                                    </div>
                                                                </div>
                                                                <div class="help-block"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="card card-primary">
                                                        <div class="card-header p-2">
                                                            <h3 class="card-title"><i class="fas fa-cog pr-2"></i>Cài đặt
                                                                quyền</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <?php $__currentLoopData = $data['list_role']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <div class="form-group col-sm-4">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"name="role[]" 
                                                                                value="<?php echo e($value->name); ?>" <?=($data['user']->hasRole($value->name))?'checked':''?> type="checkbox" id="exampleCheck<?php echo e($key); ?>">
                                                                            <label for="exampleCheck<?php echo e($key); ?>"
                                                                                class="form-check-label"><?php echo e($value->name); ?></label>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer" style="margin-top: -1.25rem;" >
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    $('#avatar').change(function () {
            const [file] =(this).files;
            if (file) {
                console.log(URL.createObjectURL(file))
                $('#avatar-show').attr("src", URL.createObjectURL(file));
            }
        })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ap24h/Desktop/iot/resources/views/backend/account/update-account.blade.php ENDPATH**/ ?>