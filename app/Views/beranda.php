<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Beranda</h2>
                <h5 class="text-white op-7 mb-2">Halaman Beranda Informasi Sistem</h5>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" role="dialog" id="modaldetail">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-size: 20px;" id="blokjudul"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="blokhasil" style="font-size: 17px;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5">

    <div class="row mt--2">

        <div class="col-md-3">
            <div class="card card-info">
                <div class="card-header">
                    <div class="card-title">Jumlah Total Buku</div>
                </div>
                <div class="card-body pb-0">
                    <div class="mb-4 mt-2">
                        <h1><?= $jmlbuku->Jumlah; ?> Buah</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-danger" style="cursor: pointer;" data-jenis="bytahun" data-nilai="<?= $maxtahun->Tahun_Terbit; ?>" onclick="rekap_dashboard(this)">
                <!-- <div class="card card-danger"> -->
                <div class="card-header">
                    <div class="card-title">Tahun Penerbitan Terbanyak</div>
                </div>
                <div class="card-body pb-0">
                    <div class="mb-4 mt-2">
                        <h1><?= $maxtahun->Tahun_Terbit . " (" . $maxtahun->Jumlah . " Buku)"; ?></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-warning" style="cursor: pointer;" data-jenis="bypenerbit" data-nilai="<?= $maxpenerbit->Penerbit; ?>" onclick="rekap_dashboard(this)">
                <div class="card-header">
                    <div class="card-title">Penerbit Terbanyak</div>
                </div>
                <div class="card-body pb-0">
                    <div class="mb-4 mt-2">
                        <h1><?= $maxpenerbit->Penerbit; ?></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-success" style="cursor: pointer;" data-jenis="byrak" data-nilai="<?= $maxrak->Rak; ?>" onclick="rekap_dashboard(this)">
                <div class="card-header">
                    <div class="card-title">Rak Penampung Terbanyak</div>
                </div>
                <div class="card-body pb-0">
                    <div class="mb-4 mt-2">
                        <h1>Blok <?= $maxrak->Rak; ?></h1>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $("#mnberanda").addClass("active");

    function rekap_dashboard(el) {
        let jenis = $(el).data("jenis");
        let nilai = $(el).data("nilai");
        let judul = "";
        if (jenis == "" || nilai == "") {
            swal({
                title: "Gagal",
                text: "Rekap Tidak Terdeteksi",
                icon: "error"
            });
            return;
        }
        $.getJSON(`<?= BASEURLKU; ?>rekapdashboard/${jenis}/${nilai}`, function(result) {
            if (result.length != 0) {
                let dt = "";
                let daftar = ["success", "primary", "info", "warning", "secondary", "danger", "default"];
                $.each(result, function(i, key) {
                    let warna = Math.floor(Math.random() * 7);
                    dt += `<div class="alert alert-${daftar[warna]}" role="alert">${key.Judul}</div>`;
                })
                $("#blokhasil").html(dt);
                if (jenis == "bytahun") {
                    judul = "Rekap Buku Berdasarkan Tahun " + nilai;
                } else if (jenis == "bypenerbit") {
                    judul = "Rekap Buku Berdasarkan Penerbit " + nilai;
                } else {
                    judul = "Rekap Buku Berdasarkan Rak " + nilai;

                }
                $("#blokjudul").html(judul);
                $("#modaldetail").modal("show");
            } else {
                swal({
                    title: "Gagal",
                    text: "Rekap Tidak Terdeteksi",
                    icon: "error"
                });
                $("#blokhasil").html("");
            }
        });
    }
</script>