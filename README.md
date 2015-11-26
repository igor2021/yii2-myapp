Задача
===============================

1. Нужно создать модуль для добавления товаров из админки
2. При создании (добавлении товара) должна быть возможность выбрать категорию и свойства.
3. Вывод для **frontend** должен осуществляется при помощи виджета **ViewGrid**.

# Результат

[Перейти на страницу](/product/products)  

# Порядок выполнения

## 1. Начало. Установка и подготовка приложения

Создадим приложение:

```
$ composer create-project --prefer-dist yiisoft/yii2-app-advanced myapp
$ cd ./myapp
$ ./init
```

Создадим базу


```
CREATE DATABASE `myapp` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
```

Доступ к базе. Изменим конфигурацию приложения в файле `/myapp/common/config/main-local.php`:

```
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=<myapp>',
            'username' => 'root',
            'password' => '<password>',
            'charset' => 'utf8',
        ],
        ...
    ],
];
```





Выполним первую миграцию

```
$ ./yii migrate
```

Читаемые ссылки в адресе URL. Изменим конфигурацию приложения в файле `/myapp/common/config/main.php`:


```
return [
    ...
    'components' => [
        ...
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
];
```

## 2. Подготовка таблиц

Создадим миграцию "таблица продукт : категория"


```
$ ./yii migrate/create init_product_category
```

Создадим миграцию "таблица продукт : обложка"

```
$ ./yii migrate/create init_product_cover
```

Создадим миграцию "таблица продукт : бумага"

```
$ ./yii migrate/create init_product_paper
```

Создадим миграцию "таблица продукт : язык"

```
$ ./yii migrate/create init_product_language
```

Создадим миграцию "таблица продукт"

```
$ ./yii migrate/create init_product
```

Создадим таблицы связей-свойств продукта "обложка", "бумага", "язык"

```
$ ./yii migrate/create init_product_has_cover
$ ./yii migrate/create init_product_has_paper
$ ./yii migrate/create init_product_has_language
```

После внесения изменений в созданные файлы выполним:

```
$ ./yii migrate
```


## 4. Модуль

Создадим модуль используя иструмент **Gii** (/gii/module) с параметрами:

* Module Class : frontend\modules\product\Module
* Module ID :  product

Затем в файл конфигурации `/myapp/frontend/config/main-local.php` добавляем:

```

<?php
    ...
    'modules' => [
        'product' => [
            'class' => 'frontend\modules\product\Module',
        ],
    ],
    ...


```


## 5. Модели

Создадим модели (ActiveRecord) используя иструмент **Gii** (/gii/model)

Создадим класс **ProductCategoryRecord** по следующим параметрам:

* Table Name : product_category
* Model Class : ProductCategoryRecord
* Namespace : frontend\modules\product\models

Создадим класс **ProductCoverRecord** по следующим параметрам:

* Table Name : product_cover
* Model Class : ProductCoverRecord
* Namespace : frontend\modules\product\models

Создадим класс **ProductPaperRecord** по следующим параметрам:

* Table Name : product_paper
* Model Class : ProductPaperRecord
* Namespace : frontend\modules\product\models

Создадим класс **ProductLanguageRecord** по следующим параметрам:

* Table Name : product_language
* Model Class : ProductLanguageRecord
* Namespace : frontend\modules\product\models

Создадим класс **ProductRecord** по следующим параметрам:

* Table Name : product
* Model Class : ProductRecord
* Namespace : frontend\modules\product\models

Далее создадим модели для таблиц связей-свойств c таблицей `product`.

Создадим класс **ProductHasCoverRecord** по следующим параметрам:

* Table Name : product_has_cover
* Model Class : ProductHasCoverRecord
* Namespace : frontend\modules\product\models

Создадим класс **ProductHasPaperRecord** по следующим параметрам:

* Table Name : product_has_paper
* Model Class : ProductHasPaperRecord
* Namespace : frontend\modules\product\models

Создадим класс **ProductHasLanguageRecord** по следующим параметрам:

