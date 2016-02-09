<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $ID
 * @property string $Name
 * @property string $About
 * @property string $Text
 * @property string $Photo
 * @property integer $CategorynewsID
 * @property string $Date
 * @property integer $Views
 * @property integer $Grey
 *
 * @property Categorynews $categorynews
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'About', 'Text', 'Photo', 'CategorynewsID'], 'required'],
            [['Text', 'Photo'], 'string'],
            [['CategorynewsID', 'Views', 'Grey'], 'integer'],
            [['Date'], 'safe'],
            [['Name', 'About'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Name' => 'Заголовок',
            'About' => 'Краткое описание',
            'Text' => 'Текст',
            'Photo' => 'Фото',
            'CategorynewsID' => 'Категория',
            'Date' => 'Дата',
            'Views' => 'Просмотры',
            'Grey' => 'Серый дизайн блока',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategorynews()
    {
        return $this->hasOne(Categorynews::className(), ['ID' => 'CategorynewsID']);
    }
}
