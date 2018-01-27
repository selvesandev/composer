<?php

require_once 'vendor/autoload.php';


$controller = new \App\Controller\Controller();
echo $controller->test();

$user = new \App\Models\User();
echo $user->model();

$userController = new \App\Controller\UserController();

echo test();


echo '<br>';


$arr = [
    'person' => [
        'f_name' => 'selvesan',
        'l_name' => 'jackson'
    ]
];

//echo $arr['person']['f_name'];

echo array_get($arr, 'person.f_name');