<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\product\models\ProductRecord */

$this->title = 'Update Product Record: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
