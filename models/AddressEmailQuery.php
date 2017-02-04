<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AddressEmail]].
 *
 * @see AddressEmail
 */
class AddressEmailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return AddressEmail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AddressEmail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
