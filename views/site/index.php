<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Задачи на текущий месяц</h1>
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

    <p><a class="btn btn-lg btn-success" href="?r=tasks">Все задачи</a></p>
    <p>
        <?= Html::a('Поставить задачу', ['tasks/create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <div class="body-content">

        <div class="row">
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
