<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Establishment;
use app\models\Establishmenttest;

/**
 * LoginForm is the model behind the login form.
 */
class SignupbusinessmanForm extends Model
{
    public $email;
    public $password;
    public $passwordRep;
    public $phone;
    public $activation_code;
    public $user_activation_code;
    public $accept;
    public $est_name;
    public $category;
    public $subcategory;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password', 'passwordRep', 'phone', 'user_activation_code', 'accept', 'est_name', 'category', 'subcategory'], 'required'],
            ['password', 'string', 'max' => 50],
            // password is validated by validatePassword()
            ['passwordRep', 'validatePassword'],
            ['email', 'email'],
            ['email', 'validateUniq'],
            ['phone', 'string', 'max' => 12],
            [['activation_code', 'est_name'], 'string'],
            [['category', 'subcategory', 'accept'], 'integer'],
            ['user_activation_code', 'validateCode', 'skipOnEmpty' => false, 'skipOnError' => false],
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

    public function validateUniq($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if ($user) {
                $this->addError($attribute, 'Пользователь с таким email уже существует.');
            }
        }
    }

    public function validateCode($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->phone) {
                if ($this->activation_code != $this->user_activation_code) {
                    $this->addError($attribute, 'Неверный код подтверждения.');
                }
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function signup()
    {
        if ($this->validate()) {
            $av = rand(1, 10);
            $model = new Users();
            $model->Name = '';
            $model->LastName = '';
            $model->Avatar = 'avatar/default/'.$av.'.jpg';
            $model->Social = '';
            $model->Email = $this->email;
            $model->Password = $this->password;
            $model->Confirmed = 1;
            $model->Questions = 0;
            $model->Answers = 0;
            $model->Ban = 0;
            $model->NewID = 0;
            $model->Businessman = 1;
            $model->Phone = $this->phone;
            if ($model->save()) {
                $est = new Establishment();
                $est_test = new Establishmenttest();
                $est->Name = $this->est_name;
                $est_test->Name = $this->est_name;
                $est->SubcategoryID = $this->subcategory;
                $est_test->SubcategoryID = $this->subcategory;
                $est->UserID = $model->ID;
                $est_test->UserID = $model->ID;
                $est->New = 1;
                if ($est->save())
                    $est_test->EstablishmentID = $est->ID;
                    if ($est_test->save())
                        return Yii::$app->user->login($model, 0);
            }
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Users::findByUsername($this->email);
        }

        return $this->_user;
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Пароль',
            'passwordRep' => 'Подтверждение пароля',
            'phone' => 'Номер телефона',
            'user_activation_code' => 'Код активации',
            'est_name' => 'Название заведения',
            'category' => 'Категория',
            'subcategory' => 'Подкатегория',
        ];
    }
}
