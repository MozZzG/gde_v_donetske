<?php

namespace app\models;

use Yii;
use yii\base\Model;
use himiklab\yii2\recaptcha\ReCaptchaValidator;

/**
 * LoginForm is the model behind the login form.
 */
class SignupForm extends Model
{
    public $email;
    public $password;
    public $passwordRep;
    public $phone;
    public $activation_code;
    public $user_activation_code;
    public $reCaptcha;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password', 'passwordRep'], 'required'],
            ['password', 'string', 'max' => 50],
            // password is validated by validatePassword()
            ['passwordRep', 'validatePassword'],
            ['email', 'email'],
            ['email', 'validateUniq'],
            ['phone', 'string', 'max' => 12],
            ['phone', 'validatePhoneUniq'],
            ['activation_code', 'string'],
            ['user_activation_code', 'validateCode', 'skipOnEmpty' => false, 'skipOnError' => false],
            [['reCaptcha'], ReCaptchaValidator::className(), 'secret' => '6LfvLBMTAAAAAKU_eW4CR5GNQsIEz3FsrIKgmErA'],
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

    public function validatePhoneUniq($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = Users::find()->where(['Phone' => $this->phone])->one();

            if ($user) {
                $this->addError($attribute, 'Пользователь с таким номером телефона уже существует.');
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
            $model->Confirmed = 0;
            $model->Questions = 0;
            $model->Answers = 0;
            $model->Ban = 0;
            $model->NewID = 0;
            $model->Businessman = 0;
            if ($this->phone) {
                $model->Phone = $this->phone;
            }
            else {
                $model->Phone = '';
            }
            if ($model->save()) {
                return true;
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
        ];
    }
}
