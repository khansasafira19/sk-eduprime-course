<?php

use app\models\LatihanSiswa;
use PhpParser\Node\Stmt\Switch_;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\LatihanSoal $model */

$this->title = 'Rincian Materi # ' . $model->id_materi;
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
                        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->username === $model->owner && $model->deleted == 0) : ?>
                            <?= Html::a('Update', ['update', 'id_materi' => $model->id_materi], ['class' => 'btn btn-outline-dark']) ?>
                            <?= Html::a('Delete', ['delete', 'id_materi' => $model->id_materi], [
                                'class' => 'btn btn-outline-danger',
                                'data' => [
                                    'confirm' => 'Anda yakin akan menghapus materi ini?',
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
                            'id_materi',
                            [
                                'attribute' => 'jenis',
                                'value' => $model->jenis == 0 ? '<button type="button" class="btn btn-dark btn-sm"><i class="bi bi-file-earmark-pdf-fill"></i> pdf</button>' : ($model->jenis == 1 ? '<button type="button" class="btn btn-success btn-sm"><i class="bi bi-camera-video-fill"></i> video</button>' : ''),
                                'format' => 'html'
                            ],
                            [
                                'attribute' => 'judul',
                            ],
                            [
                                'attribute' => 'filename_link',
                                'value' => $model->jenis == 0 ? Html::a('<i class="fas fa-book-reader"></i> ',  ['pdf/materi/' . $model->id_materi . '.pdf']) : $model->filename_link,
                                'format' => 'html'
                            ],
                            [
                                'attribute' => 'owner',
                                'visible' => Yii::$app->user->identity->level == 0 ? true : false,
                                'value' => $model->ownere->nama,
                            ],
                            [
                                'attribute' => 'timestamp',
                                'value' => function ($model) {
                                    $formatter = Yii::$app->formatter;
                                    $formatter->locale = 'id-ID';
                                    return $formatter->asDatetime($model->timestamp, 'd MMMM yyyy, hh:mm a');
                                },
                                'visible' => Yii::$app->user->identity->level == 0 ? true : false,
                            ],
                            [
                                'attribute' => 'timestamp_lastupdate',
                                'value' => function ($model) {
                                    $formatter = Yii::$app->formatter;
                                    $formatter->locale = 'id-ID';
                                    return $formatter->asDatetime($model->timestamp_lastupdate, 'd MMMM yyyy, hh:mm a');
                                },
                                'visible' => Yii::$app->user->identity->level == 0 ? true : false,
                            ],
                        ],
                    ]) ?>


                </div>
            </div>
        </div>
    </div>
</section>