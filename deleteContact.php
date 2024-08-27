<?php
require './src/contactManager.php';


$contactManager = new ContactManager($model);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($contactManager->deleteContact($id)) {
        echo "Contact deleted successfully!";
        
    } else {
        echo "Failed to delete contact.";
    }
    
    header("Location: index.php");
    exit();
}
?>