<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LinkReqTipe]].
 *
 * @see LinkReqTipe
 */
class LinkReqTipeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return LinkReqTipe[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LinkReqTipe|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
