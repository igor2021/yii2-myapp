
## 1. Страницы

* Страница "Продукты": [Перейти на страницу](/prod/products)
* Страница "Категории": [Перейти на страницу](/prod/categories)
* Страница "Обложка": [Перейти на страницу](/prod/covers)
* Страница "Бумага": [Перейти на страницу](/prod/papers)
* Страница "Язык": [Перейти на страницу](/prod/languages)


## 2. Basic Configuration

* `common/config/main.php`

```
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
```

* `common/config/main-local.php`

```  
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=myapp',
            'username' => 'myapp',
            'password' => '<password>',
            'charset' => 'utf8',
        ],
```

## 3. Псевдонимы

`/common/config/bootstrap.php`:

```
<?php
...
Yii::setAlias('modules', dirname(dirname(__DIR__)) . '/modules');
```

## 4. Role Based Access Control (RBAC) 

`common/config/main.php`:

```
	'authManager' => [
		'class' => 'yii\rbac\DbManager',
		'defaultRoles' => ['guest'],
	],	
```

```
./yii migrate --migrationPath='@yii/rbac/migrations'
```






## 5.1. Подготовка таблиц


```
./yii migrate/create --migrationPath=@modules/prod/migrations/auth create_auth_roles
./yii migrate --migrationPath=@modules/prod/migrations/auth
```

```
./yii migrate/create --migrationPath=@modules/prod/migrations init_prod_category
./yii migrate/create --migrationPath=@modules/prod/migrations init_prod_cover
./yii migrate/create --migrationPath=@modules/prod/migrations init_prod_paper
./yii migrate/create --migrationPath=@modules/prod/migrations init_prod_language
./yii migrate/create --migrationPath=@modules/prod/migrations init_prod_product
./yii migrate/create --migrationPath=@modules/prod/migrations init_prod_product_has_cover
./yii migrate/create --migrationPath=@modules/prod/migrations init_prod_product_has_paper
./yii migrate/create --migrationPath=@modules/prod/migrations init_prod_product_has_language
./yii migrate --migrationPath=@modules/prod/migrations
```

## 4.5. Прочие миграции


```
./yii migrate/create --migrationPath=@modules/prod/migrations extend_prod_product
./yii migrate --migrationPath=@modules/prod/migrations
```



## 6. Модуль

`http://localhost/gii/module`

  * Module Class : modules\prod\Module
  * Module ID :  prod


`/common/config/main-local.php`

```
<?php
    'modules' => [
        'prod' => [
            'class' => 'modules\prod\Module',
        ],
    ],
```

## 7. Модели

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

## 7. Контроллеры

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

## 8. AccessControl

* `modules/prod/controllers/CategoriesController.php`,
* `modules/prod/controllers/CoversController.php`,
* `modules/prod/controllers/LanguagesController.php`,
* `modules/prod/controllers/PapersController.php`,

```
use yii\filters\AccessControl;

......

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                    ],
                    [
                        'roles' => ['admin'],
                        'allow' => true,
                    ],
                ], 
            ],
```

`/modules/prod/controllers/ProductsController.php`,


```
use yii\filters\AccessControl;

......

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                    ],
                    [
                        'roles' => ['admin'],
                        'allow' => true,
                    ],
                ], 
            ],
```

## 9. UrlManager

`modules/prod/config/rules.php`:

```
<?php
return [
    'prod/<controller:(categories|covers|languages|papers|products)>' => 'prod/<controller>/index',
    
    'prod/product/<id:\d+>' => 'prod/products/view',
    'prod/category/<id:\d+>' => 'prod/categories/view',
    'prod/cover/<id:\d+>' => 'prod/covers/view',
    'prod/language/<id:\d+>' => 'prod/languages/view',
    'prod/paper/<id:\d+>' => 'prod/papers/view',
    
    'prod/product/<id:\d+>/<action:(create|update|delete)>' => 'prod/products/<action>',
    'prod/category/<id:\d+>/<action:(create|update|delete)>' => 'prod/categories/<action>',
    'prod/cover/<id:\d+>/<action:(create|update|delete)>' => 'prod/covers/<action>',
    'prod/language/<id:\d+>/<action:(create|update|delete)>' => 'prod/languages/<action>',
    'prod/paper/<id:\d+>/<action:(create|update|delete)>' => 'prod/papers/<action>',
];
```

`common/config/main.php`:


```
<?php
$rules = array_merge(
    require(__DIR__ . '/../../modules/prod/config/rules.php')
);

......

        'urlManager' => [
            'enablePrettyUrl' => true,
            'rules' => $rules,
        ],
```



