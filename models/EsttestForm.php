<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Establishmenttest;

/**
 * LoginForm is the model behind the login form.
 */
class EsttestForm extends Model
{
    public $Name;
    public $About;
    public $Text;
    public $Field1Name;
    public $Field1Value;
    public $Field2Name;
    public $Field2Value;
    public $Worktime;
    public $Phone;
    public $Address;
    public $Website;
    public $Video;
    public $Map;
    public $Photo1;
    public $Photo2;
    public $Photo3;
    public $Photo4;
    public $Photo5;
    public $Photo6;
    public $Photo7;
    public $Photo8;
    public $Photo9;
    public $Photo10;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['Text', 'Map', 'Video', 'Website', 'Photo1', 'Photo2', 'Photo3', 'Photo4', 'Photo5', 'Photo6', 'Photo7', 'Photo8', 'Photo9', 'Photo10'], 'string'],
            [['Name'], 'string', 'max' => 200],
            [['About', 'Worktime', 'Address', 'Field1Value', 'Field2Value'], 'string', 'max' => 100],
            [['Phone', 'Field1Name', 'Field2Name'], 'string', 'max' => 50],
            [['About', 'Text', 'Map', 'Video', 'Worktime', 'Phone', 'Address', 'Website', 'Field1Name', 'Field1Value', 'Field2Name', 'Field2Value', 'Photo1', 'Photo2', 'Photo3', 'Photo4', 'Photo5', 'Photo6', 'Photo7', 'Photo8', 'Photo9', 'Photo10'], 'default', 'value' => ''],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->password != $this->passwordRep) {
                $this->addError($attribute, 'Пароли не совпадают.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
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
                mail('komarovats93@gmail.com', $est_test->Name.' отправлено на проверку', 'Заведение "'.$est_test->Name.'" было отправлено на проверку. Посмотреть новый вариант можно здесь: http://gdevdonetske.com/establishment_test?id='.$est_test->ID);
                return true;
            }
        }
        return false;
    }

    public function attributeLabels()
    {
        return [
            'Name' => 'Название',
            'About' => 'Дополнительная информация',
            'Text' => 'Описание',
            'Map' => 'Карта',
            'Video' => 'Видео',
            'Worktime' => 'Время работы',
            'Phone' => 'Телефон',
            'Address' => 'Адрес',
            'Website' => 'Вебсайт',
            'Field1Name' => 'Field1 Name',
            'Field1Value' => 'Field1 Value',
            'Field2Name' => 'Field2 Name',
            'Field2Value' => 'Field2 Value',
        ];
    }
}
