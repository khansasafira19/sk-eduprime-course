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
                    <br />
                    <?php $form = ActiveForm::begin([
                        'layout' => 'horizontal',
                        'fieldConfig' => [
                            'horizontalCssClasses' => [
                                'label' => 'col-lg-2 tebal',
                                'wrapper' => 'col-lg-10',
                            ],
                        ],
                        'options' => ['enctype' => 'multipart/form-data']
                    ]); ?>
                    <?= $form->field($model, 'judul')->textInput([]) ?>
                    <br />

                    <?= $form->field($model, 'jenis')->dropDownList([0 => 'PDF', 1 => 'YouTube Link'], ['prompt' => 'Pilih Jenis ...'], ['onchange' => 'javascript:$("#mydiv").toggle()',]); ?>
                    <br />

                    <div id="pdf" style="display:<?php echo (($model->isNewRecord) || (!$model->isNewRecord && $model->jenis == 0) ? 'block' : 'none') ?>">
                        <?= $form->field($model, 'filepdf')->fileInput()->label('Upload File PDF') ?>
                        <?php if (!$model->isNewRecord && file_exists(Yii::getAlias('@webroot/pdf/materi/' . $model->id_materi . '.pdf'))) : ?>
                            <div class="mb-3 transparan" style="border-width:0px">
                                <div class="row g-0">
                                    <div class="col-md-2">
                                        <h5 class="card-title">File Saat Ini</h5>
                                        <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
                                    </div>
                                    <div class="col-md-10 alert">
                                        <?php echo $model->id_materi . "pdf" ?>
                                    </div>

                                </div>
                            </div>

                        <?php endif; ?>
                    </div>
                    <div id="video" style="display:<?php echo (!$model->isNewRecord && $model->jenis == 1 ? 'block' : 'none') ?>">
                        <?= $form->field($model, 'filename_link')->textarea(['rows' => 6])->label('URL Video (YouTube)') ?>
                    </div>

                </div>
                <div class="card-footer d-grid gap-2 mt-3">
                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-outline-danger btn-block']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>
<?php
$script = <<< JS
$(document).ready(function () {
    $(document.body).on('change', '#materi-jenis', function () {
        var val = $('#materi-jenis').val();
        if(val == 0 ) {
            $('#pdf').show();
            $('#video').hide();
        }
        else if(val == 1){
            $('#pdf').hide();
            $('#video').show();
        }
    });
});
        
JS;
$this->registerJs($script);
?>