<?php

namespace app\models;

use Yii;
use yii\base\Model;
//use app\models\Eventtest;

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
    public $CategoryeventID;
    public $SubcategoryeventID;
    public $Photo;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['CategoryeventID', 'required'],
            [['Photo', 'Name', 'Place', 'Contacts'], 'string'],
            [['Date'], 'safe'],
            [['CategoryeventID', 'SubcategoryeventID'], 'integer'],
            [['Time'], 'string', 'max' => 50],
            [['Photo', 'Name', 'Place', 'Contacts', 'Time'], 'default', 'value' => ''],
            [['SubcategoryeventID'], 'default', 'value' => 0],
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     *//*
    public function Sendtoadmins($id, $subcat)
    {
        if ($this->validate()) {
            $est_test = Establishmenttest::find()->where(['EstablishmentID' => $id])->one();
            if (!$est_test) {
                $est_test = new Establishmenttest();
                $est_test->EstablishmentID = $id;
                $est_test->SubcategoryID = $subcat;
                $est_test->UserID = Yii::$app->user->ID;
            }
            $est_test->Name = $this->Name;
            $est_test->About = $this->About;
            $est_test->Text = $this->Text;
            $est_test->Field1Name = $this->Field1Name;
            $est_test->Field1Value = $this->Field1Value;
            $est_test->Field2Name = $this->Field2Name;
            $est_test->Field2Value = $this->Field2Value;
            $est_test->Worktime = $this->Worktime;
            $est_test->Phone = $this->Phone;
            $est_test->Address = $this->Address;
            $est_test->Website = $this->Website;
            $est_test->Video = $this->Video;
            $est_test->Map = $this->Map;
            $est_test->Photo1 = $this->Photo1;
            $est_test->Photo2 = $this->Photo2;
            $est_test->Photo3 = $this->Photo3;
            $est_test->Photo4 = $this->Photo4;
            $est_test->Photo5 = $this->Photo5;
            $est_test->Photo6 = $this->Photo6;
            $est_test->Photo7 = $this->Photo7;
            $est_test->Photo8 = $this->Photo8;
            $est_test->Photo9 = $this->Photo9;
            $est_test->Photo10 = $this->Photo10;
            if ($est_test->save()) {
                mail('komarovats93@gmail.com', $est_test->Name.' отправлено на проверку', 'Заведение "'.$est_test->Name.'" было отправлено на проверку. Посмотреть новый вариант можно здесь: http://gdevonetske.com/establishment_test?id='.$est_test->ID);
                return true;
            }
        }
        return false;
    }*/

    public function attributeLabels()
    {
        return [

        ];
    }
}
