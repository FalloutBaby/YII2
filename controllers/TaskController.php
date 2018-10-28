<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Task;

class TaskController extends Controller
{
	 public function actionIndex()
    {
		 // Заглушка без базы
		$task = new Task();
		 
		$task->setAttributes([
		'title' => 'New Task',
		'dateOfCreation' => date("Y-m-d"),
		'deadline' => '2020-01-31'
          ]);
		 
		$task2 = new Task();
		 
		$task2->setAttributes([
		'title' => 'New Task',
		'dateOfCreation' => date("Y-m-d"),
		'deadline' => '2018-01-12'
          ]);
		 
        /*
		// Проверка валидации, в т.ч. созданного класса
		
		var_dump($task->validate());
		var_dump($task2->validate());
        var_dump($task2->getErrors());
        exit;
		*/ 
		 
       return $this->render('index', [
		   'user' => ['username' => Yii::$app->user->identity->username],
		   'tasks' => [$task, $task2]
        ]);
    }
	
	public function actionCreate()
	{
		$task = new Task();
		
		if ($task->load(Yii::$app->request->post()) && $task->create()){
			return $this->render('index', [
		   'user' => ['username' => Yii::$app->user->identity->username],
		   'tasks' => [$task]
				]);
		}
		
		return $this->render('create', [
		   'user' => ['username' => Yii::$app->user->identity->username],
		   'task' => $task
        ]);
	}
}
