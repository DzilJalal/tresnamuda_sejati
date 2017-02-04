<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipe_request".
 *
 * @property integer $id
 * @property string $nama_tipe
 *
 * @property LinkReqTipe[] $linkReqTipes
 */
class TipeRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipe_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['nama_tipe'], 'string', 'max' => 225],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID / Tipe Request :',
            'nama_tipe' => 'Nama Tipe',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinkReqTipes()
    {
        return $this->hasMany(LinkReqTipe::className(), ['id_tipe' => 'id']);
    }

    /**
     * @inheritdoc
     * @return TipeRequestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TipeRequestQuery(get_called_class());
    }
}
