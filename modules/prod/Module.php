<?php

namespace modules\prod;

use yii\web\UrlManager;
use yii\helpers\VarDumper;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'modules\prod\controllers';
    
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        \Yii::configure($this, require(__DIR__ . '/config/main.php'));
        
        
        
//         VarDumper::dump($this,10,1);
//         die();
    }
}
