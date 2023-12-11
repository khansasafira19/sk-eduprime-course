<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "provinsi".
 *
 * @property int $kode_provinsi
 * @property string $nama_provinsi
 */
class Provinsi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penggunaprovinsi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_provinsi', 'nama_provinsi'], 'required'],
            [['kode_provinsi'], 'integer'],
            [['nama_provinsi'], 'string', 'max' => 255],
            [['kode_provinsi'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_provinsi' => 'Kode Provinsi',
            'nama_provinsi' => 'Nama Provinsi',
        ];
    }
}