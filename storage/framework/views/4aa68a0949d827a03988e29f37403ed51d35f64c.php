
<div class="modal-dialog" data-width="600">
    <div class="modal-content">
        <form action="<?php echo e(route('update-node',['id'=>$data->id])); ?>" method="post" id="form_category">
        <?php echo method_field('post'); ?>
        <?php echo csrf_field(); ?>
        <input hidden name="id" value="<?php echo e($data->id); ?>">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sửa thông tin node - <span class="name-title-header"><?php echo e($data->name); ?></span> </h5>
            <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
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
                <input type="text" class="form-control" name="name" id="name" value="<?php echo e($data->name); ?>"
                    aria-describedby="emailHelp" placeholder="">
            </div>
            <div class="form-group">
                <small id="code" class="form-text text-muted">Code</small>
                <input type="text" name="code" class="form-control" id="code" value="<?php echo e($data->code); ?>">
            </div>
            <div class="form-group">
                <label for="gateway_id">gateway</label> 
                <select class="form-control user_cms" id="gateway_id" name="gateway_id">
                    <option value="" >không chọn</option>
                    <?php $__currentLoopData = $listGateway; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->id); ?>" <?php echo e(($item->id == $data->gateway_id) ? 'selected="selected"':''); ?>><?php echo e($item->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
            
        </div>
        <div class="modal-footer">
            <button class="btn btn-success" type="submit" id="submit_category">Cập nhật</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
        </div>
        </form>
    </div>
</div>
<script>
</script><?php /**PATH /Users/ap24h/Desktop/iot/resources/views/backend/node/edit.blade.php ENDPATH**/ ?>