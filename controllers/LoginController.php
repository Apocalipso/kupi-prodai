<?php

namespace app\controllers;

use Yii;
use app\models\forms\LoginForm;
use yii\web\Controller;
use app\models\Users;

class LoginController extends Controller
{
    public function actionIndex()
    {
        $loginForm = new LoginForm();
        if ( $loginForm->load(Yii::$app->request->post())){
            if ($loginForm->validate()) {
                $user = Users::findOne(['email' => $loginForm->email]);
                Yii::$app->user->login( $user);
                return $this->redirect('/');
            }
        }
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