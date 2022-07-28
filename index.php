<?php
ob_start();

session_start();
require_once __DIR__ . "/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once __DIR__ . "/helpers/Helper.php";

/** Schema namespace */
use \sprint\Schema;

/** This code will run the app schema */
if($_SERVER["SCHEMA_AUTO_RUN"] == "true") $schema = new Schema;   

/** Calls the route file which contains all the app routes */
require_once __DIR__ . "/Routers.php";

ob_end_flush();
