<?php

namespace frontend\controllers;

use common\models\ProductSearch;
use yii\web\Controller;

class ProductController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}