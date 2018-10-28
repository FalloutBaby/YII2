<?php

namespace app\models;

use Yii;
use yii\validators\Validator;

/**
 * MyValidator проверяет, что дата вида YYYY-mm-dd равна или позднее сегодняшнего числа.
 *
 */

class MyValidator extends Validator
{
	
    public $message;
	
	public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = Yii::t('yii', '{attribute} раньше сегодняшнего числа. Просрочено!');
		}
	}
	
	public function validateAttribute($model, $attribute)
	{
		$value = $model->$attribute;
		$today = date('Y-m-d'); 
		
		if ($today > $value) {
			$this->addError($model, $attribute, $this->message);
			
			return;
		}
		
        return null;
	}
}
	
	