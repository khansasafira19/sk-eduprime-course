<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "latihan_soal".
 *
 * @property int $id_latihan_soal
 * @property int $induk_latihan
 * @property string $soal
 * @property string $choice_a
 * @property string $choice_b
 * @property string $choice_c
 * @property string $choice_d
 * @property string $choice_e
 * @property int $correct_choice
 * @property string $timestamp_soal
 * @property string $owner
 */
class LatihanSoal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'latihan_soal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['induk_latihan', 'soal', 'choice_a', 'choice_b', 'choice_c', 'choice_d', 'choice_e', 'correct_choice', 'pembahasan', 'owner'], 'required'],
            [['induk_latihan', 'correct_choice'], 'integer'],
            [['soal', 'choice_a', 'choice_b', 'choice_c', 'choice_d', 'choice_e'], 'string'],
            [['timestamp_soal'], 'safe'],
            [['owner'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_latihan_soal' => 'ID Soal',
            'induk_latihan' => 'Paket Soal',
            'soal' => 'Teks Soal',
            'choice_a' => 'Pilihan A',
            'choice_b' => 'Pilihan B',
            'choice_c' => 'Pilihan C',
            'choice_d' => 'Pilihan D',
            'choice_e' => 'Pilihan E',
            'correct_choice' => 'Jawaban yang Benar',
            'timestamp_soal' => 'Timestamp Soal',
            'owner' => 'Owner',
        ];
    }
    public function getOwnere()
    {
        return $this->hasOne(Pengguna::className(), ['username' => 'owner']);
    }
    public function getInduke()
    {
        return $this->hasOne(LatihanPaket::className(), ['id_latihan_paket' => 'induk_latihan']);
    }
}
