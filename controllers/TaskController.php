<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Task;

class TaskController extends Controller
{
	 public function actionIndex()
    {
       return $this->render('index', [
            'username' => Yii::$app->user->identity->username
        ]);
    }
}