<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\forms\OfferCreateForm;
use yii\web\UploadedFile;

class OffersController extends Controller
{
    public function actionIndex()
    {
        return $this->render('offers');
    }

    public function actionAdd()
    {
        $offerForm = new OfferCreateForm();
        Yii::debug($offerForm);
        if ($offerForm->load(Yii::$app->request->post())) {
            $offerForm->photo = UploadedFile::getInstance($offerForm, 'photo');
            Yii::debug($offerForm);
            if ($offerForm->validate()) {

            }
        }
        return $this->render('add',[
            'offerForm' => $offerForm,
        ]);
    }
}