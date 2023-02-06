<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\forms\RegisterForm;
use yii\base\Exception;
use yii\web\UploadedFile;
use app\services\UserCreateService;


class RegisterController extends Controller
{
    public function actionIndex()
    {
        $registerForm = new RegisterForm();
        if ($registerForm->load(Yii::$app->request->post())) {
            $registerForm->file = UploadedFile::getInstance($registerForm, 'file');
            if ($registerForm->validate()) {

                $service  = new UserCreateService();
                $service ->create($registerForm);
                //return $this->redirect('/login', 301);

            }
        }

        return $this->render('registration', ['registerForm' => $registerForm]);
    }
}