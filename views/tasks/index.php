<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TasksFilter */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Задачи';
$this->params['breadcrumbs'][] = $this->title;
?>
 <? if(!Yii::$app->user->identity->username): ?>
    <p class="lead">Пожалуйста, войдите или зарегистрируйтесь.</p>
    <? else: ?>
    <p class="lead">Добро пожаловать, <?= Yii::$app->user->identity->username; ?>!</p>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Поставить задачу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= 
    ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => 'view',
        'itemOptions' => [
            'tag' => 'div',
            'class' => 'col-lg-4 col-md-6',
        ],    
        'summary' => false,
        'viewParams' => [
            'hideBreadcrumbs' => true
        ]
    ]); ?>
</div>

    <? endif; ?>
