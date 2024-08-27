<?php


require './src/contactManager.php';







$contactManager = new ContactManager($model);

$i = 1;

$contacts = $contactManager->getAllContacts();




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>PhoneBook</title>
</head>
<body>


        <!-- main section -->
        <main class="main-content">
            <header>
                <h1>PhoneBook App</h1>
            </header>
            <div class="container ">
                <a class="submitButton" href="addContact.php" role="button">New Contact</a><br>
            </div>
            <section class="contacts-list">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Category</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if($contacts){
                            foreach ($contacts as $contact) {
                                echo "<tr>";
                                echo "<td>" . $i. "</td>";
                                echo "<td><img src='" . $contact->getImage() . "' alt='Contact Image' width='50' style='margin-right: 10px;'>" . $contact->getName() . "</td>";
                                echo "<td>" . $contact->getEmail() . "</td>";
                                echo "<td>" . $contact->getPhoneNumber() . "</td>";  
                                echo "<td>" . $contact->getCategory() . "</td>";                    
                                echo "<td>
                                        <span class='options options-edit'>
                                        <a href='editContact.php?id=" . $contact->getId() . "' onclick=\"return confirm('Are you sure you want to edit this contact?');\">
                                                    Edit
                                        </a>
                                        </span>
                                        <span class='options options-delete'>
                                            <a href='deleteContact.php?id=" . $contact->getId() . "' onclick=\"return confirm('Are you sure you want to delete this contact?');\">
                                                    Delete
                                            </a>
                                        </span>
                                    </td>";
                                echo "</tr>";
                                $i++;
                            }
                        } else {
                            echo "<tr><td colspan='6'>No contacts found.</td></tr>";
                        }
                    
                    ?> 
                    </tbody>
                </table>
            </section>
        </main>
     </div>
</body>
</html>