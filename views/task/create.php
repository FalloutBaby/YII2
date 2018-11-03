<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Поставить задачу';
?>
<div class="jumbotron">

    <?php $form = ActiveForm::begin(['id' => 'task',
        'layout' => 'horizontal', 'action' => '?r=task/create']);
    ?>

    <?= $form->field($task, 'title')->textInput(['autofocus' => true]) ?>
    <?= $form->field($task, 'description')->textarea(['rows' => 3]) ?>
    <?= $form->field($task, 'deadline') ?>

    <div class="form-group">
    <?= Html::submitButton('Поставить задачу', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>
</div>
