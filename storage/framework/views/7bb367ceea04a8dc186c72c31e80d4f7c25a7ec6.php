<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper mt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a href="<?php echo e(route('account-add')); ?>" class="btn btn-success end-0 m-2" style=""><i
                            class="fas fa-plus"></i> Thêm mới</a>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách tài khoản</h3>
                            <form class="card-tools" action="<?php echo e(route('account-list')); ?>">
                                
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <?php echo csrf_field(); ?>
                                    <input type="text" name="keyword" value="<?php echo e(old('keyword', '')); ?>"
                                        class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>

                                </div>
                                
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tài khoản</th>
                                        <th>Họ và tên</th>
                                        <th>Nhóm quyền</th>
                                        <th>Ngày tạo</th>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit users')): ?>
                                            <th>Thao tác</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $account; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key + 1); ?></td>
                                            <td><?php echo e($value->username); ?></td>
                                            <td><?php echo e($value->name); ?></td>
                                            <td><span class="badge badge-info"><?php echo e($value->getRoleNames()); ?></span></td>
                                            <td><?php echo e($value->created_at); ?></td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit users')): ?>
                                                <td>
                                                    <div class=" text-center">
                                                        <a href="javascript:void(0)" data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle">
                                                            <span class="fas fa-cog"></span>
                                                        </a>
                                                        <ul class="dropdown-menu" id="dropdown<?php echo e($value->id); ?>">
                                                            <li>
                                                                <a href="<?php echo e(route('post-account-edit', ['id' => $value->id])); ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                    Chỉnh sửa
                                                                </a>
                                                            </li>
                                                            <li class="remove-button">
                                                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')" href="#" >
                                                                    <i class="fa fa-trash" aria-hidden="true"></i> Xóa 
                                                                </a>
                                                            
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ap24h/Desktop/iot/resources/views/backend/account/index.blade.php ENDPATH**/ ?>