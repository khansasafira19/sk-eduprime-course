<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $token string */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['pengguna/resetpasswordproceed', 'token' => $token]);
?>
<div style="background-color: #F2F2F2; padding: 50px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
    <div style="background-color: #FFFFFF; max-width: 600px; margin: 0 auto; border-radius: 10px; padding: 50px;">
        <h2 style="color: #232323; font-weight: bold; text-align: center; margin-bottom: 30px;">RESET PASSWORD EDUPRIME COURSE
        </h2>
        <h4 style="color: #232323; text-align: center; margin-bottom: 50px;"><?= $email ?></h4>
        <p style="color: #232323; font-size: 16px; line-height: 1.5;">Hai Pengguna Eduprime Course!</p>
        <p style="color: #232323; font-size: 16px; line-height: 1.5;">Sistem mendeteksi Anda telah melakukan request untuk mengganti password. Silahkan klik tautan berikut untuk mereset password Anda:</p>
        <p style="text-align: center; margin-top: 50px;">
            <a href="<?= $resetLink ?>" style="color: #FFFFFF; text-decoration: none; background-color: #0d6efd; padding: 15px 30px; border-radius: 5px;"><?= Html::encode(Yii::t('app', 'Reset Password')) ?></a>
        </p>
        <br />
        <p style="color: #232323; font-size: 16px; line-height: 1.5;">Jika Anda tidak mengirimkan request tersebut, abaikan email ini.</p>
    </div>
</div>