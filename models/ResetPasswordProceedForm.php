<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ResetPasswordProceedForm extends Model
{

    public $password_baru, $password_ulang;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['password_baru', 'password_ulang'], 'required'],
            ['password_baru', 'string', 'min' => 6, 'max' => 15],
            ['password_ulang', 'compare', 'compareAttribute' => 'password_baru', 'message' => 'Ulangi password baru tidak sesuai.'],
        ];
    }

    public function attributeLabels()
    {
        return array(
            'password_baru' => 'Password Baru',
            'password_ulang' => 'Ulangi Password Baru',
        );
    }
}
