<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "request".
 *+
 * @property integer $id
 * @property integer $karyawan_id
 * @property string $nomor_surat
 * @property string $header
 * @property string $keterangan
 * @property string $catatan
 * @property string $tanggal_permintaan
 * @property string $diketahui_oleh
 * @property string $tanggal_persetujuan
 * @property string $diterima_oleh
 * @property string $tanggal_terima
 * @property string $perkiraan_selesai
 * @property string $tanggal_selesai
 * @property string $pelaksana
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property LinkReqItem[] $linkReqItems
 * @property LinkReqTipe[] $linkReqTipes
 */
class Request extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'request';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
        [['karyawan_id', 'diketahui_oleh','tanggal_persetujuan', 'tanggal_permintaan'], 'required'],
        [['karyawan_id', 'nomor_surat'], 'integer'],
        [['keterangan', 'catatan'], 'string'],
        [[ 'keterangan','tanggal_persetujuan', 'tanggal_terima', 'perkiraan_selesai', 'tanggal_selesai', 'created_at', 'updated_at'], 'safe'],
        [['header'], 'string', 'max' => 225],
        [['diketahui_oleh', 'diterima_oleh'], 'string', 'max' => 25],
        [['pelaksana', 'created_by', 'updated_by'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
        'id' => 'ID',
        'karyawan_id' => 'Nama Karyawan :',
        'nomor_surat' => 'Nomor Surat :',
        'header' => 'Header :',
        'keterangan' => 'Keterangan :',
        'catatan' => 'Catatan :',
        'tanggal_permintaan' => 'Tanggal Permintaan :',
        'diketahui_oleh' => 'Diketahui By :',
        'tanggal_persetujuan' => 'Persetujuan :',
        'diterima_oleh' => 'Diterima by :',
        'tanggal_terima' => 'Tgl Terima :',
        'perkiraan_selesai' => 'Estimasi :',
        'tanggal_selesai' => 'Tgl Selesai :',
        'pelaksana' => 'Pelaksana :',
        'created_at' => 'Created At :',
        'updated_at' => 'Updated At :',
        'created_by' => 'Created By :',
        'updated_by' => 'Updated By :',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinkReqItems() {
        return $this->hasMany(LinkReqItem::className(), ['request_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinkReqTipes() {
        return $this->hasMany(LinkReqTipe::className(), ['id_request' => 'id']);
    }

    /**
     * @inheritdoc
     * @return RequestQuery the active query used by this AR class.
     */
    public static function find() {
        return new RequestQuery(get_called_class());
    }

    public function getKaryawan() {
        return $this->hasOne(Karyawan::className(), ['id' => 'karyawan_id']);
    }

    public function str_pad_header($value, $month, $departement) {
        $nomor = str_pad($value, 3, '0', STR_PAD_LEFT);
        return "IT/$departement/$month/$nomor";
    }

    public function behaviors() {
        return [
        'timestamp' => [
        'class' => TimestampBehavior::className(),
        'attributes' => [
        ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
        ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
        ],
        'value' => new Expression('NOW()'),
        ],
        'blameable' => [
        'class' => BlameableBehavior::className(),
        'attributes' => [
        ActiveRecord::EVENT_BEFORE_INSERT => ['created_by', 'updated_by'],
        ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_by',
        ],
        ],
        ];
    }

    public function _getDepartement($idKaryawan){
        $dep = Yii::$app->db_hrd->createCommand("SELECT b.prefix FROM karyawan a
                                                    INNER JOIN perusahaan b
                                                    ON a.perusahaan_id = b.id
                                                    WHERE a.id = $idKaryawan")->queryOne(); 
        return $dep;
    }

    public function beforeSave($insert) {
        
        $this->tanggal_permintaan = Yii::$app->formatter->asDatetime(strtotime($this->tanggal_permintaan), "php:Y-m-d H:i");
        $this->tanggal_persetujuan = Yii::$app->formatter->asDatetime(strtotime($this->tanggal_persetujuan), "php:Y-m-d H:i");
        
        $tanggal_terima = Yii::$app->formatter->asDatetime(strtotime($this->tanggal_terima), "php:Y-m-d H:i");
        $perkiraan_selesai = Yii::$app->formatter->asDatetime(strtotime($this->perkiraan_selesai), "php:Y-m-d H:i");
        $tanggal_selesai = Yii::$app->formatter->asDatetime(strtotime($this->tanggal_selesai), "php:Y-m-d H:i");

        if ($this->tanggal_terima != ''): 
            $this->tanggal_terima = $tanggal_terima; 
        else : 
            $this->tanggal_terima = NULL;
        endif;

        if ($this->perkiraan_selesai != ""):   
            $this->perkiraan_selesai = $perkiraan_selesai; 
        else : 
            $this->perkiraan_selesai = NULL; 
        endif;
        
        if ($this->tanggal_selesai != ""):   
            $this->tanggal_selesai = $tanggal_selesai; 
        else :
            $this->tanggal_selesai = NULL; 
        endif;

        if (parent::beforeSave($insert)) {
            $depart = $this->_getDepartement($this->karyawan_id);
            
            if ($insert) { // only on insert
                $nomor = Request::find()->andWhere(['YEAR([[tanggal_persetujuan]])' => new \yii\db\Expression('YEAR(CURDATE())')])->max('[[nomor_surat]]');

                $this->nomor_surat = $nomor + 1;
                
                $bulan = Yii::$app->formatter->asDatetime(strtotime($this->tanggal_permintaan), "php:m");
                
                $this->header = $this->str_pad_header($this->nomor_surat, $bulan, $depart['prefix']);
            }
            return parent::beforeSave($insert);
        }
        return parent::beforeSave($insert);
    }

}
