
<?php
ini_set("display_errors", 1);

require_once 'controller/IndexController.php';

$controller = new IndexController();

$controller->handleRequest();


?>
