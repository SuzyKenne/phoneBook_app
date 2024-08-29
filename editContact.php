<?php

require './src/contactManager.php';

$contactManager = new ContactManager($model);

// Set a default image path
$defaultImagePath = 'assets/images/default-avatar.png';

// var_dump($updatedContact);
// var_dump($contactManager); // Check if ContactManager is initialized correctly
// var_dump($contact); // Check if contact is retrieved correctly




if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $contacts = $contactManager->getAllContacts();
        $contact = null;

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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $id = $_POST['id']; 
    $name = $_POST['name'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $category = $_POST['category'];
    
    $currentContact = $contactManager->getContactById($id);
    $image = $currentContact->getImage();

    // Check if a new image was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $file_name = basename($_FILES['image']['name']);
        $tempname = $_FILES['image']['tmp_name'];
        $folder = 'assets/images/' . $file_name;

        if (move_uploaded_file($tempname, $folder)) {
            $image = $folder;
            echo "Image uploaded successfully: $image";
        } else {
            echo "Failed to move uploaded file.";
        }
    }

    $updatedContact = new Contact($id, $image, $name, $email, $phoneNumber, $category);

    if ($contactManager->editContact($updatedContact)) {
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
    <link rel="stylesheet" href="css/styleAddContact.css">
    <style>
        .image-preview-container {
            width: 100px;
            height: 100px;
            border: 2px solid #ddd;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
        }
        #image-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        #image {
            margin-bottom: 10px;
        }
    </style>
    <title>Edit Contacts</title>
</head>
<body>
    <div class="app-container">
        <header class="app-header">
            <h1>PhoneBook App</h1>
            <a href="index.php" class="btn btn-secondary">Back to Contacts</a>
        </header>
            
        <main class="main-content">   
            <div class="form-container">
                <h2>Edit Contact</h2>
                <form id="contactForm" action="editContact.php?id=<?= $contact->getId() ?>" method="post" enctype="multipart/form-data" class="formInput">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $contact->getId() ?>">    
                            <label for="name">Name:</label>
                            <input id="name" type="text" name="name" value="<?= $contact->getName() ?>" required><br>
                        </div>
                        <div class="form-group">
                            <label for="phoneNumber">Phone Number:</label>
                            <input id="phoneNumber" type="tel" name="phoneNumber" value="<?= $contact->getPhoneNumber() ?>" required><br>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input id="email" type="email" name="email" value="<?= $contact->getEmail() ?>" required><br>
                        </div>
                    
                        <div class="form-group">
                            <label for="category">Category:</label>
                            <select name="category">
                                <option value="family" <?= $contact->getCategory() == 'family' ? 'selected' : '' ?>>Family</option>
                                <option value="friend" <?= $contact->getCategory() == 'friend' ? 'selected' : '' ?>>Friend</option>
                                <option value="client" <?= $contact->getCategory() == 'client' ? 'selected' : '' ?>>Client</option>
                                <option value="boss" <?= $contact->getCategory() == 'boss' ? 'selected' : '' ?>>Boss</option>
                            </select><br>
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input id="image" type="file" name="image" value="<?= $contact->getImage() ?>" accept="image/*">
                            <div class="image-preview-container" >
                                <img id="image-preview" src="<?= $contact->getImage() ?: $defaultImagePath?>" alt="">
                            </div>
                        </div>                    
                    <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div> 
        </main>
    </div>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            var emailInput = document.getElementById('email').value;
            
            // Check if email contains both "@" and "."
            if (!emailInput.includes('@') || !emailInput.includes('.')) {
                alert("Please enter a valid email address containing both '@' and '.'");
                event.preventDefault();
            }
        });

        // Image preview functionality
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('image-preview');
            const previewContainer = document.querySelector('.image-preview-container');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.style.display = 'flex';
                }
                reader.readAsDataURL(file);
            } else {
                // If no file is selected, keep the current image
                preview.src = preview.src;
                previewContainer.style.display = 'flex';
            }
        });
    </script> 
</body>
</html>
