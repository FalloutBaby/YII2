<?php

/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Поставить задачу';
?>
	<div class="jumbotron">

		<!--
		<h2><?= $task['title'] . ' ' . $task['id']; ?></h2>
		<p><?= $task['description']; ?></p>
		<p>Создана <?= $task['dateOfCreation']; ?></p>
		<p>Выполнить до <?= $task['deadline']; ?></p>
		-->

		<?php $form = ActiveForm::begin(['id' => 'create-form',
        'layout' => 'horizontal', 'action' => $task->create()]); ?>
        
		<?= $form->field($task, 'title')->textInput(['autofocus' => true]) ?>
		<?= $form->field($task, 'description')->textarea(['rows' => 3]) ?>
		<?= $form->field($task, 'deadline') ?>
		
			<div class="form-group">
				<?= Html::submitButton('Поставить задачу', ['class' => 'btn btn-primary', 'name' => 'create-button', 'value' => 'create']) ?>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
