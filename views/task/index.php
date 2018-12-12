<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Задачи';
?>
<div class="jumbotron">
    <h1>Задачи</h1>
    <? if(!$user['username']): ?>
    <p class="lead">Пожалуйста, войдите или зарегистрируйтесь.</p>
    <? else: ?>
    <p class="lead">Добро пожаловать, <?= $user['username']; ?>!</p>

    <a class="btn btn-lg btn-success" href="?r=task/create">Поставить задачу</a>
    <? endif; ?>
    <? if($tasks): ?>
    <? foreach ($tasks as $task): ?>
    <div class="col-lg-4">
        <h2><?= $task['title']; ?></h2>
        <p><?= $task['description']; ?></p>
        <p>Создана <?= $task['dateOfCreation']; ?></p>
        <p>Выполнить до <?= $task['deadline']; ?></p>
        <?php $form = ActiveForm::begin(['id' => 'task-form' . $task['id']]); ?>
        <? if($user['id'] == $task['userIdCreated'] && $task['userIdCreated'] != ''): ?>
        <p>Вы поставили эту задачу</p><?=Html::a('Удалить', ['task/delete', 'id' => $task['id']], ['data-method' => 'POST', 'class' => 'btn btn-lg btn-danger'])
        ?>​
        <? elseif($user['id'] == $task['userIdAssigned'] && $task['userIdAssigned'] != ''): ?>
        <p>Вы выполняете эту задачу</p>
        <? elseif($task['userIdAssigned']): ?>
        <div class="form-group">
            <p>Выполняет <?= $task['userIdAssigned']; ?></p>
<?= Html::submitButton('Взять задачу', ['class' => 'btn btn-primary', 'name' => 'assign-button']) ?>
        </div>
        <? else: ?>
        <div class="form-group">
<?= Html::submitButton('Взять задачу', ['class' => 'btn btn-primary', 'name' => 'assign-button', 'value' => 'assign']) ?>
        </div>
        <? endif; ?>
<?php ActiveForm::end(); ?>
    </div>
    <? endforeach; ?>
    <? endif; ?>
</div>
