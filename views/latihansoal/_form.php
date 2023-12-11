<?php

use app\models\LatihanPaket;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LatihanSoal $model */
/** @var yii\widgets\ActiveForm $form */
?>
<style>
    div.tox-tinymce:not(:first-child) {
        height: 200px !important;
    }

    .tebal {
        font-weight: bold !important;
    }
</style>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $this->title ?></h5>
                    <?php $form = ActiveForm::begin([
                        'layout' => 'horizontal',
                        'fieldConfig' => [
                            'horizontalCssClasses' => [
                                'label' => 'col-lg-2 tebal',
                                'wrapper' => 'col-lg-10',
                            ],
                        ],
                    ]); ?>
                    <?=
                    $form->field($model, 'induk_latihan')->dropDownList(ArrayHelper::map(LatihanPaket::find()
                        ->all(), 'id_latihan_paket', function ($model) {
                        return '[' . $model->id_latihan_paket . '] ' . $model->judul;
                    }), ['prompt' => 'Pilih Soal'])
                    ?>

                    <?php // $form->field($model, 'soal')->textarea(['rows' => 6]) 
                    ?>
                    <?= $form->field($model, 'soal')->widget(\yii\redactor\widgets\Redactor::className(), [
                        'clientOptions' => [
                            'imageManagerJson' => ['/redactor/upload/image-json'],
                            'imageUpload' => ['/redactor/upload/image'],
                            'fileUpload' => ['/redactor/upload/file'],
                            'lang' => 'en',
                            'plugins' => ['clips', 'fontcolor', 'imagemanager']
                        ]
                    ]) ?>
                    <?php
                    //  $form->field($model, 'soal')->widget(TinyMce::className(), [
                    //     'language' => 'en',
                    //     'clientOptions' => [
                    //         'plugins' => [
                    //             "advlist autolink lists link charmap print preview anchor",
                    //             "searchreplace visualblocks code fullscreen",
                    //             "insertdatetime media table contextmenu paste"
                    //         ],
                    //         'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                    //         'menubar' => true,
                    //         'image_advtab' => true,
                    //     ]
                    // ]); 
                    ?>

                    <?= $form->field($model, 'choice_a')->widget(\yii\redactor\widgets\Redactor::className(), [
                        'clientOptions' => [
                            'imageManagerJson' => ['/redactor/upload/image-json'],
                            'imageUpload' => ['/redactor/upload/image'],
                            'fileUpload' => ['/redactor/upload/file'],
                            'lang' => 'en',
                            'plugins' => ['clips', 'fontcolor', 'imagemanager']
                        ]
                    ]) ?>
                    <?= $form->field($model, 'choice_b')->widget(\yii\redactor\widgets\Redactor::className(), [
                        'clientOptions' => [
                            'imageManagerJson' => ['/redactor/upload/image-json'],
                            'imageUpload' => ['/redactor/upload/image'],
                            'fileUpload' => ['/redactor/upload/file'],
                            'lang' => 'en',
                            'plugins' => ['clips', 'fontcolor', 'imagemanager']
                        ]
                    ]) ?>

                    <?= $form->field($model, 'choice_c')->widget(\yii\redactor\widgets\Redactor::className(), [
                        'clientOptions' => [
                            'imageManagerJson' => ['/redactor/upload/image-json'],
                            'imageUpload' => ['/redactor/upload/image'],
                            'fileUpload' => ['/redactor/upload/file'],
                            'lang' => 'en',
                            'plugins' => ['clips', 'fontcolor', 'imagemanager']
                        ]
                    ]) ?>

                    <?= $form->field($model, 'choice_d')->widget(\yii\redactor\widgets\Redactor::className(), [
                        'clientOptions' => [
                            'imageManagerJson' => ['/redactor/upload/image-json'],
                            'imageUpload' => ['/redactor/upload/image'],
                            'fileUpload' => ['/redactor/upload/file'],
                            'lang' => 'en',
                            'plugins' => ['clips', 'fontcolor', 'imagemanager']
                        ]
                    ]) ?>

                    <?= $form->field($model, 'choice_e')->widget(\yii\redactor\widgets\Redactor::className(), [
                        'clientOptions' => [
                            'imageManagerJson' => ['/redactor/upload/image-json'],
                            'imageUpload' => ['/redactor/upload/image'],
                            'fileUpload' => ['/redactor/upload/file'],
                            'lang' => 'en',
                            'plugins' => ['clips', 'fontcolor', 'imagemanager']
                        ]
                    ]) ?>
                    <hr />
                    <?=
                    $form->field($model, 'correct_choice')->dropDownList(['1' => 'Pilihan A', '2' => 'Pilihan B', '3' => 'Pilihan C', '4' => 'Pilihan D', '5' => 'Pilihan E'], ['prompt' => 'Pilih Soal'])
                    ?>
                    <hr />
                    <?= $form->field($model, 'pembahasan')->widget(\yii\redactor\widgets\Redactor::className(), [
                        'clientOptions' => [
                            'imageManagerJson' => ['/redactor/upload/image-json'],
                            'imageUpload' => ['/redactor/upload/image'],
                            'fileUpload' => ['/redactor/upload/file'],
                            'lang' => 'en',
                            'plugins' => ['clips', 'fontcolor', 'imagemanager']
                        ]
                    ]) ?>
                </div>
                <div class="card-footer d-grid gap-2 mt-3">
                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-outline-danger btn-block']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>