<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\tables\Tasks;

class Task extends Model {

    public $id;
    public $title;
    public $description;
    public $userIdAssigned;
    public $userIdCreated;
    public $dateOfCreation;
    public $deadline;

    const SCENARIO_CREATE = 'create';
    const SCENARIO_ASSIGN = 'assign';

    public function rules() {
        return [
            [['title', 'dateOfCreation', 'deadline', 'userIdAssigned'], 'required'],
            [['id', 'description', 'userIdCreated'], 'safe'],
            [['dateOfCreation', 'deadline'], 'date', 'format' => 'php:Y-m-d'],
            [['deadline'], MyValidator::class],
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['title', 'dateOfCreation', 'deadline'];
        $scenarios[self::SCENARIO_ASSIGN] = ['id', 'userId'];
        return $scenarios;
    }

    public function addUserId($id) {
        if (Yii::$app->request->post('assign')) {
            $this->userIdAssigned = Yii::$app->user->identity->id;
        }
    }
//
//    public function create() {
//        $this->userIdCreated = Yii::$app->user->identity->id;
//        $this->dateOfCreation = date("Y-m-d");
//        $task = new Tasks($this);
//        $task->save();
//        return ($this);
//    }

    public function getAll() {
        return (Tasks::find()->all());
    }

    public function getOne($value, $attribute = 'id') {
        return (Tasks::findOne($attribute, $value));
    }
}
