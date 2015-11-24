<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\product\models\ProductLanguageRecord */

$this->title = 'Update Product Language Record: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Language Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-language-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
