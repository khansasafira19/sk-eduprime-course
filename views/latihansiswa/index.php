<?php

use app\models\LatihanSiswa;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\LatihanSiswaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Latihan Siswa';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <h1><?= Html::encode($this->title) ?></h1>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="p-2">

                        </div>
                        <div class="p-2">

                        </div>
                        <div class="p-2">
                            <?= Html::a('<i class="bi bi-book-fill"></i> Paket Soal', ['latihanpaket/index'], ['class' => 'btn btn-outline-danger']) ?>
                            |
                            <?= Html::a('<i class="bi bi-x-diamond-fill"></i> Ranking Siswa', ['latihansiswa/rank'], ['class' => 'btn btn-outline-danger']) ?>                            
                        </div>
                    </div>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        // 'filterModel' => $searchModel,
                        'tableOptions' => ['class' => 'table table-hover'],
                        'options' => ['class' => 'table-responsive'],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            // 'id_latihan_siswa',
                            // 'latihan',
                            [
                                'attribute' => 'latihan',
                                'enableSorting' => false,
                                'value' => 'induke.judul'
                            ],
                            // 'siswa',
                            [
                                'attribute' => 'siswa',
                                'enableSorting' => false,
                                'value' => 'ownere.nama',
                                'visible' => Yii::$app->user->identity->level == 1 ? true : false
                            ],
                            // 'timestamp_siswa',
                            [
                                'attribute' => 'timestamp_siswa',
                                'value' => function ($model) {
                                    $formatter = Yii::$app->formatter;
                                    $formatter->locale = 'id-ID';
                                    return $formatter->asDatetime($model->timestamp_siswa, 'd MMMM yyyy, hh:mm a');
                                },
                                'enableSorting' => false,
                            ],
                            // 'skor',
                            [
                                'attribute' => 'skor',
                                'enableSorting' => false,
                                'format' => ['decimal', 2],
                            ],
                            [
                                'attribute' => 'selesai',
                                'value' => function ($model) {
                                    if ($model->selesai == 0)
                                        return  '<button type="button" class="btn btn-danger btn-sm"><i class="bi bi-exclamation-circle-fill"></i> tidak selesai</button>';
                                    else
                                        return '<button type="button" class="btn btn-dark btn-sm"><i class="bi bi-bookmark-check-fill"></i> selesai</button>';
                                },
                                'format' => 'raw',
                                'enableSorting' => false,

                            ],
                            [
                                'attribute' => 'siswa',
                                'enableSorting' => false,
                                'value' => 'ownere.nama',
                                'visible' => Yii::$app->user->identity->level == 0 ? true : false
                            ],
                            [
                                'class' => ActionColumn::className(),
                                'urlCreator' => function ($action, LatihanSiswa $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id_latihan_siswa' => $model->id_latihan_siswa]);
                                },
                                'header' => '<center>Pembahasan</center>',
                                'template' => '{view}',
                                'buttons' => [
                                    'view' => function ($key, $client, $index) {
                                        $url = '/_jariyah-fi/sk-eduprime-course/latihansiswa/detail?id_latihan_siswa=' . $index;
                                        return Html::a('<center><i class="bi bi-eye-fill text-danger"></i></center>', $url, ['title' => 'Lihat pembahasan', 'class' => 'modalButton', 'data-pjax' => '0']);
                                    },
                                ],
                            ],
                            [
                                'class' => ActionColumn::className(),
                                'urlCreator' => function ($action, LatihanSiswa $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id_latihan_siswa' => $model->id_latihan_siswa]);
                                },
                                'header' => '<center>Hapus</center>',
                                'template' => '{delete}',
                                'visible' => Yii::$app->user->identity->level === 0 ? true : false,
                                'buttons' => [
                                    'delete' => function ($url, $model, $key) {
                                        return Html::a('<center><i class="fas text-danger fa-trash-alt"></i></center> ', $url, [
                                            'title' => 'Hapus latihan ini',
                                            'data-method' => 'post',
                                            'data-pjax' => 0,
                                            'data-confirm' => 'Anda yakin ingin menghapus latihan ini? Paket ' . $model['induke']['judul'] . ' dikerjakan oleh <br/><strong>' . $model['ownere']['nama'] . '</strong>'
                                        ]);
                                    },
                                ],
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</section>