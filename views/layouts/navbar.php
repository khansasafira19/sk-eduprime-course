<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <img src="<?php

                            use yii\helpers\Html;

                            echo Yii::$app->request->baseUrl; ?>/images/user.png" alt="Profile" class="rounded-circle">
                <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo Yii::$app->user->identity->nama ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                    <h6><?php echo Yii::$app->user->identity->nama ?></h6>
                    <span><?php echo Yii::$app->user->identity->email ?></span>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <?= Html::a('<i class="bi bi-person"></i> <span>My Profile</span>', ['pengguna/view?id=' . Yii::$app->user->identity->username], [
                        'class' => 'dropdown-item d-flex align-items-center'
                    ]) ?>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <?= Html::a('<i class="bi bi-box-arrow-right"></i> </span>Logout</span>', ['/site/logout'], ['data-method' => 'post', 'class' => 'dropdown-item d-flex align-items-center']) ?>
                </li>
            </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
    </ul>
</nav><!-- End Icons Navigation -->