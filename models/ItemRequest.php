<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_request".
 *
 * @property integer $id
 * @property string $nama_item
 *
 * @property AnalisaRequest[] $analisaRequests
 * @property LinkReqItem[] $linkReqItems
 */
class ItemRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_item'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_item' => 'Nama Item',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnalisaRequests()
    {
        return $this->hasMany(AnalisaRequest::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinkReqItems()
    {
        return $this->hasMany(LinkReqItem::className(), ['item_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ItemRequestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemRequestQuery(get_called_class());
    }
}
