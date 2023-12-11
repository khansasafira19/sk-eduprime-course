<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LatihanPaket $model */
/** @var yii\widgets\ActiveForm $form */
?>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <div class="d-flex justify-content-between">
                        <div class="p-2">

                        </div>
                        <div class="p-2">

                        </div>
                        <div class="p-2">
                            <?= Html::a('<i class="bi bi-book-fill"></i> Paket Soal', ['latihanpaket/index'], ['class' => 'btn btn-outline-danger']) ?>
                        </div>
                    </div>
                    <h5 class="card-title"><?= $this->title ?></h5>
                    
                    <?php $form = ActiveForm::begin([
                        'layout' => 'horizontal',
                        'fieldConfig' => [
                            'horizontalCssClasses' => [
                                'label' => 'col-lg-3 tebal',
                                'wrapper' => 'col-lg-9',
                            ],
                        ],
                    ]); ?>

                    <?= $form->field($model, 'judul')->textInput(['maxlength' => true]) ?>
                    <br/>

                    <?= $form->field($model, 'waktu_menit')->textInput() ?>

                </div>
                <div class="card-footer d-grid gap-2 mt-3">
                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-outline-danger btn-block']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>