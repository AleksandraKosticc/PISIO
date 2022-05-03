<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "item".
 *
 * @property integer $id
 * @property integer $inventory_number
 * @property string $name
 * @property string $description
 * @property string $date
 * @property string $price
 * @property integer $amortization
 * @property integer $person_id
 * @property integer $status_id
 * @property integer $location_id
 * @property integer $type_id
 *
 * @property \app\models\Location $location
 * @property \app\models\Person $person
 * @property \app\models\Status $status
 * @property \app\models\Type $type
 * @property \app\models\Transition[] $transitions
 */
class Item extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'location',
            'person',
            'status',
            'type',
            'transitions'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inventory_number', 'name', 'date', 'price', 'amortization', 'person_id', 'status_id', 'location_id', 'type_id'], 'required'],
            [['inventory_number', 'amortization', 'person_id', 'status_id', 'location_id', 'type_id'], 'integer'],
            [['description'], 'string'],
            [['date'], 'safe'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'inventory_number' => Yii::t('app', 'Inventory number'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'date' => Yii::t('app', 'Date'),
            'price' => Yii::t('app', 'Price'),
            'amortization' => Yii::t('app', 'Amortization'),
            'person_id' => Yii::t('app', 'In person'),
            'status_id' => Yii::t('app', 'In status'),
            'location_id' => Yii::t('app', 'In location'),
            'type_id' => Yii::t('app', 'In type'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(\app\models\Location::className(), ['id' => 'location_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(\app\models\Person::className(), ['id' => 'person_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(\app\models\Status::className(), ['id' => 'status_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(\app\models\Type::className(), ['id' => 'type_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransitions()
    {
        return $this->hasMany(\app\models\Transition::className(), ['item_id' => 'id']);
    }
    

    /**
     * @inheritdoc
     * @return \app\models\ItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ItemQuery(get_called_class());
    }
}
