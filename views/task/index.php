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
					<?php $form = ActiveForm::begin(['id' => 'task-form' . $task['id'], 'action' => $task->addUserId($task['id'])]); ?>
	 					<? if($user['username'] == $task['userId'] && $task['userId'] != ''): ?>
							<p>Вы выполняете эту задачу</p>
						<? elseif($task['userId']): ?>
							<div class="form-group">
							<p>Выполняет <?= $task['userId']; ?></p>
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
