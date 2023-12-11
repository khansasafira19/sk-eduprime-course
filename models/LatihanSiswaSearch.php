<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LatihanSiswa;
use Yii;

/**
 * LatihanSiswaSearch represents the model behind the search form of `app\models\LatihanSiswa`.
 */
class LatihanSiswaSearch extends LatihanSiswa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_latihan_siswa', 'latihan', 'selesai'], 'integer'],
            [['siswa', 'timestamp_siswa'], 'safe'],
            [['skor'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = LatihanSiswa::find();

        $query->where(['deleted' => 0]);
        // add conditions that should always apply here
        if (Yii::$app->user->identity->level != 0)
            $query->where(['siswa' => Yii::$app->user->identity->username]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);



        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_latihan_siswa' => $this->id_latihan_siswa,
            'latihan' => $this->latihan,
            'timestamp_siswa' => $this->timestamp_siswa,
            'skor' => $this->skor,
            'selesai' => $this->selesai,
        ]);

        $query->andFilterWhere(['like', 'siswa', $this->siswa]);

        return $dataProvider;
    }

    public function rank($params)
    {
        $query = LatihanSiswa::find();

        $query = LatihanSiswa::find()
            ->select(['latihan_siswa.*', '(SELECT COUNT(DISTINCT ls2.skor) + 1 FROM latihan_siswa ls2 WHERE ls2.siswa = latihan_siswa.siswa AND (ls2.skor > latihan_siswa.skor OR (ls2.skor = latihan_siswa.skor AND ls2.timestamp_siswa < latihan_siswa.timestamp_siswa))) AS rank'])
            ->groupBy(['siswa'])
            ->orderBy(['siswa' => SORT_ASC, 'skor' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);



        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_latihan_siswa' => $this->id_latihan_siswa,
            'latihan' => $this->latihan,
            'timestamp_siswa' => $this->timestamp_siswa,
            'skor' => $this->skor,
            'selesai' => $this->selesai,
        ]);

        $query->andFilterWhere(['like', 'siswa', $this->siswa]);

        return $dataProvider;
    }
}
