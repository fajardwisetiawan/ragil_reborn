<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark"><b><?= $title ?></b> | <?= $app_name ?></h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <?php if ($this->session->flashdata("gagal")) : ?>
            <div class="alert bg-danger alert-dismissible fade show" role="alert">
                <strong>Gagal !</strong> <?= $this->session->flashdata("gagal") ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php unset($_SESSION["gagal"]);
        endif; ?>

        <?php if ($this->session->flashdata("sukses")) : ?>
            <div class="alert bg-success alert-dismissible fade show" role="alert">
                <strong>Sukses !</strong> <?= $this->session->flashdata("sukses") ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php unset($_SESSION["sukses"]);
        endif; ?>

        <div class="container-fluid">
            <div class="card">
                <form method="POST" action="<?= base_url("master/toko/save") ?>" id="form_add" enctype='multipart/form-data'>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="recipient-name" class="control-label">Alamat Lengkap</label>
                                    <textarea class="form-control" name="alamat_lengkap" id="alamat_lengkap" cols="3" rows="3"  placeholder="Alamat Lengkap" required><?= $toko ? $toko->alamat_lengkap : ""  ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="recipient-name" class="control-label">Nomor WA</label>
                                    <input type="text" class="form-control" name="nomor_wa" id="nomor_wa" placeholder="Nomor WA" value="<?= $toko ? $toko->nomor_wa : "" ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="recipient-name" class="control-label">Telepon</label>
                                    <input type="text" class="form-control" name="telepon" id="telepon" placeholder="Telepon" value="<?= $toko ? $toko->telepon : "" ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="recipient-name" class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= $toko ? $toko->email : "" ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success ml-1" style="width: 100%;">
                            <i class="fas fa-save"></i> SIMPAN
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>