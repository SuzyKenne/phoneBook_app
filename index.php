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
    <link rel="stylesheet" href="css/styleIndex.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>PhoneBook</title>
</head>
<body>
    <div class="app-container">
        <header class="app-header">
            <h1>PhoneBook App</h1>
            <a class="new-contact-btn" href="addContact.php" role="button">New Contact</a>
        </header>
        <main class="main-content">
            <section class="contacts-list">
                <div class="scroll-hint">Scroll horizontally to view all information</div>
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
                                echo "<td><a class='contact-name' href='viewContact.php?id=". $contact->getId() ."'>"
                                    . $contact->getName() .
                                    "</a></td>";
                                echo "<td>" . $contact->getEmail() . "</td>";
                                echo "<td>" . $contact->getPhoneNumber() . "</td>";
                                echo "<td>" . $contact->getCategory() . "</td>";
                                echo "<td class='options-cell'>
                                    <a href='editContact.php?id=" . $contact->getId() . "' class='btn btn-edit' onclick=\"return confirm('Are you sure you want to edit this contact?');\">
                                        <i class='fas fa-edit'></i> Edit
                                    </a>
                                    <a href='deleteContact.php?id=" . $contact->getId() . "' class='btn btn-delete' onclick=\"return confirm('Are you sure you want to delete this contact?');\">
                                        <i class='fas fa-trash-alt'></i> Delete
                                    </a>
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

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleIndex.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>PhoneBook</title>
</head>
<body>
    <div class="app-container">
        <header class="app-header">
            <h1>PhoneBook App</h1>
            <a class="new-contact-btn" href="addContact.php" role="button">New Contact</a>
        </header>
        <main class="main-content">
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
                                echo "<td><a class='contact-name' href='viewContact.php?id=". $contact->getId() ."'>"
                                    . $contact->getName() .
                                    "</a></td>";
                                echo "<td>" . $contact->getEmail() . "</td>";
                                echo "<td>" . $contact->getPhoneNumber() . "</td>";
                                echo "<td>" . $contact->getCategory() . "</td>";
                                echo "<td class='options-cell'>
                                    <a href='editContact.php?id=" . $contact->getId() . "' class='btn btn-edit' onclick=\"return confirm('Are you sure you want to edit this contact?');\">
                                        <i class='fas fa-edit'></i> Edit
                                    </a>
                                    <a href='deleteContact.php?id=" . $contact->getId() . "' class='btn btn-delete' onclick=\"return confirm('Are you sure you want to delete this contact?');\">
                                        <i class='fas fa-trash-alt'></i> Delete
                                    </a>
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
</html> -->