<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\product\models\CategoryRecord */

$this->title = 'Create Category Record';
$this->params['breadcrumbs'][] = ['label' => 'Category Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