* Table Name : product_has_language
* Model Class : ProductHasLanguageRecord
* Namespace : frontend\modules\product\models



## 6. Контроллеры

Создадим котроллер и прдеставление с раелизацией `CRUD` (Create-Read-Update-Delete) используя иструмент **Gii** (/gii/crud)

Создадим класс **CategoriesController** по следующим параметрам:

* Model Class : frontend\modules\product\models\ProductCategoryRecord
* Search Model Class : frontend\modules\product\models\ProductCategoryRecordSearch
* Controller Class : frontend\modules\product\controllers\CategoriesController
* View Path : @frontend/modules/product/views/categories

Создадим класс **CoversController** по следующим параметрам:

* Model Class : frontend\modules\product\models\ProductCoverRecord
* Search Model Class : frontend\modules\product\models\ProductCoverRecordSearch
* Controller Class : frontend\modules\product\controllers\CoversController
* View Path : @frontend/modules/product/views/covers

Создадим класс **PapersController** по следующим параметрам:

* Model Class : frontend\modules\product\models\ProductPaperRecord
* Search Model Class : frontend\modules\product\models\ProductPaperRecordSearch
* Controller Class : frontend\modules\product\controllers\PapersController
* View Path : @frontend/modules/product/views/papers

Создадим класс **LanguagesController** по следующим параметрам:

* Model Class : frontend\modules\product\models\ProductLanguageRecord
* Search Model Class : frontend\modules\product\models\ProductLanguageRecordSearch
* Controller Class : frontend\modules\product\controllers\LanguagesController
* View Path : @frontend/modules/product/views/languages

Создадим класс **ProductsController** по следующим параметрам:

* Model Class : frontend\modules\product\models\ProductRecord
* Search Model Class : frontend\modules\product\models\ProductRecordSearch
* Controller Class : frontend\modules\product\controllers\ProductsController
* View Path : @frontend/modules/product/views/products


## 7. Код. Создание/Обновление записи. Модель поиска

T.к. еще не знаком с реализацией I18N в Yii2, текст в коде будет писаться, там где это нужно, русскими буквами.

В файле `frontend/modules/product/models/ProductRecord.php` сделаем изменения и добавим методы:


```
   ...
   
    /** 
     * Params for id
     * @var cover_id 
     * @var parer_id
     * @var language_id
     * For use in, for example, ActiveForm->field()
     */
    public $cover_id;
    public $paper_id;
    public $language_id;

    ...

    /**
     * @return array(items, options) name-value/key-value pairs.
     * For ActiveField->dropDownList()
     */
    public function dropDownListCategories()
    {
        $records = ProductCategoryRecord::find()->all();
        $items = ArrayHelper::map($records,'id','name');
        $options = [
            'prompt' => 'Виберите категорию...'
        ];
        
        return ['items' => $items, 'options' => $options];
    }
    
    /**
     * @return array(items, options) name-value/key-value pairs.
     * For ActiveField->dropDownList()
     */
    public function dropDownListCovers()
    {
        $records = ProductCoverRecord::find()->all();
        $items = ArrayHelper::map($records,'id','name');
        $options = [
            'prompt' => 'Виберите обложку...'
        ];
    
        return ['items' => $items, 'options' => $options];
    }
```

Этот метод будет вызыватся в представлении `frontend/modules/product/views/products` при создании записи. Изменим файл `frontend/modules/product/views/products/_form.php`:


```
...
use frontend\modules\product\models\ProductRecord;
...

    <?php $form = ActiveForm::begin(); ?>

    <?php 
        $params = ProductRecord::dropDownListCategories();
        echo $form->field($model, 'category_id')->dropDownList($params['items'], $params['options']);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php 
        $params = ProductRecord::dropDownListCovers();
        echo $form->field($model, 'cover_id')->dropDownList($params['items'], $params['options']);

        $params = ProductRecord::dropDownListPapers();
        echo $form->field($model, 'paper_id')->dropDownList($params['items'], $params['options']);

        $params = ProductRecord::dropDownListLanguages();
        echo $form->field($model, 'language_id')->dropDownList($params['items'], $params['options']);
    ?>
   
...
```

