<?php
class contact{
    public $id;
    public $name;
    public $phoneNumber;
    public $email;
    public $category;
    public $image;

    public function __construct($id, $name,$category, $email, $phoneNumber, $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->category = $category;
        $this->image = $image;
    }


    public function getContactDetails(){
        return [
            "id" => $this->id,
            "name" => $this->name,
            "phoneNumber" => $this->phoneNumber,
            "email" => $this->email,
            "image" => $this->image

        ];
    }
}
?>