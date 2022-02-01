<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

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
                <div class="card-header">
                    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modal_tambah"><i class="fas fa-plus"></i> Tambah <?= $title ?></button>
                </div>
                <div class="modal fade myModal" id="modal_tambah">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Form Tambah <?= $title ?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="<?= base_url("master/user/add") ?>" id="form_add" enctype='multipart/form-data'>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="recipient-name" class="control-label">Username <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="recipient-name" class="control-label">Password <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" name="password" id="password" value="12345678" placeholder="Password" readonly required>
                                                <span class="text-danger">*) Password default : <b>12345678</b></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="recipient-name" class="control-label">Nama <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="recipient-name" class="control-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                                <textarea  class="form-control" name="alamat_lengkap" id="alamat_lengkap" placeholder="Alamat Lengkap" cols="3" rows="3" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="recipient-name" class="control-label">Kode Pos <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="kode_pos" id="kode_pos" placeholder="Kode Pos" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="recipient-name" class="control-label">Telepon <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="telepon" id="telepon" placeholder="Telepon" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="recipient-name" class="control-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary add-btn">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="table_data" class="table nowrap table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 3%">No.</th>
                                <th style="width: 8%">Aksi</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Alamat Lengkap</th>
                                <th>Telepon</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($user as $u) { ?>
                                <tr>
                                    <td><?= $no++ ?>.</td>
                                    <td>
                                        <button type="button" title="Edit" onclick="modal_edit('<?= $u->id ?>')" data-toggle="modal" data-target="#modal_ubah" class="btn btn-sm btn-info waves-effect waves-light" type="button"><span class="btn-label text-white"><i class="fas fa-edit"></i></span></button>
                                        <button type="button" title="Hapus" onclick="hapus('<?= $u->id ?>')" class="btn btn-sm btn-danger waves-effect waves-light" type="button"><span class="btn-label text-white"><i class="fas fa-trash"></i></span></button>
                                    </td>
                                    <td><?= $u->username ?></td>
                                    <td><?= $u->nama ?></td>
                                    <td><?= $u->alamat_lengkap ?></td>
                                    <td><?= $u->telepon ?></td>
                                    <td><?= $u->email ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade myModal" id="modal_ubah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Ubah <?= $title ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url("master/user/update") ?>" id="form_add" enctype='multipart/form-data'>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="recipient-name" class="control-label">Username <span class="text-danger">*</span></label>
                                <input type="hidden" class="form-control" name="id_edit" id="id_edit" placeholder="ID" required>
                                <input type="text" class="form-control" name="username_edit" id="username_edit" placeholder="Username" readonly required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="recipient-name" class="control-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama_edit" id="nama_edit" placeholder="Nama" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="recipient-name" class="control-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea  class="form-control" name="alamat_lengkap_edit" id="alamat_lengkap_edit" placeholder="Alamat Lengkap" cols="3" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="recipient-name" class="control-label">Kode Pos <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="kode_pos_edit" id="kode_pos_edit" placeholder="Kode Pos" required>
                            </div>
                            <div class="col-md-6">
                                <label for="recipient-name" class="control-label">Telepon <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="telepon_edit" id="telepon_edit" placeholder="Telepon" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="recipient-name" class="control-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email_edit" id="email_edit" placeholder="Email" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary add-btn">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#table_data').DataTable();
    });

    function modal_edit(id) {
        $.ajax({
            url: "<?= base_url('master/user/getById/') ?>" + id,
            type: "GET",
            dataType: "JSON",
            contentType: "application/json; charset=utf-8",
            success: function(result) {
                $('#id_edit').val(result.id);
                $("#username_edit").val(result.username)
                $("#nama_edit").val(result.nama)
                $("#alamat_lengkap_edit").val(result.alamat_lengkap)
                $("#kode_pos_edit").val(result.kode_pos)
                $('#email_edit').val(result.email);
                $('#telepon_edit').val(result.telepon);

            }
        });
    }

    function hapus(id) {
        swal.fire({
            title: 'Hapus Data ?',
            text: "Data akan terhapus secara permanent",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('master/user/delete') ?>",
                    data: {
                        "id": id
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.response_code == 200) {
                            Swal.fire(
                                'Terhapus',
                                data.response_message,
                                'success'
                            ).then((result) => {
                                location.reload()
                            })
                        } else {
                            Swal.close();
                            Swal.fire("Oops", data.response_message, "error");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire("Oops", xhr.responseText, "error");
                    }
                })
            }
        });
    }

    function check_level() {
        var level = $("#level").val()
        if (level == 'DOKTER' || level == 'PERAWAT' || level == 'BIDAN') {
            $("#div_poli").show()
            $("#poli").prop('required', true);
        } else {
            $("#div_poli").hide()
            $("#poli").val("").change();
            $("#poli").prop('required', false);
        }
    }

    function check_level_edit() {
        var level = $("#level_edit").val()
        if (level == 'DOKTER' || level == 'PERAWAT' || level == 'BIDAN') {
            $("#div_poli_edit").show()
            $("#poli_edit").prop('required', true);
        } else {
            $("#div_poli_edit").hide()
            $("#poli_edit").val("").change();
            $("#poli_edit").prop('required', false);
        }
    }
