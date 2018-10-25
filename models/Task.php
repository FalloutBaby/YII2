<?php

namespace app\models;

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
}
