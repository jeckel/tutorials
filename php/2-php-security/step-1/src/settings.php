<?php
/**
 * Created by PhpStorm.
 * User: jeckel
 * Date: 28/12/17
 * Time: 16:46
 */

return [
    'db' => [
        'driver'    => 'mysql',
        'host'      => getenv('MYSQL_HOST'),
        'database'  => getenv('MYSQL_DATABASE'),
        'username'  => getenv('MYSQL_USER'),
        'password'  => getenv('MYSQL_PASSWORD'),
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ]
];