<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

?>
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= Yii::$app->request->baseUrl ?>/site/index">Beranda</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-12">
      <div class="row">

        <!-- Sales Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Materi <span>| PDF</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-file-pdf"></i>
                </div>
                <div class="ps-3">
                  <h6><?= $materipdf ?></h6>
                  <span class="text-success small pt-1 fw-bold">PDF Files</span> <span class="text-muted small pt-2 ps-1"></span>

                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

        <!-- Revenue Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card revenue-card">
            <div class="card-body">
              <h5 class="card-title">Materi <span>| Video</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-camera-video"></i>
                </div>
                <div class="ps-3">
                  <h6><?= $materiyt ?></h6>
                  <span class="text-success small pt-1 fw-bold">YouTube Links</span> <span class="text-muted small pt-2 ps-1"></span>

                </div>
              </div>
            </div>

          </div>
        </div><!-- End Revenue Card -->

        <!-- Customers Card -->
        <div class="col-xxl-4 col-xl-12">

          <div class="card info-card customers-card">

            <div class="card-body">
              <h5 class="card-title">Users <span>| Active</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6><?= $users ?></h6>
                  <span class="text-danger small pt-1 fw-bold">Students</span> <span class="text-muted small pt-2 ps-1"></span>

                </div>
              </div>

            </div>
          </div>

        </div><!-- End Customers Card -->        

        <!-- Recent Sales -->
        <div class="col-12">
          <div class="card recent-sales overflow-auto">
            <div class="card-body">
              <h5 class="card-title">Ranking Siswa <span>| Pengerjaan Pertama</span></h5>

              <?= yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => ['class' => 'table table-borderless'],
                'columns' => [
                  ['class' => 'yii\grid\SerialColumn'],
                  [
                    'attribute' => 'latihan',
                    'enableSorting' => false,
                    'value' => 'induke.judul'
                  ],
                  [
                    'attribute' => 'siswa',
                    'enableSorting' => false,
                    'value' => 'ownere.nama'
                  ],
                  [
                    'attribute' => 'ranking',
                    'enableSorting' => false,
                  ],
                  [
                    'attribute' => 'skor',
                    'enableSorting' => false,
                  ],
                ],
              ]); ?>

            </div>

          </div>
        </div><!-- End Recent Sales -->

        <!-- Top Selling -->
        <div class="col-12">
          <div class="card top-selling overflow-auto">
            <div class="card-body pb-0">
              <h5 class="card-title">Materials <span>| PDF and YouTube Videos</span></h5>
              <?php Pjax::begin(['id' => 'some_pjax_id']); ?>
              <?= yii\grid\GridView::widget([
                'dataProvider' => $dataProviderMateri,
                'tableOptions' => ['class' => 'table table-borderless'],
                'columns' => [
                  ['class' => 'yii\grid\SerialColumn'],
                  [
                    'attribute' => 'jenis',
                    'enableSorting' => false,
                    'value' => function ($model) {
                      if ($model->jenis == 0)
                        return  '<span class="text-dark"><i class="bi bi-file-earmark-pdf-fill"></i> File PDF</span>';
                      elseif ($model->jenis == 1)
                        return '<span class="text-dark"><i class="bi bi-camera-video-fill"></i> YouTube Video</span>';
                      else
                        return '';
                    },
                    'format' => 'html'
                  ],
                  [
                    'attribute' => 'judul',
                    'enableSorting' => false,
                  ],
                  [
                    'attribute' => 'filename_link',
                    'enableSorting' => false,
                    'value' => function ($model) {
                      return ($model->filename_link == null ? Html::a('<center><i class="bi bi-file-earmark-pdf-fill text-danger"></i></center>', '/_jariyah-fi/sk-eduprime-course/materi/viewpdf?id_materi=' . $model->id_materi, [
                        'title' => 'Lihat pdf ini', 'class' => 'modalButton', 'data-pjax' => '0'
                      ]) : Html::a('<center><i class="bi bi-camera-video-fill text-danger"></i></center>', '/_jariyah-fi/sk-eduprime-course/materi/viewpdf?id_materi=' . $model->id_materi, [
                        'title' => 'Lihat soal-soal ini', 'class' => 'modalButton', 'data-pjax' => '0'
                      ]));
                    },
                    'header' => '<center>File/Video</center>',
                    'format' => 'html'
                  ],
                ],
              ]); ?>
              <?php Pjax::end() ?>

            </div>

          </div>
        </div><!-- End Top Selling -->

      </div>
    </div><!-- End Left side columns -->
  </div>
</section>