Сделаем следующие изменения в файле котроллера `frontend/modules/product/controllers/ProductsController.php` для метода/действия `actionCreate`:


```
    /**
     * Creates a new ProductRecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductRecord();
                
        if ($model->load(Yii::$app->request->post()) ) {
            $transaction = Yii::$app->db->beginTransaction();
            
            try {
                // ProductRecord
                $model->save();
                
                // ProductHasCoverRecord
                do {
                    $post = Yii::$app->request->post();
                    $prop_model = new ProductHasCoverRecord();
                    $prop_model->product_id = $model->id;
                    $prop_model->cover_id = $post['ProductRecord']['cover_id'];
                    $prop_model->save();
                } while(0);
                // ProductHasPaperRecord
                do {
                    $post = Yii::$app->request->post();
                    $prop_model = new ProductHasPaperRecord();
                    $prop_model->product_id = $model->id;
                    $prop_model->paper_id = $post['ProductRecord']['paper_id'];
                    $prop_model->save();
                } while(0);
                // ProductHasLanguageRecord
                do {
                    $post = Yii::$app->request->post();
                    $prop_model = new ProductHasLanguageRecord();
                    $prop_model->product_id = $model->id;
                    $prop_model->language_id = $post['ProductRecord']['language_id'];
                    $prop_model->save();
                } while(0);
                
                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
            }
                        
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model, 
            ]);
        }
    }
```

Чтобы наши данные показывались корректно (имя категории, и читаемые даты) после создания "продукта", сделаем изменения в файле `frontend/modules/product/views/products/view.php`:


```
    ...
    
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

    ...
```

Теперь сделаем следующие изменения в файле котроллера `frontend/modules/product/controllers/ProductsController.php` для действия `actionUpdate`:


```
    ...
    
    /**
     * Updates an existing ProductRecord model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $transaction = Yii::$app->db->beginTransaction();
        
            try {
                // ProductRecord
                $model->save();
        
                // ProductHasCoverRecord
                do {
                    $post = Yii::$app->request->post();
                    $prop_model = new ProductHasCoverRecord();
                    $prop_model->product_id = $model->id;
                    $prop_model->cover_id = $post['ProductRecord']['cover_id'];
                    $prop_model->save();
                } while(0);
                // ProductHasPaperRecord
                do {
                    $post = Yii::$app->request->post();
                    $prop_model = new ProductHasPaperRecord();
                    $prop_model->product_id = $model->id;
                    $prop_model->paper_id = $post['ProductRecord']['paper_id'];
                    $prop_model->save();
                } while(0);
                // ProductHasLanguageRecord
                do {
                    $post = Yii::$app->request->post();
                    $prop_model = new ProductHasLanguageRecord();
                    $prop_model->product_id = $model->id;
                    $prop_model->language_id = $post['ProductRecord']['language_id'];
                    $prop_model->save();
                } while(0);
        
                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            /* Get vars for relation & Set them in current model */ 
            $model->cover_id = $model->productHasCover->id;
            $model->paper_id = $model->productHasPaper->id;
            $model->language_id = $model->productHasLanguage->id;
            
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    ...
```

Настройм метод поиска `search()` в файле/классе `frontend/modules/product/models/ProductRecordSearch.php`:


