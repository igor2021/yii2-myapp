<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use modules\prod\models\Product;

/* @var $this yii\web\View */
/* @var $model modules\prod\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-record-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
        $params = Product::dropDownListCategories();
        echo $form->field($model, 'category_id')->dropDownList($params['items'], $params['options']);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php 
        $params = Product::dropDownListCovers();
        echo $form->field($model, 'cover')->dropDownList($params['items'], $params['options']);

        $params = Product::dropDownListPapers();
        echo $form->field($model, 'paper')->dropDownList($params['items'], $params['options']);

        $params = Product::dropDownListLanguages();
        echo $form->field($model, 'language')->dropDownList($params['items'], $params['options']);
    ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
