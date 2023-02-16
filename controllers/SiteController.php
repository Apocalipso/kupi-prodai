<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Publications;
use app\models\PublicationsCategories;
use app\models\Comments;

class SiteController extends Controller
{
    public function beforeAction( $action ) {
        if ( parent::beforeAction ( $action ) )
        {
            if ( $action->id == 'error'  && Yii::$app->response->statusCode !== 500)
            {
                $this->layout = 'error';
            }
            if (Yii::$app->response->statusCode === 500)
            {
                $this->layout = 'errorserver';
            }
            return true;
        }
    }
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $allPublication = Publications::find()->orderBy(['creation_time' => SORT_DESC])->limit(8)->all();

        if (count($allPublication) === 0){
            return $this->render('index-empty');
        }

        $categories = PublicationsCategories::find()
            ->select(['category_id', 'count' => 'count(publication_id)'])
            ->orderBy(['category_id' => SORT_ASC])
            ->groupBy(['category_id'])->all();

        $mostComments = Comments::find()->select(['publication_id'])
            ->groupBy(['publication_id'])
            ->orderBy(['publication_id' => SORT_DESC])
            ->limit(8)->all();

        return $this->render('index', [
            'allPublication' => $allPublication,
            'categories' => $categories,
            'mostComments' => $mostComments,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('/');
    }

}
