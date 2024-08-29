<?php

require './src/contactManager.php';

$contactManager = new ContactManager($model);

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

    echo 'this codde runs';


    $id = $_POST['id']; 
    $name = $_POST['name'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $category = $_POST['category'];
     // Initialize $image as an empty string
     $image = '';

     //email validation
     if(!str_ends_with($email, '@gmail.com')){
        echo "Email must end with @gmail.com";
        exit;
     }

     // Check if an image was uploaded and if there were no errors
     if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
         // Get the file name and temporary path
         $file_name = basename($_FILES['image']['name']); // Sanitize file name
         $tempname = $_FILES['image']['tmp_name'];
 
         // Define the target directory where the file should be moved
         $folder = 'assets/images/' . $file_name;
 
         
 
         // Attempt to move the uploaded file to the target directory
         if (move_uploaded_file($tempname, $folder)) {
             $image = $folder; // Assign the file path to $image
             echo "Image uploaded successfully: $image";
         } else {
             echo "Failed to move uploaded file.";
         }
     } 
    echo 'contace object instantiated';

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
                            <input id="image" type="file" name="image" accept="image/*"><br>
                            <img src="<?= $contact->getImage() ?>" alt="Current Image" width="100"><br>
                        </div>                    
                    <button type="submit" name="submit" class="submitButton">Save Contact</button>
                </form>
            </div> 
        </main>
    </div>

    <!-- <script>
        document.getElementById('contactForm').addEventListener('submit', function(event){
            var emailInput = document.getElementById('email').value;
            var emailDomain = "@gmail.com";
            if(!emailInput.endsWitch(emailDomain)){
                alert("Email must end with " + emailDomain);
                event.preventDefault();
            }
        })
    </script> -->
</body>
</html>
