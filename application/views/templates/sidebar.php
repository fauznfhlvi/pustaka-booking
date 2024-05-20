<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
        
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-cat"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dream Diction</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
        
    <!-- Looping Menu-->

        <!-- Heading -->
        <div class="sidebar-heading">
            HOME
        </div>
        <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link pb-100" href="<?=base_url('admin/index'); ?>">
                        <i class="fa fa-fw fa book"></i>
                        <span>Dashboard</span></a>
                </li>
            </li>
            
        <div class="sidebar-heading">
            Master Data</div>
        <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link pb-0" href="<?=base_url('buku/kategori'); ?>">
                        <i class="fa fa-fw fa book"></i>
                        <span>Kategori Novel</span></a>
                </li>
            <li class="nav-item active">
                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link pb-0" href="<?=base_url('buku'); ?>">
                        <i class="fa fa-fw fa book"></i>
                        <span>Data Novel</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pb-0" href="<?=base_url('user/anggota'); ?>">
                        <i class="fa fa-fw fa book"></i>
                        <span>Data Member</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pb-0" href="<?=base_url('user/admin'); ?>">
                        <i class="fa fa-fw fa book"></i>
                        <span>Data Admin</span></a>
                </li>
            </li>
        <!-- Divider -->
        <hr class="sidebar-divider mt-3">

        <!-- Heading -->
        <div class = "sidebar-heading">
            Transaksi
        </div>
        <!-- Nav Item  - Dashboard -->
        <li class = "nav-item active">
            <!-- Nav Item - Dashboard -->
        <li class = "nav-item">
            <a class = "nav-link pb-0" href ="<?= base_url('pinjam');?>">
            <i class = "fa fa-fw fa-shopping-cart"></i>
            <span> Data Peminjaman</span></a>
        </li>
        <li class = "nav-item">
            <a class = "nav-link pb-0" href ="<?= base_url('pinjam/daftarBooking');?>">
            <i class = "fa fa-fw fa-shopping-cart"></i>
            <span> Data Booking</span></a>
        </li>
        </li>
        <!-- Divider -->
        <hr class = "sidebar-diviider mt-3">

        <!-- Heading -->
        <div class = "sidebar-heading">
            Laporan
        </div>
        <!-- Nav Item  - Dashboard -->
        <li class = "nav-item active">
            <!-- Nav Item - Dashboard -->
        <li class = "nav-item">
            <a class = "nav-link pb-0" href ="<?= base_url('laporan/laporan_buku');?>">
            <i class = "fa fa-fw fa-address-book"></i>
            <span> Laporan Data Buku</span></a>
        </li>
        <li class = "nav-item">
            <a class = "nav-link pb-0" href ="<?= base_url('laporan/laporan_anggota');?>">
            <i class = "fa fa-fw fa-address-book"></i>
            <span> Laporan Data Anggota</span></a>
        </li>
        <li class = "nav-item">
            <a class = "nav-link pb-0" href ="<?= base_url('laporan/laporan_pinjam');?>">
            <i class = "fa fa-fw fa-address-book"></i>
            <span> Laporan Data Peminjaman</span></a>
        </li>
        </li>
        <!-- Divider -->
        <hr class = "sidebar-diviider mt-3">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -- >