<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LatihanSoal $model */

$this->title = 'Update Latihan Soal: ' . $model->id_latihan_soal;
?>
<div class="latihan-soal-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
