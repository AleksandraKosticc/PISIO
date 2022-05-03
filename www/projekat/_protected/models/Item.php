<?php

namespace app\models;

use Yii;
use \app\models\base\Item as BaseItem;

/**
 * This is the model class for table "item".
 */
class Item extends BaseItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['inventory_number', 'name', 'date', 'price', 'amortization', 'person_id', 'status_id', 'location_id', 'type_id'], 'required'],
            [['inventory_number', 'amortization', 'person_id', 'status_id', 'location_id', 'type_id'], 'integer'],
            [['description'], 'string'],
            [['date'], 'safe'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 255]
        ]);
    }

    public function extraFields()
    {
            return ['location', 'status', 'type', 'person'];
    }


/**
     * Gets query for [[Location]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }

    /**
     * Gets query for [[Person]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
    }

    /**
     * Gets query for [[Transfers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransition()
    {
        return $this->hasMany(Transition::className(), ['item' => 'id']);
    }
	
}