```
    ...
    
    /** 
     * @var string query. For use for search query.
     * @var string category
     * @var string cover
     * @var string paper
     * @var string language
     */
    public $search;
    public $category;
    public $cover;
    public $paper;
    public $language;
    
    ...
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ProductRecord::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('category');
        $dataProvider->sort->attributes['category'] = [
            'asc' => ['product_category.name' => SORT_ASC],
            'desc' => ['product_category.name' => SORT_DESC]
        ];
        
        $query->joinWith('cover');
        $dataProvider->sort->attributes['cover'] = [
            'asc' => ['product_cover.name' => SORT_ASC],
            'desc' => ['product_cover.name' => SORT_DESC]
        ];
        
        $query->joinWith('paper');
        $dataProvider->sort->attributes['cover'] = [
            'asc' => ['product_paper.name' => SORT_ASC],
            'desc' => ['product_paper.name' => SORT_DESC]
        ];

        $query->joinWith('language');
        $dataProvider->sort->attributes['cover'] = [
            'asc' => ['product_language.name' => SORT_ASC],
            'desc' => ['product_language.name' => SORT_DESC]
        ];
        
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'product.name', $this->name])
            ->andFilterWhere(['like', 'product.description', $this->description]);
        
        /* Addition conditions/filters */
        do {
            if ( $this->category ) {
                $query->andWhere(['like', 'product_category.name', [$this->category]]);
            }
            if ( $this->cover ) {
                $query->andWhere(['like', 'product_cover.name', [$this->cover]]);
            }
            if ( $this->paper ) {
                $query->andWhere(['like', 'product_paper.name', [$this->paper]]);
            }
            if ( $this->language ) {
                $query->andWhere(['like', 'product_language.name', [$this->language]]);
            }
        } while(0);
            
        return $dataProvider;
    }
    
    ...
```

# 8. Код. Варианты вывода файла "index.php" шаблона "views/products" 

Для данного модуля (под названием `product`) сделаем два варианта отображения страницы `/product/products/index`.

## Вариант 1

Изменим файл `frontend/modules/product/models/ProductRecordSearch.php`:


```
    ...
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description', 'category', 'cover', 'paper', 'language'], 'safe'],
        ];
    }
    
    ...
```



Изменим файл `frontend/modules/product/views/products/index.php`:


```
   
    ...
    
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
    
    ...
```

## Вариант 2

Изменим файл `frontend/modules/product/models/ProductRecordSearch.php`:


```
    ...
    
    /** 
     * @var string query
     * For use for search query
     */
    public $search;
    
    ...
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'search' => 'Поиск',
        ];
    }
    
    ...
    
```



Изменим файл `frontend/modules/product/views/products/_search.php`:


```
...

<div class="product-record-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'fieldConfig' => [
            'template' => '
                <div class="row form-horizontal"> 
                    <div class="col-sm-2 col-md-1 col-lg-1 form-control-static text-right">{label}</div>
                    <div class="col-sm-5 col-md-5 col-lg-5 form-control-static">{input}</div> 
                    <div class="col-sm-5 col-md-6 col-lg-6 form-control-static">
                      <button class="btn btn-primary" type="submit">Search</button>
                      <button class="btn btn-default" type="reset">Reset</button>
                    </div>
                </div>
                <div class="col-sm-12">{error}</div>',
        ],        
    ]); ?>
    
    <?= $form->field($model, 'search') ?>
    
    <?php ActiveForm::end(); ?>
    
</div>

...
```

Изменим файл `frontend/modules/product/views/products/index.php`:


```
...
    
use yii\widgets\DetailView;
    
    ...
    
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
    
    ...
```

# 9. Ограничение записи

Теперь сделаем так, чтобы только пользователь с именем "admin" мог создавать, редактировать, удалять записи.
Для этого сделаем ограничение в следующих файлах:

* frontend/modules/product/models/ProductCategoryRecord.php
* frontend/modules/product/models/ProductCoverRecord.php
* frontend/modules/product/models/ProductHasCoverRecord.php
* frontend/modules/product/models/ProductHasLanguageRecord.php
* frontend/modules/product/models/ProductHasPaperRecord.php
* frontend/modules/product/models/ProductPaperRecord.php
* frontend/modules/product/models/ProductRecord.php


```
...

use yii\web\MethodNotAllowedHttpException;

......

    /**
     * Saves the current record.
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        if ( Yii::$app->user->identity->username != 'admin' ) {
            throw new MethodNotAllowedHttpException;
        } else {
            parent::save();
            return true;
        }
    }
    
    ...
```

  

