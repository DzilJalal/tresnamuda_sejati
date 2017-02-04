<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_request_detail".
 *
 * @property integer $id
 * @property integer $item_request_id
 * @property string $nama_detail
 *
 * @property ItemRequest $itemRequest
 */
class ItemRequestDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_request_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_request_id'], 'integer'],
            [['nama_detail'], 'required'],
            [['nama_detail'], 'string', 'max' => 250],
            [['item_request_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItemRequest::className(), 'targetAttribute' => ['item_request_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_request_id' => 'Item Request ID',
            'nama_detail' => 'Nama Detail',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemRequest()
    {
        return $this->hasOne(ItemRequest::className(), ['id' => 'item_request_id']);
    }

    /**
     * @inheritdoc
     * @return ItemRequestDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemRequestDetailQuery(get_called_class());
    }
}
