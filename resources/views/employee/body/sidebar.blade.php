<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->


        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('employee.dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dasbor</span>
                    </a>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-user-received-line"></i>
                        <span>Pengaturan Supplier</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('employee.supplier.all') }}">Semua Supplier</a></li>

                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-user-5-line"></i>
                        <span>Pengaturan Customer</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('employee.customer.all') }}">Semua Customer</a></li>

                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-scales-2-line"></i>
                        <span>Pengaturan Unit</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('employee.unit.all') }}">Semua Unit</a></li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-layout-grid-line"></i>
                        <span>Pengaturan Kategori</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('employee.category.all') }}">Semua Kategori</a></li>

                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-barcode-box-line"></i>
                        <span>Pengaturan Produk</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('employee.product.all') }}">Semua Produk</a></li>

                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-login-circle-line"></i>
                        <span>Stok Masuk</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('employee.purchase.all') }}">Daftar Stok Masuk</a></li>
                        <li><a href="{{ route('employee.purchase.pending') }}">Approval Stok Masuk</a></li>
                        <li><a href="{{ route('employee.daily.purchase.report') }}">Laporan Stok Masuk</a></li>
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-logout-circle-line"></i>
                        <span>Stok Keluar</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('employee.invoice.all') }}">Daftar Stok Keluar</a></li>
                        <li><a href="{{ route('employee.invoice.pending.list') }}">Approval Stok Keluar</a></li>
                        <li><a href="{{ route('employee.daily.invoice.report') }}">Laporan Stok Keluar</a></li>
                    </ul>
                </li>




                {{-- <li class="menu-title">Pages</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-account-circle-line"></i>
                        <span>Authentication</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="auth-login.html">Login</a></li>
                        <li><a href="auth-register.html">Register</a></li>
                        <li><a href="auth-recoverpw.html">Recover Password</a></li>
                        <li><a href="auth-lock-screen.html">Lock Screen</a></li>
                    </ul>
                </li> --}}

                <li class="menu-title">Pengaturan</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-archive-drawer-line"></i>
                        <span>Pengaturan Stok</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('employee.stock.report') }}">Laporan Stok</a></li>
                        {{-- <li><a href="auth-register.html">Supplier / Product Wise </a></li> --}}

                    </ul>
                </li>


                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-profile-line"></i>
                        <span>Utility</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-starter.html">Starter Page</a></li>
                        <li><a href="pages-timeline.html">Timeline</a></li>
                        <li><a href="pages-directory.html">Directory</a></li>
                        <li><a href="pages-invoice.html">Invoice</a></li>
                        <li><a href="pages-404.html">Error 404</a></li>
                        <li><a href="pages-500.html">Error 500</a></li>
                    </ul>
                </li> --}}






            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
