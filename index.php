
<?php
ini_set("display_errors", 1);

require_once 'controller/ContactsController.php';

$controller = new ContactsController();

$controller->handleRequest();

?>
