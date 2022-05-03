<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "transition".
 *
 * @property integer $id
 * @property string $date
 * @property integer $person_from_id
 * @property integer $person_to_id
 * @property integer $item_id
 * @property integer $location_from_id
 * @property integer $location_to_id
 *
 * @property \app\models\Location $locationTo
 * @property \app\models\Item $item
 * @property \app\models\Location $locationFrom
 * @property \app\models\Person $personFrom
 * @property \app\models\Person $personTo
 */
class Transition extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'locationTo',
            'item',
            'locationFrom',
            'personFrom',
            'personTo'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['person_from_id', 'person_to_id', 'item_id', 'location_from_id', 'location_to_id'], 'required'],
            [['person_from_id', 'person_to_id', 'item_id', 'location_from_id', 'location_to_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transition';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
            'person_from_id' => Yii::t('app', 'In person'),
            'person_to_id' => Yii::t('app', 'In person'),
            'item_id' => Yii::t('app', 'In item'),
            'location_from_id' => Yii::t('app', 'In location'),
            'location_to_id' => Yii::t('app', 'In location'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationTo()
    {
        return $this->hasOne(\app\models\Location::className(), ['id' => 'location_to_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(\app\models\Item::className(), ['id' => 'item_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationFrom()
    {
        return $this->hasOne(\app\models\Location::className(), ['id' => 'location_from_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonFrom()
    {
        return $this->hasOne(\app\models\Person::className(), ['id' => 'person_from_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonTo()
    {
        return $this->hasOne(\app\models\Person::className(), ['id' => 'person_to_id']);
    }
    

    /**
     * @inheritdoc
     * @return \app\models\TransitionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\TransitionQuery(get_called_class());
    }
}
