<?php

use app\models\LatihanSiswa;
use PhpParser\Node\Stmt\Switch_;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\LatihanSoal $model */

$this->title = 'Rincian Soal # ' . $model->id_latihan_soal;
\yii\web\YiiAsset::register($this);
?>
<style>
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #fae2e5;
    }
</style>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h1><?= Html::encode($this->title) ?></h1>

                    <p>
                        <?= Html::a('<i class="bi bi-bag-plus-fill"></i> Daftar Soal', ['index?id=' . $model->induk_latihan], ['class' => 'btn btn-outline-danger']) ?>
                        <?= Html::a('Update', ['update', 'id_latihan_soal' => $model->id_latihan_soal], ['class' => 'btn btn-danger']) ?>
                        <?php $ada = LatihanSiswa::find()->select('*')->where('latihan = ' . $model->induk_latihan)->all() ?>
                        <?php if (empty($ada)) : ?>
                            <?= Html::a('Delete', ['delete', 'id_latihan_soal' => $model->id_latihan_soal], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Anda yakin akan menghapus soal ini? Penghapusan tidak dapat dibatalkan.',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        <?php endif; ?>
                    </p>

                    <?= DetailView::widget([
                        'model' => $model,
                        'options' => [
                            'class' => 'table table-striped detail-view',
                        ],
                        'attributes' => [
                            'id_latihan_soal',
                            [
                                'attribute' => 'induk_latihan',
                                'value' => function ($model) {
                                    return ('[' . $model->induke->id_latihan_paket . '] ' . $model->induke->judul);
                                },
                            ],
                            [
                                'attribute' => 'soal',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return nl2br($model->soal);
                                },
                            ],
                            [
                                'attribute' => 'choice_a',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return nl2br($model->choice_a);
                                },
                            ],
                            [
                                'attribute' => 'choice_b',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return nl2br($model->choice_b);
                                },
                            ],
                            [
                                'attribute' => 'choice_c',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return nl2br($model->choice_c);
                                },
                            ],
                            [
                                'attribute' => 'choice_d',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return nl2br($model->choice_d);
                                },
                            ],
                            [
                                'attribute' => 'choice_e',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return nl2br($model->choice_e);
                                },
                            ],
                            [
                                'attribute' => 'correct_choice',
                                'format' => 'html',
                                'value' => function ($model) {
                                    $hasil = '';
                                    switch ($model->correct_choice) {
                                        case 1:
                                            $hasil = '<b>Pilihan A</b><br/> ' . $model->choice_a;
                                            break;
                                        case 2:
                                            $hasil = '<b>Pilihan B</b><br/> ' . $model->choice_b;
                                            break;
                                        case 3:
                                            $hasil = '<b>Pilihan C</b><br/>  ' . $model->choice_c;
                                            break;
                                        case 4:
                                            $hasil = '<b>Pilihan D</b><br/>  ' . $model->choice_d;
                                            break;
                                        case 5:
                                            $hasil = '<b>Pilihan E</b><br/>  ' . $model->choice_e;
                                            break;
                                    }
                                    return $hasil;
                                },
                            ],
                            [
                                'attribute' => 'pembahasan',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return nl2br($model->pembahasan);
                                },
                            ],
                            [
                                'attribute' => 'timestamp_soal',
                                'value' => function ($model) {
                                    $formatter = Yii::$app->formatter;
                                    $formatter->locale = 'id-ID';
                                    return $formatter->asDatetime($model->timestamp_soal, 'd MMMM yyyy, hh:mm a');
                                },
                            ],
                            // 'owner',
                            [
                                'attribute' => 'owner',
                                'value' => function ($model) {
                                    return ($model->ownere->nama);
                                },
                            ],
                        ],
                    ]) ?>


                </div>
            </div>
        </div>
    </div>
</section>