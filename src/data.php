<?php
require_once "contact.php";
require_once "contactManager.php";

$Contacts = [
    new Contact(1, "Kenne Suzy", "+237 650 398 429","suzyndatewo@gmail.com", "Family", "assets/images/image1.jpeg"),
    new Contact(2, "Monie Julius", "+237 657 345 123","moniejulius@gmail.com" ,"Friend", "assets/images/image2.jpeg"),
    new Contact(3, "Kenne Suzy", "+237 650 398 429","suzyndatewo@gmail.com", "Family", "assets/images/image1.jpeg"),
    new Contact(4, "Yan Ivan", "+237 657 345 123","yanivan@gmail.com" ,"Friend", "assets/images/image2.jpeg"),
];

$contactManager = new ContactManager($Contacts);
