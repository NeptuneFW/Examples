<?php
/**
 * Created by PhpStorm.
 * User: Peker
 * Date: 24.04.2017
 * Time: 22:55
 */

$route->get('/category', [ 'call' => 'Category@index', 'nickname' => 'category', 'middleware' => [ 'AuthMiddleware@isLogin', 'AuthMiddleware@isAdmin']]);
$route->get('/category/add', [ 'call' => 'Category@add', 'nickname' => 'categoryAdd', 'middleware' => [ 'AuthMiddleware@isLogin', 'AuthMiddleware@isAdmin']]);
$route->get('/category/list', [ 'call' => 'Category@list', 'nickname' => 'categoryList', 'middleware' => [ 'AuthMiddleware@isLogin', 'AuthMiddleware@isAdmin']]);
$route->post('/category/list', [ 'call' => 'Category@list', 'nickname' => 'categoryList', 'middleware' => [ 'AuthMiddleware@isLogin', 'AuthMiddleware@isAdmin']]);
$route->post('/category/add', [ 'call' => 'Category@addPost', 'middleware' => [ 'AuthMiddleware@isLogin', 'AuthMiddleware@isAdmin']]);
$route->get('/category/edit/{id}', ['call' => 'Category@edit', 'nickname'=> 'category_edit', 'middleware' => ['AuthMiddleware@isLogin', 'AuthMiddleware@isAdmin']]);
$route->post('/category/edit/{id}', ['call' => 'Category@editPost', 'middleware' => ['AuthMiddleware@isLogin', 'AuthMiddleware@isAdmin']]);
$route->get('/category/delete/{id}', ['call' => 'Category@delete', 'nickname'=> 'category_delete', 'middleware' => ['AuthMiddleware@isLogin', 'AuthMiddleware@isAdmin']]);