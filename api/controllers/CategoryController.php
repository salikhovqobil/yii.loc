<?php

namespace api\conttroller;

use yii\rest\ActiveController;

class CategoryController extends ActiveController
{

    public $modelClass = 'common\models\Category';

    public function actions()
    {
        $actions  = parent::actions();
        return $actions;
    }
}