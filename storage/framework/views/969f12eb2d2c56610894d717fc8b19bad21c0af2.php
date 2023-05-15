<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper mt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="content-header">
                            <div class="float-right">
                                <form class="card-tools" action="">
                                    <div class="input-group input-group-sm" style="width: 350px;">
                                        <input type="text" name="keyword" value="<?php echo e(@$_GET['keyword']); ?>"
                                            class="form-control float-right" placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-header">
                            <h3 class="card-title" style="font-size: 24px">Quản lý Node </h3>
                            <div class="float-right">
                                <a href="#" role="button" data-toggle="modal" data-target="#create_model"
                                    class="btn btn-success"><i class="fas fa-plus"></i> Thêm mới</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tên node</th>
                                        <th>ID</th>
                                        <th>Gateway</th>
                                        <th>Loại node</th>
                                        
                                        <th>Thao tác</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $listNode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><a data-id="<?php echo e($value->id); ?>" href="<?php echo e(route('detail-node',['id'=>$value->id])); ?>"><?php echo e($value->name); ?> <a></td>
                                            <td><?php echo e($value->code); ?></td>
                                            <td><?php echo e($value->gateway->name); ?></td>
                                            <td><?php echo e(($value->type == 1) ?'AN (điều kiển)':'SN nhận dữ liệu'); ?></td>

                                            
                                            <td>
                                                <div class=" text-center">
                                                    <a href="javascript:void(0)" data-toggle="dropdown"
                                                        class="btn-default btn-xs dropdown-toggle">
                                                        <span class="fas fa-cog"></span>
                                                    </a>
                                                    <ul class="dropdown-menu" id="dropdown<?php echo e($value->id); ?>">
                                                      <li>
                                                        <a data-id="<?php echo e($value->id); ?>" href="<?php echo e(route('detail-node',['id'=>$value->id])); ?>">
                                                          <i class="fas fa-info-circle"></i>
                                                              Chi tiết
                                                        </a>
                                                      </li>
                                                        <li>
                                                            <a class="btn_edit" data-id="<?php echo e($value->id); ?>"
                                                                href="<?php echo e(route('edit-node', ['id' => $value->id])); ?>">
                                                                <i class="fas fa-edit"></i>
                                                                Chỉnh sửa
                                                            </a>
                                                        </li>
                                                        <li class="remove-button">
                                                            <a class="delete-node"
                                                                data-toppic="remove#<?php echo e(hexdec($value->code)); ?>"
                                                                data-push="<?php echo e($value->gateway->code . '/' . $value->gateway->remote); ?>"
                                                                href="<?php echo e(route('delete-node', ['id' => $value->id])); ?>">
                                                                <i class="fa fa-trash" aria-hidden="true"></i> Xóa
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php if(count($listNode) <= 0): ?>
                                <p
                                    style="font-size: 24px;color: #999;margin: 38px 0;font-style: italic;text-align: center;">
                                    Không có bản ghi nào!</p>
                            <?php endif; ?>
                        </div>
                        <!-- /.card-body -->
                        <div class="d-flex mt-3 ml-4">
                            <?php echo $__env->make('component.pagination-admin', $object = $listNode, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                <form action="#" method="post" id="form_category">
                    <?php echo method_field('post'); ?>
                    <?php echo csrf_field(); ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm mới Node </h5>
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
                            <small class="form-text text-muted">ID</small>
                            <input type="text" name="code" class="form-control" id="code">
                        </div>
                        <div class="form-group">
                            <label for="gateway_id">gateway</label>
                            <select class="form-control user_cms" id="gateway_id" name="gateway_id">
                                <option value="">không chọn</option>
                                <?php $__currentLoopData = $listGateway; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="work_shift_id">loại node </label>
                            <div class="work_shift_checkbox clearfix">
                                <div class="icheck-primary d-inline pr-3">
                                    <input type="radio" id="checkboxPrimary0" value="1" checked name="type">
                                    <label for="checkboxPrimary0">
                                        AN (điều khiển)
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="checkboxPrimary1" value="2" name="type">
                                    <label for="checkboxPrimary1">
                                        SN (giám sát)
                                    </label>
                                </div>
                            </div>
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
    <div id="modal_node_type" class="modal fade royalty-post" data-backdropz="static" data-width="600"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function() {
            $('#submit_category').on('click', function(event) {
                event.preventDefault();
                var name = $('#name').val();
                var code = $('#code').val();
                var gateway_id = $('#gateway_id').val();
                var form_data = new FormData();
                form_data.append('name', name);
                form_data.append('code', code);
                form_data.append('gateway_id', gateway_id);
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    type: "POST",
                    url: "<?php echo e(route('node-store')); ?>",
                    data: form_data,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(result) {
                        console.log(result.data);
                        if (result.success) {
                            public(result.push, result.toppic);
                            toastr["success"](result.success);
                            setTimeout(() => {
                                location.reload();
                            }, "1000");
                            $(this).off(event);
                        } else {
                            $.each(result.error, function(key, value) {
                                toastr["error"](value);
                            });
                        }
                    }
                })
            })
        });
        $(document).ready(function() {
            $('a.delete-node').on('click', function(event) {
                event.preventDefault();
                const confirmation = confirm('Bạn có chắc chắn muốn xóa node này?');
                if (confirmation) {
                    var push = $(this).attr('data-push');
                    var toppic = $(this).attr('data-toppic');
                    public(push, toppic);

                    // console.log(push);
                    // console.log(toppic);
                    window.location.href = $(this).attr('href');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $('.btn_edit').click(function() {
                var id = $(this).data('id');
                var $modal_node_type = $('#modal_node_type');
                $modal_node_type.load('/node/edit/' + id, '', function() {
                    $modal_node_type.modal().on("hidden", function() {
                        $modal_node_type.empty();
                    });
                });
                return false;
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ap24h/Desktop/iot/resources/views/backend/node/index.blade.php ENDPATH**/ ?>