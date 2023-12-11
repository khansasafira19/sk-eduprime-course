<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\LatihanSiswa $model */

$this->title = $model->id_latihan_siswa;
$this->params['breadcrumbs'][] = ['label' => 'Latihan Siswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="latihan-siswa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_latihan_siswa' => $model->id_latihan_siswa], ['class' => 'btn btn-danger']) ?>
        <?= Html::a('Delete', ['delete', 'id_latihan_siswa' => $model->id_latihan_siswa], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_latihan_siswa',
            'latihan',
            'siswa',
            'timestamp_siswa',
            'skor',
            'selesai',
        ],
    ]) ?>

</div>
