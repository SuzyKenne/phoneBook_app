<?php
require_once "../phoneBook/src/contact.php";
require_once "../phoneBook/src/contactManager.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Load the existing contacts
    $jsonData = file_get_contents(__DIR__ . '/src/contacts.json');
    $contactsArray = json_decode($jsonData, true);

    // Handle the uploaded image
    $targetFile = 'assets/images/' . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

    // Create a new contact
    $newContact = [
        'id' => count($contactsArray) + 1,
        'name' => $_POST["name"],
        'phoneNumber' => $_POST["phoneNumber"],
        'email' => $_POST["email"],
        'category' => $_POST["category"],
        'image' => $targetFile,
    ];

    $contactsArray[] = $newContact;

     if (file_put_contents(__DIR__ . '/src/contacts.json', json_encode($contactsArray, JSON_PRETTY_PRINT))) {
        echo "Contact added successfully.<br>";
        header("Location: index.php");
        exit();
    } else {
        echo "Error saving contacts to JSON file.";
    }
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
<body><!--  -->
    <div class="formContainer">
        <div class="formContentContainer">
            <h2>Add Contacts</h2>
            <form action="add.php" method="post" class="formInput">
                <label for="name">Name:</label>
                <input id="name" type="text" placeholder="Enter your name" name="name" required><br>

                <label for="phoneNumber">Phone Number:</label>
                <input id="phoneNumber" type="text" placeholder="Enter your phoneNumber" name="phoneNumber" required><br>

                <label for="email">Email:</label>
                <input id="email" type="text" placeholder="Enter your email" name="email" required><br>

                <label for="category">Category:</label>
                <select name="category">    
                    <option value="family">Family</option>
                    <option value="friend">Friends</option>
                    <option value="client">Clients</option>
                    <option value="boss">Bosses</option>
                </select>

                <label for="image">Image:</label>
                <input id="image" type="file" name="image" accept="images/*"><br>

                <button type="submit" class="submitButton">Add Contacts</button>
            </form>
        </div>
    </div>
   
</body>
</html>