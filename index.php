<?php
session_start();
Dotenv\Dotenv::createImmutable(__DIR__)->load();
require "routers/index.php";