<?php

$container['events'] = function () {
    return new Laminas\EventManager\EventManager;
};

$container['db'] = function () {
  $dsn = 'mysql:host=db;dbname=pp_project_manager';
  $username = 'root';
  $password = 'root';
  $options = [
      \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
  ];

  $pdo = new \PDO($dsn, $username, $password, $options);
  $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

  return $pdo;
};