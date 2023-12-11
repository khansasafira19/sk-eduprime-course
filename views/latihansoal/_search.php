<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LatihanSoalSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="latihan-soal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_latihan_soal') ?>

    <?= $form->field($model, 'induk_latihan') ?>

    <?= $form->field($model, 'soal') ?>

    <?= $form->field($model, 'choice_a') ?>

    <?= $form->field($model, 'choice_b') ?>

    <?php // echo $form->field($model, 'choice_c') ?>

    <?php // echo $form->field($model, 'choice_d') ?>

    <?php // echo $form->field($model, 'choice_e') ?>

    <?php // echo $form->field($model, 'correct_choice') ?>

    <?php // echo $form->field($model, 'timestamp_soal') ?>

    <?php // echo $form->field($model, 'owner') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-danger']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
