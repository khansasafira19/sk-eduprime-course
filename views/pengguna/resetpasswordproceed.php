<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
?>
<div class="row justify-content-center">
    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

        <div class="d-flex justify-content-center py-4">
            <a href="<?php echo Yii::$app->request->baseUrl; ?>" class="logo d-flex align-items-center w-auto">
                <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/favicon.png" alt="">
                <span class="d-none d-lg-block"><?php echo Yii::$app->name ?></span>
            </a>
        </div><!-- End Logo -->

        <div class="card mb-3" style="width:100%">

            <div class="card-body login-card-body rounded">

                <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Reset Password</h5>
                    <p class="text-center small">Masukkan Password Baru Anda</p>
                </div>

                <?php $form = ActiveForm::begin([
                    'id' => 'reset-form',
                    'options' => ['name' => "Form"]
                ]); ?>

                <?= $form->field($model, 'password_baru')->passwordInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'password_ulang')->passwordInput(['maxlength' => true]) ?>
                <br />
                <div class="col-12">
                    <?= Html::submitButton('Reset Password', ['class' => 'btn btn-danger w-100',]) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>