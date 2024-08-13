<?php
class contactManager {
    private $contacts = [];

    public function __construct($contacts = [])
    {
        $this->contacts = $contacts;
    }


    // get all contacts by id
    public function getAllContacts(){
        return $this->contacts;
    }

    public function getContactById ($id){
        foreach($this->contacts as $contact){
            if($contact->id == $id){
                return$contact;
            }
        }
        return null;
    }

    public function addContact($contact){
        $this->contacts[] = $contact;
    }

    public function editContact($id, $updatedContact){
        foreach($this->contacts as &$contact){
            if($contact->$id == $id){
                $contact = $updatedContact;
                return true;
            }
        }

        return false;
    }

    public function deleteContact($id){
        foreach($this->contacts as $key => $contact){
            if($contact->id == $id) {
                unset($this->contacts[$key]);
                return true;
            }
        }
        return false;
    }
}
?>