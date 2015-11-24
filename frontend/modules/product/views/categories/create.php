<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\product\models\ProductCategoryRecord */

$this->title = 'Create Product Category Record';
$this->params['breadcrumbs'][] = ['label' => 'Product Category Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
