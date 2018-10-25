<?php

/* @var $form yii\bootstrap\ActiveForm */

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
			
		<? endif; ?>
			<? foreach ($tasks as $task): ?>
				<div class="col-lg-4">
					<h2><?= $task['title'] . ' ' . $task['id']; ?></h2>
					<p><?= $task['description']; ?></p>
					<p>Создана <?= $task['dateOfCreation']; ?></p>
					<p>Выполнить до <?= $task['deadline']; ?></p>
					<?php $form = ActiveForm::begin(['id' => 'task-form' . $task['id'], 'action' => $task->addUserId($task['id'])]); ?>
	 					<? if($user['username'] == $task['userId'] && $task['userId'] != ''): ?>
							<p>Вы выполняете эту задачу</p>
						<? elseif($task['userId']): ?>
							<div class="form-group">
							<p>Выполняет <?= $task['userId']; ?></p>
							<?= Html::submitButton('Взять задачу', ['class' => 'btn btn-primary', 'name' => 'apply-button']) ?>
							</div>
						<? else: ?>
							<div class="form-group">
							<?= Html::submitButton('Взять задачу', ['class' => 'btn btn-primary', 'name' => 'apply-button', 'value' => 'apply-button']) ?>
							</div>
						<? endif; ?>
					<?php ActiveForm::end(); ?>
				</div>
			<? endforeach; ?>
	</div>
