<?php

$route->get('/color/{color}', ['call' => 'Color@index', 'nickname' => 'color']);