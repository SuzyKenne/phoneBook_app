<?php
require_once "../phoneBook/src/data.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $newContact = new contact(
        count($contacts) + 1,
        "assets/images/avatar.jpg",
        $_POST["name"],
        $_POST["email"],
        $_POST["phoneNumber"],
        $_POST["category"],
        
    );

    $contactManager->addContact($newContact);
    header("location: index.php");
    exit;
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Add Contacts</title>
</head>
<body>
    <div class="formContainer">
        <div class="formContentContainer">
            <h2>Add Contacts</h2>
            <form action="add.php" method="post" class="formInput">
                <label for="name">Name:</label>
                <input id="name" type="text" placeholder="Enter your name" name="name" required>

                <label for="phoneNumber">Phone Number:</label>
                <input id="phoneNumber" type="text" placeholder="Enter your phoneNumber" name="phoneNumber" required>

                <label for="email">Email:</label>
                <input id="email" type="text" placeholder="Enter your email" name="email" required>

                <label for="category">Category:</label>
                <select name="category">    
                    <option value="family">Family</option>
                    <option value="friend">Friends</option>
                    <option value="client">Clients</option>
                    <option value="boss">Bosses</option>
                </select>

                <button type="submit" class="submitButton">Add Contacts</button>
            </form>
        </div>
    </div>
   
</body>
</html>