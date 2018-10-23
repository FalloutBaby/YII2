<?php

namespace app\models;

use yii\base\Model;

class Task extends Model
{
	public $name;
	public $date;
	public $deadline;
	
	public function rules()
    {
        return [
          [['name', 'date', 'deadline'], 'required'],
          [['title'], 'myValidate'],
        ];
    }
}