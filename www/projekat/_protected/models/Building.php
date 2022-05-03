<?php

namespace app\models;

use Yii;
use \app\models\base\Building as BaseBuilding;

/**
 * This is the model class for table "building".
 */
class Building extends BaseBuilding
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255]
        ]);
    }
	
}
