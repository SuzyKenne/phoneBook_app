<?php
class ContactManager {
    private $contacts;

    public function __construct($contacts = []) {
        $this->contacts = $contacts;
    }

    // Method to add a new contact
    public function addContact(Contact $contact) {
        $this->contacts[] = $contact;
        $this->saveContacts();
    }

    // Method to update a contact by ID
    public function updateContact($id, $name, $phoneNumber, $email, $category, $image) {
        foreach ($this->contacts as $contact) {
            if ($contact->getId() == $id) {
                $contact->setName($name);
                $contact->setPhoneNumber($phoneNumber);
                $contact->setEmail($email);
                $contact->setCategory($category);
                $contact->setImage($image);
                $this->saveContacts();
                return true;
            }
        }
        return false;
    }

    // Method to delete a contact by ID
    public function deleteContact($id) {
        foreach ($this->contacts as $index => $contact) {
            if ($contact->getId() == $id) {
                unset($this->contacts[$index]);
                $this->contacts = array_values($this->contacts); // Reindex array
                $this->saveContacts();
                return true;
            }
        }
        return false;
    }

    // Method to get all contacts
    public function getAllContacts() {
        return $this->contacts;
    }

    // Method to save contacts to a JSON file
    private function saveContacts() {
        $contactsArray = [];
        foreach ($this->contacts as $contact) {
            $contactsArray[] = [
                'id' => $contact->getId(),
                'name' => $contact->getName(),
                'phoneNumber' => $contact->getPhoneNumber(),
                'email' => $contact->getEmail(),
                'category' => $contact->getCategory(),
                'image' => $contact->getImage(),
            ];
        }
        file_put_contents(__DIR__ . '/src/contacts.json', json_encode($contactsArray, JSON_PRETTY_PRINT));
    }
}
?>
