<?php
require_once "../phoneBook/src/contact.php";
require_once "../phoneBook/src/contactManager.php";

// Read the contacts.json file
$jsonData = file_get_contents(__DIR__ . '/src/contacts.json');

// Decode the JSON data into a PHP array
$contactsArray = json_decode($jsonData, true);

// Check if decoding was successful
if ($contactsArray === null) {
    die("Error decoding JSON: " . json_last_error_msg());
}

// Convert the array back into Contact objects
$contacts = [];
foreach ($contactsArray as $contactData) {
    $contacts[] = new contact(
        $contactData['id'],
        $contactData['name'],
        $contactData['phoneNumber'],
        $contactData['email'],
        $contactData['category'],
        $contactData['image']
    );
}

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
                <h1>PhoneBook App</h1>
            </header>
            <section class="contacts-list">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Category</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contacts as $contact): ?>
                            <tr>
                                <td>
                                    <img src="<?= htmlspecialchars($contact->getImage()) ?>" alt=" " width="20" height="20">
                                    <?= htmlspecialchars($contact->getName()) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($contact->getEmail()) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($contact->getPhoneNumber()) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($contact->getCategory()) ?>
                                </td>
                                <td>
                                    <span class="options options-edit">
                                        <a href="edit.php?id=<?= htmlspecialchars($contact->getId()) ?>" onclick="return confirm('Are you sure you want to edit this contact?');">
                                            Edit
                                        </a>
                                    </span>
                                    <span class="options options-delete">
                                        <a href="delete.php?id=<?= htmlspecialchars($contact->getId()) ?>" onclick="return confirm('Are you sure you want to delete this contact?');">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?> 
                    </tbody>
                </table>
            </section>
        </main>
     </div>
</body>
</html>
