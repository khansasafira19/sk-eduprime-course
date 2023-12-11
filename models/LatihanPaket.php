<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "latihan_paket".
 *
 * @property int $id_latihan_paket
 * @property string $judul
 * @property string $timestamp_paket
 */
class LatihanPaket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'latihan_paket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['judul'], 'required'],
            [['waktu_menit'], 'integer'],
            [['timestamp_paket'], 'safe'],
            [['judul'], 'string', 'max' => 225],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_latihan_paket' => 'Id Latihan Paket',
            'judul' => 'Judul',
            'waktu_menit' => 'Waktu Pengerjaan (Dalam Menit)',
            'timestamp_paket' => 'Paket Diinput/Diupdate Pada',
        ];
    }
}
