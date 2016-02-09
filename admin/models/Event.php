<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
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
 *
 * @property Categoryevent $categoryevent
 * @property Establishment $establishment
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Photo', 'Date', 'Name', 'CategoryeventID'], 'required'],
            [['Photo', 'Name', 'Place', 'Contacts'], 'string'],
            [['Date'], 'safe'],
            [['CategoryeventID', 'SubcategoryeventID', 'EstablishmentID', 'IndexTop'], 'integer'],
            [['Time'], 'string', 'max' => 50],
            [['Place', 'Contacts', 'Time'], 'default', 'value' => ''],
            [['SubcategoryeventID', 'EstablishmentID', 'IndexTop'], 'default', 'value' => 0],
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
            'Time' => 'Время начала',
            'Contacts' => 'Контакты',
            'CategoryeventID' => 'Категория',
            'SubcategoryeventID' => 'Подкатегория',
            'EstablishmentID' => 'Заведение',
            'IndexTop' => 'Топ на главной',
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
}
