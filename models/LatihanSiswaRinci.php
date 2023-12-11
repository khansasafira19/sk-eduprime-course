<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "latihan_siswa_rinci".
 *
 * @property int $id_latihan_siswa_rinci
 * @property int $latihan_siswa
 * @property int $latihan_soal
 * @property int $user_choice
 */
class LatihanSiswaRinci extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'latihan_siswa_rinci';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['latihan_siswa', 'latihan_soal'], 'required'],
            [['user_choice'], 'safe'],
            [['latihan_siswa', 'latihan_soal', 'user_choice'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_latihan_siswa_rinci' => 'Id Latihan Siswa Rinci',
            'latihan_siswa' => 'ID Tes',
            'latihan_soal' => 'Nomor Soal',
            'user_choice' => 'User Choice',
        ];
    }

    public function getSoale()
    {
        return $this->hasOne(LatihanSoal::className(), ['id_latihan_soal' => 'latihan_soal']);
    }
}
