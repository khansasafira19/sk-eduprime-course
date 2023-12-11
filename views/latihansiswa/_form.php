<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LatihanSiswa $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="latihan-siswa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'latihan')->textInput() ?>

    <?= $form->field($model, 'siswa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'timestamp_siswa')->textInput() ?>

    <?= $form->field($model, 'skor')->textInput() ?>

    <?= $form->field($model, 'selesai')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
