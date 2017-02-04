<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departement".
 *
 * @property integer $id
 * @property string $prefix
 * @property string $nama_departement
 *
 * @property Karyawan[] $karyawans
 */
class Departement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departement';
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
            [['prefix', 'nama_departement'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prefix' => 'Prefix',
            'nama_departement' => 'Nama Departement',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKaryawans()
    {
        return $this->hasMany(Karyawan::className(), ['departement_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return DepartementQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DepartementQuery(get_called_class());
    }
}
