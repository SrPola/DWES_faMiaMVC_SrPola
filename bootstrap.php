<?php
    require 'vendor/autoload.php';
    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    define('USER', $_ENV['USER']);
    define('PASS', $_ENV['PASS']);