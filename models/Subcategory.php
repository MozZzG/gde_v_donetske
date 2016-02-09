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
 * @property Establishment[] $establishments
 * @property News[] $news
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
            'Name' => 'Name',
            'CategoryID' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstablishments()
    {
        return $this->hasMany(Establishment::className(), ['SubcategoryID' => 'ID']);
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
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['ID' => 'CategoryID']);
    }
}
