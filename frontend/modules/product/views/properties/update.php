<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\product\models\PropertyRecord */

$this->title = 'Update Property Record: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Property Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="property-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
