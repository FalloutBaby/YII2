<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Comments */

$this->title = $model->id;
if (!$hideBreadcrumbs) {
    $this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
}
\yii\web\YiiAsset::register($this);
?>
<div class="comments-view">

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Комментарий от',
                'attribute' => 'user.username'
            ],
            'text:ntext',
            [
                'format' => ['image', ['width' => '200', 'height' => '100']],
                'value' => Yii::getAlias('@uploads/preview/') . $model->file,
                'attribute' => 'file'
            ],
            'date_of_creation',
        ],
        'options' => ['class' => 'task-list-container'],
    ])
    ?>

    <p>
        <? if(Yii::$app->user->identity->username == $model->user->username): ?>
        <?= Html::a('Изменить', ['comments/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <? endif; ?>
        <? if(Yii::$app->user->identity->username == $model->user->username || Yii::$app->user->can('deleteComment')): ?>
        <?=
        Html::a('Удалить', ['comments/delete', 'id' => $model->id, 'taskId' => $model->task_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Удалить комментарий?',
                'method' => 'post',
            ],
        ])
        ?>
        <? endif; ?>
    </p>

</div>
