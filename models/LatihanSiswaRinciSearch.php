<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LatihanSiswaRinci;

/**
 * LatihanSiswaRinciSearch represents the model behind the search form of `app\models\LatihanSiswaRinci`.
 */
class LatihanSiswaRinciSearch extends LatihanSiswaRinci
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_latihan_siswa_rinci', 'latihan_siswa', 'latihan_soal', 'user_choice'], 'integer'],
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
        $query = LatihanSiswaRinci::find();

        // add conditions that should always apply here

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
            'id_latihan_siswa_rinci' => $this->id_latihan_siswa_rinci,
            'latihan_siswa' => $this->latihan_siswa,
            'latihan_soal' => $this->latihan_soal,
            'user_choice' => $this->user_choice,
        ]);

        return $dataProvider;
    }
}
