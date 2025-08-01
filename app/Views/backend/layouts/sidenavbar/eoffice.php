    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="<?= base_url('/beranda'); ?>">
                        <h2 class="brand-text mb-0">FKM UNMUL</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="navigation-header"><span><?= $lvl ?></span>
                <li class="<?= $title == 'Beranda' ? 'active' : '' ?>"><a href="<?= base_url('beranda'); ?>"><i class="feather icon-home"></i><span class="menu-item" data-i18n="Analytics">Beranda</span></a>
                </li>
                <li class=" navigation-header"><span>BANK DATA</span>
                </li>
                <li class=""><a href="#"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Dashboard">SDM</span><span class="badge badge badge-warning badge-pill float-right mr-2">2</span></a>
                    <ul class="menu-content">
                        <li class="<?= $title == 'Dosen' ? 'active' : '' ?>"><a href="<?= base_url('dosen'); ?>"><i class="feather icon-users"></i><span class="menu-item" data-i18n="Analytics">Dosen</span></a>
                        </li>
                        <li class="<?= $title == 'Tendik' ? 'active' : '' ?>"><a href="<?= base_url('tendik'); ?>"><i class="feather icon-users"></i><span class="menu-item" data-i18n="eCommerce">Tendik</span></a>
                        </li>
                    </ul>
                </li>
                <li class="<?= $title == 'Semester' ? 'active' : '' ?>"><a href="<?= base_url('semester'); ?>"><i class="feather icon-home"></i><span class="menu-item" data-i18n="Analytics">Semester</span></a>
                </li>
                <li class=" navigation-header"><span>E-OFFICE</span>
                </li>
                <li class=""><a href="#"><i class="feather icon-layers"></i><span class="menu-title" data-i18n="Dashboard">SK</span><span class="badge badge badge-warning badge-pill float-right mr-2">2</span></a>
                    <ul class="menu-content">
                        <li class="<?= $title == 'Surat Keputusan' ? 'active' : '' ?>"><a href="<?= base_url('sk'); ?>"><i class="feather icon-book"></i><span class="menu-item" data-i18n="Analytics">Surat Keputusan</span></a>
                        </li>
                        <li class="<?= $title == 'Kategori SK' ? 'active' : '' ?>"><a href="<?= base_url('kategori_sk'); ?>"><i class="feather icon-book"></i><span class="menu-item" data-i18n="Analytics">Kategori SK</span></a>
                        </li>
                    </ul>
                </li>
                <li class="<?= $title == 'Surat Masuk' ? 'active' : '' ?>"><a href="<?= base_url('s_masuk'); ?>"><i class="feather icon-mail"></i><span class="menu-item" data-i18n="Analytics">Surat Masuk</span></a>
                </li>
                <li class=""><a href="#"><i class="feather icon-mail"></i><span class="menu-title" data-i18n="Dashboard">Surat Keluar</span><span class="badge badge badge-warning badge-pill float-right mr-2">2</span></a>
                    <ul class="menu-content">
                        <li class="<?= $title == 'Surat Keluar' ? 'active' : '' ?>"><a href="<?= base_url('s_keluar'); ?>"><i class="feather icon-mail"></i><span class="menu-item" data-i18n="Analytics">Surat Keluar</span></a>
                        </li>
                        <li class="<?= $title == 'Kategori Surat' ? 'active' : '' ?>"><a href="<?= base_url('kategori_surat'); ?>"><i class="feather icon-list"></i><span class="menu-item" data-i18n="Analytics">Kategori Surat</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header"><span>AKUN</span>
                </li>
                <li class="<?= $title == 'Akun' ? 'active' : '' ?>"><a href="<?= base_url('user'); ?>"><i class="feather icon-users"></i><span class="menu-item" data-i18n="Analytics">Akun</span></a>
                </li>
                <li><a href="<?= base_url('auth/logout'); ?>"><i class="feather icon-log-out"></i><span class="menu-item" data-i18n="Analytics">Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->