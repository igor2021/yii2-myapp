Задача
===============================

1. Нужно создать модуль для добавления товаров из админки
2. При создании (добавлении товара) должна быть возможность выбрать категорию и свойства.
3. Вывод для **frontend** должен осуществляется при помощи виджета **ViewGrid**.

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
$ ./yii migrate/create init_product_prop_cover
$ ./yii migrate/create init_product_prop_paper
$ ./yii migrate/create init_product_prop_language
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


## 7. Код

T.к. еще не знаком с реализацией I18N в Yii2, текст будет писаться, там где это нужно, русскими буквами.

В файле `frontend/modules/product/models/ProductRecord.php` добавим метод:


```
    /**
     * @param items
     * @param options
     * @return array name-value pairs.
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
```

Этот метод будет вфзыватся в представлении `frontend/modules/product/views/products/_form.php` при создании записи:


```
...
use frontend\modules\product\models\ProductRecord;
...
    <?php 
        $params = ProductRecord::dropDownListCategories();
        echo $form->field($model, 'category_id')->dropDownList($params['items'], $params['options']);
    ?>
...
```



