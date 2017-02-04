<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "perusahaan".
 *
 * @property integer $id_perusahaan
 * @property string $prefix
 * @property string $nama_perusahaan
 * @property string $description
 *
 * @property Karyawan[] $karyawans
 */
class Perusahaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'perusahaan';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_hrd');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prefix', 'nama_perusahaan'], 'required'],
            [['description'], 'string'],
            [['prefix', 'nama_perusahaan'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'prefix' => 'Prefix',
            'nama_perusahaan' => 'Nama Perusahaan',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKaryawans()
    {
        return $this->hasMany(Karyawan::className(), ['perusahaan_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return PerusahaanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PerusahaanQuery(get_called_class());
    }
}
