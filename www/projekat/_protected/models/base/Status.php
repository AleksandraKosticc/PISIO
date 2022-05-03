<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "status".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @property \app\models\Item[] $items
 */
class Status extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'items'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(\app\models\Item::className(), ['status_id' => 'id']);
    }
    

    /**
     * @inheritdoc
     * @return \app\models\StatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\StatusQuery(get_called_class());
    }
}
