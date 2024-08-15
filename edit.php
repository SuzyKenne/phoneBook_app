<?php
require_once "../phoneBook/src/contact.php";
require_once "../phoneBook/src/contactManager.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contactId = intval($_GET['id']);

    
    $jsonData = file_get_contents(__DIR__ . '/src/contacts.json');
    $contactsArray = json_decode($jsonData, true);

    if ($contactsArray === null) {
        die("Error decoding JSON: " . json_last_error_msg());
    }

    foreach ($contactsArray as &$contact) {
        if ($contact['id'] == $contactId) {
            $contact['name'] = $_POST['name'];
            $contact['phoneNumber'] = $_POST['phoneNumber'];
            $contact['email'] = $_POST['email'];
            $contact['category'] = $_POST['category'];

            if (!empty($_FILES['image']['tmp_name'])) {
                $targetDir = "assets/images/";
                $uniqueName = uniqid() . '-' . basename($_FILES["image"]["name"]);
                $targetFile = $targetDir . $uniqueName;

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    $contact['image'] = $targetFile;
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
            break;
        }
    }

    file_put_contents(__DIR__ . '/src/contacts.json', json_encode($contactsArray, JSON_PRETTY_PRINT));

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Edit Contact</title>
</head>
<body>
    <div class="formContainer">
        <div class="formContentContainer">
            <h2>Edit Contact</h2>
            <form action="edit.php?id=<?= htmlspecialchars($contactId) ?>" method="post" enctype="multipart/form-data">
                <label for="name">Name:</label>
                <input id="name" type="text" name="name" value="<?= htmlspecialchars($contactsArray['name']) ?>" required><br>

                <label for="phoneNumber">Phone Number:</label>
                <input id="phoneNumber" type="text" name="phoneNumber" value="<?= htmlspecialchars($contactsArray['phoneNumber']) ?>" required><br>

                <label for="email">Email:</label>
                <input id="email" type="email" name="email" value="<?= htmlspecialchars($contactsArray['email']) ?>" required><br>

                <label for="category">Category:</label>
                <select name="category">
                    <option value="family" <?= $contactsArray['category'] == 'family' ? 'selected' : '' ?>>Family</option>
                    <option value="friend" <?= $contactsArray['category'] == 'friend' ? 'selected' : '' ?>>Friends</option>
                    <option value="client" <?= $contactsArray['category'] == 'client' ? 'selected' : '' ?>>Clients</option>
                    <option value="boss" <?= $contactsArray['category'] == 'boss' ? 'selected' : '' ?>>Bosses</option>
                </select><br>

                <label for="image">Image:</label>
                <input id="image" type="file" name="image" accept="image/*"><br>
                <img src="<?= htmlspecialchars($contactsArray['image']) ?>" alt="Current Image" style="width:100px;height:auto;"><br>

                <button type="submit" class="submitButton">Save Changes</button>
            </form>
        </div>
    </div>
</body>
</html>

