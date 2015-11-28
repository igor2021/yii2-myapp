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

