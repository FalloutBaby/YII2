<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */

$this->title = 'Ваши задачи';
$this->params['breadcrumbs'][] = $this->title;
?>

<? if(!Yii::$app->user->identity->username): ?>
<p class="lead">Пожалуйста, войдите или зарегистрируйтесь.</p>
<? else: ?>
<p class="lead">Добро пожаловать, <?= Yii::$app->user->identity->username; ?>!</p>
<div class="tasks-index">
    <h1><?= $this->title ?></h1>

    <?=
    ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '../tasks/view',
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
</div>
<? endif; ?>