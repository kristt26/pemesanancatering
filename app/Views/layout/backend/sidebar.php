<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-navy bg-custom1 elevation-4">
    <a href="../assets/backend/index3.html" class="brand-link">
        <img src="../assets/backend/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                <?php  if(session()->get('role')=='Admin'):?>
                <li class="nav-item">
                    <a href="../widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=base_url('admin/menu')?>" class="nav-link {{title=='Menu Makanan' ? 'active': ''}}">
                        <i class="nav-icon fas fa-utensils"></i>
                        <p>
                            Menu Makanan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=base_url('admin/paket')?>" class="nav-link {{title=='Paket Makanan' ? 'active': ''}}">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            Paket Makanan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=base_url('admin/pegawai')?>" class="nav-link {{title=='Pegawai' ? 'active': ''}}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Pegawai
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?=base_url('admin/customer')?>" class="nav-link {{title=='Customer' ? 'active': ''}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Customer
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=base_url('admin/pesanan')?>" class="nav-link {{title=='Pesanan' ? 'active': ''}}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Pesanan
                            <span ng-if="warning > 0" class="right badge badge-warning">{{warning}}</span>
                        </p>
                    </a>
                </li>
                <?php endif;?>


                <?php  if(session()->get('role')=='Customer'):?>
                <li class="nav-item">
                    <a href="<?=base_url('customer/home')?>" class="nav-link {{title=='Home' ? 'active': ''}}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=base_url('customer/pesanan')?>" class="nav-link {{title=='Pesanan' ? 'active': ''}}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Pesanan
                        </p>
                    </a>
                </li>
                
                <?php endif;?>
                <li class="nav-item">
                    <a href="<?=base_url('customer/jadwal')?>" class="nav-link {{title=='Jadwal' ? 'active': ''}}">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>
                            Cek Jadwal
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=base_url('auth/logout')?>" class="nav-link {{title=='LogOut' ? 'active': ''}}">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>