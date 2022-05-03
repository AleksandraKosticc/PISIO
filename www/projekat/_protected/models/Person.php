<?php

namespace app\models;

use Yii;
use \app\models\base\Person as BasePerson;

/**
 * This is the model class for table "person".
 */
class Person extends BasePerson
{
     use \mootensai\relation\RelationTrait;

     public $fullName;
    /**
     * @inheritdoc
     */
     public static function tableName()
    {
        return 'person';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['lastname', 'firstname', 'title', 'jmbg'], 'required'],
            [['lastname', 'firstname', 'title', 'profession'], 'string', 'max' => 255],
            [['jmbg'], 'string', 'max' => 13],
            [['contact'], 'string', 'max' => 45]
        ]);
    }



/**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasMany(Item::className(), ['person_id' => 'id']);
    }

    /**
     * Gets query for [[Transition]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransition()
    {
        return $this->hasMany(Transition::className(), ['person_from_id' => 'id']);
    }

    /**
     * Gets query for [[Transition0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransition0()
    {
        return $this->hasMany(Transition::className(), ['person_to_id' => 'id']);
    }
	
}
