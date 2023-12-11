<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pengguna */

$this->title = 'Update Pengguna: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Pengguna', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->username]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengguna-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>