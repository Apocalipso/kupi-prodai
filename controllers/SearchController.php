<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use yii\web\HttpException;

class SearchController extends Controller
{
    public function actionIndex()
    {
        return $this->render('search');
    }
}