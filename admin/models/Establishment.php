<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "establishment".
 *
 * @property integer $ID
 * @property string $Name
 * @property string $About
 * @property string $Text
 * @property string $Map
 * @property string $Video
 * @property string $Worktime
 * @property string $Phone
 * @property string $Address
 * @property string $Website
 * @property string $Field1Name
 * @property string $Field1Value
 * @property string $Field2Name
 * @property string $Field2Value
 * @property string $Photo1
 * @property string $Photo2
 * @property string $Photo3
 * @property string $Photo4
 * @property string $Photo5
 * @property string $Photo6
 * @property string $Photo7
 * @property string $Photo8
 * @property string $Photo9
 * @property string $Photo10
 * @property integer $SubcategoryID
 * @property integer $Views
 * @property integer $Likes
 * @property integer $Comments
 * @property double $Rating
 * @property integer $UserID
 * @property integer $Top
 * @property integer $IndexTop
 *
 * @property Subcategory $subcategory
 */
class Establishment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'establishment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'SubcategoryID'], 'required'],
            [['Text', 'Map', 'Video', 'Website', 'Photo1', 'Photo2', 'Photo3', 'Photo4', 'Photo5', 'Photo6', 'Photo7', 'Photo8', 'Photo9', 'Photo10'], 'string'],
            [['SubcategoryID', 'Views', 'Likes', 'Comments', 'UserID', 'Top', 'IndexTop', 'New'], 'integer'],
            [['Rating'], 'number'],
            [['Name'], 'string', 'max' => 200],
            [['About', 'Worktime', 'Address', 'Field1Value', 'Field2Value'], 'string', 'max' => 100],
            [['Phone', 'Field1Name', 'Field2Name'], 'string', 'max' => 50],
            [['About', 'Text', 'Map', 'Video', 'Worktime', 'Phone', 'Address', 'Website', 'Field1Name', 'Field1Value', 'Field2Name', 'Field2Value', 'Photo1', 'Photo2', 'Photo3', 'Photo4', 'Photo5', 'Photo6', 'Photo7', 'Photo8', 'Photo9', 'Photo10'], 'default', 'value' => ''],
            [['Views', 'Likes', 'Comments', 'Rating', 'Top', 'UserID', 'IndexTop', 'New'], 'default', 'value' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Name' => 'Названиe',
            'About' => 'Дополнительная информация',
            'Text' => 'Описание',
            'Map' => 'Карта',
            'Video' => 'Видео',
            'Worktime' => 'Время работы',
            'Phone' => 'Телефон',
            'Address' => 'Адрес',
            'Website' => 'Сайт',
            'Field1Name' => 'Поле 1',
            'Field1Value' => 'Значение поля 1',
            'Field2Name' => 'Поле 2',
            'Field2Value' => 'Значение поля 2',
            'Photo1' => 'Photo1',
            'Photo2' => 'Photo2',
            'Photo3' => 'Photo3',
            'Photo4' => 'Photo4',
            'Photo5' => 'Photo5',
            'Photo6' => 'Photo6',
            'Photo7' => 'Photo7',
            'Photo8' => 'Photo8',
            'Photo9' => 'Photo9',
            'Photo10' => 'Photo10',
            'SubcategoryID' => 'Подкатегория',
            'Views' => 'Просмотры',
            'Likes' => 'Лайки',
            'Comments' => 'Комментарии',
            'Rating' => 'Рейтинг',
            'UserID' => 'User ID',
            'Top' => 'Топ в категории',
            'IndexTop' => 'Топ на главной',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategory()
    {
        return $this->hasOne(Subcategory::className(), ['ID' => 'SubcategoryID']);
    }
}
