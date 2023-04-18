<aside class="main-sidebar sidebar-dark-primary elevation-4 bg-menu">
    <!-- Brand Logo -->
    
        <a href="{{ route('admin') }}" class="brand-link" style="float: right; text-align: center">
            
                <span class="brand-text font-weight-light">
                    <img src="{{request()->getSchemeAndHttpHost()}}/backend/dist/img/logo_2.jpeg" alt="" class="brand-image"
                    style="float: unset;">
                </span>
        </a>
 

    <!-- Sidebar -->
    <div class="sidebar" style="margin-top: 57px">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"  data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('account-list')}}" class="nav-link {{route('account-list') == URL::current()?'active':''}}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Tài khoản
                            <span class="badge badge-info right"></span>
                        </p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{route('gateway-list')}}" class="nav-link {{route('gateway-list') == URL::current()?'active':''}}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Gateway
                            {{-- <span class="badge badge-info right"></span> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('node-list')}}" class="nav-link {{route('node-list') == URL::current()?'active':''}}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Node
                            <span class="badge badge-info right"></span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <p>
                            About
                        </p>
                    </a>
                </li>
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
