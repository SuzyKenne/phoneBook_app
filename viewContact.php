<?php
require './src/contactManager.php';

$contactManager = new ContactManager($model);


var_dump($id);
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $contact = $contactManager->getContactById($id);


    if($contact === null) {
        echo "Contact not found!";
        exit();
    }
    var_dump($contact);
} else {
    echo "No contact ID provided.";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Details</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container-view-contact">
        <h2>Contact Details</h2>
        <?php
                    echo "<img src=" . $contact->getImage() . " />";
                    echo "<p>Name: <strong>" . $contact->getName() . "</strong> </p>";
                    echo "<p>Email: <strong>" . $contact->getEmail() . "</strong> </p>";
                    echo "<p>Phone Number: <strong>" . $contact->getPhoneNumber() . "</strong> </p>";
                    echo "<p>Category: <strong>" . $contact->getCategory() . "</strong> </p>";
                
            
                    
        ?>
    </div>
</body>
</html>