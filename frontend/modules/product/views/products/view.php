<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\product\models\ProductRecord */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-record-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category',
                'label' => 'Категория',
                'value' => $model->category->name,
            ],
            'name',
            'description:ntext',
            [
                'attribute' => 'cover',
                'label' => 'Обложка',
                'value' => $model->cover->name,
            ],
            [
                'attribute' => 'paper',
                'label' => 'Бумага',
                'value' => $model->paper->name,
            ],
            [
                'attribute' => 'language',
                'label' => 'Язык',
                'value' => $model->language->name,
            ],
            [
                'attribute' => 'created_at',
                'format' => ['datetime', 'Y-M-d H:m:s'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['datetime', 'Y-M-d H:m:s'],
            ],
        ],
    ]) ?>

</div>
