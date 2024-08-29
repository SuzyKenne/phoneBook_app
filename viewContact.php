<?php
require './src/contactManager.php';

// Set a default image path
$defaultImagePath = 'assets/images/default-avatar.png';
$contactManager = new ContactManager($model);



if(isset($_GET['id'])){
    $id = $_GET['id'];
    $contact = $contactManager->getContactById($id);
    $image = $defaultImagePath;
    if($contact === null) {
        echo "Contact not found!";
        exit();
    }
} else {
    echo "No contact ID provided.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Details</title>
    <link rel="stylesheet" href="css/styleViewContact.css">
</head>
<body>
    <div class="app-container">
        <header class="app-header">
            <h1>PhoneBook App</h1>
            <a href="index.php" class="btn btn-secondary">Back to Contacts</a>
        </header>
        <main class="main-content">
            <div class="contact-details">
                <h2>Contact Details</h2>
                <?php if ($contact): ?>
                    <div class="contact-image">
                        <img src="<?= $contact->getImage() ?: $defaultImagePath?>" alt="Contact Image" />
                    </div>
                    <div class="contact-info">
                        <p><span>Name:</span> <?= htmlspecialchars($contact->getName()); ?></p>
                        <p><span>Email:</span> <?= htmlspecialchars($contact->getEmail()); ?></p>
                        <p><span>Phone Number:</span> <?= htmlspecialchars($contact->getPhoneNumber()); ?></p>
                        <p><span>Category:</span> <?= htmlspecialchars($contact->getCategory()); ?></p>
                    </div>
                    <div class="contact-actions">
                        <a href="editContact.php?id=<?= $contact->getId(); ?>" class="btn btn-primary">Edit Contact</a>
                        <a href="deleteContact.php?id=<?= $contact->getId(); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this contact?');">Delete Contact</a>
                    </div>
                <?php else: ?>
                    <p class="error-message">Contact not found.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>