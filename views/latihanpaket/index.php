<?php

use app\models\LatihanPaket;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\LatihanPaketSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Paket Soal';
?>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <h1><?= $this->title ?></h1>
            <div class="card">

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="p-2">

                        </div>
                        <div class="p-2">

                        </div>
                        <div class="p-2">
                            <?= Html::a('<i class="bi bi-file-bar-graph-fill"></i> Latihan Anda', ['latihansiswa/index'], ['class' => 'btn btn-outline-danger']) ?>
                            |
                            <?= Html::a('<i class="bi bi-x-diamond-fill"></i> Ranking Siswa', ['latihansiswa/rank'], ['class' => 'btn btn-outline-danger']) ?>
                            <?php if (Yii::$app->user->identity->level == 0) : ?>
                                |
                                <?= Html::a('<i class="bi bi-file-arrow-up-fill"></i> Tambah Paket Soal', ['create'], ['class' => 'btn btn-outline-danger']) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <br />

                    <?php Pjax::begin(['id' => 'some_pjax_id']); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        // 'filterModel' => $searchModel,
                        // 'showHeader' => false, // hide the header
                        'tableOptions' => ['class' => 'table table-hover'],
                        'options' => ['class' => 'table-responsive'],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            [
                                'attribute' => 'judul',
                                'enableSorting' => false,
                            ],
                            [
                                'attribute' => 'waktu_menit',
                                'header' => '<center>Waktu Pengerjaan (Dalam Menit)</center>',
                                'enableSorting' => false,
                                'value' => function ($model) {
                                    return '<center>' . $model->waktu_menit . '</center>';
                                },
                                'format' => 'html'
                            ],
                            [
                                'attribute' => 'timestamp_paket',
                                'value' => function ($model) {
                                    $formatter = Yii::$app->formatter;
                                    $formatter->locale = 'id-ID';
                                    return $formatter->asDatetime($model->timestamp_paket, 'd MMMM yyyy, hh:mm a');
                                },
                                'enableSorting' => false,
                                'label' => 'Dibuat Pada',
                                'visible' => Yii::$app->user->identity->level == 0 ? true : false
                            ],
                            [
                                'class' => ActionColumn::className(),
                                'urlCreator' => function ($action, LatihanPaket $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id_latihan_paket' => $model->id_latihan_paket]);
                                },
                                'template' => '{update}',
                                'header' => '<center>Update Paket</center>',
                                'visible' => Yii::$app->user->identity->level == 0 ? true : false,
                                'buttons' => [
                                    'update' => function ($key, $client, $index) {
                                        $url = '/_jariyah-fi/sk-eduprime-course/latihanpaket/update?id_latihan_paket=' . $index;
                                        // $url = '/latihansoal/index?id=' . $index; untuk cpanel
                                        return Html::a('<center><i class="bi bi-pencil-fill text-danger"></i></center>', $url, [
                                            'title' => 'Update paket soal ini',
                                        ]);
                                    },
                                ],

                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => '<center>Daftar Soal</center>',
                                'template' => '{view}',
                                'visible' => Yii::$app->user->identity->level == 0 ? true : false,
                                'buttons' => [
                                    'view' => function ($key, $client, $index) {
                                        $url = '/_jariyah-fi/sk-eduprime-course/latihansoal/index?id=' . $index;
                                        // $url = '/latihansoal/index?id=' . $index; untuk cpanel
                                        return Html::a('<center><i class="bi bi-eye-fill text-danger"></i></center>', $url, [
                                            'title' => 'Lihat soal-soal ini',
                                            'onclick' => 'window.open(this.href, "_blank"); return false;'
                                        ]);
                                    },
                                ],
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Mini Tes',
                                'template' => '{latihansiswa}',
                                'buttons' => [
                                    'latihansiswa' => function ($key, $client, $index) {
                                        $url = '/_jariyah-fi/sk-eduprime-course/latihanpaket/preview?id=' . $index;
                                        // $url = '/latihanpaket/preview?id=' . $index; untuk cpanel
                                        return Html::a('Kerjakan <i class="bi bi-alarm"></i>', '#', [
                                            'title' => 'Kerjakan latihan ini',
                                            'class' => 'modalButton btn btn-danger btn-sm',
                                            'data-pjax' => '0',
                                            'data-index' => $index, // added data-index attribute
                                            'data-url' => $url, // added data-url attribute
                                            'data-toggle' => 'modal',
                                            'data-target' => '#myModal',
                                        ]);
                                    },
                                ],
                            ],

                        ],
                    ]); ?>

                    <?php Pjax::end() ?>
                </div>
            </div>

        </div>
    </div>
</section>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.modalButton', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        var modal = $('#myModal');
        modal.find('.modal-content').load(url, function() {
            modal.modal('show');
        });
    });
</script>