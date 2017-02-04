<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "karyawan".
 *
 * @property integer $id
 * @property string $nik
 * @property string $first_name
 * @property string $last_name
 * @property string $date_birth
 * @property string $place_birth
 * @property string $sex
 * @property string $address
 * @property string $rt_rw
 * @property string $kelurahan
 * @property string $kecamatan
 * @property string $religion
 * @property string $status_perkawinan
 * @property string $citizen
 * @property string $phone
 * @property string $date_in
 * @property string $date_out
 * @property string $is_active
 * @property integer $departement_id
 * @property integer $branch_id
 * @property integer $perusahaan_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property Branch $branch
 * @property Departement $departement
 * @property Perusahaan $perusahaan
 */
class Karyawan extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ytresnamuda_hrd.karyawan';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db_hrd');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nik', 'first_name', 'date_birth', 'place_birth', 'address', 'religion', 'status_perkawinan', 'citizen', 'date_in', 'is_active', 'departement_id', 'branch_id', 'perusahaan_id'], 'required'],
            [['date_birth', 'date_in', 'date_out', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['sex', 'address', 'is_active'], 'string'],
            [['departement_id', 'branch_id', 'perusahaan_id'], 'integer'],
            [['nik'], 'string', 'max' => 12],
            [['first_name', 'last_name', 'place_birth', 'rt_rw', 'kelurahan', 'kecamatan', 'religion', 'status_perkawinan', 'citizen', 'phone', 'created_by', 'updated_by'], 'string', 'max' => 50],
            [['nik'], 'unique'],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
            [['departement_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departement::className(), 'targetAttribute' => ['departement_id' => 'id']],
            [['perusahaan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Perusahaan::className(), 'targetAttribute' => ['perusahaan_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'nik' => 'Nik',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'date_birth' => 'Date Birth',
            'place_birth' => 'Place Birth',
            'sex' => 'Sex',
            'address' => 'Address',
            'rt_rw' => 'Rt Rw',
            'kelurahan' => 'Kelurahan',
            'kecamatan' => 'Kecamatan',
            'religion' => 'Religion',
            'status_perkawinan' => 'Status Perkawinan',
            'citizen' => 'Citizen',
            'phone' => 'Phone',
            'date_in' => 'Date In',
            'date_out' => 'Date Out',
            'is_active' => 'Is Active',
            'departement_id' => 'Departement ID',
            'branch_id' => 'Branch ID',
            'perusahaan_id' => 'Perusahaan ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch() {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartement() {
        return $this->hasOne(Departement::className(), ['id' => 'departement_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerusahaan() {
        return $this->hasOne(Perusahaan::className(), ['id' => 'perusahaan_id']);
    }

    /**
     * @inheritdoc
     * @return KaryawanQuery the active query used by this AR class.
     */
    public static function find() {
        return new KaryawanQuery(get_called_class());
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if ($insert) {
            $this->date_birth = Yii::$app->formatter->asDatetime(strtotime($this->date_birth), "php:Y-m-d");
            $this->date_in = Yii::$app->formatter->asDatetime(strtotime($this->date_in), "php:Y-m-d");
            $this->date_out = Yii::$app->formatter->asDatetime(strtotime($this->date_out), "php:Y-m-d");
        }

        return parent::beforeSave($insert);
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

}
