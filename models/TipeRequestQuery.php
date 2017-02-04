<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[TipeRequest]].
 *
 * @see TipeRequest
 */
class TipeRequestQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TipeRequest[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TipeRequest|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
