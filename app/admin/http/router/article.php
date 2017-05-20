<?php

$route->get('/article', [ 'call' => 'Article@index', 'nickname' => 'article', 'middleware' => [ 'AuthMiddleware@isLogin', 'AuthMiddleware@isAdmin']]);
$route->post('/article/add', [ 'call' => 'Article@addPost','middleware' => [ 'AuthMiddleware@isLogin', 'AuthMiddleware@isAdmin']]);
$route->get('/article/add', [ 'call' => 'Article@add', 'nickname' => 'articleAdd', 'middleware' => [ 'AuthMiddleware@isLogin', 'AuthMiddleware@isAdmin']]);
$route->get('/article/list', [ 'call' => 'Article@list', 'nickname' => 'articleList', 'middleware' => [ 'AuthMiddleware@isLogin', 'AuthMiddleware@isAdmin']]);
$route->get('/article/edit/{id}', [ 'call' => 'Article@edit', 'nickname' => 'article_edit', 'middleware' => [ 'AuthMiddleware@isLogin', 'AuthMiddleware@isAdmin']]);
$route->post('/article/edit/{id}', [ 'call' => 'Article@editPost', 'middleware' => [ 'AuthMiddleware@isLogin', 'AuthMiddleware@isAdmin']]);
$route->get('/article/delete/{id}', [ 'call' => 'Article@delete', 'nickname' => 'article_delete', 'middleware' => [ 'AuthMiddleware@isLogin', 'AuthMiddleware@isAdmin']]);
