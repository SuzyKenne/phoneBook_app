<?php
require_once "../phoneBook/src/data.php";
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
    <!-- side-bar -->
     <div class="container">
        <aside class="sidebar">
            <!-- <div class="create-contact">
                <button>Contacts</button>
            </div> -->
            <nav class="menu">
                <ul>
                  <li class="active">Contacts</li> 
                </ul>
            </nav>
            <div class="view-manage">
                <h3>View & Manage</h3>
                <ul>
                    <li><a href="add.php">Add New Contacts</a></li>
                    <li><a href="edit.php">Update Contacts</a></li>
                    <li><a href="delete.php">Delete</a></li>
                </ul>
            </div>
            <div class="category">
                <h3>Categories</h3>
                <ul>
                    <li>Family</li>
                    <li>Friends</li>
                    <li>Clients</li>
                    <li>Bosses</li>
                </ul>
            </div>
        </aside>

        <!-- main section -->
        <main class="main-content">
            <header>
                <input type="search" placeholder="Search">
            </header>
            <section class="contacts-list">
                <table>
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>category</th>
                    </thead>
                    <tbody>
                        <?php foreach ($contacts as $contact):?>
                            <tr>
                                <td>
                                    
                                        <img src="<?= $contact->image ?>" alt="<?= $contact->name ?>" width="20" height="15">
                                        <?= $contact->name ?>
                                    
                                </td>
                                <td>
                                    <?= $contact->email ?>
                                </td>
                                <td>
                                    <?= $contact->category ?>
                                </td>
                                <td>
                                    <?= $contact->phoneNumber ?>
                                </td>
                            </tr>
                        <?php endforeach?> 
                    </tbody>
                </table>
            </section>
        </main>
     </div>

    

</body>
</html>