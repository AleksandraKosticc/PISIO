<?php

namespace app\models;

use Yii;
use \app\models\base\Transition as BaseTransition;

/**
 * This is the model class for table "transition".
 */
class Transition extends BaseTransition
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['date'], 'safe'],
            [['person_from_id', 'person_to_id', 'item_id', 'location_from_id', 'location_to_id'], 'required'],
            [['person_from_id', 'person_to_id', 'item_id', 'location_from_id', 'location_to_id'], 'integer']
        ]);
    }

    public function extraFields()
    {
            return ['person', 'item', 'location'];
    }

	
}
