<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Tasks */

$this->title = $model->title;
if (!$hideBreadcrumbs) {
    $this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
}
\yii\web\YiiAsset::register($this);
?>
<div class="tasks-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    \app\widgets\TaskPreview::widget([
        'model' => $model,
    ])
    ?>

    <p class="buttons">
        <? if(Yii::$app->user->can('updateTask')): ?>
        <?= Html::a(Yii::t('taskBtn', 'edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <? endif; ?>
        <? if(Yii::$app->user->can('deleteTask')): ?>
        <?=
        Html::a('x', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
        <? endif; ?>
    </p>
    <?=
    ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '../comments/view',
        'itemOptions' => [
            'tag' => 'div',
            'class' => 'col-lg-4 col-md-6',
        ],
        'summary' => false,
        'viewParams' => [
            'hideBreadcrumbs' => true
        ]
    ]);
    ?>

    <? if(!Yii::$app->user->isGuest): ?>
    <p>
        <?= Html::a(Yii::t('taskBtn', 'addComm'), ['comments/create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>
    <? endif; ?>
</div>
