<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Task;

class TaskController extends Controller
{
	
	
	 public function actionIndex()
    {
		$model = new Task();
		 
		$model->setAttributes([
		'title' => 'New Task',
		'dateOfCreation' => date("Y-m-d"),
		'deadline' => '2020-01-31'
          ]);
		 
		$model2 = new Task();
		 
		$model2->setAttributes([
		'title' => 'New Task',
		'dateOfCreation' => date("Y-m-d"),
		'deadline' => '2018-12-12'
          ]);
		 
       return $this->render('index', [
		   'user' => ['username' => Yii::$app->user->identity->username],
		   'tasks' => [$model, $model2]
        ]);
    }
}
