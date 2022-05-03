<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Building]].
 *
 * @see Building
 */
class BuildingQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Building[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Building|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
