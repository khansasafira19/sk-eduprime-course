<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LatihanPaket;

/**
 * LatihanPaketSearch represents the model behind the search form of `app\models\LatihanPaket`.
 */
class LatihanPaketSearch extends LatihanPaket
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_latihan_paket'], 'integer'],
            [['judul', 'timestamp_paket'], 'safe'],
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
        $query = LatihanPaket::find();

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
            'id_latihan_paket' => $this->id_latihan_paket,
            'timestamp_paket' => $this->timestamp_paket,
        ]);

        $query->andFilterWhere(['like', 'judul', $this->judul]);

        return $dataProvider;
    }
}
