<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LinkReqItemDetail]].
 *
 * @see LinkReqItemDetail
 */
class LinkReqItemDetailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return LinkReqItemDetail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LinkReqItemDetail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
