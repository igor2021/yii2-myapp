
## 1. Страницы

* Страница "Продукты": [Перейти на страницу](/prod/products)
* Страница "Категории": [Перейти на страницу](/prod/categories)
* Страница "Обложка": [Перейти на страницу](/prod/covers)
* Страница "Бумага": [Перейти на страницу](/prod/papers)
* Страница "Язык": [Перейти на страницу](/prod/languages)


## 2. Подготовка таблиц


```
./yii migrate/create init_prod_category
./yii migrate/create init_prod_cover
./yii migrate/create init_prod_paper
./yii migrate/create init_prod_language
./yii migrate/create init_prod_product
./yii migrate/create init_prod_product_has_cover
./yii migrate/create init_prod_product_has_paper
./yii migrate/create init_prod_product_has_language
./yii migrate
```

## 3. Псевдонимы

`/common/config/bootstrap.php`:

```
<?php
...
Yii::setAlias('modules', dirname(dirname(__DIR__)) . '/modules');
```

## 4. Модуль

`http://localhost/gii/module`

  * Module Class : modules\prod\Module
  * Module ID :  prod


`/common/config/main-local.php`

```
<?php
    ...
    'modules' => [
        'prod' => [
            'class' => 'modules\prod\Module',
        ],
    ],
    ...
```

## 5. Модели

`http://localhost/gii/model`

```
* Table Name : prod_category
* Model Class : Category
* Namespace : modules\prod\models
```

```
* Table Name : prod_cover
* Model Class : Cover
* Namespace : modules\prod\models
```

```
* Table Name : prod_paper
* Model Class : Paper
* Namespace : modules\prod\models
```

```
* Table Name : prod_language
* Model Class : Language
* Namespace : modules\prod\models
```

```
* Table Name : prod_product
* Model Class : Product
* Namespace : modules\prod\models
```

```
* Table Name : prod_product_has_cover
* Model Class : ProductHasCover
* Namespace : modules\prod\models
```

```
* Table Name : prod_product_has_paper
* Model Class : ProductHasPaper
* Namespace : modules\product\models
```

```
* Table Name : prod_product_has_language
* Model Class : ProductHasLanguage
* Namespace : modules\product\models
```

## 6. Контроллеры

`http://localhost/gii/crud`

```
* Model Class : modules\prod\models\Category
* Search Model Class : modules\prod\models\CategorySearch
* Controller Class : modules\prod\controllers\CategoriesController
* View Path : @modules/prod/views/categories
```

```
* Model Class : modules\prod\models\Cover
* Search Model Class : modules\prod\models\CoverSearch
* Controller Class : modules\prod\controllers\CoversController
* View Path : @modules/prod/views/covers
```


```
* Model Class : modules\prod\models\Paper
* Search Model Class : modules\prod\models\PaperSearch
* Controller Class : modules\prod\controllers\PapersController
* View Path : @modules/prod/views/papers
```

```
* Model Class : modules\prod\models\Language
* Search Model Class : modules\prod\models\LanguageSearch
* Controller Class : modules\prod\controllers\LanguagesController
* View Path : @modules/prod/views/languages
```

```
* Model Class : modules\prod\models\Product
* Search Model Class : modules\prod\models\ProductSearch
* Controller Class : modules\prod\controllers\ProductsController
* View Path : @modules/prod/views/products
```






