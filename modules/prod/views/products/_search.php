<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\prod\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-record-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'fieldConfig' => [
            'template' => '
                <div class="row form-horizontal"> 
                    <div class="col-sm-2 col-md-1 col-lg-1 form-control-static text-right">{label}</div>
                    <div class="col-sm-5 col-md-5 col-lg-5 form-control-static">{input}</div> 
                    <div class="col-sm-5 col-md-6 col-lg-6 form-control-static">
	    	          <button class="btn btn-primary" type="submit">Search</button>
		              <button class="btn btn-default" type="reset">Reset</button>
                    </div>
                </div>
                <div class="col-sm-12">{error}</div>',
        ],        
    ]); ?>
	
	<?= $form->field($model, 'search') ?>
	
    <?php ActiveForm::end(); ?>
    
</div>
