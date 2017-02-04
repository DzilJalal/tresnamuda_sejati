<?php

namespace app\modules\hrd\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Karyawan;

/**
 * KaryawanSearch represents the model behind the search form about `app\models\Karyawan`.
 */
class KaryawanSearch extends Karyawan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'departement_id', 'branch_id', 'perusahaan_id'], 'integer'],
            [['nik', 'first_name', 'last_name', 'date_birth', 'place_birth', 'sex', 'address', 'rt_rw', 'kelurahan', 'kecamatan', 'religion', 'status_perkawinan', 'citizen', 'phone', 'date_in', 'date_out', 'is_active', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
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
        $query = Karyawan::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date_birth' => $this->date_birth,
            'date_in' => $this->date_in,
            'date_out' => $this->date_out,
            'departement_id' => $this->departement_id,
            'branch_id' => $this->branch_id,
            'perusahaan_id' => $this->perusahaan_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'place_birth', $this->place_birth])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'rt_rw', $this->rt_rw])
            ->andFilterWhere(['like', 'kelurahan', $this->kelurahan])
            ->andFilterWhere(['like', 'kecamatan', $this->kecamatan])
            ->andFilterWhere(['like', 'religion', $this->religion])
            ->andFilterWhere(['like', 'status_perkawinan', $this->status_perkawinan])
            ->andFilterWhere(['like', 'citizen', $this->citizen])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
