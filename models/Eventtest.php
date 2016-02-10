<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "eventtest".
 *
 * @property integer $ID
 * @property string $Photo
 * @property string $Date
 * @property string $Name
 * @property string $Place
 * @property string $Time
 * @property string $Contacts
 * @property integer $CategoryeventID
 * @property integer $SubcategoryeventID
 * @property integer $EstablishmentID
 * @property integer $IndexTop
 * @property integer $EventID
 */
class Eventtest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eventtest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CategoryeventID'], 'required'],
            [['Photo', 'Name', 'Place', 'Contacts'], 'string'],
            [['Date'], 'safe'],
            [['CategoryeventID', 'SubcategoryeventID', 'EstablishmentID', 'IndexTop', 'EventID'], 'integer'],
            [['Time'], 'string', 'max' => 50],
            [['Photo', 'Name', 'Place', 'Contacts', 'Time'], 'default', 'value' => ''],
            [['CategoryeventID', 'SubcategoryeventID', 'EstablishmentID', 'IndexTop'], 'default', 'value' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Photo' => 'Афиша',
            'Date' => 'Дата',
            'Name' => 'Название',
            'Place' => 'Место проведения',
            'Time' => 'Начало',
            'Contacts' => 'Контакты',
            'CategoryeventID' => 'Категория',
            'SubcategoryeventID' => 'Подкатегория',
            'EstablishmentID' => 'Establishment ID',
            'IndexTop' => 'Index Top',
            'EventID' => 'Event ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryevent()
    {
        return $this->hasOne(Categoryevent::className(), ['ID' => 'CategoryeventID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstablishment()
    {
        return $this->hasOne(Establishment::className(), ['ID' => 'EstablishmentID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['ID' => 'EventID']);
    }
}
