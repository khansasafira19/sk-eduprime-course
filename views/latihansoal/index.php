<?php

use app\models\LatihanPaket;
use app\models\LatihanSiswa;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\Modal;
use app\models\LatihanSoal;

/** @var yii\web\View $this */
/** @var app\models\LatihanPaketSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Daftar Soal';
// $this->params['breadcrumbs'][] = $this->title;
?>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <h1><?= $this->title ?></h1>
            <div class="card">
                <div class="card-body">
                    <br />
                    <p class="text-right">
                        <?php if (Yii::$app->user->identity->level == 0) : ?>
                            <?= Html::a('<i class="bi bi-bag-plus-fill"></i> Daftar Paket Soal', ['latihanpaket/index'], ['class' => 'btn btn-outline-danger']) ?>
                            <?= Html::a('<i class="bi bi-bag-plus-fill"></i> Tambah Soal Baru', ['create'], ['class' => 'btn btn-outline-danger']) ?>
                        <?php endif; ?>

                    </p>
                    <?php Pjax::begin(['id' => 'some_pjax_id']); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        // 'filterModel' => $searchModel,
                        // 'showHeader' => false, // hide the header
                        'tableOptions' => ['class' => 'table table-hover'],
                        'options' => ['class' => 'table-responsive'],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            // [
                            //     'attribute' => 'induk_latihan',
                            //     'enableSorting' => false,
                            // ],
                            [
                                'attribute' => 'soal',
                                'enableSorting' => false,
                                'format'=>'html'
                            ],
                            [
                                'attribute' => 'owner',
                                'enableSorting' => false,
                                'value' => 'ownere.nama'
                            ],
                            [
                                'class' => ActionColumn::className(),
                                'urlCreator' => function ($action, LatihanSoal $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id_latihan_soal' => $model->id_latihan_soal]);
                                },
                                'buttons' => [
                                    'view' => function ($key, $client, $index) {
                                        $url = '/_jariyah-fi/sk-eduprime-course/latihansoal/view?id_latihan_soal=' . $index;
                                        return Html::a('<i class="bi bi-eye-fill text-danger"></i>', $url, ['title' => 'Lihat soal-soal ini', 'class' => 'modalButton', 'data-pjax' => '0']);
                                    },
                                    'update' => function ($key, $client, $index) {
                                        $url = '/_jariyah-fi/sk-eduprime-course/latihansoal/update?id_latihan_soal=' . $index;
                                        // $url = '/latihansoal/index?id=' . $index; untuk cpanel
                                        return Html::a('<i class="bi bi-pencil-fill text-danger"></i>', $url, [
                                            'title' => 'Update detail soal ini',
                                        ]);
                                    },
                                ],
                                'visibleButtons' => [
                                    'delete' => function ($model, $key, $index) {
                                        $ada = LatihanSiswa::find()->select('*')->where('latihan = ' . $model->induk_latihan)->all();
                                        if (!isset($ada))
                                            return true;
                                        else
                                            return false;
                                    },
                                ]
                            ],

                        ],
                    ]); ?>

                    <?php Pjax::end() ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?php
Modal::begin([
    'title' => 'Rincian Soal',
    'id' => 'modal',
    'size' => 'modal-lg'
]);

echo '<div id="modalContent"></div>';
Modal::end();
?>
<script>
    $(function() {
        // changed id to class
        $('.modalButton').click(function() {
            $.get($(this).attr('href'), function(data) {
                $('#modal').modal('show').find('#modalContent').html(data)
            });
            return false;
        });
    });
</script>