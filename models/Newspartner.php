<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "newspartner".
 *
 * @property integer $ID
 * @property string $Name
 * @property string $About
 * @property string $Text
 * @property string $Photo
 * @property integer $EstablishmentID
 * @property string $Date
 * @property integer $Views
 * @property integer $Grey
 */
class Newspartner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'newspartner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'About', 'Text', 'Photo', 'EstablishmentID', 'Date', 'Views', 'Grey'], 'required'],
            [['Text', 'Photo'], 'string'],
            [['EstablishmentID', 'Views', 'Grey'], 'integer'],
            [['Date'], 'safe'],
            [['Name', 'About'], 'string', 'max' => 200]
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
            'About' => 'About',
            'Text' => 'Text',
            'Photo' => 'Photo',
            'EstablishmentID' => 'Establishment ID',
            'Date' => 'Date',
            'Views' => 'Views',
            'Grey' => 'Grey',
        ];
    }
}
