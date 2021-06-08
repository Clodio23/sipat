<?php
//for develop set to 1. for production set 0
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!session_id())  session_start();
require_once '../../app_sipat/init.php';

$new = new App;
