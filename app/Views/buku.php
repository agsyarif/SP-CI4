<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Data Buku</h2>
                <h5 class="text-white op-7 mb-2">Halaman Pengelolaan Buku</h5>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modaltambah" data-backdrop="static" data-keyboard="false">Tambah Data</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tblbuku" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Kode</th>
                                    <th style="width: 20%;">Judul</th>
                                    <th style="width: 20%;">Pengarang</th>
                                    <th style="width: 20%;">Penerbit</th>
                                    <th style="width: 10%;">Tahun</th>
                                    <th style="width: 10%;">ISBN</th>
                                    <th style="width: 10%;">Operasi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" role="dialog" id="modaltambah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-size: 20px;">Tambah Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Kode Buku</label>
                        <input type="text" class="form-control ftambah" id="txtkode">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Judul</label>
                        <input type="text" class="form-control ftambah" id="txtjudul">
                    </div>
                    <div class="form-group col-md-12">
                        <label>ISBN</label>
                        <input type="text" class="form-control ftambah" id="txtisbn">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Pengarang</label>
                        <select class="form-control ftambah" id="cbopengarang">
                            <option value="">Pilih Salah Satu</option>
                            <?php
                            if (is_array($dtpengarang)) {
                                if (count($dtpengarang) > 0) {
                                    foreach ($dtpengarang as $k) {
                                        $id = $k->ID_Pengarang;
                                        $nama = $k->Nama_Pengarang;
                                        echo "<option value='$id'>$nama</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Penerbit</label>
                        <select class="form-control ftambah" id="cbopenerbit">
                            <option value="">Pilih Salah Satu</option>
                            <?php
                            if (is_array($dtpenerbit)) {
                                if (count($dtpenerbit) > 0) {
                                    foreach ($dtpenerbit as $k) {
                                        $id = $k->ID_Penerbit;
                                        $nama = $k->Nama_Penerbit;
                                        echo "<option value='$id'>$nama</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Tahun Terbit</label>
                        <input type="text" class="form-control ftambah" id="txttahun" maxlength="4">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Rak</label>
                        <input type="text" class="form-control ftambah" id="txtrak">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="tambah_data()">Simpan</button>
                <button type="button" class="btn btn-danger" onclick="reset_tambah_buku()">Reset</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" role="dialog" id="modalupdate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-size: 20px;">Tambah Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Kode Buku</label>
                        <input type="text" class="form-control fupdate" id="txtkodee">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Judul</label>
                        <input type="text" class="form-control fupdate" id="txtjudule">
                    </div>
                    <div class="form-group col-md-12">
                        <label>ISBN</label>
                        <input type="text" class="form-control fupdate" id="txtisbne">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Pengarang</label>
                        <select class="form-control fupdate" id="cbopengarange">
                            <option value="">Pilih Salah Satu</option>
                            <?php
                            if (is_array($dtpengarang)) {
                                if (count($dtpengarang) > 0) {
                                    foreach ($dtpengarang as $k) {
                                        $id = $k->ID_Pengarang;
                                        $nama = $k->Nama_Pengarang;
                                        echo "<option value='$id'>$nama</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Penerbit</label>
                        <select class="form-control fupdate" id="cbopenerbite">
                            <option value="">Pilih Salah Satu</option>
                            <?php
                            if (is_array($dtpenerbit)) {
                                if (count($dtpenerbit) > 0) {
                                    foreach ($dtpenerbit as $k) {
                                        $id = $k->ID_Penerbit;
                                        $nama = $k->Nama_Penerbit;
                                        echo "<option value='$id'>$nama</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Tahun Terbit</label>
                        <input type="text" class="form-control fupdate" id="txttahune" maxlength="4">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Rak</label>
                        <input type="text" class="form-control fupdate" id="txtrake">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="update_data()">Update</button>
                <button type="button" class="btn btn-danger" onclick="hapus_data()">Hapus</button>
                <button type="button" class="btn btn-secondary" onclick="reset_update_buku()">Batal</button>
            </div>
        </div>
    </div>
</div>


<script>
    $("#mndata").addClass("active");
    let tabel = $("#tblbuku").DataTable({
        "ajax": "<?= BASEURLKU; ?>bookrow"
    });

    function reset_tambah_buku() {
        $(".ftambah").val("");
        $("#sbopengarang").val("").change();
        $("#sbopenerbit").val("").change();
    }

    function tambah_data() {
        let kode = $("#txtkode").val();
        let judul = $("#txtjudul").val();
        let isbn = $("#txtisbn").val();
        let pengarang = $("#cbopengarang").val();
        let penerbit = $("#cbopenerbit").val();
        let tahun = $("#txttahun").val();
        let rak = $("#txtrak").val();

        if (kode == "" || judul == "" || isbn == "" || pengarang == "" || penerbit == "" || tahun == "" || rak == "") {
            swal({
                title: "Gagal",
                text: "Ada Isian Yang Masih Ksosong",
                icon: "error"
            });
            return;
        }
        $.ajax({
            url: "<?= BASEURLKU; ?>addbook",
            method: "POST",
            data: {
                kodex: kode,
                judulx: judul,
                isbnx: isbn,
                pengarangx: pengarang,
                penerbitx: penerbit,
                tahunx: tahun,
                rakx: rak
            },
            cache: "false",
            success: function(response) {
                console.log(response);
                let data = JSON.parse(response);
                if (data.kode == "1") {
                    swal({
                        title: "Berhasil",
                        text: data.pesan,
                        icon: "success"
                    });
                    reset_tambah_buku();
                    tabel.ajax.reload();
                } else {
                    swal({
                        title: "Gagal",
                        text: data.pesan,
                        icon: "error"
                    });
                }
            },
            error: function() {
                console.log(response);
                swal({
                    title: "Gagal",
                    text: "Koneksi Ke Controller Gagal",
                    icon: "error"
                });
            }
        })
    }

    function reset_update_buku() {
        $(".fupdate").val("");
        $("#sbopengarange").val("").change();
        $("#sbopenerbite").val("").change();
    }

    function filter(el) {
        let kode = $(el).data("kode");
        if (kode == "") {
            swal({
                title: "Gagal",
                text: "Data Tidak Terdeteksi",
                ison: "error"
            });
            return;
        }
        $.ajax({
            url: "<?= BASEURLKU; ?>getbook",
            method: "POST",
            data: {
                kodex: kode
            },
            cache: "false",
            success: function(response) {
                let data = JSON.parse(response);
                console.log(data);
                if (data.kode == "1") {
                    $("#txtkodee").val(kode);
                    $("#txtjudule").val(data.judul);
                    $("#txtisbne").val(data.isbn);
                    $("#cbopengarange").val(data.pengarang);
                    $("#cbopenerbite").val(data.penerbit);
                    $("#txttahune").val(data.tahun);
                    $("#txtrake").val(data.rak);
                    $("#modalupdate").modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                } else {
                    swal({
                        title: "Gagal",
                        text: data.pesan,
                        ison: "error"
                    });
                }
            },
            error: function() {
                swal({
                    title: "Gagal",
                    text: "Koneksi Ke Controller Gagal",
                    ison: "error"
                });
            }
        });
    }

    function update_data() {
        let kode = $("#txtkodee").val();
        let judul = $("#txtjudule").val();
        let isbn = $("#txtisbne").val();
        let pengarang = $("#cbopengarange").val();
        let penerbit = $("#cbopenerbite").val();
        let tahun = $("#txttahune").val();
        let rak = $("#txtrake").val();
        console.log(kode);
        console.log(isbn);
        if (kode == "" || judul == "" || isbn == "" || pengarang == "" || penerbit == "" || tahun == "" || rak == "") {
            swal({
                title: "Gagal",
                text: "[update ]Ada Isian Yang Masih Ksosong",
                icon: "error"
            });
            return;
        }
        $.ajax({
            url: "<?= BASEURLKU; ?>updatebook",
            method: "POST",
            data: {
                kodex: kode,
                judulx: judul,
                isbnx: isbn,
                pengarangx: pengarang,
                penerbitx: penerbit,
                tahunx: tahun,
                rakx: rak
            },
            cache: "false",
            success: function(response) {
                let data = JSON.parse(response);
                if (data.kode == "1") {
                    swal({
                        title: "Berhasil",
                        text: data.pesan,
                        icon: "success"
                    });
                    reset_tambah_buku();
                    tabel.ajax.reload();
                    $("#modalupdate").modal("hide");
                } else {
                    swal({
                        title: "Gagal",
                        text: data.pesan,
                        icon: "error"
                    });
                }
            },
            error: function() {
                swal({
                    title: "Gagal",
                    text: "Koneksi Ke Controller Gagal",
                    ison: "error"
                });
            }
        })
    }

    function hapus_data() {
        let kode = $("#txtkodee").val();
        if (kode == "") {
            swal({
                title: "Gagal",
                text: "Kode Buku Masih Kosong",
                icon: "error"
            });
            return;
        }
        swal({
            title: "Konfirmasi",
            text: "Anda Yakin Ingin Menghapus Data Buku Ini?",
            icon: "warning",
            buttons: {
                confirm: {
                    text: 'Yakin',
                    className: 'btn btn-primary'
                },
                cancel: {
                    visible: true,
                    text: 'Tidak',
                    className: 'btn btn-danger'
                }
            }
        }).then((hapus) => {
            if (hapus) {
                $.ajax({
                    url: "<?= BASEURLKU; ?>delbook",
                    method: "POST",
                    data: {
                        kodex: kode
                    },
                    cache: "false",
                    success: function(response) {
                        let data = JSON.parse(response);
                        if (data.kode == "1") {
                            swal({
                                title: "Berhasil",
                                text: data.pesan,
                                icon: "success"
                            });
                            reset_update_buku();
                            tabel.ajax.reload();
                            $("#modalupdate").modal("hide");
                        } else {
                            swal({
                                title: "Gagal",
                                text: data.pesan,
                                icon: "error"
                            });
                        }
                    },
                    error: function() {
                        swal({
                            title: "Gagal",
                            text: "Koneksi Ke Controller Gagal",
                            icon: "error"
                        });
                    }
                })
            }
        })
    }
</script>