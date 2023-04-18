<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper mt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="p-2">
                        <a href="#" role="button" data-toggle="modal" data-target="#create_model"
                            class="btn btn-success"><i class="fas fa-plus"></i> Thêm mới</a>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách GateWay </h3>
                            <form class="card-tools" action="">
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
                            <table class="table  table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>code</th>
                                        <th>rec</th>
                                        <th>remote</th>
                                        <th class="text-center">thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $listGateWay; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                      <td><a data-id="<?php echo e($value->id); ?>" href="<?php echo e(route('detail-gateway',['id'=>$value->id])); ?>"><?php echo e($value->name); ?> <a></td>
                                      <td><?php echo e($value->code); ?></td>
                                      <td><?php echo e($value->rec); ?></td>
                                      <td><?php echo e($value->remote); ?></td>
                                      <td>
                                        <div class="text-center">
                                          <a href="javascript:void(0)" data-toggle="dropdown"
                                            class="btn-default btn-xs dropdown-toggle">
                                            <span class="fas fa-cog"></span>
                                          </a>
                                          <ul class="dropdown-menu" id="dropdown<?php echo e($value->id); ?>">
                                            <li>
                                              <a data-id="<?php echo e($value->id); ?>" href="<?php echo e(route('detail-gateway',['id'=>$value->id])); ?>">
                                                <i class="fas fa-info-circle"></i>
                                                    Chi tiết
                                              </a>
                                            </li>
                                            <li>
                                              <a class="btn_edit" data-id="<?php echo e($value->id); ?>" href="<?php echo e(route('edit-gateway',['id'=>$value->id])); ?>">
                                                <i class="fas fa-edit"></i>
                                                Chỉnh sửa
                                              </a>
                                            </li>
                                          </ul>
                                        </div>
                                      </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="create_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?php echo e(route('gateway-store')); ?>" method="post" id="form_category">
                    <?php echo method_field('post'); ?>
                    <?php echo csrf_field(); ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm mới GateWay </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Tên</label>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p style="color: red; font-size: 14px">* <?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <input type="text" class="form-control" name="name" id="name"
                                aria-describedby="emailHelp" placeholder="">
                        </div>
                        <div class="form-group">
                            <small id="code" class="form-text text-muted">Code</small>
                            <input type="text" name="code" class="form-control" id="code">
                        </div>
                        <div class="form-group">
                            <label for="rec">rec</label>
                            <?php $__errorArgs = ['rec'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p style="color: red; font-size: 14px">* <?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <input type="text" name="rec" class="form-control" id="rec">
                        </div>
                        <div class="form-group">
                            <label for="remote">remote</label>
                            <?php $__errorArgs = ['remote'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p style="color: red; font-size: 14px">* <?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <input type="text" name="remote" class="form-control" id="remote">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit" id="submit_category">Lưu lại</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="modal_gateway_type" class="modal fade" data-backdropz="static" data-width="600"></div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        <?php if($errors->any()): ?>
            $('#create_model').modal('show');
        <?php endif; ?>
        $(document).ready(function () {
            $('#submit_category').click(function() { 
                $(this).prop('disabled', true);
                $('#form_category').submit(); 
            })
        });
    </script>
    <script>
        $(document).ready(function(){
          $('.btn_edit').click(function(){
              var id = $(this).data('id');
              var $modal_gateway_type = $('#modal_gateway_type');
              $modal_gateway_type.load('/gateway/edit/'+id, '', function(){
                  $modal_gateway_type.modal().on("hidden", function() {
                      $modal_gateway_type.empty();
                  });
              });
              return false;
          });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ap24h/Desktop/iot/resources/views/backend/gateway/index.blade.php ENDPATH**/ ?>