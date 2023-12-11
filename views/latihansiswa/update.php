<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LatihanSiswa $model */

$this->title = 'Update Latihan Siswa: ' . $model->id_latihan_siswa;
$this->params['breadcrumbs'][] = ['label' => 'Latihan Siswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_latihan_siswa, 'url' => ['view', 'id_latihan_siswa' => $model->id_latihan_siswa]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="latihan-siswa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
