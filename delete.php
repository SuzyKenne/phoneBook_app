<?php
require_once "../phoneBook/src/contact.php";
require_once "../phoneBook/src/contactManager.php";


if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("No contact ID specified.");
}

$contactId = intval($_GET['id']);


$jsonData = file_get_contents(__DIR__ . '/src/contacts.json');
$contactsArray = json_decode($jsonData, true);


if ($contactsArray === null) {
    die("Error decoding JSON: " . json_last_error_msg());
}

$contactsArray = array_filter($contactsArray, function($contact) use ($contactId) {
    return $contact['id'] != $contactId;
});


$contactsArray = array_values($contactsArray);

if (file_put_contents(__DIR__ . '/src/contacts.json', json_encode($contactsArray, JSON_PRETTY_PRINT)) === false) {
    die("Error saving contacts to JSON file.");
}

header("Location: index.php");
exit();
?>