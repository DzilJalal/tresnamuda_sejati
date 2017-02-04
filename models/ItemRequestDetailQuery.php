<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ItemRequestDetail]].
 *
 * @see ItemRequestDetail
 */
class ItemRequestDetailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ItemRequestDetail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ItemRequestDetail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
