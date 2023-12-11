<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "materi".
 *
 * @property int $id_materi
 * @property int $jenis
 * @property string $judul
 * @property string $filename_link
 * @property string $owner
 * @property string $timestamp
 * @property string $timestamp_lastupdate
 */
class Materi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $filepdf;

    public static function tableName()
    {
        return 'materi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenis'], 'integer'],
            [['judul'], 'required'],
            [['judul'], 'string'],
            [['timestamp', 'timestamp_lastupdate', 'owner', 'filename_link'], 'safe'],
            [['owner'], 'string', 'max' => 30],
            ['filename_link', 'url', 'validSchemes' => ['http', 'https'], 'when' => function () {
                return $this->jenis == 1;
            }, 'enableClientValidation' => false],
            ['filename_link', 'required', 'when' => function () {
                return $this->jenis == 1;
            }, 'enableClientValidation' => false],
            [['filepdf'], 'file', 'extensions' => 'pdf'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_materi' => 'Id Materi',
            'jenis' => 'Jenis',
            'judul' => 'Judul',
            'filename_link' => 'Filename Link',
            'owner' => 'Owner',
            'timestamp' => 'Timestamp',
            'timestamp_lastupdate' => 'Timestamp Lastupdate',
        ];
    }

    public function getOwnere()
    {
        return $this->hasOne(Pengguna::className(), ['username' => 'owner']);
    }
    
}
