<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\product\models\ProductRecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Records';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-record-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product Record', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [   
                'label' => 'Описание',
                'format' => 'html',
                'value' => function ($model) {
                    $result = DetailView::widget([
                        'model' => $model,
                        'attributes' => [
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
                        ],
                    ]);
                    
                    return $result;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
