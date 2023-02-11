<?php

namespace app\controllers;

use Yii;
use app\models\Publications;
use yii\web\Controller;

class MyController extends Controller
{
    public function actionIndex()
    {
        $myPublications = Publications::find()->andWhere(['creator_id'=>Yii::$app->user->id])->all();

        return $this->render('my', [
            'myPublications' => $myPublications,
        ]);
    }
}