<?php

use yii\helpers\Html;
?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <?= Html::a('<i class="bi bi-house-fill"></i> <span>Dashboard</span>', ['site/index'], [
                'class' => (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') ? 'nav-link' : 'nav-link collapsed'
            ]) ?>
        </li>
        <li class="nav-item">
            <?= Html::a('<i class="bi bi-receipt"></i> <span>Latihan</span>', ['latihanpaket/index'], [
                'class' => (Yii::$app->controller->id == 'latihanpaket' || Yii::$app->controller->id == 'latihansoal' || Yii::$app->controller->id == 'latihansiswa') ? 'nav-link' : 'nav-link collapsed'
            ]) ?>
        </li>
        <li class="nav-item">
            <?= Html::a('<i class="bi bi-book-fill"></i> <span>Materi</span>', ['materi/index'], [
                'class' => (Yii::$app->controller->id == 'materi') ? 'nav-link' : 'nav-link collapsed'
            ]) ?>
        </li>
        <?php if (Yii::$app->user->identity->level == 0) : ?>
            <li class="nav-item">
                <?= Html::a('<i class="bi bi-person-bounding-box"></i> <span>Pengguna</span>', ['pengguna/index'], [
                    'class' => (Yii::$app->controller->id == 'pengguna') ? 'nav-link' : 'nav-link collapsed'
                ]) ?>
            </li>
        <?php endif; ?>
    </ul>
</aside><!-- End Sidebar-->