</script>
<script>   
    window.addEventListener('load', function() {

        // $(".admin_select2").select2({
        //     dropdownParent: $("#modal_tambah"),
        //     closeOnSelect: true,
        //     theme: 'bootstrap4',
        //     ajax: {
        //         url: '<?= base_url('master/admin/searchAdmin') ?>',
        //         type: "post",
        //         dataType: 'json',
        //         delay: 250,
        //         data: function(params) {
        //             return {
        //                 searchTerm: params.term
        //             };
        //         },
        //         processResults: function(response) {
        //             console.log(response)
        //             return {
        //                 results: response
        //             };
        //         },
        //         cache: true,
        //     },
        // })

        // $(".admin_select2_edit").select2({
        //     dropdownParent: $("#modal_ubah"),
        //     closeOnSelect: true,
        //     theme: 'bootstrap4',
        //     ajax: {
        //         url: '<?= base_url('master/admin/searchAdmin') ?>',
        //         type: "post",
        //         dataType: 'json',
        //         delay: 250,
        //         data: function(params) {
        //             return {
        //                 searchTerm: params.term
        //             };
        //         },
        //         processResults: function(response) {
        //             console.log(response)
        //             return {
        //                 results: response
        //             };
        //         },
        //         cache: true,
        //     },
        // })

        $('#level').on('change', function() {
            $(".poli").select2({
                ajax: {
                    url: '<?= base_url('master/admin/searchPoli/') ?>' + this.value,
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            searchTerm: params.term
                        };
                    },
                    processResults: function(response) {

                        return {
                            results: response
                        };
                    },
                    cache: true,
                },
                'theme': 'bootstrap4'
            });
        });

        $('#level_edit').on('change', function() {
            $(".poli_edit").select2({
                ajax: {
                    url: '<?= base_url('master/admin/searchPoli/') ?>' + this.value,
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            searchTerm: params.term
                        };
                    },
                    processResults: function(response) {

                        return {
                            results: response
                        };
                    },
                    cache: true,
                },
                'theme': 'bootstrap4'
            });
        });

    });
</script>
<script>
    $(document).ready(function() {
        $("#provinsi").change(function() {
            var kec = $(this).find(":selected").text();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url("Welcome/getKabupatenByIdProvinsi"); ?>",
                data: {
                    id_prov: $("#provinsi").val()
                },
                dataType: "json",
                beforeSend: function(e) {
                    if (e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response) {
                    $("#kabupaten").html(response.list_kabupaten).show();
                    $("#kabupaten").change(function() {
                        var kabupaten = $(this).find(":selected").text();
                    });
                    $("#kecamatan").html('<option value="">--- Pilih Kabupaten Terlebih Dahulu</option> ---').show();
                    $("#kelurahan").html('<option value="">--- Pilih Kecamatan Terlebih Dahulu</option> ---').show();
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            });
        });

        $("#kabupaten").change(function() {
            var kec = $(this).find(":selected").text();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url("Welcome/getKecamatanByIdKabupaten"); ?>",
                data: {
                    id_kab: $("#kabupaten").val()
                },
                dataType: "json",
                beforeSend: function(e) {
                    if (e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response) {
                    $("#kecamatan").html(response.list_kecamatan).show();
                    $("#kecamatan").change(function() {
                        var kecamatan = $(this).find(":selected").text();
                    });
                    $("#kelurahan").html('<option value="">--- Pilih Kecamatan Terlebih Dahulu</option> ---').show();
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            });
        });

        $("#kecamatan").change(function() {
            var kec = $(this).find(":selected").text();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url("Welcome/getKelurahanByIdKecamatan"); ?>",
                data: {
                    kecamatan_id: $("#kecamatan").val()
                },
                dataType: "json",
                beforeSend: function(e) {
                    if (e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response) {
                    $("#kelurahan").html(response.list_kelurahan).show();
                    $("#kelurahan").change(function() {
                        var kelurahan = $(this).find(":selected").text();
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            });
        });

        $("#provinsi_edit").change(function() {
            var kec = $(this).find(":selected").text();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url("Welcome/getKabupatenByIdProvinsi"); ?>",
                data: {
                    id_prov: $("#provinsi_edit").val()
                },
                dataType: "json",
                beforeSend: function(e) {
                    if (e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response) {
                    $("#kabupaten_edit").html(response.list_kabupaten).show();
                    $("#kabupaten_edit").change(function() {
                        var kabupaten = $(this).find(":selected").text();
                    });
                    $("#kecamatan_edit").html('<option value="">--- Pilih Kabupaten Terlebih Dahulu</option> ---').show();
                    $("#kelurahan_edit").html('<option value="">--- Pilih Kecamatan Terlebih Dahulu</option> ---').show();
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            });
        });

        $("#kabupaten_edit").change(function() {
            var kec = $(this).find(":selected").text();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url("Welcome/getKecamatanByIdKabupaten"); ?>",
                data: {
                    id_kab: $("#kabupaten_edit").val()
                },
                dataType: "json",
                beforeSend: function(e) {
                    if (e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response) {
                    $("#kecamatan_edit").html(response.list_kecamatan).show();
                    $("#kecamatan_edit").change(function() {
                        var kecamatan = $(this).find(":selected").text();
                    });
                    $("#kelurahan_edit").html('<option value="">--- Pilih Kecamatan Terlebih Dahulu</option> ---').show();
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            });
        });

        $("#kecamatan_edit").change(function() {
            var kec = $(this).find(":selected").text();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url("Welcome/getKelurahanByIdKecamatan"); ?>",
                data: {
                    kecamatan_id: $("#kecamatan_edit").val()
                },
                dataType: "json",
                beforeSend: function(e) {
                    if (e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response) {
                    $("#kelurahan_edit").html(response.list_kelurahan).show();
                    $("#kelurahan_edit").change(function() {
                        var kelurahan = $(this).find(":selected").text();
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            });
        });
    });
</script>