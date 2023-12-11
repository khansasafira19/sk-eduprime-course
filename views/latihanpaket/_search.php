<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LatihanPaketSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="latihan-paket-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_latihan_paket') ?>

    <?= $form->field($model, 'judul') ?>

    <?= $form->field($model, 'timestamp_paket') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-danger']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
