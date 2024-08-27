<?php

require './src/contactManager.php';


$contactManager = new ContactManager($model);

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Handle GET request
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $contacts = $contactManager->getAllContacts();
            $contact = new Contact(null, $image, $name, $email, $phoneNumber, $category);

            foreach ($contacts as $c) {
                if ($c->getId() == $id) {
                    $contact = $c;
                    break;
                }
            }

            if ($contact === null) {
                echo "Contact not found.";
                exit();
            }
        } else {
            echo "No ID provided.";
            exit();
        }
    } 
        // Handle POST request
    if (isset($_POST['submit'])) {
        $id = $_POST['id']; // Make sure the form includes the ID as a hidden input field
        $name = $_POST['name'];
        $phoneNumber = $_POST['phoneNumber'];
        $email = $_POST['email'];
        $category = $_POST['category'];
        $image = $contact->getImage(); // Use the existing image by default

        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "assets/images/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = $target_file; // Update the image path
            } else {
                echo "Failed to upload image.";
                exit();
            }
        }

        // Create an updated contact object
        $updatedContact = new Contact($id, $image, $name, $email, $phoneNumber, $category);
        var_dump($updatedContact);
        if ($contactManager->editContact($id, $updatedContact)) {
            // Redirect to the index page after successful update
            header("Location: index.php");
            exit();
        } else {
            echo "Failed to update contact.";
        }

        
    }
    

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Edit Contacts</title>
</head>
<body>
    <div class="formContainer">
        <div class="formContentContainer">
            <h2>Edit Contact</h2>
            
            <form action="editContact.php?id=<?= $contact->getId() ?>" method="post" enctype="multipart/form-data" class="formInput">
                <label for="name">Name:</label>
                <input id="name" type="text" name="name" value="<?= $contact->getName() ?>" required><br>

                <label for="phoneNumber">Phone Number:</label>
                <input id="phoneNumber" type="text" name="phoneNumber" value="<?= $contact->getPhoneNumber() ?>" required><br>

                <label for="email">Email:</label>
                <input id="email" type="text" name="email" value="<?= $contact->getEmail() ?>" required><br>

                <label for="category">Category:</label>
                <select name="category">
                    <option value="family" <?= $contact->getCategory() == 'family' ? 'selected' : '' ?>>Family</option>
                    <option value="friend" <?= $contact->getCategory() == 'friend' ? 'selected' : '' ?>>Friend</option>
                    <option value="client" <?= $contact->getCategory() == 'client' ? 'selected' : '' ?>>Client</option>
                    <option value="boss" <?= $contact->getCategory() == 'boss' ? 'selected' : '' ?>>Boss</option>
                </select><br>

                <label for="image">Image:</label>
                <input id="image" type="file" name="image" accept="image/*"><br>
                <img src="<?= $contact->getImage() ?>" alt="Current Image" width="100"><br>

                <button type="submit" name="submit" class="submitButton">Save Contact</button>
            </form>
        </div>
    </div>
</body>
</html>
