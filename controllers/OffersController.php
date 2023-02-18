<?php

namespace app\controllers;

use app\models\PublicationsFiles;
use yii;
use yii\web\Controller;
use app\models\forms\OfferCreateForm;
use app\services\OffersCreateService;
use app\models\forms\CommentForm;
use yii\web\UploadedFile;
use yii\data\Pagination;
use app\models\Comments;
use app\models\Publications;
use app\models\PublicationsCategories;
use app\models\Categories;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

class OffersController extends Controller
{
    public function actionIndex()
    {
        return $this->render('offers');
    }

    public function actionAdd()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/login']);
        }
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
        if (!$publication) {
            throw new NotFoundHttpException('Такого объявления не существует', 404);
        }

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
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/login']);
        }

        $publication = Publications::findOne($id);

        if(Yii::$app->user->id  === $publication->creator_id){
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
        }
        else{
            throw new yii\web\ForbiddenHttpException('У вас нет прав, чтобы редактировать данную публикацию',403);
        }

        return $this->render('edit',[
            'offerForm' => $offerForm,
            'publication' => $publication,
        ]);
    }

    public function actionCategory($id)
    {
        $currentCategory = Categories::findOne($id);

        if (!$currentCategory) {
            throw new NotFoundHttpException('Такой категории не существует', 404);
        }

        $countOffers = PublicationsCategories::find()->select('publication_id')->where(['category_id' => $id])->count();

        $categories = PublicationsCategories::find()
            ->select(['category_id', 'count' => 'count(publication_id)'])
            ->orderBy(['category_id' => SORT_ASC])
            ->groupBy(['category_id'])->all();

        $query = Publications::find()
            ->rightJoin('publications_categories', '`publications_categories`.`publication_id` = `publications`.`id`')
            ->where(['category_id' => $id]);

        $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => [
         'pageSize' => 8,
        ],
        'sort' => [
         'defaultOrder' => [
           'creation_time' => SORT_DESC,
         ]
        ],
        ]);

        $pagination = new Pagination([
            'totalCount' => $countOffers,
            'pageSize' => 8,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);

        return $this->render('categories', [
            'pagination' => $pagination,
            'currentCategory' => $currentCategory,
            'query' => $query,
            'dataProvider' => $dataProvider,
            'categories' => $categories,
            'countOffers' => $countOffers,
        ]);

    }

    public function actionDelete($id)
    {
        $publication = Publications::findOne($id);
        if(Yii::$app->user->id  === $publication->creator_id || Yii::$app->user->getIdentity()->moderator === 1 ){
            $service = new OffersCreateService();
            $service::deletePublicationCategories($id);
            $service->deleteFile($publication->publicationsFiles[0]->path);
            PublicationsFiles::findOne(['publication_id' => $publication->id])->delete();
            $publication->delete();
            return $this->redirect('/my/');
        }
        else{
            throw new yii\web\ForbiddenHttpException('У вас нет прав, чтобы удалять данную публикацию',403);
        }
    }
}