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
class ResetPasswordForm extends Model
{

    public $email;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email'], 'safe'],
            [['email'], 'email'],
        ];
    }

    public function attributeLabels()
    {
        return array(
            'email' => 'Email',
        );
    }
}
