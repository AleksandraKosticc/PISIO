<?php

namespace app\models;

use Yii;
use \app\models\base\Room as BaseRoom;

/**
 * This is the model class for table "room".
 */
class Room extends BaseRoom
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['number', 'name', 'building_id'], 'required'],
            [['number', 'building_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
	    [['building_id'], 'exist', 'skipOnError' => true, 'targetClass' => Building::className(), 'targetAttribute' => ['building_id' => 'id']],
      
        ]);
    }

	public function extraFields()
    {
            return ['building'];
    }

/**
     * Gets query for [[Building]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBuilding()
    {
        return $this->hasOne(Building::className(), ['id' => 'building_id']);
    }

    /**
     * Gets query for [[Locations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Location::className(), ['room_id' => 'id']);
    }

   
	
}
