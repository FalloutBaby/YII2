<?php

use yii\helpers\Url;

/** @var $model \app\models\tables\Tasks */
?>

<div class="task-container">
    <div class="task-preview-content"><?= $model->description ?></div>
        <div>Выполняет <span class="task-preview task-preview-user"><?= $model->userAssigned0->username ?></span></div>
        <div class="task-preview-created">Создана <?= $model->created_at ?> by <?= $model->userCreated0->username ?></div>
        <? if($model->updated_at): ?><div class="task-preview-updated">Изменена <?= $model->updated_at ?></div><? endif; ?>
        <div>Выполнить до <span class="task-preview task-preview-deadline"><?= $model->deadline ?></span></div>
</div>

