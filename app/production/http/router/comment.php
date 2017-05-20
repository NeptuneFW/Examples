<?php

$route->post("/comment/add", ['call' => 'Comment@add', 'nickname' => 'commentAdd']);