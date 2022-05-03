<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "location".
 *
 * @property integer $id
 * @property string $lat_lon
 * @property string $description
 * @property integer $room_id
 *
 * @property \app\models\Item[] $items
 * @property \app\models\Room $room
 * @property \app\models\Transition[] $transitions
 */
class Location extends \yii\db\ActiveRecord
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
            'room',
            'transitions'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lat_lon', 'room_id'], 'required'],
            [['room_id'], 'integer'],
            [['lat_lon'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lat_lon' => Yii::t('app', 'Latitude and longitude'),
            'description' => Yii::t('app', 'Description'),
            'room_id' => Yii::t('app', 'In room'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(\app\models\Item::className(), ['location_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(\app\models\Room::className(), ['id' => 'room_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransitions()
    {
        return $this->hasMany(\app\models\Transition::className(), ['location_from_id' => 'id']);
    }
    

    /**
     * @inheritdoc
     * @return \app\models\LocationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\LocationQuery(get_called_class());
    }
}
