<!-- Preloader -->

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo e(route('admin')); ?>" class="nav-link">Home</a>
        </li>
        
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        

        <!-- Messages Dropdown Menu -->
        
        <!-- Notifications Dropdown Menu -->
        
        
        <li class="dropdown user nav-item">
            <a id="exp_my_profile" href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <?php if(empty(Auth::user()->avatar)): ?>
                    <img src="<?php echo e(asset('backend/dist/img/avatar.png')); ?>" class="img-circle elevation-2" width="29" height="29" alt="User Image">
                <?php else: ?>
                    <img src="<?php echo e(Auth::user()->avatar); ?>" class="img-circle elevation-2" width="29" height="29" alt="User Image">
                <?php endif; ?>
                <span class="username" data-id="8"><?php echo e(Auth::user()->name); ?></span>
                <i class="icon-angle-down"></i>
            </a>
            <ul class="dropdown-menu">
                
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="javascript:void(0)" role="button">
                        <i class="pr-1 fas fa-expand-arrows-alt"></i>Toàn màn hình
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="#" role="button" title="log out" data-toggle="modal" data-target="#logoutModal">
                        <i class="pr-1 fas fa-sign-out-alt"> </i>Thoát
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Đăng xuất</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn đăng xuất?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                <form action="<?php echo e(route('logout')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-danger" type="submit" >Đồng ý</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Users/ap24h/Desktop/iot/resources/views/backend/layout/header.blade.php ENDPATH**/ ?>