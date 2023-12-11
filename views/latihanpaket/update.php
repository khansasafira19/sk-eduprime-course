<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LatihanPaket $model */

$this->title = 'Update Paket Bank Soal # ' . $model->id_latihan_paket;
?>
<div class="latihan-paket-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
