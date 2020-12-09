<?php

    $router->get('/', 'TodoController@index');
    $router->get('create', 'TodoController@create');
    $router->get('edit', 'TodoController@edit');

    $router->post('storage', 'TodoController@storage');
    $router->post('update', 'TodoController@update');
    $router->post('delete', 'TodoController@delete');
