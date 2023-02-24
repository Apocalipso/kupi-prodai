<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Publications;
use app\models\Comments;

class MyController extends Controller
{
    /*Просмотр публикаций*/
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/login']);
        }

        $myPublications = Publications::find()->andWhere(['creator_id'=>Yii::$app->user->id])->all();

        return $this->render('my', [
            'myPublications' => $myPublications,
        ]);
    }

    /*Просмотр комментариев*/
    public function actionComments()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/login']);
        }

        $myPublications = Publications::find()->andWhere(['creator_id'=>Yii::$app->user->id])->all();
        $publicationWithComments = [];
        foreach ($myPublications as $publication){
            if($publication->comments) {
                array_push($publicationWithComments, $publication);
            }
        }
        if(!$publicationWithComments) {
            return $this->render('empty-comments');
        }
        return $this->render('comments',[
            'publications' => $publicationWithComments,
        ]);
    }

    /*Удаление комментария*/
    public function actionDelete($id)
    {
        $comment = Comments::findOne($id);
        if (Yii::$app->user->id  === $comment->user_id || Yii::$app->user->getIdentity()->moderator === 1) {
            $comment->delete();
            $this->redirect('/my/comments');
        } else {
            throw new yii\web\ForbiddenHttpException('У вас нет прав, чтобы удалить данный комментарий',403);
        }
    }
}