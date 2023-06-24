<?php

use Config\Constants;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Praktek 5.2 | CodeIgniter 4</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="<?= BASEURLKU; ?>writable/assets/img/ico.ico" type="image/x-icon">
    <script src="<?= BASEURLKU; ?>writable/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        webFont.load({
            google: {
                "families": ["Lato:300, 400, 700, 900"]
            },
            custom: {
                "Families": [
                    "Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Reguler", "Font Awesome 5 Brands", "simple-line-icon"
                ],
                Urls: ['<?= BASEURLKU; ?>writable/assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link rel="stylesheet" href="<?= BASEURLKU; ?>writable/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASEURLKU; ?>writable/assets/css/atlantis.min.css">
    <script src="<?= BASEURLKU; ?>writable/assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="<?= BASEURLKU; ?>writable/assets/js/core/popper.min.js"></script>
    <script src="<?= BASEURLKU; ?>writable/assets/js/core/bootstrap.min.js"></script>
    <script src="<?= BASEURLKU; ?>writable/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="<?= BASEURLKU; ?>writable/assets/js/plugin/jquery-ui-touch-punch/jquery-ui.touch-punch.min.js"></script>
    <script src="<?= BASEURLKU; ?>writable/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="<?= BASEURLKU; ?>writable/assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="<?= BASEURLKU; ?>writable/assets/js/atlantis.min.js"></script>
</head>

<body>

    <p style="width: 100%;text-align: center; margin-top: 50px;">
        <button type="button" class="btn btn-danger btn-lg">Tombol Percobaan Panel</button>
    </p>
    <div class="col-md-6 ml-auto mr-auto">
        <div class="card">
            <div class="crd-header">
                <h4 class="card-title">Percobaan Panel</h4>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills nav-danger nav-pills-no-bd" role="tablist">
                    <li class="nav-item">
                        <a href="#tab1" class="nav-link active" data-toggle="pill" role="tab">Tomorrow</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab2" class="nav-link" data-toggle="pill" role="tab">Greyhound</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab3" class="nav-link" data-toggle="pill" role="tab">Army Of Thieves</a>
                    </li>
                </ul>
                <div class="tab-content mt-2 mb-3">
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                        <p style="color: red;">A Family man is drafted to fight in a future war where the fate of humanity relies on his ability to confront the past</p>
                    </div>
                    <div class="tab-pane fade" id="tab2" role="tabpanel">
                        <p style="color: green;">Several months after the U.S entry into world War II, an Inexperienced U.S. Navy Commander mush lead an Allied convoy being stalked by a German submarine wolf pack</p>
                    </div>
                    <div class="tab-pane fade" id="tab3" role="tabpanel">
                        <p style="color: blue;">A prequel, set before the events of army of the Dead, which focuses on German safecracker ludwig Dieter leading a group of aspiring thieves on a top secret heist during the early stages of the zombie apocalypse</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>