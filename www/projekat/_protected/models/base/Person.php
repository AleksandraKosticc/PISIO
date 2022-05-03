<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "person".
 *
 * @property integer $id
 * @property string $lastname
 * @property string $firstname
 * @property string $title
 * @property string $jmbg
 * @property string $profession
 * @property string $contact
 *
 * @property \app\models\Item[] $items
 * @property \app\models\Transition[] $transitions
 */
class Person extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'items',
            'transitions'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lastname', 'firstname', 'title', 'jmbg'], 'required'],
            [['lastname', 'firstname', 'title', 'profession'], 'string', 'max' => 255],
            [['jmbg'], 'string', 'max' => 13],
            [['contact'], 'string', 'max' => 45]
        ];
    }

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
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lastname' => Yii::t('app', 'Lastname'),
            'firstname' => Yii::t('app', 'Firstname'),
            'title' => Yii::t('app', 'Title'),
            'jmbg' => Yii::t('app', 'JMBG'),
            'profession' => Yii::t('app', 'Profession'),
            'contact' => Yii::t('app', 'Contact'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(\app\models\Item::className(), ['person_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransitions()
    {
        return $this->hasMany(\app\models\Transition::className(), ['person_to_id' => 'id']);
    }
    

    /**
     * @inheritdoc
     * @return \app\models\PersonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\PersonQuery(get_called_class());
    }
}
