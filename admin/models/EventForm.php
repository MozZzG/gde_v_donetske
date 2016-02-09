<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class EventForm extends Model
{
    public $file1;
    public $date;
    public $name;
    public $place;
    public $time;
    public $contacts;
    public $cat;
    public $subcat;
    public $itop;
    public $est;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['date', 'name', 'cat'], 'required'],
            [['name', 'place', 'contacts'], 'string'],
            [['date'], 'safe'],
            [['subcat', 'itop', 'est', 'cat'], 'integer'],
            [['time'], 'string', 'max' => 50],
            [['file1'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'checkExtensionByMimeType' => false],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'place' => 'Место проведения',
            'date' => 'Дата',
            'time' => 'Время начала',
            'contacts' => 'Контакты',
            'cat' => 'Категория',
            'subcat' => 'Подкатегория',
            'itop' => 'Топ на главной',
            'file1' => 'Афиша',
            'est' => 'Заведение',
        ];
    }
}
