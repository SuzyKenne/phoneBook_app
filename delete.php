<?php
require_once "../phoneBook/src/data.php";
$id = $_GET["id"];
$contactManager->deleteContact($id);
header("location: index.php");
exit;
?>