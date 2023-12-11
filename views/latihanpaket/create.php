<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LatihanPaket $model */

$this->title = 'Tambah Paket Bank Soal';
?>
<div class="latihan-paket-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
