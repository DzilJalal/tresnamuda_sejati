<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Departement]].
 *
 * @see Departement
 */
class DepartementQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Departement[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Departement|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
