<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Tasks */

$this->title = $model->title;
if(!$hideBreadcrumbs){
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
}
\yii\web\YiiAsset::register($this);
?>
<div class="tasks-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= Html::beginTag('a', ['href' => '?r=tasks/view&id='.$model->id, 'class' => 'btn-default btn-block task-list-link']); ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Создано пользователем',
                'attribute' => 'userCreated0.username'
            ],
            [
                'label' => 'Выполняет',
                'attribute' => 'userAssigned0.username'
            ],
            'created_at',
            'deadline',
        ],
        'options' => ['class' => 'task-list-container'],
    ]) ?>
    <?= Html::endTag('a'); ?>
</div>
