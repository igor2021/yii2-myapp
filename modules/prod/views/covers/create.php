<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\prod\models\Cover */

$this->title = 'Create Cover';
$this->params['breadcrumbs'][] = ['label' => 'Covers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cover-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
