<?php
/**
 * Created by PhpStorm.
 * User: Peker
 * Date: 24.04.2017
 * Time: 22:55
 */

$route->get('/user', [ 'call' => 'User@index', 'nickname' => 'user', 'middleware' => [ 'AuthMiddleware@isLogin', 'AuthMiddleware@isAdmin']]);
$route->get('/user/list', [ 'call' => 'User@list', 'nickname' => 'userList', 'middleware' => [ 'AuthMiddleware@isLogin', 'AuthMiddleware@isAdmin']]);
$route->post('/user/list', [ 'call' => 'User@list', 'nickname' => 'userList', 'middleware' => [ 'AuthMiddleware@isLogin', 'AuthMiddleware@isAdmin']]);
$route->get('/user/ban/{id}', ['call' => 'User@ban', 'nickname'=> 'user_ban', 'middleware' => ['AuthMiddleware@isLogin', 'AuthMiddleware@isAdmin']]);