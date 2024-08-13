<?php
require_once "../phoneBook/src/data.php";
$id = $_GET["id"];
$contact = $contactManager->getContactById($id);
if (!$contact){
    die("Contact not found!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <img url=" ">
        <ul>
            <li><?= $contact->name ?>Name: </li>   
            <li><?= $contact->name ?>Name: </li>
            <li><?= $contact->phoneNumber ?>PhoneNumber: </li>
            <li><?= $contact->email ?>Email: </li>
            <li><?= $contact->category ?>Category: </li>
        </ul>
    </div>
</body>
</html>