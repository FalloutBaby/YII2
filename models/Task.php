<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Task extends Model
{
	public $id;
	public $title;
	public $description;
	public $userId;
	public $dateOfCreation;
	public $deadline;
	private static $count = 0;
    const SCENARIO_CREATE = 'create';
    const SCENARIO_ASSIGN = 'assign';
	
	public function __construct() {
    	self::$count++;
		$this->id = self::$count;
	}
	
	public function rules()
    {
        return [
          [['title', 'dateOfCreation', 'deadline'], 'required'],
		  [['id', 'description', 'userId'], 'safe'],
		  [['dateOfCreation', 'deadline'], 'date', 'format' => 'php:Y-m-d'],
		  [['deadline'], MyValidator::class],
        ];
    }
	
	public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['title', 'dateOfCreation', 'deadline'];
        $scenarios[self::SCENARIO_ASSIGN] = ['id', 'userId'];
        return $scenarios;
    }

	public function addUserId($id)
    {
        if (Yii::$app->request->post('assign')) {
            $this->userId = Yii::$app->user->identity->username;
        }
    }
	
	public function create()
	{
		$this->dateOfCreation =  date("Y-m-d");
		if ($this->validate()) {
			return true;
		}
		return false;
	}
}
