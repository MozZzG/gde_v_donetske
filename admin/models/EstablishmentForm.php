<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class EstablishmentForm extends Model
{
    public $file1;
    public $file2;
    public $file3;
    public $file4;
    public $file5;
    public $file6;
    public $file7;
    public $file8;
    public $file9;
    public $file10;

    public $name;
    public $about;
    public $text;
    public $map;
    public $video;
    public $worktime;
    public $phone;
    public $address;
    public $website;
    public $field1name;
    public $field1value;
    public $field2name;
    public $field2value;
    public $subcat;
    public $top;
    public $indextop;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'about', 'text', 'worktime', 'phone', 'address', 'subcat'], 'required'],
            [['text', 'map', 'video', 'website'], 'string'],
            [['subcat', 'top', 'indextop'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['about', 'worktime', 'address', 'field1value', 'field2value'], 'string', 'max' => 100],
            [['phone', 'field1name', 'field2name'], 'string', 'max' => 50],
            [['file1', 'file2', 'file3', 'file4', 'file5', 'file6', 'file7', 'file8', 'file9', 'file10'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'checkExtensionByMimeType' => false],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'about' => 'Дополнительная информация',
            'text' => 'Описание',
            'map' => 'Карта',
            'video' => 'Видео',
            'worktime' => 'Время работы',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'website' => 'Сайт',
            'field1name' => 'Поле 1',
            'field1value' => 'Значение 1',
            'field2name' => 'Поле 2',
            'field2value' => 'Значение 2',
            'subcat' => 'Подкатегория',
            'top' => 'Топ в категории',
            'indextop' => 'Топ на главной',
        ];
    }
}
