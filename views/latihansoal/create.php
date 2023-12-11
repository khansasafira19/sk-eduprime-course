<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LatihanSoal $model */

$this->title = 'Tambah Soal Latihan';
?>
<div class="latihan-soal-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
