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

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body" id="blokgrafik1"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body" id="blokgrafik2"></div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="form-group col-md-12">
                <label>Penerbit</label>
                <select class="form-control" id="cbopenerbit" onchange="caridatagrafik()">
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
        </div>
        <div class="card-body" id="blokgrafik3"></div>
    </div>
</div>

<script src="<?= BASEURLKU ?>writable/assets/highcharts.js"></script>
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

    grafikstatis();

    function grafikstatis() {
        Highcharts.chart('blokgrafik1', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafik Data Statis'
            },
            subtitle: {
                text: 'Data Penjualan 2022'
            },
            xAxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "Mei", "jun"],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Unit'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size: 15px;">{point.key}</span><table>',
                pointFormat: '<tr><td style="color: {series.color};padding:0">{series.name}:</td>' + '<td style="padding: 0;">&nbsp<b>{point.y:.0f}Unit</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Penjualan HP',
                data: [66, 71, 106, 129, 144, 176]
            }]
        });
    }

    grafikdinamis();

    function grafikdinamis() {
        Highcharts.chart('blokgrafik2', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafik Data Dinamis'
            },
            subtitle: {
                text: 'Data Buku Per Tahun'
            },
            xAxis: {
                categories: [
                    <?php
                    foreach ($dtgrafik as $k) {
                        echo "'" . $k->Tahun_Terbit . "',";
                    }
                    ?>
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Buah'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size: 15px;">{point.key}</span><table>',
                pointFormat: '<tr><td style="color: {series.color};padding:0">{series.name}:</td>' + '<td style="padding: 0;">&nbsp<b>{point.y:.0f} Buah</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Data Buku',
                data: [
                    <?php
                    foreach ($dtgrafik as $k) {
                        echo $k->Jumlah . ",";
                    }
                    ?>
                ]
            }]
        });
    }

    function caridatagrafik() {
        let penerbit = $("#cbopenerbit").val();
        if (penerbit != "") {
            $.getJSON(`<?= BASEURLKU ?>grafik/${penerbit}`, function(result) {
                if (result.length != 0) {
                    var tahunf = [];
                    var jumlahf = [];
                    $.each(result, function(i, key) {
                        let th = key.Tahun_Terbit;
                        let jml = key.Jumlah;
                        tahunf.push(th);
                        jumlahf.push(parseInt(jml));
                    })
                    buatgrafik(tahunf, jumlahf);
                } else {
                    swal({
                        title: "Gagal",
                        text: "Data Tidak di Temukan",
                        icon: "error"
                    });
                }
            })
        } else {
            $("#blokgrafik3").html("");
        }
    }

    function buatgrafik(tahunf, jumlahf) {
        Highcharts.chart('blokgrafik3', {
            chart: {
                type: 'areaspline'
            },
            title: {
                text: "Grafik Buku By Penerbit"
            },
            subtitle: {
                text: 'Pengelompokan Berdasarkan Tahun'
            },
            xAxis: {
                categories: tahunf,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: ''
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size: 15px;">{point.key}</span><table>',
                pointFormat: '<tr><td style="color: {series.color};padding:0">{series.name}:</td>' + '<td style="padding: 0;">&nbsp<b>{point.y:.0f} Buah</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            series: [{
                name: 'Jumlah Buku',
                data: jumlahf
            }]
        });
    }
</script>