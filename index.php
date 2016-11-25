
<?php
ini_set("display_errors", 1);

/*require_once 'controller/ContactsController.php';

$controller = new ContactsController();

$controller->handleRequest();*/

require_once 'controller/KhoaController.php';

$controller = new KhoaController();

$controller->handleRequest();

?>
