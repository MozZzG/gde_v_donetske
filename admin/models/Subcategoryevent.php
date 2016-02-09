<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subcategoryevent".
 *
 * @property integer $ID
 * @property string $Name
 * @property integer $CategoryeventID
 * @property integer $Count
 *
 * @property Event[] $events
 * @property Categoryevent $categoryevent
 */
class Subcategoryevent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subcategoryevent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'CategoryeventID'], 'required'],
            [['CategoryeventID', 'Count'], 'integer'],
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
            'Name' => 'Подкатегория',
            'CategoryeventID' => 'Категория',
            'Count' => 'Число событий',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['SubcategoryeventID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryevent()
    {
        return $this->hasOne(Categoryevent::className(), ['ID' => 'CategoryeventID']);
    }
}
