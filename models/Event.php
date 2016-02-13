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
 * @property integer $New
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
            [['Photo', 'Name', 'Place', 'Contacts'], 'string'],
            [['Date'], 'safe'],
            [['CategoryeventID', 'SubcategoryeventID', 'EstablishmentID', 'IndexTop', 'New'], 'integer'],
            [['Time'], 'string', 'max' => 50],
            [['Photo', 'Name', 'Place', 'Contacts', 'Time'], 'default', 'value' => ''],
            [['Date'], 'default', 'value' => '0000-00-00'],
            [['CategoryeventID'], 'default', 'value' => 1],
            [['SubcategoryeventID', 'EstablishmentID', 'IndexTop', 'New'], 'default', 'value' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Photo' => 'Photo',
            'Date' => 'Date',
            'Name' => 'Name',
            'Place' => 'Place',
            'Time' => 'Time',
            'Contacts' => 'Contacts',
            'CategoryeventID' => 'Categoryevent ID',
            'SubcategoryeventID' => 'Subcategoryevent ID',
            'EstablishmentID' => 'Establishment ID',
            'IndexTop' => 'Index Top',
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
