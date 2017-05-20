<?php

$route->get('/article/{permalink}/{id}', [
    'call' => 'Article@index',
    'nickname' => 'article',
    'sitemap' => [
        'if' => 'deleted=0',
        'lastmod' => 'created',
        'columns' => [
            'permalink' => 'ntblog.articles.permalink',
            'id' => 'ntblog.articles.id'
        ]
    ]
]);
$route->get('/like/article/{id}', [
    'call' => 'Article@like',
    'nickname' => 'like'
]);

$route->get('/unlike/article/{id}', [
    'call' => 'Article@unlike',
    'nickname' => 'unlike'
]);