<?php

namespace app\controllers;

use app\models\search\CommentsFilter;
use app\models\search\TasksFilter;
use app\models\tables\Tasks;
use app\models\tables\Users;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * TasksController implements the CRUD actions for Tasks model.
 */
class TasksController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access_update' => [
                'class' => AccessControl::className(),
                'only' => ['update'],
                'rules' => [
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['updateTask'],
                    ],
                ],
            ],
            'access_create' => [
                'class' => AccessControl::className(),
                'only' => ['create'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['createTask'],
                    ],
                ],
            ],
            'access_delete' => [
                'class' => AccessControl::className(),
                'only' => ['delete'],
                'rules' => [
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['deleteTask'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TasksFilter();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tasks model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $cache = Yii::$app->cache;
        $key = 'tasks_' . $id;

        if (!$model = $cache->get($key)) {
            $model = $this->findModel($id);
            $cache->set($key, $model, 3600);
        }

        $searchModel = new CommentsFilter();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);

        return $this->render('detail-view', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Tasks();
        $users = ArrayHelper::map(Users::find()->all(), 'id', 'username');
        $model->user_created = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->user_assigned == '') {
                $model->user_assigned = $model->user_created;
                $model->save();
            }
            $model->on(Tasks::EVENT_AFTER_INSERT, $model->notification());
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
                    'users' => $users,
        ]);
    }

    /**
     * Updates an existing Tasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $users = ArrayHelper::map(Users::find()->all(), 'id', 'username');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // При обновлении данных обновим кэш
            $cache = Yii::$app->cache;
            $key = 'tasks_' . $id;

            if (!$model = $cache->get($key)) {
                $model = $this->findModel($id);
                $cache->set($key, $model, 3600);
            }

            $model->on(Tasks::EVENT_AFTER_INSERT, $model->notification());
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
                    'users' => $users,
        ]);
    }

    /**
     * Deletes an existing Tasks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
