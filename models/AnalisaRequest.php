<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "analisa_request".
 *
 * @property integer $id
 * @property string $waktu
 * @property integer $item_id
 * @property integer $jumlah
 * @property string $permasalahan
 * @property string $analisa
 *
 * @property ItemRequest $item
 */
class AnalisaRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'analisa_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['waktu'], 'safe'],
            [['item_id', 'jumlah_request'], 'integer'],
            [['permasalahan', 'analisa'], 'string'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItemRequest::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'waktu' => 'Waktu: ',
            'item_id' => 'Item ID: ',
            'jumlah_request' => 'Jumlah Request: ',
            'permasalahan' => 'Permasalahan: ',
            'analisa' => 'Analisa: ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(ItemRequest::className(), ['id' => 'item_id']);
    }

    /**
     * @inheritdoc
     * @return AnalisaRequestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AnalisaRequestQuery(get_called_class());
    }

    /*
     * 
     * AJAX FUNCTION
     * 
     * param POST : waktu , item-request 
     * 
     * */

    public function beforeSave($insert) {   
        //if (parent::beforeSave($insert)) {
        //    if ($insert) { // only on insert
        //        $pecah  = explode("-", $this->waktu);
        //        $this->waktu =  $pecah[1]. "-". $pecah[0] . "-01";
        //    }
        //    return parent::beforeSave($insert);
        //}

        $pecah  = explode("-", $this->waktu);
        $this->waktu =  $pecah[1]. "-". $pecah[0] . "-01";
        return parent::beforeSave($insert);
    }
}
