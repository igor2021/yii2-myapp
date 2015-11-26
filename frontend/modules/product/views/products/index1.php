<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\product\models\ProductRecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Records';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-record-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product Record', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'category',
                'label' => 'Категория',
                'format' => 'paragraphs',
                'value' => function ($model) {
                    $result = $model->category->name;
                    return $result;
                }
            ],
            'name',
            'description:ntext',
            [
                'attribute' => 'cover',
                'label' => 'Обложка',
                'format' => 'ntext',
                'value' => function ($model) {
                    $result = $model->cover->name;
                    return $result;
                }
            ],
            [
                'attribute' => 'paper',
                'label' => 'Бумага',
                'format' => 'ntext',
                'value' => function ($model) {
                    $result = $model->paper->name;
                    return $result;
                }
            ],
            [
                'attribute' => 'language',
                'label' => 'Язык',
                'format' => 'ntext',
                'value' => function ($model) {
                    $result = $model->language->name;
                    return $result;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
