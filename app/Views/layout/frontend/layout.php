<!DOCTYPE html>
<html lang="en" ng-app="apps" ng-controller="homeController">

<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">

    <!-- Site Metas -->
    <title>Food Funday Restaurant - One page HTML Responsive</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="../assets/frontend/images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="../assets/frontend/images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/frontend/css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="../assets/frontend/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../assets/frontend/css/responsive.css">
    <!-- color -->
    <link id="changeable-colors" rel="stylesheet" href="../assets/frontend/css/colors/orange.css" />

    <!-- Modernizer -->
    <script src="../assets/frontend/js/modernizer.js"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.../assets/frontend/js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div id="loader">
        <div id="status"></div>
    </div>
    <div id="site-header">
        <header id="header" class="header-block-top">
            <div class="container">
                <div class="row">
                    <div class="main-menu">
                        <!-- navbar -->
                        <nav class="navbar navbar-default" id="mainNav">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <div class="logo">
                                    <h5 style="color: white;">Pemesanan Catering</h5>
                                    <!-- <a class="navbar-brand js-scroll-trigger logo-header" href="#">
                                        <img src="../assets/frontend/images/logo.png" alt="">
                                    </a> -->
                                </div>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="active"><a href="#banner">Home</a></li>
                                    <li><a href="#about">Tentang Kami</a></li>
                                    <li><a href="#menu">Menu</a></li>
                                    <li><a href="#our_team">Team</a></li>
                                    <li><a href="#gallery">Gallery</a></li>
                                    <li><a href="#pricing">pricing</a></li>
                                    <li><a href="<?= base_url('auth')?>">Login</a></li>
                                </ul>
                            </div>
                            <!-- end nav-collapse -->
                        </nav>
                        <!-- end navbar -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </header>
        <!-- end header -->
    </div>
    <!-- end site-header -->

    <div id="banner" class="banner full-screen-mode parallax">
        <div class="container pr">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="banner-static">
                    <div class="banner-text">
                        <div class="banner-cell">
                            <h1>Kami Melayani <span class="typer" id="some-id" data-delay="200" data-delim=":"
                                    data-words="Wedding:Event" data-colors="red"></span><span class="cursor"
                                    data-cursorDisplay="_" data-owner="some-id"></span></h1>
                            <h2>Pemesanan Catering </h2>
                            <a href="#about">
                                <div class="mouse"></div>
                            </a>
                        </div>
                        <!-- end banner-cell -->
                    </div>
                    <!-- end banner-text -->
                </div>
                <!-- end banner-static -->
            </div>
            <!-- end col -->
        </div>
        <!-- end container -->
    </div>
    <!-- end banner -->

    <div id="about" class="about-main pad-top-100 pad-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                        <h2 class="block-title"> About Us </h2>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                        <div class="about-images">
                            <img class="about-main" src="../assets/frontend/images/about-main.jpg"
                                alt="About Main Image">
                            <img class="about-inset" src="../assets/frontend/images/about-inset.jpg"
                                alt="About Inset Image">
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>

    <div class="special-menu pad-top-100 parallax">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                        <h2 class="block-title color-white text-center"> Today's Special </h2>
                    </div>
                    <div class="special-box">
                        <div id="owl-demo">
                            <?php foreach ($menu as $key => $value):?>
                            <div class="item item-type-zoom">
                                <a href="#" class="item-hover">
                                    <div class="item-info">
                                        <div class="headline">
                                            <?= $value['menu']?>
                                            <div class="line"></div>
                                            <div class="dit-line">Lorem ipsum dolor sit amet, consectetur adip aliqua.
                                                Ut enim ad minim venia.</div>
                                        </div>
                                    </div>
                                </a>
                                <div class="item-img">
                                    <img src="../assets/backend/img/makanan/<?= $value['foto']?>" alt="sp-menu">
                                </div>
                            </div>
                            <?php endforeach;?>
                            <!-- <div ng-repeat="item in datas.menu" class="item item-type-zoom">
                                <a href="#" class="item-hover">
                                    <div class="item-info">
                                        <div class="headline">
                                            {{item.menu}}
                                            <div class="line"></div>
                                            <div class="dit-line">{{item.keterangan}}</div>
                                        </div>
                                    </div>
                                </a>
                                <div class="item-img">
                                    <img ng-src="{{item.foto}}" alt="sp-menu">
                                </div>
                            </div> -->

                        </div>
                    </div>
                    <!-- end special-box -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end special-menu -->

    <div id="menu" class="menu-main pad-top-100 pad-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                        <h2 class="block-title text-center">
                            Our Menu
                        </h2>
                    </div>
                    <div class="tab-menu">
                        <div class="slider slider-nav">
                            <div class="tab-title-menu">
                                <h2>STARTERS</h2>
                                <p> <i class="flaticon-canape"></i> </p>
                            </div>
                            <div class="tab-title-menu">
                                <h2>MAIN DISHES</h2>
                                <p> <i class="flaticon-dinner"></i> </p>
                            </div>
                            <div class="tab-title-menu">
                                <h2>DESERTS</h2>
                                <p> <i class="flaticon-desert"></i> </p>
                            </div>
                            <div class="tab-title-menu">
                                <h2>DRINKS</h2>
                                <p> <i class="flaticon-coffee"></i> </p>
                            </div>
                        </div>
                        <div class="slider slider-single">
                            <div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"
                                    ng-repeat="item in datas.menu | filter: 'Starters'">
                                    <div class="offer-item">
                                        <img ng-src="{{item.foto}}" alt="" class="img-responsive">
                                        <div>
                                            <h3>{{item.menu}}</h3>
                                            <p>
                                                {{item.keterangan}}
                                            </p>
                                        </div>
                                        <span class="offer-price"
                                            style="font-size: 15px;">{{item.harga | currency: 'Rp. '}}</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"
                                    ng-repeat="item in datas.menu | filter: 'Main'">
                                    <div class="offer-item">
                                        <img ng-src="{{item.foto}}" alt="" class="img-responsive">
                                        <div>
                                            <h3>{{item.menu}}</h3>
                                            <p>
                                                {{item.keterangan}}
                                            </p>
                                        </div>
                                        <span class="offer-price"
                                            style="font-size: 15px;">{{item.harga | currency: 'Rp. '}}</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"
                                    ng-repeat="item in datas.menu | filter: 'Deserts'">
                                    <div class="offer-item">
                                        <img ng-src="{{item.foto}}" alt="" class="img-responsive">
                                        <div>
                                            <h3>{{item.menu}}</h3>
                                            <p>
                                                {{item.keterangan}}
                                            </p>
                                        </div>
                                        <span class="offer-price"
                                            style="font-size: 15px;">{{item.harga | currency: 'Rp. '}}</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"
                                    ng-repeat="item in datas.menu | filter: 'Drinks'">
                                    <div class="offer-item">
                                        <img ng-src="{{item.foto}}" alt="" class="img-responsive">
                                        <div>
                                            <h3>{{item.menu}}</h3>
                                            <p>
                                                {{item.keterangan}}
                                            </p>
                                        </div>
                                        <span class="offer-price"
                                            style="font-size: 15px;">{{item.harga | currency: 'Rp. '}}</span>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                        </div>
                    </div>
                    <!-- end tab-menu -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end menu -->

    <div id="our_team" class="team-main pad-top-100 pad-bottom-100 parallax">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                        <h2 class="block-title text-center">
                            Our Team
                        </h2>
                    </div>
                    <div class="team-box">

                        <div class="row">
                            <?php foreach ($pegawai as $key => $value):?>
                            <div class="col-md-4 col-sm-6">
                                <div class="sf-team" style="margin-bottom: 20px;">
                                    <div class="thumb">
                                        <a href="#"><img src="../assets/backend/img/foto/<?= $value['foto']?>"
                                                alt=""></a>
                                    </div>
                                    <div class="text-col">
                                        <h3><?= $value['nama']?></h3>
                                        <p><?= $value['pekerjaan']?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>

                            <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div>
                    <!-- end team-box -->

                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end team-main -->

    <div id="gallery" class="gallery-main pad-top-100 pad-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                        <h2 class="block-title text-center">
                            Our Gallery
                        </h2>
                    </div>
                    <div class="gal-container clearfix">
                        <?php foreach ($menu as $key => $value):?>
                        <div class="col-md-4 col-sm-6 co-xs-12 gal-item">
                            <div class="box">
                                <a href="#" data-toggle="modal" data-target="#<?= $key?>">
                                    <img src="../assets/backend/img/makanan/<?= $value['foto']?>" alt="" />
                                </a>
                                <div class="modal fade" id="<?= $key?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <div class="modal-body">
                                                <img src="../assets/backend/img/makanan/<?= $value['foto']?>" alt="" />
                                            </div>
                                            <div class="col-md-12 description">
                                                <h4><?= $value['keterangan']?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                    <!-- end gal-container -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end gallery-main -->

    <div id="pricing" class="blog-main pad-top-100 pad-bottom-100 parallax">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2 class="block-title text-center">
                        Pricing
                    </h2>
                </div>
                <div class="panel-pricing-in">
                    <div ng-repeat="item in datas.paket" class="col-md-4 col-sm-4 text-center">
                        <div class="panel panel-pricing">
                            <div class="panel-heading">
                                <!-- <div class="pric-icon">
                                    <img src="../assets/frontend/images/store.png" alt="" />
                                </div> -->
                                <h2>{{item.nama_paket}}</h2>
                            </div>
                            <div class="panel-body text-center">
                                <p><strong>{{item.harga*item.porsi | currency: 'Rp. '}}</strong></p>
                                <h2 style="color: black;">{{item.porsi}} Porsi</h2>
                            </div>
                            <ul class="list-group text-center">
                                <li ng-repeat="det in item.detail" class="list-group-item"><i class="fa fa-check"></i> {{det.menu}}</li>
                            </ul>
                            <div class="panel-footer">
                                <a class="btn btn-lg btn-block hvr-underline-from-center" href="<?= base_url('auth')?>">Purchase Now!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end blog-main -->


    <div id="footer" class="footer-main">
        <div class="footer-box pad-top-70">
            <div class="container">
                <div class="row">
                    <div class="footer-in-main">
                        <div class="footer-logo">
                            <div class="text-center">
                                <img src="../assets/frontend/images/logo.png" alt="" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                            <div class="footer-box-a">
                                <h3>About Us</h3>
                                <p>Kepuasan anda adalah kebanggan kami</p>

                            </div>
                            <!-- end footer-box-a -->
                        </div>
                        <!-- end col -->
                        <!-- end col -->
                        <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                            <div class="footer-box-c">
                                <h3>Kontak Kami</h3>
                                <p>
                                    <i class="fa fa-map-signs" aria-hidden="true"></i>
                                    <span>Perum Pemda II No 216 Jayapura</span>
                                </p>
                                <p>
                                    <i class="fa fa-mobile" aria-hidden="true"></i>
                                    <span>
                                        +6282238281801
                                    </span>
                                </p>
                                <p>
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <span><a href="#">deni@malik.com</a></span>
                                </p>
                            </div>
                            <!-- end footer-box-c -->
                        </div>
                        <!-- end col -->
                        <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                            <div class="footer-box-d">
                                <h3>Waktu Pelayanan</h3>

                                <ul>
                                    <li>
                                        <p>Senin - Sabtu </p>
                                        <span> 08:00 AM - 23:59 PM</span>
                                    </li>
                                </ul>
                            </div>
                            <!-- end footer-box-d -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end footer-in-main -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
            <div id="copyright" class="copyright-main">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h6 class="copy-title"> Copyright &copy; 2021 Octagon Cendrawasih Solusion <a
                                    href="https://themewagon.com/" target="_blank">OCT</a> </h6>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            <!-- end copyright-main -->
        </div>
        <!-- end footer-box -->
    </div>
    <!-- end footer-main -->

    <a href="#" class="scrollup" style="display: none;">Scroll</a>

    <section id="color-panel" class="close-color-panel">
        <a class="panel-button gray2"><i class="fa fa-cog fa-spin fa-2x"></i></a>
        <!-- Colors -->
        <div class="segment">
            <h4 class="gray2 normal no-padding">Color Scheme</h4>
            <a title="orange" class="switcher orange-bg"></a>
            <a title="strong-blue" class="switcher strong-blue-bg"></a>
            <a title="moderate-green" class="switcher moderate-green-bg"></a>
            <a title="vivid-yellow" class="switcher vivid-yellow-bg"></a>
        </div>
    </section>

    <!-- ALL JS FILES -->
    <script src="../assets/frontend/js/all.js"></script>
    <script src="../assets/frontend/js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="../assets/frontend/js/custom.js"></script>
    <script src="../assets/backend/dist/js/angular/angular.min.js"></script>
    <script src="../assets/backend/js/guest.js"></script>
    <script src="../assets/backend/js/services/helper.services.js"></script>
    <script src="../assets/backend/js/services/auth.services.js"></script>
    <script src="../assets/backend/js/services/admin.services.js"></script>
    <script src="../assets/backend/js/services/message.services.js"></script>
    <script src="../assets/backend/js/controllers/guest.controllers.js"></script>
    <script src="../assets/backend/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../assets/backend/libs/swangular/swangular.js"></script>
    <script src="../assets/backend/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/backend/libs/angular-datatables/dist/angular-datatables.min.js"></script>
    <script src="../assets/backend/libs/angular-locale_id-id.js"></script>
    <script src="../assets/backend/libs/input-mask/angular-input-masks-standalone.min.js"></script>
    <script src="../assets/backend/libs/jquery.PrintArea.js"></script>
    <script src="../assets/backend/libs/angular-base64-upload/dist/angular-base64-upload.min.js"></script>
    <script src="../assets/backend/libs/loading/dist/loadingoverlay.min.js"></script>
    <script src="../assets/backend/libs/calendar/main.min.js"></script>
    <script src="../assets/backend/libs/calendar/locales-all.min.js"></script>
    <script src="../assets/backend/libs/angularjs-currency-input-mask/dist/angularjs-currency-input-mask.min.js">
    </script>
</body>

</html>