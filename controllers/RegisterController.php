<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\forms\RegisterForm;
use yii\base\Exception;
use yii\web\UploadedFile;


class RegisterController extends Controller
{
    public function actionIndex()
    {
        $registerForm = new RegisterForm();
        if ($registerForm->load(Yii::$app->request->post())) {
            $registerForm->file = UploadedFile::getInstance($registerForm, 'file');
            if ($registerForm->validate()) {
                return $this->redirect('https://ya.ru', 301);

            }
        }

        return $this->render('registration', ['registerForm' => $registerForm]);
    }
}