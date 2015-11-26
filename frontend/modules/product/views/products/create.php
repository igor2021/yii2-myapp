<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\product\models\ProductRecord */

$this->title = 'Create Product Record';
$this->params['breadcrumbs'][] = ['label' => 'Product Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="product-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
