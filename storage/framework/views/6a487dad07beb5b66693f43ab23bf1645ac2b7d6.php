<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper mt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách email liên hệ </h3>
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
                            <table class="table table-head-fixed table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Họ tên</th>
                                        <th>Email</th>
                                        <th>Title</th>
                                        <th>Ngày tạo</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($contact) <= 0): ?>
                                        <tr>
                                            <td>
                                                <p>(Không có dữ liệu)</p>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php $__currentLoopData = $contact; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="contact_id_<?php echo e($value->id); ?>">
                                            <td class="contact_name"><?php echo e(($value->fullname)?$value->fullname:'Khách hàng'); ?></td>
                                            <td class="contact_email"><?php echo e($value->email); ?></td>
                                            <td class="contact_title"><?php echo e($value->title); ?></td>
                                            <td class="contact_time"><?php echo e($value->created_at); ?></td>
                                            <td class="d-none contact_content"><?php echo e($value->content); ?></td>
                                            <td class="d-none contact_phone"><?php echo e($value->phone); ?></td>
                                            <td class="d-none contact_addres"><?php echo e($value->addres); ?></td>
                                            <td >
                                                <a href="javascript:void(0)" class="see_click" data-id="<?php echo e($value->id); ?>">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                
                                            </td>
                                            
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
    <div class="modal fade" id="create_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thông tin email đăng ký liên hệ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="title">Họ và tên : </label>
                        <span id="contact_name"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="title">Số điện thoại : </label>
                        <span id="contact_phone"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="title">Email : </label>
                        <span id="contact_email"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="title">Địa chỉ : </label>
                        <span id="contact_addres"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="exampleCheck1">Tiêu đề :</label>
                        <span id="contact_title"> Tiêu đề</span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="exampleCheck1">Nội dung :</label>
                        <p id="contact_content" class="ml-2"> Nội dung</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            $('.see_click').click(function() { 
                var id = $(this).attr('data-id');
                var name = $(this).parents('.contact_id_'+id+'').children('.contact_name')[0].innerText;
                var email = $(this).parents('.contact_id_'+id+'').children('.contact_email')[0].innerText;
                var phone = $(this).parents('.contact_id_'+id+'').children('.contact_phone')[0].innerText;
                var addres = $(this).parents('.contact_id_'+id+'').children('.contact_addres')[0].innerText;
                var title = $(this).parents('.contact_id_'+id+'').children('.contact_title')[0].innerText;
                var content = $(this).parents('.contact_id_'+id+'').children('.contact_content')[0].innerText;
                var time = $(this).parents('.contact_id_'+id+'').children('.contact_time')[0].innerText;

                $('#contact_name').html(name);
                $('#contact_email').html(email);
                $('#contact_phone').html(phone);
                $('#contact_addres').html(addres);
                $('#contact_title').html(title);
                $('#contact_content').html(content);
                $('#contact_time').html(time);
                console.log(name);
                $('#create_model').modal('show');
            })
            
           
            $('#submit_category').click(function() { 
                $(this).prop('disabled', true);
                $('#form_category').submit(); 
            })

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ap24h/Desktop/iot/resources/views/backend/contact/index.blade.php ENDPATH**/ ?>