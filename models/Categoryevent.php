<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoryevent".
 *
 * @property integer $ID
 * @property string $Name
 * @property integer $Count
 *
 * @property Event[] $events
 * @property Subcategoryevent[] $subcategoryevents
 */
class Categoryevent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoryevent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'Count'], 'required'],
            [['Count'], 'integer'],
            [['Name'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Name' => 'Name',
            'Count' => 'Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['CategoryeventID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategoryevents()
    {
        return $this->hasMany(Subcategoryevent::className(), ['CategoryEventID' => 'ID']);
    }
}
