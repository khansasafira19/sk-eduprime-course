<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pengguna;

/**
 * PenggunaCari represents the model behind the search form of `app\models\Pengguna`.
 */
class PenggunaCari extends Pengguna
{

    /**
     * {@inheritdoc}
     */
    public $tingkatane, $provinsie, $jenjange;

    public function rules()
    {
        return [
            [['username', 'password', 'nama'], 'safe'],
            [['hape'], 'integer'],
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
        $query = Pengguna::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['tgl_daftar' => SORT_DESC, 'nama' => SORT_ASC]]
        ]);
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([            
            'theme' => $this->theme,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'hape', $this->hape])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
