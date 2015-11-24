<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\product\models\ProductLanguageRecord */

$this->title = 'Create Product Language Record';
$this->params['breadcrumbs'][] = ['label' => 'Product Language Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-language-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
