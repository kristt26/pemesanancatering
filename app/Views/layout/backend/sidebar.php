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
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Pesanan
                        </p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Forms
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../forms/general.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>General Elements</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../forms/advanced.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Advanced Elements</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../forms/editors.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Editors</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../forms/validation.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Validation</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>