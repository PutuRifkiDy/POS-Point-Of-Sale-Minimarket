<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset(auth()->user()->foto ?? '') }}" class="img-circle" alt="User Image" style="width:40px; height:40px" >
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <p><i class="fa fa-circle text-success"></i> Online</p>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            @if (auth()->user()->level == 1)
                
            
            <li class="header">MASTER</li>
            <li>
                <a href="{{ route('kategori.index') }}">
                    <i class="fa fa-cube"></i> <span>Kategori</span>

                </a>
            </li>
            <li>
                <a href="{{ route('produk.index') }}">
                    <i class="fa fa-cubes"></i> <span>Produk</span>

                </a>
            </li>
            <li>
                <a href="{{ route('member.index') }}">
                    <i class="fa fa-credit-card-alt"></i> <span>Member</span>

                </a>
            </li>
            <li>
                <a href="{{ route('supplier.index') }}">
                    <i class="fa fa-truck"></i> <span>Supplier</span>

                </a>
            </li>

            <li class="header">TRANSAKSI</li>
            <li>
                <a href="{{ route('pengeluaran.index') }}">
                    <i class="fa fa-money"></i> <span>Pengeluaran</span>

                </a>
            </li>
            <li>
                <a href="{{ route('pembelian.index') }}">
                    <i class="fa fa-download"></i> <span>Pembelian</span>

                </a>
            </li>
            <li>
                <a href="{{ route('penjualan.index') }}">
                    <i class="fa fa-upload"></i> <span>Penjualan</span>

                </a>
            </li>
            <li>
                <a href="{{ route('transaksi.index') }}">
                    <i class="fa fa-cart-arrow-down"></i> <span>Transaksi Lama</span>

                </a>
            </li>
            <li>
                <a href="{{ route('transaksi.baru') }}">
                    <i class="fa fa-cart-plus"></i> <span>Transaksi Baru</span>

                </a>
            </li>
            <li class="header">REPORT</li>
            <li>
                <a href="{{ route('laporan_pengeluaran.index') }}">
                    <i class="fa fa-file-pdf-o"></i> <span>Laporan Pengeluaran</span>
                </a>
            </li>
            <li>
                <a href="{{ route('laporan_pembelian.index') }}">
                    <i class="fa fa-file-pdf-o"></i> <span>Laporan Pembelian</span>
                </a>
            </li>
            <li>
                <a href="{{ route('laporan_penjualan.index') }}">
                    <i class="fa fa-file-pdf-o"></i> <span>Laporan Penjualan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('laporan.index') }}">
                    <i class="fa fa-file-pdf-o"></i> <span>Laporan Pendapatan Final</span>
                </a>
            </li>
            <li class="header">SYSTEM</li>
            <li>
                <a href="{{ route('user.index') }}">
                    <i class="fa fa-users"></i> <span>User</span>

                </a>
            </li>
            <li>
                <a href="{{ route('setting.index') }}">
                    <i class="fa fa-cogs"></i> <span>Pengaturan</span>

                </a>
            </li>
            @else
            <li>
                <a href="{{ route('transaksi.index') }}">
                    <i class="fa fa-cart-arrow-down"></i> <span>Transaksi Lama</span>

                </a>
            </li>
            <li>
                <a href="{{ route('transaksi.baru') }}">
                    <i class="fa fa-cart-plus"></i> <span>Transaksi Baru</span>

                </a>
            </li>
            @endif
        </ul>


    </section>
    <!-- /.sidebar -->
</aside>
