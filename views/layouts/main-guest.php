<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <?php $this->head() ?>
    <title><?= Yii::$app->name ?></title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?php echo Yii::$app->request->baseUrl; ?>/images/favicon.png" rel="icon">
    <link href="<?php echo Yii::$app->request->baseUrl; ?>/images/favicon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo Yii::$app->request->baseUrl; ?>/library/bootslander/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?php echo Yii::$app->request->baseUrl; ?>/library/bootslander/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Yii::$app->request->baseUrl; ?>/library/bootslander/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo Yii::$app->request->baseUrl; ?>/library/bootslander/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?php echo Yii::$app->request->baseUrl; ?>/library/bootslander/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?php echo Yii::$app->request->baseUrl; ?>/library/bootslander/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?php echo Yii::$app->request->baseUrl; ?>/library/bootslander/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?php echo Yii::$app->request->baseUrl; ?>/library/bootslander/assets/css/style.css" rel="stylesheet">

    <style>
        .back-to-top {
            background: #444444;
        }

        .back-to-top:hover {
            background: #0D0D0D;
        }

        body {
            font-family: "Montserrat", sans-serif;
        }

        #hero:before {

            background: #fff;
        }

        #header.header-scrolled {
            background: #dc3545;
        }

        #hero h1,
        #hero h2,
        .navbar a {
            color: #444444;
        }

        .header-scrolled .navbar a {
            color: #fff;
        }

        .navbar a {
            font-size: 18px !important;
        }

        .navbar a:hover,
        .navbar .active {
            color: #000000 !important;
        }

        #hero h1 {
            font-size: 78px;
            font-weight: 700;
            line-height: 82px;
            ;
        }

        #hero h2 {
            font-size: 52px;
            font-weight: 500;
            line-height: 56px;
            ;
        }

        #contact h3 {
            font-size: 36px;
            font-weight: 500;
            line-height: 40px;
        }

        #contact h2 {
            font-size: 48px;
            font-weight: 700;
            line-height: 52px;
        }

        #about h3 {
            color: #dc3545 !important;
            font-size: 42px;
        }

        #about h4 {
            color: #dc3545 !important;
            font-size: 24px;
            font-family: "Montserrat", sans-serif;
        }

        #about p {
            font-size: 18px;
            font-family: "Montserrat", sans-serif;
        }

        .about .icon-box .icon i {
            color: #dc3545;
            font-size: 62px;

        }

        .about .icon-box .icon {
            margin-right: 20px;
        }

        .about .icon-box .icon,
        .about .icon-box .icon:hover {
            width: 100px;
            height: 100px;
            border: 2px solid #dc3545;
            border-radius: 70px;
            transition: 0.5s;
        }

        .about .icon-box:hover .icon {
            background: #dc3545;
        }

        .about .icon-box .title a,
        .about .icon-box .title a:hover {
            color: #dc3545;
            transition: 0.3s;
        }

        a {
            color: #dc3545;
        }

        #hero .btn-get-started {
            font-size: 20px;
        }

        .img-fluid {
            max-width: 135%;
            height: auto;
        }

        .tombol-login-atas {
            font-family: "Montserrat", sans-serif;
            padding: 10px 30px !important;
            border-radius: 50px;
            transition: 0.5s;
            color: #fff !important;
            background: #dc3545 !important;
            margin-left: 10px !important;
        }

        .navbar>ul>li>a.nav-link.scrollto.tombol-login-atas.bg-danger:hover {

            background-color: #fff !important;
        }

        .section-title p {
            color: #444444;
        }

        .pricing .box {
            background-color: #dc3545 !important;
        }

        .pricing h4 {
            color: #fff;
            font-size: 24px;
        }

        .pricing h3 {
            font-size: 36px;
            color: #fff;
            background: transparent;
            border-bottom: solid 0.25rem #fff;
        }

        .pricing .box {
            background-color: #e0884b !important;

        }

        .pricing .featured {
            background-color: #dc3545 !important;
        }

        .pricing .featured h3 {
            color: #fff;
            background: transparent;
        }

        .pricing ul,
        .pricing ul i {
            color: #fff;
            font-family: "Montserrat", sans-serif;
            text-align: left;
            font-size: 18px;
            line-height: 22px;
            font-weight: 500;
        }

        .pricing ul {
            min-height: 280px;
            margin-bottom: 0px;
        }

        .pricing .btn-wrap {
            background: transparent;
            margin-top: 0px;
        }

        .pricing .btn-buy {
            background: #fff;
            color: #dc3545;
            font-size: 16px;
        }

        .pricing .btn-buy:hover {
            background: #dc3545;
            color: #fff;
        }

        .pricing ul {
            list-style-type: "> ";
            list-style-position: outside;
            list-style-image: none;
            padding-left: 10px;
        }

        .pricing ul li {
            padding-bottom: 8px;
        }

        #footer {
            background: #dc3545;
        }

        .testimonials .container {
            padding: 10px 40px;
        }

        .testimonials,
        .testimonials::before {
            background: none !important;
        }

        .testimonial-item {
            background: #efa1a9 !important;
            padding: 10px;
        }

        .testimonial-item p {
            font-size: 24px !important;
        }

        .testimonials .testimonial-img {
            width: 200px;
            border-radius: 50%;
            border: 6px solid rgba(255, 255, 255, 0.15);
            margin: 0 auto;
        }

        .testimonials .gambar {
            text-align: center !important;
            margin-bottom: -80px !important;
        }

        .testimonials .testimonial-item h3 {
            font-size: 26px !important;
            font-weight: bold;
            margin: 80px 20px 50px 20px !important;
            color: #fff;
        }

        .testimonials .swiper-pagination .swiper-pagination-bullet {
            width: 16px;
            height: 16px;
            opacity: 1;
            background-color: #c3c3c3;
        }

        .testimonials .swiper-pagination .swiper-pagination-bullet-active {
            background-color: #dc3545 !important;
        }
    </style>

    <!-- =======================================================
  * Coded by: Safira Khansa, a.k.a. Nofriani
  * Started on: March 14th, 2023
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center header-transparent">
        <div class="container d-flex align-items-center justify-content-between">

            <div class="logo">
                <h1>
                    <?= Html::a('<img src="' . Yii::$app->request->baseUrl . '/images/favicon.png" alt="">', ['site/index'], []) ?>
                </h1>
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">BERANDA</a></li>
                    <li><a class="nav-link scrollto" href="#about">TENTANG</a></li>
                    <!-- <li><a class="nav-link scrollto" href="#features">Fasilitas</a></li>
                    <li><a class="nav-link scrollto" href="#gallery">Galeri</a></li>
                    <li><a class="nav-link scrollto" href="#team">Tutor</a></li> -->
                    <li><a class="nav-link scrollto" href="#pricing">PAKET</a></li>
                    <li><a class="nav-link scrollto" href="#contact">KONTAK</a></li>
                    <li>
                        <?= Html::a('LOGIN', ['site/login'], ['class' => 'nav-link scrollto tombol-login-atas bg-danger']) ?>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
                    <div data-aos="zoom-out">
                        <h1>Eduprime Course</h1>
                        <h2>Anything can be done with enough effort!</h2>
                        <div class="text-center text-lg-start">
                            <div class="d-flex justify-content-between col-md-10">
                                <div class="p-2">
                                    <?= Html::a('LOGIN', ['site/login'], ['class' => 'btn-get-started bg-danger btn-lg scrollto']) ?>
                                </div>
                                <div class="p-2">
                                    <?= Html::a('DAFTAR SEKARANG', ['pengguna/create'], ['class' => 'btn-get-started bg-white text-danger btn-lg scrollto', 'style' => 'border: solid 0.05rem #dc3545']) ?>
                                </div>
                                <div class="p-2">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/hero-img-2.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

        <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
            <defs>
                <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
            </defs>
            <g class="wave1">
                <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
            </g>
            <g class="wave2">
                <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
            </g>
            <g class="wave3">
                <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
            </g>
        </svg>

    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container">

                <div class="row">
                    <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5" data-aos="fade-left">
                        <h3>Kenapa memilih Eduprime Course?</h3>

                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
                            <div class="icon"><i class="bx bxs-school"></i></div>
                            <h4 class="title">Reason 1</h4>
                            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>

                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="200">
                            <div class="icon"><i class="bx bxs-book-add"></i></div>
                            <h4 class="title">Reason 2</h4>
                            <p class="description">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>

                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="300">
                            <div class="icon"><i class="bx bx-laptop"></i></div>
                            <h4 class="title">Reason 3</h4>
                            <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti provident</p>
                        </div>

                    </div>
                    <div class="col-xl-5 col-lg-6 d-flex justify-content-center align-items-stretch" data-aos="fade-right">
                        <!-- ======= Testimonials Section ======= -->
                        <section id="testimonials" class="testimonials">
                            <div class="container">

                                <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                                    <div class="swiper-wrapper">

                                        <div class="swiper-slide">
                                            <div class="gambar">
                                                <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/landing-page/ela.png" class="testimonial-img" alt="">
                                            </div>
                                            <div class="testimonial-item">
                                                <h3>Miss Ela</h3>
                                                <p>
                                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                                    At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.
                                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                                </p>
                                            </div>
                                        </div><!-- End testimonial item -->

                                        <div class="swiper-slide">
                                            <div class="gambar">
                                                <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/landing-page/snow.png" class="testimonial-img" alt="">
                                            </div>
                                            <div class="testimonial-item">
                                                <h3>Miss Snow</h3>
                                                <p>
                                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                                    At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.
                                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <div class="gambar">
                                                <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/landing-page/ariel.png" class="testimonial-img" alt="">
                                            </div>
                                            <div class="testimonial-item">
                                                <h3>Miss Ariel</h3>
                                                <p>
                                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                                    At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.
                                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>

                            </div>
                        </section><!-- End Testimonials Section -->
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Pricing Section ======= -->
        <section id="pricing" class="pricing">
            <div class="container">

                <div class="section-title text-center" data-aos="fade-up">
                    <p>PILIHAN PAKET</p>
                </div>

                <div class="row d-flex justify-content-center" data-aos="fade-left">
                    <div class="col-lg-3 col-md-6">
                        <div class="box" data-aos="zoom-in" data-aos-delay="100">
                            <h3>PREMIUM</h3>
                            <h4>CAT and Tutoring</h4>
                            <ul>
                                <li>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur</li>
                                <li>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur</li>
                                <li>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur</li>
                                <li>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur</li>
                            </ul>
                            <div class="btn-wrap">
                                <?= Html::a('Daftar Sekarang', ['pengguna/create'], ['class' => 'btn-buy']) ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-4 mt-md-0">
                        <div class="box featured" data-aos="zoom-in" data-aos-delay="200">
                            <h3>BRONZE</h3>
                            <h4>Tutoring Only</h4>
                            <ul>
                                <li>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur</li>
                                <li>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur</li>
                                <li>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur</li>
                                <li>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur</li>
                            </ul>
                            <div class="btn-wrap">
                                <?= Html::a('Daftar Sekarang', ['pengguna/create'], ['class' => 'btn-buy']) ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
                        <div class="box" data-aos="zoom-in" data-aos-delay="300">
                            <h3>DIAMOND</h3>
                            <h4>CAT Only</h4>
                            <ul>
                                <li>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur</li>
                                <li>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur</li>
                                <li>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur</li>
                                <li>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur</li>
                            </ul>
                            <div class="btn-wrap">
                                <!-- <a href="#" class="btn-buy">Buy Now</a> -->
                                <?= Html::a('Daftar Sekarang', ['pengguna/create'], ['class' => 'btn-buy']) ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Pricing Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Got Any Questions?</h2>
          <p>Contact Me</p>
        </div>

        <div class="row">

          <div class="col-lg-4" data-aos="fade-right" data-aos-delay="100">
            <div class="dark">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>Indonesia</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>khansa.safira19@gmail.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+62 856 6499 1937</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="200">

            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit" class="bg-warning text-dark">Send Message</button></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>Safira Khansa</span></strong> 2023
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/ -->
                Developed by <a href="https://khansasafira19.github.io/" class="text-dark">SK</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?php echo Yii::$app->request->baseUrl; ?>/library/bootslander/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="<?php echo Yii::$app->request->baseUrl; ?>/library/bootslander/assets/vendor/aos/aos.js"></script>
    <script src="<?php echo Yii::$app->request->baseUrl; ?>/library/bootslander/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo Yii::$app->request->baseUrl; ?>/library/bootslander/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?php echo Yii::$app->request->baseUrl; ?>/library/bootslander/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?php echo Yii::$app->request->baseUrl; ?>/library/bootslander/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?php echo Yii::$app->request->baseUrl; ?>/library/bootslander/assets/js/main.js"></script>

</body>

</html>