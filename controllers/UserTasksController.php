<?php

namespace app\controllers;

use yii;
use app\models\search\TasksFilter;
use yii\web\Controller;

class UserTasksController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new TasksFilter();
        $query = Yii::$app->user->identity->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $query);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
