<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengguna".
 *
 * @property string $username
 * @property string $password
 * @property int $nip
 * @property string $nama
 * @property int $jabatan
 * @property int $pangkatgol
 * @property string $email
 * @property string $foto
 * @property string $tgl_daftar
 * @property int $status_pengguna
 */
class Pengguna extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $password_repeat;
    public $pdffile;

    public static function tableName()
    {
        return 'pengguna';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'nama', 'hape', 'email'], 'required'],
            [['tgl_daftar', 'tgl_update'], 'safe'],
            [['username'], 'string', 'max' => 30],
            [['password', 'nama', 'email'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['hape'], 'string', 'max' => 13],
            [['hape'], 'string', 'min' => 9],
            [['hape'], 'unique'],
            ['password_repeat', 'required', 'skipOnEmpty' => !$this->isNewRecord],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => "Password tidak sesuai"],
            [['email'], 'email'],
            [['username'], 'validateSpasi', 'skipOnEmpty' => false, 'skipOnError' => false],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'password' => 'Password',
            'nama' => 'Nama',
            'email' => 'Email',
            'tgl_daftar' => 'Tgl Daftar',
            'level' => 'Status',
            'hape' => 'Nomor HP'
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->password = md5($this->password);
                return true;
            } else
                return true;
        } else {
            return false;
        }
    }

    public function validateSpasi()
    {
        $b = $this->username;
        if (str_contains($b, ' ')) {
            $this->addError('username', 'Username tidak dapat mengandung spasi.');
        }
    }

   
}
