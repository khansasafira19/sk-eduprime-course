<?php

use app\models\LatihanSoal;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\LatihanPaket $model */

$this->title = $model->id_latihan_paket;
$this->params['breadcrumbs'][] = ['label' => 'Latihan Pakets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h1><?= Html::encode($this->title) ?></h1>

                    <p>
                        <?= Html::a('Update', ['update', 'id_latihan_paket' => $model->id_latihan_paket], ['class' => 'btn btn-danger']) ?>
                        <?php $ada = LatihanSoal::find()->select('*')->where('induk_latihan = ' . $model->id_latihan_paket)->all() ?>
                        <?php if (empty($ada)) : ?>
                            <?= Html::a('Delete', ['delete', 'id_latihan_paket' => $model->id_latihan_paket], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Anda yakin akan menghapus paket soal ini? Penghapusan tidak dapat dibatalkan.',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        <?php endif; ?>
                    </p>

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id_latihan_paket',
                            'judul',
                            'waktu_menit',
                            'timestamp_paket',
                        ],
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</section>