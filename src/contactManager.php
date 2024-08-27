
<?php
require 'db.conn.php';
require './src/contact.php';


$model = new Model();

class ContactManager {
    private $conn;
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "phoneBook";

    

    public function __construct($dbname) {
        $this->conn = $dbname;
    }

    public function getAllContacts() {
        $conn = new mysqli($this->servername, $this->username,$this->password, $this->dbname);

        $sql = "SELECT * FROM contacts";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            $contacts = array();
            
            while ($row = $result->fetch_assoc()){
                $contact = new Contact(
                    $row['id'],
                    $row['image'],
                    $row['name'],
                    $row['email'],
                    $row['phoneNumber'],
                    $row['category'],
                    

                );
                $contacts[] = $contact;
            }
            return $contacts;
             } else {
            error_log("Database Query Failed: " . $this->conn->error);
            return null;
        }
        
    }


    public function addContact($contact) {
        $conn = new mysqli($this->servername, $this->username,$this->password, $this->dbname);

        $sql = "INSERT INTO contacts( image, name, email, phoneNumber, category) VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if($stmt === false){
            error_log("Prepare Failed: " . $conn->error);
            return false;
        }


        $image = $contact->getImage();
        $name = $contact->getName();
        $email = $contact->getEmail();
        $phoneNumber = $contact->getPhoneNumber();
        $category = $contact->getCategory();

       

        $stmt->bind_param("sssss", $image, $name, $email,$phoneNumber, $category);
        if($stmt->execute()) {
            $stmt->close();
            return true;
        } else{
            $stmt->close();
            return false;
        }
        
        
    }

    



   
    public function editContact($id, $contact) {
        // Create a new database connection
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    
        // Check for connection errors
        if ($conn->connect_error) {
            error_log("Connection failed: " . $conn->connect_error);
            return false;
        }
    
        // Prepare the SQL statement
        $sql = "UPDATE contacts SET image = ?, name = ?, email = ?, phoneNumber = ?, category = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
    
        if ($stmt === false) {
            error_log("Prepare failed: " . $conn->error);
            $conn->close();
            return false;
        }
    
        // Get contact details
        $image = $contact->getImage();
        $name = $contact->getName();
        $email = $contact->getEmail();
        $phoneNumber = $contact->getPhoneNumber();
        $category = $contact->getCategory();
    
        // Bind parameters
        $stmt->bind_param("sssssi", $image, $name, $email, $phoneNumber, $category, $id);
    
        // Execute the statement
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return true;
        } else {
            error_log("Execute failed: " . $stmt->error);
            $stmt->close();
            $conn->close();
            return false;
        }
    }
    

    public function deleteContact($id) {
        // Ensure that the connection is using the one passed through the constructor
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    
        $sql = "DELETE FROM contacts WHERE id = ?";
    
        $stmt = $conn->prepare($sql);
    
        if ($stmt === false) {
            error_log("Prepare Failed: " . $conn->error);
            return false;
        }
    
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
    
    
}
