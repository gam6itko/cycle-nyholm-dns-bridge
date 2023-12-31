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
            // 'mysql:host=mysql;dbname=testdb;charset=utf8mb4', 'user', 'pass'
            new NyholmDsnConnectionConfig('mysql://user:pass@mysql:3306/testdb?charset=utf8mb4')
        ),
    ],
];
```
