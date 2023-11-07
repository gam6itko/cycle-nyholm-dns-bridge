# Nyholmd DNS Cycle Database Config

```php
# app/config/database.php

return [
    'default' => env('DATABASE_DEFAULT_DRIVER', 'my-db'),

    'databases' => [
        'my-db' => [
            'connection' => 'mysql.db',
        ],
    ],

    'connections' => [
        'mysql.db' => new MySQLDriverConfig(
            new NyholmDsnConnectionConfig('mysql://root:root@mysql:3306/my_database_name')
        ),
    ],
];
```
