<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use app\models\Users;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $creation_time
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $repeatPassword
 */
class RegisterForm extends Model
{
    public $name;
    public $email;
    public $file;
    public $password;
    public $repeatPassword;

    public function rules()
    {
        return [
            [['name', 'email', 'password', 'repeatPassword','file'], 'required'],
            [['name'], 'string', 'max' => 122,'min' => 6],
            //['name', 'match', 'pattern' => '/^[a-zA-Zа-яА-Я ]+$/'],
            [['password', 'repeatPassword'], 'string', 'min' => 6],
            [['email'], 'string', 'max' => 64],
            [['email'], 'unique', 'targetAttribute' => ['email' => 'email'], 'targetClass' => Users::class],
            [['file'], 'file', 'skipOnEmpty' => true, 'maxFiles' => 1, 'extensions' => 'png, jpg'],
            [['repeatPassword'], 'compare', 'compareAttribute' => 'password']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя и фамилия',
            'email' => 'Эл. почта',
            'file' => 'Файл',
            'password' => 'Пароль',
            'repeatPassword' => 'Пароль еще раз'
        ];
    }

}
