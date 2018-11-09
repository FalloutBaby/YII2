<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UsersFilter */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?= 
    //GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
//            'username',
//            'password',
//            'roleId',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]);
//    
    ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => 'view',
        'viewParams' => [
            'hideBreadcrumbs' => true
        ]
    ]);
            
    ?>
</div>
