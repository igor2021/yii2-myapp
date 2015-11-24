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

Создадим миграцию "таблица свойств : категория"


```
$ ./yii migrate/create init_product_prop_category
```

Создадим миграцию "таблица свойств : обложка"

```
$ ./yii migrate/create init_product_prop_cover
```

Создадим миграцию "таблица свойств : бумага"

```
$ ./yii migrate/create init_product_prop_paper
```

Создадим миграцию "таблица свойств : язык"

```
$ ./yii migrate/create init_product_prop_language
```

Создадим миграцию "таблица товаров"

```
$ ./yii migrate/create init_product
```

Создадим таблицы связей "обложка", "бумага", "язык"

```
$ ./yii migrate/create init_product_cover
$ ./yii migrate/create init_product_paper
$ ./yii migrate/create init_product_language
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


## 5. Модель

Создадим модели (ActiveRecord) используя иструмент **Gii** (/gii/model)

Создадим класс **CategoryRecord** по следующим параметрам:

* Table Name : product_prop_category
* Model Class : ProductPropCategory
* Namespace : frontend\modules\product\models

Создадим класс **PropertyRecord** по следующим параметрам:

* Table Name : property
* Model Class : PropertyRecord
* Namespace : frontend\modules\product\models

Создадим класс **ProductRecord** по следующим параметрам:

* Table Name : product
* Model Class : ProductRecord
* Namespace : frontend\modules\product\models


## 6. Контроллер

Создадим котроллер и прдеставление с раелизацией `CRUD` (Create-Read-Update-Delete) используя иструмент **Gii** (/gii/crud)

Создадим класс **CategoriesController** по следующим параметрам:

* Model Class : frontend\modules\product\models\CategoryRecord
* Search Model Class : frontend\modules\product\models\CategoryRecordSearch
* Controller Class : frontend\modules\product\controllers\CategoriesController
* View Path : @frontend/modules/product/views/categories

Создадим класс **PropertiesController** по следующим параметрам:

* Model Class : frontend\modules\product\models\PropertyRecord
* Search Model Class : frontend\modules\product\models\PropertyRecordSearch
* Controller Class : frontend\modules\product\controllers\PropertiesController
* View Path : @frontend/modules/product/views/properties

Создадим класс **ProductsController** по следующим параметрам:

* Model Class : frontend\modules\product\models\ProductRecord
* Search Model Class : frontend\modules\product\models\ProductRecordSearch
* Controller Class : frontend\modules\product\controllers\ProductsController
* View Path : @frontend/modules/product/views/products



