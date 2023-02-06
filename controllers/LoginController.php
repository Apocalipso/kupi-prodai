<?php

namespace app\controllers;

use app\models\forms\LoginForm;
use yii\web\Controller;

class LoginController extends Controller
{
    public function actionIndex()
    {
        $loginForm = new LoginForm();
        return $this->render('login',[
            'loginForm' => $loginForm,
        ]);
    }

    public function actionAuth(){
        echo 'action auth';
    }

    public function actionVk()
    {
        echo 'actionvk';
    }
}