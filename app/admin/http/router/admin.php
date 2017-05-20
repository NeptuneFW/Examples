<?php
/**
 * Created by PhpStorm.
 * User: Peker
 * Date: 22.04.2017
 * Time: 18:39
 */
$route->get('/', [ 'call' => 'Home@index', 'nickname' => 'admin', 'middleware' => [ 'AuthMiddleware@isLogin', 'AuthMiddleware@isAdmin']]);
$route->post('/', [ 'call' => 'Home@index',  'middleware' => [ 'AuthMiddleware@isLogin', 'AuthMiddleware@isAdmin']]);
$route->get('/logout', [ 'call' => 'Home@logout', 'middleware' => 'AuthMiddleware@isLogin', 'nickname' => 'logout']);
$route->get('/login', [ 'call' => 'Home@login', 'middleware' => 'AuthMiddleware@isNotLogin', 'nickname' => 'login']);
$route->post('/login', [ 'call' => 'Home@loginPost', 'middleware' => 'AuthMiddleware@isNotLogin']);
