<?php

$base_url = "http://localhost/mvc-up/";
$base_dir = "/mvc-up/";

$tmp = explode('?', $_SERVER['REQUEST_URI']);
$current_route = str_replace($base_dir,'',$tmp[0]);
unset($tmp);


$dbHost = 'localhost';
$dbName = 'mvc_blog';
$dbUsername = 'root';
$dbPassword = '';
