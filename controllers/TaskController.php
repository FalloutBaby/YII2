<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Task;
use app\models\tables\Tasks;

class TaskController extends Controller {

    public function actionIndex() {
        $tasks = Task::getAll();

        return $this->render('index', [
                    'user' => ['username' => Yii::$app->user->identity->username,
                        'id' => Yii::$app->user->identity->id],
                    'tasks' => $tasks
        ]);
    }

    public function actionCreate() {
        $task = new Task();
        
        if ($task->load(Yii::$app->request->post()) && $task->create()) {
            return $this->redirect('?r=task');
        }

        return $this->render('create', [
                    'user' => ['username' => Yii::$app->user->identity->username],
                    'task' => $task
        ]);
    }

    public function actionDelete($id) {
        $task = Tasks::findOne($id);
        $task->delete();
        return $this->redirect('?r=task');
    }
}
