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
    <link rel="stylesheet" href="css/style.css">
    <title>Add Contacts</title>
</head>
<body><!--  -->
    <div class="formContainer">
        <div class="formContentContainer">
            <h2>Add Contacts</h2>
            
                <form id="contactForm" action="addContact.php" method="post" enctype="multipart/form-data" class="formInput">
                    <label for="name">Name:</label>
                    <input id="name" type="text" placeholder="Enter your name" name="name"  required><br>

                    <label for="phoneNumber">Phone Number:</label>
                    <input id="phoneNumber" type="tel" placeholder="Enter your phoneNumber" name="phoneNumber"  required>
                    <label for="email">Email:</label>
                    <input id="email" type="email" placeholder="Enter your email" name="email"  required><br>

                    <label for="category">Category:</label>
                    <select name="category" >    
                        <option value="family">Family</option>
                        <option value="friend">Friends</option>
                        <option value="client">Clients</option>
                        <option value="boss">Work</option>
                    </select>

                    <label for="image">Image:</label>
                    <input id="image" type="file" width="50px" name="image" accept="image/*" ><br>

                    <button type="submit" name ="submit" class="submitButton">Add Contacts</button>
               </form>
            
        </div>
    </div>

    <!-- <script>
        document.getElementById('contactForm').addEventListener('submit', function(event){
            var emailInput = document.getElementById('email').value;
            var emailDomain = "@gmail.com";
            if(!emailInput.endsWitch(emailDomain)){
                alert("Email must end with " + emailDomain);
                event.preventDefault();
            }
        });
    </script>
    -->
</body>
</html>