<?php

namespace app\commands;

use yii\console\Controller;
use yii\helpers\Console;
use app\models\tables\Tasks;
use app\models\tables\Users;
use yii;

class NotificationController extends Controller {

    public $message;

    /**
     * Search tasks that are less then two weeks to complete and send notifications to users
     */
    public function actionMessage() {
        $tasks = Tasks::find()->where("TO_DAYS(deadline) - TO_DAYS(CURDATE()) < 14");
        $i = 1;
        $count = 0;
        foreach ($tasks->each() as $task) {
            $count++;
        }
        Console::startProgress(1, $count);
        foreach ($tasks->each() as $task) {
            Console::updateProgress($i++, $count);
            if ($task->user_assigned) {
                $this->notification($task);
            }
        }
        Console::endProgress();
    }

    public function notification($task) {
        Yii::$app->mailer->compose()
                ->setTo(Users::findOne($task->user_assigned)->email)
                ->setFrom('console@notificati.on')
                ->setSubject('Deadline is near!')
                ->setTextBody($task->title . ': Выполнить до ' . $task->deadline)
                ->send();
        return true;
    }

}
