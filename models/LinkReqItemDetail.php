<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "link_req_item_detail".
 *
 * @property integer $id
 * @property integer $request_id
 * @property integer $item_request_detail
 *
 * @property ItemRequestDetail $itemRequestDetail
 * @property Request $request
 */
class LinkReqItemDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'link_req_item_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_id', 'item_request_detail'], 'integer'],
            [['item_request_detail'], 'exist', 'skipOnError' => true, 'targetClass' => ItemRequestDetail::className(), 'targetAttribute' => ['item_request_detail' => 'id']],
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
            'item_request_detail' => 'Item Request Detail',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemRequestDetail()
    {
        return $this->hasOne(ItemRequestDetail::className(), ['id' => 'item_request_detail']);
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
     * @return LinkReqItemDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LinkReqItemDetailQuery(get_called_class());
    }
}
