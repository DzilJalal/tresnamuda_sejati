<?php

namespace app\modules\it\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AnalisaRequest;

/**
 * AnalisaRequestSearch represents the model behind the search form about `app\models\AnalisaRequest`.
 */
class AnalisaRequestSearch extends AnalisaRequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'item_id', 'jumlah_request'], 'integer'],
            [['waktu', 'permasalahan', 'analisa'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = AnalisaRequest::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'waktu' => SORT_DESC,
                ],
             ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'waktu' => $this->waktu,
            'item_id' => $this->item_id,
            'jumlah_request' => $this->jumlah_request,
        ]);

        $query->andFilterWhere(['like', 'permasalahan', $this->permasalahan])
            ->andFilterWhere(['like', 'analisa', $this->analisa]);

        return $dataProvider;
    }
}
