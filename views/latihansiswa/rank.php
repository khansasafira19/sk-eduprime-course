<?php

use app\models\LatihanSiswa;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\LatihanSiswaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ranking Siswa';
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
                            <?= Html::a('<i class="bi bi-file-bar-graph-fill"></i> Latihan Anda', ['latihansiswa/index'], ['class' => 'btn btn-outline-danger']) ?>
                        </div>
                    </div>
                    <h5 class="card-title">
                        <i>
                            Dihitung dari Percobaan Pertama
                        </i>
                    </h5>
                    <br />
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
                                'value' => 'ownere.nama'
                            ],
                            [
                                'attribute' => 'ranking',
                                'enableSorting' => false,
                            ],
                            [
                                'attribute' => 'timestamp_siswa',
                                'value' => function ($model) {
                                    $formatter = Yii::$app->formatter;
                                    $formatter->locale = 'id-ID';
                                    return $formatter->asDatetime($model->timestamp_siswa, 'd MMMM yyyy, hh:mm a');
                                },
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
        </div>
    </div>
</section>