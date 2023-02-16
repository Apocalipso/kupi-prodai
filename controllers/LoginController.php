<?php

namespace app\controllers;

use Yii;
use app\models\forms\LoginForm;
use yii\web\Controller;
use app\models\Users;
use app\services\UserCreateService;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\authclient\clients\VKontakte;

class LoginController extends Controller
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
                        'roles' => ['?'],
                    ],
                ]
            ]
        ];
    }

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
        $url = Yii::$app->authClientCollection->getClient("vkontakte")->buildAuthUrl();
        Yii::$app->getResponse()->redirect($url);
    }

    public function actionVk()
    {
        $code = Yii::$app->request->get('code');
        $vkClient = Yii::$app->authClientCollection->getClient("vkontakte");
        $accessToken = $vkClient->fetchAccessToken($code);
        $userAttributes = $vkClient->getUserAttributes();

        $user = Users::findOne(['vk_id' => $userAttributes['user_id']]);
        if ($user){
            Yii::$app->user->login($user);
            return $this->redirect('/');
        }
        $service = new UserCreateService();
        $newUser = $service->createVk($userAttributes);
        Yii::$app->user->login($newUser);
        return $this->redirect('/');
    }
}