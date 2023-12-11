<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LatihanSiswaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="latihan-siswa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_latihan_siswa') ?>

    <?= $form->field($model, 'latihan') ?>

    <?= $form->field($model, 'siswa') ?>

    <?= $form->field($model, 'timestamp_siswa') ?>

    <?= $form->field($model, 'skor') ?>

    <?php // echo $form->field($model, 'selesai') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-danger']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
