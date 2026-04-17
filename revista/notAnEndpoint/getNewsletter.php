<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
include("../wdywfm/myLoad.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Allow: GET");
@$limit  = (intval($_GET['limit']) != 0) ? (int) $_GET['limit'] : 21;
@$offset = (intval($_GET['offset']) != 0) ? (int) $_GET['offset'] : 0;
echo json_encode(userData::getNewsletter($limit, $offset), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
?>
