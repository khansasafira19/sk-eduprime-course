<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pengguna */

$this->title = 'Ubah Password';
$this->params['breadcrumbs'][] = ['label' => 'Pengguna', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrapper">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Ubah Password</h3>
                    </div>
                    <div class="card-body">
                        <?php $form = ActiveForm::begin(); ?>
                        <?= $form->errorSummary($model); ?>
                        <?= $form->field($model, 'password_lama')->passwordInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'password_baru')->passwordInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'password_ulang')->passwordInput(['maxlength' => true]) ?>
                    </div>

                    <div class="card-footer">
                        <!--<button type="submit" class="btn btn-danger">Submit</button>-->
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-success btn-sm bundar']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


