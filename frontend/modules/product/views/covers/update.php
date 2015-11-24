<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\product\models\ProductCoverRecord */

$this->title = 'Update Product Cover Record: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Cover Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-cover-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
