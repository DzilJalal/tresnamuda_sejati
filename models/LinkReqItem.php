<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "link_req_item".
 *
 * @property integer $id
 * @property integer $request_id
 * @property integer $item_id
 * @property integer $item_detail_id
 *
 * @property ItemRequestDetail $itemDetail
 * @property ItemRequest $item
 * @property Request $request
 */
class LinkReqItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'link_req_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'item_detail_id'], 'required'],            
            [['request_id', 'item_id', 'item_detail_id'], 'integer'],
            [['keterangan'], 'string'],
            [['item_detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItemRequestDetail::className(), 'targetAttribute' => ['item_detail_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItemRequest::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::className(), 'targetAttribute' => ['request_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_id' => 'Request ID',
            'item_id' => 'Item ID',
            'item_detail_id' => 'Item Detail ID',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemDetail()
    {
        return $this->hasOne(ItemRequestDetail::className(), ['id' => 'item_detail_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(ItemRequest::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(Request::className(), ['id' => 'request_id']);
    }

    /**
     * @inheritdoc
     * @return LinkReqItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LinkReqItemQuery(get_called_class());
    }
}
