<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class NewspartnerForm extends Model
{
    public $file1;
    public $name;
    public $about;
    public $text;
    public $est;
    public $date;
    public $grey;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'about', 'text', 'est', 'date'], 'required'],
            [['text', 'date'], 'string'],
            [['est', 'grey'], 'integer'],
            [['name', 'about'], 'string', 'max' => 200],
            [['file1'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'checkExtensionByMimeType' => false],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'about' => 'Описание',
            'file1' => 'Фото',
            'text' => 'Текст',
            'est' => 'Партнер',
            'date' => 'Дата',
            'grey' => 'Серый дизайн блока',
        ];
    }
}
