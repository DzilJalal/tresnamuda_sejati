<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AnalisaRequest]].
 *
 * @see AnalisaRequest
 */
class AnalisaRequestQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return AnalisaRequest[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AnalisaRequest|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
