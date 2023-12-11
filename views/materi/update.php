<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Materi $model */

$this->title = 'Update Materi # ' . $model->id_materi;
?>
<div class="materi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
