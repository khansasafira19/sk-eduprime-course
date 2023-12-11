<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

?>
<script type="text/javascript">
    function IsEmpty() {
        var a = document.forms["Form"]["LoginForm[username]"].value;
        var b = document.forms["Form"]["LoginForm[password]"].value;
        if (a == null || a == "", b == null || b == "") {
            //alert("Silahkan isi username dan/atau password Anda.");
            swal({
                title: "Hai!",
                text: "Mohon lengkapi isi username dan/atau password Anda.",
                icon: "error",
                button: "OK",
                dangerMode: false,
            });
            return false;
        }
    }
</script>
<div class="row justify-content-center">
    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

        <div class="d-flex justify-content-center py-4">
            <a href="<?php echo Yii::$app->request->baseUrl; ?>" class="logo d-flex align-items-center w-auto">
                <!-- <img src="<?php //echo Yii::$app->request->baseUrl; ?>/images/favicon.png" alt=""> -->
                <span class="d-none d-lg-block"><?php echo Yii::$app->name ?></span>
            </a>
        </div><!-- End Logo -->

        <div class="card mb-3" style="width:100%">

            <div class="card-body login-card-body rounded">

                <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login</h5>
                    <p class="text-center small">Masukkan username dan password Anda</p>
                </div>

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'options' => ['name' => "Form"]
                ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox([]) ?>

                <div class="col-12">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-danger w-100', 'name' => 'login-button',  'onclick' => "return IsEmpty();"]) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <div class="credits text-center">
            <p class="small mb-0">Belum Punya Akun? <?= Html::a('Buat Akun', ['pengguna/create'], []) ?></p>
            <p class="small mb-0">Lupa Password? <?= Html::a('Reset', ['pengguna/resetpassword'], []) ?></p>
        </div>

    </div>
</div>