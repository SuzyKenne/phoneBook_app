<?php
require './src/contactManager.php';
$model = new Model();
$contactManager = new ContactManager($model);

if (isset($_POST['submit'])) {
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

    // Create the Contact object
    $contact = new Contact(null, $image, $name, $email, $phoneNumber, $category);

    // Proceed with adding the contact
    if ($contactManager->addContact($contact)) {
        echo "Contact added successfully!";
        header("Location: index.php"); // Redirect to index.php after successful addition
        exit();
    } else {
        echo "Failed to add contact.";
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
    <title>Add Contact</title>
</head>
<body>
    <div class="app-container">
        <header class="app-header">
            <h1>PhoneBook App</h1>
            <a href="index.php" class="btn btn-secondary">Back to Contacts</a>
        </header>
        <main class="main-content">
            <div class="form-container">
                <h2>Add New Contact</h2>
                <form id="contactForm" action="addContact.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input id="name" type="text" placeholder="Enter name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">Phone Number:</label>
                        <input id="phoneNumber" pattern="[0-9()+\-\s]+" type="tel" placeholder="Enter phone number" name="phoneNumber" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input id="email" type="email" placeholder="Enter email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select name="category" id="category">
                            <option value="family">Family</option>
                            <option value="friend">Friends</option>
                            <option value="client">Clients</option>
                            <option value="boss">Work</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input id="image" type="file" name="image" accept="image/*">
                        <div class="image-preview-container" style="display: none;">
                            <img id="image-preview" src="#" alt="Image preview">
                        </div>
                    </div>

                 <button type="submit" name="submit" class="btn btn-primary">Add Contact</button>
                </form>
            </div>
        </main>
    </div>
    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            var emailInput = document.getElementById('email').value;
            var emailDomain = "@gmail.com";
            if (!emailInput.endsWith(emailDomain)) {
                alert("Email must end with " + emailDomain);
                event.preventDefault();
            }
        });

        // Allow only digits and specific special characters in phone number field
        document.getElementById('phoneNumber').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9()+\-\s]/g, '');
        });

        
        var phoneNumber = document.getElementById('phoneNumber').value;
            if (phoneNumber.trim().length === 0) {
                alert("Phone number is required.");
                event.preventDefault();
            } else if (!/^[0-9()+\-\s]+$/.test(phoneNumber)) {
                alert("Phone number can only contain digits, spaces, and the characters: +()-");
                event.preventDefault();
            }
        ;

    
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