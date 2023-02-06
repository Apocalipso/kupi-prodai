<?php
namespace app\services;

use yii;
use app\models\Users;

class UserCreateService {
    public function create($registerForm)
    {
        $user = new Users;
        $user->creation_time = date('Y-m-d G:i:s');
        $user->name = $registerForm->name;
        $user->email = $registerForm->email;
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($registerForm->password);
        return $user->save();
    }
}