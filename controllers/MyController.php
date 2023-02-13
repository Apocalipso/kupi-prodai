<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Publications;
use app\models\Comments;

class MyController extends Controller
{
    public function actionIndex()
    {
        $myPublications = Publications::find()->andWhere(['creator_id'=>Yii::$app->user->id])->all();

        return $this->render('my', [
            'myPublications' => $myPublications,
        ]);
    }

    public function actionComments()
    {
        $myPublications = Publications::find()->andWhere(['creator_id'=>Yii::$app->user->id])->all();
        $publicationWithComments = [];
        foreach ($myPublications as $publication){
            if($publication->comments){
                array_push($publicationWithComments, $publication);
            }
        }
        if(!$publicationWithComments){
            return $this->render('empty-comments');
        }
        return $this->render('comments',[
            'publications' => $publicationWithComments,
        ]);
    }

    public function actionDelete($id)
    {
        Comments::findOne($id)->delete();
        $this->redirect('/my/comments');
    }
}