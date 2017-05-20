<?php

$route->get("/category/{permalink}/{id}", [
    'call' => "Category@index",
    'nickname' => "category",
    'sitemap' => array(
        'if' => 'deleted=\'0\'',
        'priority' => '0.7',
        'columns' => array(
            'permalink' => 'ntblog.categories.permalink',
            'id' => 'ntblog.categories.id'
        )
    )
]);
