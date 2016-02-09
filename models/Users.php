<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $ID
 * @property string $Email
 * @property string $Password
 * @property string $Name
 * @property string $LastName
 * @property string $Avatar
 * @property integer $Questions
 * @property integer $Answers
 * @property integer $Confirmed
 * @property string $Social
 * @property integer $Ban
 * @property integer $NewID
 * @property string $Phone
 * @property integer $Businessman
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_forum');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Email', 'Name', 'LastName', 'Avatar', 'Social'], 'string'],
            [['Questions', 'Answers', 'Confirmed', 'Ban', 'NewID', 'Businessman'], 'integer'],
            [['Password'], 'string', 'max' => 50],
            [['Phone'], 'string', 'max' => 12]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Email' => 'Email',
            'Password' => 'Password',
            'Name' => 'Name',
            'LastName' => 'Last Name',
            'Avatar' => 'Avatar',
            'Questions' => 'Questions',
            'Answers' => 'Answers',
            'Confirmed' => 'Confirmed',
            'Social' => 'Social',
            'Ban' => 'Ban',
            'NewID' => 'New ID',
            'Phone' => 'Phone',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    public static function findByUsername($username)
    {
        foreach (Users::find()->all() as $user) {
            if (strcasecmp($user->Email, $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    public function getId()
    {
        return $this->ID;
    }

    public function getAuthKey()
    {

    }

    public function validateAuthKey($authKey)
    {

    }

    public function validatePassword($password)
    {
        return $this->Password === $password;
    }
}
