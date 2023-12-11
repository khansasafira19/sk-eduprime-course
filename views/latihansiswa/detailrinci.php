<?php

use app\models\LatihanSiswa;
use PhpParser\Node\Stmt\Switch_;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\LatihanSoal $model */

// $this->title = 'Pembahasan Soal Tes # ' . $model->id_latihan_siswa_rinci;
\yii\web\YiiAsset::register($this);
?>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h1><?= Html::encode($this->title) ?></h1>

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            // 'id_latihan_siswa_rinci',
                            [
                                'attribute' => 'latihan_siswa',
                            ],
                            [
                                'attribute' => 'latihan_soal',
                            ],
                            [
                                'attribute' => 'soal',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return nl2br($model->soale->soal);
                                },
                            ],
                            [
                                'attribute' => 'soal',
                                'label'=>'Pilihan A',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return nl2br($model->soale->choice_a);
                                },
                            ],
                            [
                                'attribute' => 'soal',
                                'label'=>'Pilihan B',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return nl2br($model->soale->choice_b);
                                },
                            ],
                            [
                                'attribute' => 'soal',
                                'label'=>'Pilihan C',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return nl2br($model->soale->choice_c);
                                },
                            ],
                            [
                                'attribute' => 'soal',
                                'label'=>'Pilihan D',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return nl2br($model->soale->choice_d);
                                },
                            ],
                            [
                                'attribute' => 'soal',
                                'label'=>'Pilihan E',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return nl2br($model->soale->choice_e);
                                },
                            ],
                            [
                                'attribute' => 'correct_choice',
                                'format' => 'html',
                                'value' => function ($model) {
                                    $hasil = '';
                                    switch ($model->soale->correct_choice) {
                                        case 1:
                                            $hasil = '<b>Pilihan A</b><br/> ' . $model->soale->choice_a;
                                            break;
                                        case 2:
                                            $hasil = '<b>Pilihan B</b><br/> ' . $model->soale->choice_b;
                                            break;
                                        case 3:
                                            $hasil = '<b>Pilihan C</b><br/>  ' . $model->soale->choice_c;
                                            break;
                                        case 4:
                                            $hasil = '<b>Pilihan D</b><br/>  ' . $model->soale->choice_d;
                                            break;
                                        case 5:
                                            $hasil = '<b>Pilihan E</b><br/>  ' . $model->soale->choice_e;
                                            break;
                                    }
                                    return $hasil;
                                },
                            ],
                            [
                                'attribute' => 'user_choice',
                                'format' => 'html',
                                'value' => function ($model) {
                                    $hasil = '';
                                    switch ($model->user_choice) {
                                        case 1:
                                            $hasil = '<b>Pilihan A</b><br/> ' . $model->soale->choice_a;
                                            break;
                                        case 2:
                                            $hasil = '<b>Pilihan B</b><br/> ' . $model->soale->choice_b;
                                            break;
                                        case 3:
                                            $hasil = '<b>Pilihan C</b><br/>  ' . $model->soale->choice_c;
                                            break;
                                        case 4:
                                            $hasil = '<b>Pilihan D</b><br/>  ' . $model->soale->choice_d;
                                            break;
                                        case 5:
                                            $hasil = '<b>Pilihan E</b><br/>  ' . $model->soale->choice_e;
                                            break;
                                    }
                                    return $hasil;
                                },
                            ],
                            [
                                'attribute' => 'pembahasan',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return nl2br($model->soale->pembahasan);
                                },
                            ],
                        ],
                    ]) ?>


                </div>
            </div>
        </div>
    </div>
</section>