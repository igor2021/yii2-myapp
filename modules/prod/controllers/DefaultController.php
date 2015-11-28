<?php

namespace modules\prod\controllers;

use yii\web\Controller;
use yii\helpers\Markdown;
use yii\helpers\VarDumper;

class DefaultController extends Controller
{
//    public function actions()    
//    {
//        
//        $this->runAction('prod/products/view', ['id' => '6']);
//         die;
//         return [
    
//             'error' => [
//                 'class' => 'yii\web\ErrorAction',
//             ],
//         ];
//    }
    
    public function actionIndex()
    {
        $file = __DIR__ . '/../README.md';
        $content = Markdown::process(file_get_contents($file), 'extra');
        
        return $this->renderContent($content);
    }
}
