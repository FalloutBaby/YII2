<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="jumbotron">
        <?= Html::tag('h1', Yii::t('layoutHeaders', 'current')); ?>
        <?=
        ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '../tasks/view',
            'options' => ['class' => 'col-lg-12 col-md-12 col-sm-12'],
            'itemOptions' => [
                'tag' => 'div',
                'class' => 'col-lg-3 col-md-4 col-sm-6',
            ],
            'summary' => false,
            'viewParams' => [
                'hideBreadcrumbs' => true
            ]
        ]);
        ?>
    </div>
    <p>
        <?= Html::a(Yii::t('taskBtn', 'add'), ['tasks/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <p><?= Html::a(Yii::t('taskBtn', 'all'), ['tasks'], ['class' => 'btn btn-success']) ?></p>
    
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <p><?= Html::a(Yii::t('taskBtn', 'my'), ['user-tasks'], ['class' => 'btn btn-default']) ?></p>
            </div>
            <div class="col-lg-4">
                <p><a class="btn btn-default" href="?r=admin-users">Пользователи &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
