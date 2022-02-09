<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <p><b>Hari Ini</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $belum_bayar_today ? $belum_bayar_today : 0 ?></h3>
                            <p>BELUM BAYAR</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <a href="<?= base_url('transaksi/belum_bayar') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $dikemas_today ? $dikemas_today : 0 ?></h3>
                            <p>DIKEMAS</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <a href="<?= base_url('transaksi/dikemas') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $dikirim_today ? $dikirim_today : 0 ?></h3>
                            <p>DIKIRIM</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <a href="<?= base_url('transaksi/dikirim') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $batal_today ? $batal_today : 0 ?></h3>
                            <p>BATAL</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <a href="<?= base_url('transaksi/batal') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-12">
                    <p><b>Semua</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $belum_bayar_all ? $belum_bayar_all : 0 ?></h3>
                            <p>BELUM BAYAR</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <a href="<?= base_url('transaksi/belum_bayar') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $dikemas_all ? $dikemas_all : 0 ?></h3>
                            <p>DIKEMAS</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <a href="<?= base_url('transaksi/dikemas') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $dikirim_all ? $dikirim_all : 0 ?></h3>
                            <p>DIKIRIM</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <a href="<?= base_url('transaksi/dikirim') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $batal_all ? $batal_all : 0 ?></h3>
                            <p>BATAL</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <a href="<?= base_url('transaksi/batal') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12 col-12">
                    <p>Grafik Penjualan Bulan Ini</p>
                    <canvas id="myChart" height="50px"></canvas>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script type="text/javascript">
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
            <?php
                if (count($bulan_ini)>0) {
                    foreach ($bulan_ini as $row) {
                        echo "'" . $row->nama_produk ."',";
                    }
                }
            ?>
            ],
            datasets: [{
                label: 'Jumlah Penjualan',
                backgroundColor: '#ADD8E6',
                borderColor: '##93C3D2',
                data: [
                <?php
                    if (count($bulan_ini)>0) {
                    foreach ($bulan_ini as $row) {
                        echo $row->total . ", ";
                    }
                    }
                ?>
                ]
            }]
        },
    });
</script>