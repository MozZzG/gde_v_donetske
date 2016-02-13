<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Eventtest;

/**
 * LoginForm is the model behind the login form.
 */
class EventtestForm extends Model
{
    public $Name;
    public $Date;
    public $Place;
    public $Time;
    public $Contacts;
    public $EstablishmentID;
    public $CategoryeventID;
    public $SubcategoryeventID;
    public $Photo;
    public $EventID;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['CategoryeventID', 'required'],
            [['Photo', 'Name', 'Place', 'Contacts'], 'string'],
            [['Date'], 'safe'],
            [['CategoryeventID', 'SubcategoryeventID', 'EstablishmentID', 'EventID'], 'integer'],
            [['Time'], 'string', 'max' => 50],
            [['Photo', 'Name', 'Place', 'Contacts', 'Time'], 'default', 'value' => ''],
            [['SubcategoryeventID'], 'default', 'value' => 0],
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function Sendtoadmins()
    {
        if ($this->validate()) {
            $event_test = Eventtest::find()->where(['EventID' => $this->EventID])->one();
            if (!$event_test) {
                $event_test = new Eventtest();
            }
            $event_test->Photo = $this->Photo;
            $event_test->Name = $this->Name;
            $event_test->Date = $this->Date;
            $event_test->Place = $this->Place;
            $event_test->Time = $this->Time;
            $event_test->Contacts = $this->Contacts;
            $event_test->CategoryeventID = $this->CategoryeventID;
            $event_test->SubcategoryeventID = $this->SubcategoryeventID;
            $event_test->EstablishmentID = $this->EstablishmentID;
            $event_test->EventID = $this->EventID;
            if ($event_test->save()) {
                //mail('komarovats93@gmail.com', $event_test->Name.' отправлено на проверку', 'Афиша "'.$event_test->Name.'" была отправлена на проверку. Посмотреть новый вариант можно здесь: http://gdevdonetske.com/event_test?id='.$event_test->ID);
                return true;
            }
        }
        return false;
    }

    public function attributeLabels()
    {
        return [

        ];
    }
}
