<div class="panel-header bg-primary-gradient">
    <div class="panel-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md row">
            <div>
                <h2 class="text-white pb-2 fw-old">Data Pelanggan</h2>
                <h2 class="text-white op-7 mb-2">Halaman Pengelolaan Pelanggan</h2>
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
                        <table id="tblpelanggan" class="display table table-triped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 15%;">ID</th>
                                    <th style="width: 40%;">Nama</th>
                                    <th style="width: 15%;">Jenis Kelamin</th>
                                    <th style="width: 15%;">Telp.</th>
                                    <th style="width: 15%;">Opersi</th>
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
                <h5 class="modal-title" style="font-size: 20px;">Tambah Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>ID Pelanggan</label>
                        <input type="text" class="form-control ftambah" id="txtid">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Nama</label>
                        <input type="text" class="form-control ftambah" id="txtnama">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Jenis Kelamin</label>
                        <select class="form-control ftambah" id="cbojk">
                            <option value="Laki-Laki" selected>Laki-Laki</option>
                            <option value="Perempuan" selected>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label>No Telp.</label>
                        <input type="text" class="form-control ftambah" id="txttelp">
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="tambah_data()">Simpan</button>
                <button type="button" class="btn btn-danger" onclick="reset_tambah_data()">Reset</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" role="dialog" id="modalupdate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-size: 20px;">Update Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>ID Pelanggan</label>
                        <input type="text" class="form-control fupdate" id="txtide">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Nama</label>
                        <input type="text" class="form-control fupdate" id="txtnamae">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Jenis Kelamin</label>
                        <select class="form-control fupdate" id="cbojke">
                            <option value="Laki-Laki" selected>Laki-Laki</option>
                            <option value="Perempuan" selected>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label>No Telp.</label>
                        <input type="text" class="form-control fupdate" id="txttelpe">
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="update_data()">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    $("#mnpelanggan").addClass("active");
    let tabel = $("#tblpelanggan").DataTable();
    const firebaseConfig = {
        apiKey: "AIzaSyCU2SEze2hZ1KN0_8OF-5kuvqTntY4Dxlw",
        authDomain: "pemrograman-web2-d7b72.firebaseapp.com",
        databaseURL: "https://pemrograman-web2-d7b72-default-rtdb.firebaseio.com",
        projectId: "pemrograman-web2-d7b72",
        storageBucket: "pemrograman-web2-d7b72.appspot.com",
        messagingSenderId: "760048667308",
        appId: "1:760048667308:web:ba7959a23c9ed3e6cb6d09",
        measurementId: "G-2410R7NCMG"
    };
    firebase.initializeApp(firebaseConfig);
    let db = firebase.database();
    let dtpelanggan = db.ref("blokpelanggan");

    dtpelanggan.on('value', sukses, gagal);

    function sukses(items) {
        let dt = "";
        tabel.clear();
        $.each(items.val(), function(i, kolom) {
            let nama = kolom.nama;
            let jk = kolom.jenis_kelamin;
            let telp = kolom.no_telp;
            // let tombol = `<button type="button" class="btn btn-info" data-id="${i}" onclick="filter{this}">Update</button><button type="button" class="btn btn-danger" data-id="${i}" onclick="hapus{this}">Hapus</button>`;
            let tombol = `<button type="button" class="btn btn-info" data-id="${i}" onclick="filter(this)">Update</button> <button type="button" class="btn btn-danger" data-id="${i}" onclick="hapus(this)">Hapus</button>`;
            dt = [i, nama, jk, telp, tombol];
            tabel.rows.add([dt]).draw();
        })
    }

    function gagal(error) {
        console.log(error);
    }

    function reset_tambah_data() {
        $(".ftambah").val("");
        $("#cbojk").val("Laki-Laki").change();
    }

    function tambah_data() {
        let id = $("#txtid").val();
        let nama = $("#txtnama").val();
        let jk = $("#cbojk").val();
        let telp = $("#txttelp").val();
        if (id == "" || nama == "" || jk == "" || telp == "") {
            swal({
                title: "gagal",
                text: 'Ada Isian Yang Masih Kosong',
                icon: 'error'
            });
            return;
        }
        db.ref("blokpelanggan/" + id).set({
            nama: nama,
            jenis_kelamin: jk,
            no_telp: telp
        }, (error) => {
            if (error) {
                swal({
                    title: "gagal",
                    text: 'Data Baru Gagal ditambahkan',
                    icon: 'error'
                });
            } else {
                swal({
                    title: 'Berhasil',
                    text: 'Data Berhasil di Ditambahkan',
                    icon: 'success'
                });
                reset_tambah_data();
            }
        });
    }

    function filter(el) {
        let id = $(el).data("id");
        dtpelanggan.child(id).get().then(function(nilai) {
            if (nilai.exists()) {
                $("#txtide").val(id);
                $("#txtnamae").val(nilai.val().nama);
                $("#cbojke").val(nilai.val().jenis_kelamin).change();
                $("#txttelpe").val(nilai.val().no_telp);
                $("#modalupdate").modal("show");
            } else {
                swal({
                    title: 'Gagal',
                    text: 'Data Tidak Tersedia',
                    icon: 'error'
                });
            }
        }).catch(function(error) {
            swal({
                title: 'Gagal',
                text: 'Jaringan Terputus',
                icon: 'error'
            });
        });
    }

    function reset_update() {
        $(".fupdate").val("");
        $("#cbojke").val("Laki-Laki").change();
    }

    function update_data() {
        let id = $("#txtide").val();
        let nama = $("#txtnamae").val();
        let jk = $("#cbojke").val();
        let telp = $("#txttelpe").val();
        if (id == "" || nama == "" || jk == "" || telp == "") {
            swal({
                title: 'Gagal',
                text: 'Ada Isian Yang Masih Kosong',
                icon: 'error'
            });
            return;
        }
        db.ref("blokpelanggan/" + id).set({
            nama: nama,
            jenis_kelamin: jk,
            no_telp: telp
        }, (error) => {
            if (error) {
                swal({
                    title: 'Gagal',
                    text: 'Data Gagal di Update',
                    icon: 'error'
                });
            } else {
                swal({
                    title: 'Berhasil',
                    text: 'Data Berhasil di Update',
                    icon: 'success'
                });
                $("#modalupdate").modal("hide");
                reset_update();
            }
        });
    }

    function hapus(el) {
        let id = $(el).data("id");
        if (id == "") {
            swal({
                title: "Gagal",
                text: "ID Masih Kosong",
                icon: "error"
            });
            return;
        }
        swal({
            title: 'Hapus Data',
            text: "Anda Yakin Ingin Menghapus Data Ini?",
            icon: 'warning',
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
        }).then((Hapuss) => {
            if (Hapuss) {
                db.ref("blokpelanggan/" + id).set({},
                    (error) => {
                        if (error) {
                            swal({
                                title: 'Gagal',
                                text: 'Data Gagal di Hapus',
                                icon: 'error'
                            });
                        } else {
                            swal({
                                title: 'Berhasil',
                                text: 'Data Berhasil di Hapus',
                                icon: 'success'
                            });
                            tabel.row($(this).parents('tr')).remove().draw();
                        }
                    });
            } else {
                swal.close();
            }
        });
    }
</script>