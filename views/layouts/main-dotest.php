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
    <?php include_once('_metatags.php')?>
    <title><?=Yii::$app->name?></title>
    <!-- =======================================================
  * Coded by: Safira Khansa, a.k.a. Nofriani
  * Started on: March 14th, 2023
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  ======================================================== -->
</head>

<!-- <body> -->

<body class="d-flex flex-column h-100 toggle-sidebar">
    <?php $this->beginBody() ?>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="<?php echo Yii::$app->request->baseUrl; ?>" class="logo d-flex align-items-center">
            <!-- untuk di rumahweb: echo Yii::$app->request->hostInfo; -->
                <!-- <img src="<?php //echo Yii::$app->request->baseUrl; ?>/library/niceadmin/assets/img/logo.png" alt=""> -->
                <span class="d-none d-lg-block"><?php echo Yii::$app->name ?></span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <!-- Navigation -->
        <?= $this->render('navbar') ?>

    </header><!-- End Header -->

    <!-- Navigation -->
    <?= $this->render('sidebar') ?>

    <main id="main" class="main flex-shrink-0" role="main">
        <!-- <div class="container"> -->
            <?php if (!empty($this->params['breadcrumbs'])) : ?>
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            <?php endif ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        <!-- </div> -->
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer mt-auto py-3 bg-light">
        <div class="copyright">
            &copy; Copyright <strong><span>Safira Khansa</span></strong> 2023
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Developed by <a href="https://khansasafira19.github.io/" target="_blank">SK</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <?php include_once('_metatags2.php')?>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>