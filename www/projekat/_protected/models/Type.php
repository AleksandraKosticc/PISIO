<?php

namespace app\models;

use Yii;
use \app\models\base\Type as BaseType;

/**
 * This is the model class for table "type".
 */
class Type extends BaseType
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
