<?php

namespace app\models;

use Yii;
use \app\models\base\Location as BaseLocation;

/**
 * This is the model class for table "location".
 */
class Location extends BaseLocation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['lat_lon', 'room_id'], 'required'],
            [['room_id'], 'integer'],
            [['lat_lon'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 255]
        ]);
    }

    public function extraFields()
    {
            return ['room'];
    }

	
}
