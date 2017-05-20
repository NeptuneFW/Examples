<?php
/**
 * Created by PhpStorm.
 * User: Peker
 * Date: 11.04.2017
 * Time: 13:01
 */

$route->get("/login", [
    'call' => "Home@login",
    'nickname' => "login",
    'sitemap' => true
]);

$route->get('/lang/{lang}', ['call' => 'Home@lang', 'nickname' => 'lang']);

$route->post("/login", [
    'call' => "Home@loginPost",
]);

$route->get("/register", [
    'call' => "Home@register",
    'nickname' => "register",
    'sitemap' => true
]);

$route->post("/register", [
    'call' => "Home@registerPost"
]);

$route->get("/", [ 'call' => 'Home@index', 'nickname' => 'home', 'sitemap' => true]);
$route->get("/categories", [ 'call' => 'Home@catList', 'nickname' => 'categories', 'sitemap' => true]);
$route->get("/about_us", [ 'call' => 'Home@about', 'nickname' => 'about_us', 'sitemap' => true]);
$route->get("/contact", [ 'call' => 'Home@contact', 'nickname' => 'contact', 'sitemap' => true]);

$route->get("/logout", [
    'call' => "Home@logout",
    'nickname' => "logout"
]);