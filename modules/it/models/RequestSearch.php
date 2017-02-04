<?php

namespace app\modules\it\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Request;

/**
 * RequestSearch represents the model behind the search form about `app\models\Request`.
 */
class RequestSearch extends Request {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'karyawan_id', 'nomor_surat'], 'integer'],
            [['keterangan', 'catatan', 'header', 'tanggal_permintaan', 'diketahui_oleh', 'tanggal_persetujuan', 'diterima_oleh', 'tanggal_terima', 'perkiraan_selesai', 'tanggal_selesai', 'pelaksana', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Request::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'nomor_surat' => SORT_DESC,
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
            'karyawan_id' => $this->karyawan_id,
            'nomor_surat' => $this->nomor_surat,
            'header' => $this->header,
            'tanggal_permintaan' => $this->tanggal_permintaan,
            'tanggal_persetujuan' => $this->tanggal_persetujuan,
            'tanggal_terima' => $this->tanggal_terima,
            'perkiraan_selesai' => $this->perkiraan_selesai,
            'tanggal_selesai' => $this->tanggal_selesai,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan])
                ->andFilterWhere(['like', 'catatan', $this->catatan])
                ->andFilterWhere(['like', 'diketahui_oleh', $this->diketahui_oleh])
                ->andFilterWhere(['like', 'diterima_oleh', $this->diterima_oleh])
                ->andFilterWhere(['like', 'pelaksana', $this->pelaksana])
                ->andFilterWhere(['like', 'created_by', $this->created_by])
                ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }

    public function countRequestBelumSelesai(){
        $countAll = Request::find()->select(['COUNT(*) AS total_belum_selesai'])->where('tanggal_selesai IS NULL')->count();
        return $countAll;
    }

    public function searchRequestBelumSelesai(){
        
        $query = Request::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andWhere([
            'tanggal_selesai' => NULL,
        ]);

        return $dataProvider;
    }

}
