<?php

namespace app\controllers;

use app\models\Publications;
use yii;
use yii\web\Controller;
use app\models\forms\OfferCreateForm;
use app\services\OffersCreateService;
use app\models\Comments;
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
        if ($offerForm->load(Yii::$app->request->post())) {
            $offerForm->photo = UploadedFile::getInstance($offerForm, 'photo');

            if ($offerForm->validate()) {
                $service = new OffersCreateService();
                $filepath = $service->saveUploadFile($offerForm->photo);
                $service->create($offerForm, $filepath);
                return $this->redirect('/my');
            }
        }
        return $this->render('add',[
            'offerForm' => $offerForm,
        ]);
    }

    public function actionView($id)
    {
        $publication = Publications::findOne($id);
        return $this->render('view',[
            'publication' => $publication,
        ]);
    }

    public function actionEdit($id)
    {
        echo $id . 'edit';
    }

    public function actionCategory($id)
    {
        echo $id . 'category';
    }
}