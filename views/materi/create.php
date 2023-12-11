<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Materi $model */

$this->title = 'Tambah Materi';
?>
<div class="materi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
