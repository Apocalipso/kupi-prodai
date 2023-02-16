<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\forms\RegisterForm;
use yii\base\Exception;
use yii\web\UploadedFile;
use app\services\UserCreateService;
use yii\filters\AccessControl;


class RegisterController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,

                'denyCallback' => function () {
                    return $this->redirect(['/']);
                },
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['?']
                    ]
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $registerForm = new RegisterForm();
        if ($registerForm->load(Yii::$app->request->post())) {
            $registerForm->file = UploadedFile::getInstance($registerForm, 'file');
            if ($registerForm->validate()) {

                $service  = new UserCreateService();
                $avatarPath = $service->saveUploadFile($registerForm->file);
                $service -> create($registerForm, $avatarPath);
                return $this->redirect('/login', 301);

            }
        }

        return $this->render('registration', ['registerForm' => $registerForm]);
    }
}