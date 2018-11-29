<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TasksFilter */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('layoutHeaders', 'tasks');
$this->params['breadcrumbs'][] = $this->title;
?>
<? if(Yii::$app->user->isGuest): ?>
<p class="lead">Пожалуйста, войдите или зарегистрируйтесь.</p>
<? else: ?>
<p class="lead"><?= Yii::t('layoutHeaders', 'welcome{user}', ['user' => Yii::$app->user->identity->username]); ?></p>
<? endif; ?>

<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <? if(Yii::$app->user->can('createTask')): ?>
    <p>
        <?= Html::a(Yii::t('taskBtn', 'add'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <? endif; ?>
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
    ]);
    ?>
</div>
