<?php

namespace app\widgets;
use app\models\tables\Tasks;
use yii\base\Widget;

class TaskPreview extends Widget
{
    /** @var  Task */
    public $model;

    public function run()
    {
        if (is_a($this->model, Tasks::class)) {
            return $this->render('detailed_view', ['model' => $this->model]);
        }
        throw new \Exception("Невозможно отобразить модель!");
    }
}

