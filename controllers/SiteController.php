<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Publications;

class SiteController extends Controller
{
    public function beforeAction( $action ) {
        if ( parent::beforeAction ( $action ) )
        {
            if ( $action->id == 'error'  && Yii::$app->response->statusCode !== 500)
            {
                $this->layout = 'error';
            }
            if (Yii::$app->response->statusCode === 500)
            {
                $this->layout = 'errorserver';
            }
            return true;
        }
    }
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $allPublication = Publications::find()->all();
        if (count($allPublication) === 0){
            return $this->render('index-empty');
        }

        return $this->render('index', [
            'allPublication' => $allPublication,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('/');
    }

}
