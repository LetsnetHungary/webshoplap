<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("vendor/autoload.php");

define("SERVER", CoreApp\AppConfig::getData("server"));

date_default_timezone_set(CoreApp\AppConfig::getData("timezone"));

$url = isset($_GET["url"]) ? $_GET["url"] : "Index";

$app = new CoreApp\App($url);
$app->build();
