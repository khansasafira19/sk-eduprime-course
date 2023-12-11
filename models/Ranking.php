<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ranking".
 *
 * @property int $id_latihan_siswa
 * @property int $latihan
 * @property string $siswa
 * @property string $timestamp_siswa
 * @property float|null $skor
 * @property int $selesai
 */
class Ranking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $ranking;
    public static function tableName()
    {
        return 'ranking';
    }

    public static function primaryKey()
    {
        return ['id_latihan_siswa'];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_latihan_siswa', 'latihan', 'selesai'], 'integer'],
            [['latihan', 'siswa'], 'required'],
            [['timestamp_siswa'], 'safe'],
            [['skor'], 'number'],
            [['siswa'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_latihan_siswa' => 'Id Latihan Siswa',
            'latihan' => 'Latihan',
            'siswa' => 'Siswa',
            'timestamp_siswa' => 'Timestamp Siswa',
            'skor' => 'Skor',
            'selesai' => 'Selesai',
        ];
    }

    public function getOwnere()
    {
        return $this->hasOne(Pengguna::className(), ['username' => 'siswa']);
    }
    public function getInduke()
    {
        return $this->hasOne(LatihanPaket::className(), ['id_latihan_paket' => 'latihan']);
    }
}
