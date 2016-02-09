<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class NewsForm extends Model
{
    public $file1;
    public $name;
    public $about;
    public $text;
    public $cat;
    public $date;
    public $grey;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'about', 'text', 'cat'], 'required'],
            [['text', 'date'], 'string'],
            [['cat', 'grey'], 'integer'],
            [['name', 'about'], 'string', 'max' => 200],
            [['file1'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'checkExtensionByMimeType' => false],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'about' => 'Описание',
            'file1' => 'Фото',
            'text' => 'Текст',
            'cat' => 'Категория',
            'date' => 'Дата',
            'grey' => 'Серый дизайн блока',
        ];
    }
}
