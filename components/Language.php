<?php

namespace app\components;

use yii\base\BootstrapInterface;
use yii\base\Component;

class Language extends Component implements BootstrapInterface {

    public function bootstrap($app) {
        if ($app->session['lang']) {
            $app->language = $app->session['lang'];
        }
    }

}
