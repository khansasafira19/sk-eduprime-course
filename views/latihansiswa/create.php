<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LatihanSiswa $model */

$this->title = 'Create Latihan Siswa';
$this->params['breadcrumbs'][] = ['label' => 'Latihan Siswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="latihan-siswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
