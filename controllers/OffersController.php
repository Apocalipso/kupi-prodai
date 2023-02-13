<?php

namespace app\controllers;

use app\models\PublicationsFiles;
use yii;
use yii\web\Controller;
use app\models\forms\OfferCreateForm;
use app\services\OffersCreateService;
use app\models\forms\CommentForm;
use yii\web\UploadedFile;
use app\models\Comments;
use app\models\Publications;
use app\models\PublicationsCategories;

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
        $commentForm = new CommentForm();

        if ($commentForm->load(Yii::$app->request->post())) {
            if ($commentForm->validate()) {
                $comment = new Comments();
                $comment->creation_time = date("Y-m-d H:i:s");;
                $comment->text = $commentForm->text;
                $comment->user_id = Yii::$app->user->getIdentity()->id;
                $comment->publication_id = $id;
                $comment->save();
                return $this->redirect('/offers/' . $id);
            }
        }

        return $this->render('view',[
            'publication' => $publication,
            'commentForm' => $commentForm,
        ]);
    }

    public function actionEdit($id)
    {
        $publication = Publications::findOne($id);
        $offerForm = new OfferCreateForm();

        if ($offerForm->load(Yii::$app->request->post())) {
            $offerForm->photo = UploadedFile::getInstance($offerForm, 'photo');
            if ($offerForm->validate()) {
                $service = new OffersCreateService();
                $service::deletePublicationCategories($id);

                $publication->creation_time = date("Y-m-d H:i:s");
                $publication->title = $offerForm->title;
                $publication->description = $offerForm->description;
                $publication->creator_id = Yii::$app->user->id;
                $publication->price =  $offerForm->price;
                $publication->is_sell = $offerForm->is_sell;
                $publication->update();


                foreach ($offerForm->publication_categories as $category)
                {
                    $publicationCategories = new PublicationsCategories();
                    $publicationCategories->category_id = $category;
                    $publicationCategories->publication_id = $publication->id;
                    $publicationCategories->save();
                }

                if($offerForm->photo)
                {
                    $service = new OffersCreateService();
                    $service->deleteFile($publication->publicationsFiles[0]->path);
                    PublicationsFiles::findOne(['publication_id' => $publication->id])->delete();

                    $filePath = $service->saveUploadFile($offerForm->photo);
                    $publicationFile = new PublicationsFiles();
                    $publicationFile->creation_time = date("Y-m-d H:i:s");
                    $publicationFile->publication_id = $publication->id;
                    $publicationFile->name = $filePath['name'];
                    $publicationFile->path = $filePath['path'];
                    $publicationFile->save();
                }
            }
            return $this->redirect('/offers/' . $id);
        }

        return $this->render('edit',[
            'offerForm' => $offerForm,
            'publication' => $publication,
        ]);
    }

    public function actionCategory($id)
    {
        echo $id . 'category';
    }

    public function actionDelete($id)
    {
        $publication = Publications::findOne($id);
        $service = new OffersCreateService();
        $service::deletePublicationCategories($id);
        $service->deleteFile($publication->publicationsFiles[0]->path);
        PublicationsFiles::findOne(['publication_id' => $publication->id])->delete();
        $publication->delete();
        return $this->redirect('/my/');
    }
}