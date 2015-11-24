<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\product\models\ProductPaperRecord */

$this->title = 'Create Product Paper Record';
$this->params['breadcrumbs'][] = ['label' => 'Product Paper Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-paper-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
