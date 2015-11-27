<?php

namespace modules\prod\controllers;

use yii\web\Controller;
use yii\helpers\Markdown;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $file = __DIR__ . '/../README.md';
        $content = Markdown::process(file_get_contents($file), 'extra');
        
        return $this->renderContent($content);
    }
}
