<style>
    .centerr {
        display: block;
        margin-left: auto;
        margin-right: auto;
        margin-top: 20px;
        margin-bottom: 20px;
        width: 50%;
    }
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="brand-link">
        <img src="<?= base_url("assets/dist/img/logo.png") ?>" alt="User Image" class="centerr" width="100">
        <p class="text-center" style="font-size: 0.75em; padding: 0; margin: 0;"><?= $this->session->userdata('username_admin') ?></b>
        <p class="text-center" style="font-size: 0.75em; padding: 0; margin: 0;"><?= $this->session->userdata('nama_admin') ?></b>
    </div>

    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">BERANDA</li>
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-header">MASTER</li>
                <li class="nav-item">
                    <a href="<?= base_url('master/user') ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('master/toko') ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Toko
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('master/produk_ready') ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Produk Ready
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('master/produk_preorder') ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Produk Preorder
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('master/bank') ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Bank
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('master/ekspedisi') ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Ekspedisi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('master/kategori') ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Kategori
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('master/ukuran') ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Ukuran
                        </p>
                    </a>
                </li>

                <li class="nav-header">TRANSAKSI</li>
                <li class="nav-item">
                    <a href="<?= base_url('transaksi/tagihan') ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Tagihan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('transaksi/belum_bayar') ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Belum Bayar
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('transaksi/dikemas') ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dikemas
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('transaksi/dikirim') ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dikirim
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('transaksi/batal') ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Batal
                        </p>
                    </a>
                </li>

                <li class="nav-header">LAPORAN</li>
                <li class="nav-item">
                    <a href="<?= base_url('laporan/penjualan') ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Penjualan
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
</aside>