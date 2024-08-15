<?php
class Contact{
    private $id;
    private $name;
    private $phoneNumber;
    private $email;
    private $category;
    private $image;

    public function __construct($id, $name,$category, $email, $phoneNumber, $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->category = $category;
        $this->image = $image;
    }
    //getters
    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPhoneNumber(){
        return $this->phoneNumber;
    }

    public function getCategory(){
        return $this->category;
    }

    public function getImage(){
        return $this->image;
    }

    //setters
    public function setImage(){
        return $this->image;
    }

    public function setName(){
        return $this->name;
    }

    public function setEmail(){
        return $this->email;
    }

    public function setCategory(){
        return $this->category;
    }
    
}
?>