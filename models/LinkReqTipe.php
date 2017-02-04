<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "link_req_tipe".
 *
 * @property integer $request_id
 * @property integer $tipe_id
 *
 * @property Request $request
 * @property TipeRequest $tipe
 */
class LinkReqTipe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'link_req_tipe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            #[['tipe_id'], 'each', 'integer'],
            #[['tipe_id'], 'each', 'rule' => ['trim']],
            #[['tipe_id'], 'in', 'range' => [1, 2, 3], 'skipOnError' => true],
            ['tipe_id]', 'each', 'rule' => ['integer']],
            [['tipe_id'], 'required'],
            #[['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::className(), 'targetAttribute' => ['request_id' => 'id']],
            #[['tipe_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipeRequest::className(), 'targetAttribute' => ['tipe_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'request_id' => 'Request ID',
            'tipe_id' => 'Tipe ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(Request::className(), ['id' => 'request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipe()
    {
        return $this->hasOne(TipeRequest::className(), ['id' => 'tipe_id']);
    }
}
