<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\product\models\PropertyRecord */

$this->title = 'Create Property Record';
$this->params['breadcrumbs'][] = ['label' => 'Property Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
