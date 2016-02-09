<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subcategory".
 *
 * @property integer $ID
 * @property string $Name
 * @property integer $CategoryID
 *
 * @property News[] $news
 * @property News[] $news0
 * @property Category $category
 */
class Subcategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subcategory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'CategoryID'], 'required'],
            [['CategoryID'], 'integer'],
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
            'CategoryID' => 'Категория',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['SubcategoryID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews0()
    {
        return $this->hasMany(News::className(), ['CategoryID' => 'CategoryID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['ID' => 'CategoryID']);
    }
}
