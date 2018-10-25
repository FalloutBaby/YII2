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
	
	public function __construct() {
    	self::$count++;
		$this->id = self::$count;
	}
	
	public function rules()
    {
        return [
          [['title', 'dateOfCreation', 'deadline'], 'required'],
		  [['id', 'description', 'userId'], 'safe'],
        ];
    }
	
	public function addUserId($id)
    {
        if (Yii::$app->request->post('apply-button')) {
            $this->userId = Yii::$app->user->identity->username;
        }
    }
}
