<?php
class Contact{
    private $id;
    private $image;
    private $name;
    private $email;
    private $phoneNumber;
    private $category;
   

    public function __construct($id, $image, $name, $email, $phoneNumber, $category)
    {
        $this->id = $id;
        $this->image = $image;
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->category = $category;
        
    }
    //getters
    public function getId(){
        return $this->id;
    }

    public function getImage(){
        
        return $this->image;
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

   

    //setters

    public function setId($id){
        $this->id = $id;
    }
    public function setImage($img){
        $this->image =$img;
    }

    public function setName($name){
       $this->name = $name;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setPhoneNumber($phoneNumber){
        $this->phoneNumber = $phoneNumber;
    }

    public function setCategory($category){
        $this->category = $category;
    }
    
}
?>