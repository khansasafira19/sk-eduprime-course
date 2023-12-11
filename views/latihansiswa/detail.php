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

$this->title = 'Pembahasan Soal';
// $this->params['breadcrumbs'][] = $this->title;
?>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <h1><?= $this->title ?></h1>
            <div class="card">
                <div class="card-body">
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
                                'attribute' => 'latihan_siswa',
                                'enableSorting' => false,
                                // 'format'=>'html'
                            ],
                            [
                                'attribute' => 'latihan_soal',
                                'enableSorting' => false,
                                // 'format'=>'html'
                            ],
                            [
                                'header' => 'Pertanyaan',
                                'enableSorting' => false,
                                'value' => 'soale.soal',
                                'format' => 'html'
                            ],
                            [
                                'header' => 'Jawaban Benar',
                                'enableSorting' => false,
                                'value' => function ($model) {
                                    $hasil = '-';
                                    $condition = $model->soale->correct_choice;
                                    switch ($condition) {
                                        case 1:
                                            $hasil = 'A . ' . $model->soale->choice_a;
                                            break;
                                        case 2:
                                            $hasil = 'B . ' . $model->soale->choice_b;
                                            break;
                                        case 3:
                                            $hasil = 'C . ' . $model->soale->choice_c;
                                            break;
                                        case 4:
                                            $hasil = 'D . ' . $model->soale->choice_d;
                                            break;
                                        case 5:
                                            $hasil = 'E . ' . $model->soale->choice_e;
                                            break;
                                        default:
                                            $hasil = '-';
                                            break;
                                    }
                                    return $hasil;
                                },
                                // 'value' => 'soale.correct_choice',
                                'format' => 'html'
                            ],
                            [
                                'header' => 'Jawaban Anda',
                                'enableSorting' => false,
                                'value' => function ($model) {
                                    $hasil = '-';
                                    $condition = $model->user_choice;
                                    switch ($condition) {
                                        case 1:
                                            $hasil = 'A . ' . $model->soale->choice_a;
                                            break;
                                        case 2:
                                            $hasil = 'B . ' . $model->soale->choice_b;
                                            break;
                                        case 3:
                                            $hasil = 'C . ' . $model->soale->choice_c;
                                            break;
                                        case 4:
                                            $hasil = 'D . ' . $model->soale->choice_d;
                                            break;
                                        case 5:
                                            $hasil = 'E . ' . $model->soale->choice_e;
                                            break;
                                        default:
                                            $hasil = '-';
                                            break;
                                    }
                                    return $hasil;
                                },
                                // 'value' => 'soale.correct_choice',
                                'format' => 'html'
                            ],
                            [
                                'class' => ActionColumn::className(),
                                // 'urlCreator' => function ($action, LatihanSoal $model, $key, $index, $column) {
                                //     return Url::toRoute([$action, 'id_latihan_soal' => $model->id_latihan_soal]);
                                // },
                                'template' => '{view}',
                                'buttons' => [
                                    'view' => function ($key, $client, $index) {
                                        $url = '/_jariyah-fi/sk-eduprime-course/latihansiswa/detailrinci?id_latihan_siswa_rinci=' . $index;
                                        return Html::a('<i class="bi bi-eye-fill text-danger"></i>', $url, ['title' => 'Lihat lebih rinci soal ini', 'class' => 'modalButton', 'data-pjax' => '0']);
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