<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Materi;
use Yii;

/**
 * MateriSearch represents the model behind the search form of `app\models\Materi`.
 */
class MateriSearch extends Materi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_materi', 'jenis'], 'integer'],
            [['judul', 'filename_link', 'owner', 'timestamp', 'timestamp_lastupdate'], 'safe'],
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
        $query = Materi::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (Yii::$app->user->identity->level !== 0)
            $dataProvider->query->where([
                'deleted' => 0,
            ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_materi' => $this->id_materi,
            'jenis' => $this->jenis,
            'timestamp' => $this->timestamp,
            'timestamp_lastupdate' => $this->timestamp_lastupdate,
        ]);

        $query->andFilterWhere(['like', 'judul', $this->judul])
            ->andFilterWhere(['like', 'filename_link', $this->filename_link])
            ->andFilterWhere(['like', 'owner', $this->owner]);

        return $dataProvider;
    }
}
