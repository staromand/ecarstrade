<?php

use App\Infrastructure\Database\Connection;
use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->usePutenv()->load(__DIR__.'/.env');

Connection::get();
