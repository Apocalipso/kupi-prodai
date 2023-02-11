<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Publications;

class CommentsController extends Controller
{
    public function actionIndex()
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
        echo $id;
    }

}