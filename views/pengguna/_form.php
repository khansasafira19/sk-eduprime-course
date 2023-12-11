<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Provinsi;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\file\FileInput;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Pengguna */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-6 d-flex flex-column align-items-center justify-content-center">

        <div class="d-flex justify-content-center py-4">
            <a href="index.html" class="logo d-flex align-items-center w-auto">
                <!-- <img src="<?php //echo Yii::$app->request->baseUrl; 
                                ?>/images/favicon.png" alt=""> -->
                <span class="d-none d-lg-block"><?php echo Yii::$app->name ?></span>
            </a>
        </div><!-- End Logo -->

        <div class="card mb-3" style="width:100%">

            <div class="card-body login-card-body rounded">

                <div class="pt-4 pb-2">
                    <h3 class="card-title text-center">Pendaftaran EDUPRIME COURSE</h3>

                </div>

                <?php $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'horizontalCssClasses' => [
                            'label' => 'col-lg-3 tebal',
                            'wrapper' => 'col-lg-9',
                        ],
                    ],
                ]); ?>

                <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'style' => 'text-transform:lowercase', 'onkeypress' => "CheckSpace(event)", 'disabled' => $model->isNewRecord ? false : true, 'placeholder' => 'lowercase, untuk login.']) ?>
                <br />
                <?php if ($model->isNewRecord) { ?>
                    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder' => 'Gunakan password yang kompleks.']) ?>
                    <br />
                    <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true, 'placeholder' => 'Ulangi Password']) ?>
                <?php } ?>
                <br />
                <?= $form->field($model, 'hape')->textInput(['maxlength' => true, 'minLength' => true, 'placeholder' => 'Tanpa 62 atau 0 di depan (diawali angka 8)']) ?>
                <br />
                <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'placeholder' => 'Nama lengkap, dengan proper case.']) ?>
                <br />
                <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => "Email AKTIF"]) ?>
                <br />
                <div class="col-12">
                    <?= Html::submitButton('Daftar', ['class' => 'btn btn-danger w-100']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <?php if (Yii::$app->user->isGuest) : ?>
            <div class="credits text-center">
                <p class="small mb-0">Sudah Punya Akun? <?= Html::a('Login', ['site/login'], ['class' => 'bg-warning', 'style' => 'padding: 0 5px; border-radius: 5px']) ?></p>
            </div>
        <?php endif; ?>
    </div>
</div>
<script type="text/javascript">
    function CheckSpace(event) {
        if (event.which == 32) {
            event.preventDefault();
            return false;
        }
    }
</script>