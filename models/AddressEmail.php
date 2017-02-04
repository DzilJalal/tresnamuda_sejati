<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "address_email".
 *
 * @property integer $id
 * @property string $nama
 * @property string $email
 * @property string $degree
 */
class AddressEmail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address_email';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'email', 'degree'], 'required'],
            [['email'], 'email'],
            [['degree'], 'string'],
            [['nama'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'email' => 'Email',
            'degree' => 'Degree',
        ];
    }

    /**
     * @inheritdoc
     * @return AddressEmailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AddressEmailQuery(get_called_class());
    }
}
