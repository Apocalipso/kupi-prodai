<?php

namespace app\controllers;

use yii\web\Controller;

class LoginController extends Controller
{
    public function actionIndex()
    {
        return $this->render('login');
    }

    public function actionAuth(){
        echo 'action auth';
    }

    public function actionVk()
    {
        echo 'actionvk';
    }
}