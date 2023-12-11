<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LatihanSoal;

/**
 * LatihanSoalSearch represents the model behind the search form of `app\models\LatihanSoal`.
 */
class LatihanSoalSearch extends LatihanSoal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_latihan_soal', 'induk_latihan', 'correct_choice'], 'integer'],
            [['soal', 'choice_a', 'choice_b', 'choice_c', 'choice_d', 'choice_e', 'timestamp_soal', 'owner'], 'safe'],
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
        $query = LatihanSoal::find();

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
            'id_latihan_soal' => $this->id_latihan_soal,
            'induk_latihan' => $this->induk_latihan,
            'correct_choice' => $this->correct_choice,
            'timestamp_soal' => $this->timestamp_soal,
        ]);

        $query->andFilterWhere(['like', 'soal', $this->soal])
            ->andFilterWhere(['like', 'choice_a', $this->choice_a])
            ->andFilterWhere(['like', 'choice_b', $this->choice_b])
            ->andFilterWhere(['like', 'choice_c', $this->choice_c])
            ->andFilterWhere(['like', 'choice_d', $this->choice_d])
            ->andFilterWhere(['like', 'choice_e', $this->choice_e])
            ->andFilterWhere(['like', 'owner', $this->owner]);

        return $dataProvider;
    }
}
