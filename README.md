# phoneBook_app

PhoneBook App is a simple PHP application for managing contacts. It allows users to add, edit, view and delete contacts with their details including name, email, category and profile picture. This uses a database for storage and is built using Object-Oriented Programming (OOP) principle PHP.

# Features
  .Add new contacts with name , email, phone number, category and profile picture
  .Edit existant contacts
  .Delete contacts
  .View all contacts in a list

# Requirements

  .PHP 8.3 or higher
  .MySQL database
  .Apache Web Server

# File Structure

/

├── index.php       &emsp; &emsp;      # Landing page displaying the list of contacts

├── addContact.php    &emsp; &emsp;         # Page for creating a new contact

├── editContact.php       &emsp; &emsp;        # Page for editing an existing contact

├── viewContact.php     &emsp; &emsp;       # Page for viewing details of a contact

├── deleteContact.php     &emsp; &emsp;        # Script to handle contact deletion

├── db.conn.php     &emsp; &emsp;        # File containing database connection information

├── Contact.php     &emsp; &emsp;       # Contact class definition

├── ContactManager.php  &emsp; &emsp;   # Class for managing contacts and perform CRUD operations

├── css

&emsp; &emsp; └── styleIndex.css     &emsp; &emsp;         # Stylesheet for the index.php page
&emsp; &emsp; └── styleAddContact.css     &emsp; &emsp;         # Stylesheet for the addContact.php and editContact.php file
&emsp; &emsp; └── styleViewContact.css     &emsp; &emsp;         # Stylesheet for the viewContact.php file
 
├── css

&emsp; &emsp; └── images/    &emsp; &emsp;         # upload images

└── README.md        &emsp; &emsp;      # Project documentation