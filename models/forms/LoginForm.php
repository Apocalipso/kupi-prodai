<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use app\models\Users;

class LoginForm extends Model
{
    public $user;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            [['password'], 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Эл. почта',
            'password' => 'Пароль',
        ];
    }

    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !\Yii::$app->security->validatePassword($this->password, $user->password)) {
                $this->addError($attribute, 'Неправильный email или пароль');
            }
        }
    }

    public function getUser()
    {
        if ($this->user === null) {
            $this->user = Users::findOne(['email' => $this->email]);
        }
        return $this->user;
    }
}
