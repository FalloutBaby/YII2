<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */

$this->title = Yii::t('layoutHeaders', 'yours');
$this->params['breadcrumbs'][] = $this->title;
?>

<p class="lead"><?= Yii::t('layoutHeaders', 'welcome{user}', ['user' => Yii::$app->user->identity->username]); ?></p>

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