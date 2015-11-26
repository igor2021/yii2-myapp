<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\product\models\ProductRecord;

/* @var $this yii\web\View */
/* @var $model frontend\modules\product\models\ProductRecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-record-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
        $params = ProductRecord::dropDownListCategories();
        echo $form->field($model, 'category_id')->dropDownList($params['items'], $params['options']);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php 
        $params = ProductRecord::dropDownListCovers();
        echo $form->field($model, 'cover_id')->dropDownList($params['items'], $params['options']);

        $params = ProductRecord::dropDownListPapers();
        echo $form->field($model, 'paper_id')->dropDownList($params['items'], $params['options']);

        $params = ProductRecord::dropDownListLanguages();
        echo $form->field($model, 'language_id')->dropDownList($params['items'], $params['options']);
    ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
