<?php

namespace app\controllers;

use yii\web\Controller;

class OffersController extends Controller
{
    public function actionIndex()
    {
        return $this->render('offers');
    }

    public function actionAdd()
    {
        return $this->render('add');
    }
}