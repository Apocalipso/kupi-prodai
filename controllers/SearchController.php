<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use yii\web\HttpException;
use app\models\Publications;
use app\models\forms\SearchForm;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class SearchController extends Controller
{
    /*Поиск публикаций*/
    public function actionIndex()
    {
        $allPublication = Publications::find()->orderBy(['creation_time' => SORT_DESC])->limit(8)->all();
        $foundOffers = null;
        if (Yii::$app->request->getIsGet()) {
            $search = Yii::$app->request->get('SearchForm')['search'];
            $foundOffers = Publications::find()
                ->where(['like','title', $search]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $foundOffers,
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
            'totalCount' => $foundOffers->count(),
            'pageSize' => 8,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);
        return $this->render('search', [
            'allPublication' => $allPublication,
            'dataProvider' => $dataProvider,
            'count' => $foundOffers->count(),
            'pagination' => $pagination,
        ]);
    }
}