<?php

namespace modules\prod;

use Yii;
use yii\web\UrlManager;
use yii\web\Request;
use yii\helpers\VarDumper;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'modules\prod\controllers';

    
    
    public function init()
    {
        parent::init();
        
        // custom initialization code goes here
    }
}
