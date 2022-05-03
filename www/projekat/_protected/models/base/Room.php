<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "room".
 *
 * @property integer $id
 * @property integer $number
 * @property string $name
 * @property string $description
 * @property integer $building_id
 *
 * @property \app\models\Location[] $locations
 * @property \app\models\Building $building
 */
class Room extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'locations',
            'building'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'name', 'building_id'], 'required'],
            [['number', 'building_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'number' => Yii::t('app', 'Number'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'building_id' => Yii::t('app', 'In building'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(\app\models\Location::className(), ['room_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuilding()
    {
        return $this->hasOne(\app\models\Building::className(), ['id' => 'building_id']);
    }
    

    /**
     * @inheritdoc
     * @return \app\models\RoomQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\RoomQuery(get_called_class());
    }
}
