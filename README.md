# Student Management System (CRUD)

A secure Student Management System built with raw PHP and MySQL.

## Features
* **Create:** Register new students.
* **Read:** View list of students with XSS protection.
* **Update:** Edit student details.
* **Delete:** Remove records.
* **Security:** Password hashing, Session management, SQL Injection protection.

## How to Run (Localhost)
1.  Clone this repo to your XAMPP `htdocs` folder.
2.  Open phpMyAdmin and create a database named `cyber200`.
3.  Import the `cyber200.sql` file located in the root folder.
4.  Configure `insert_data.php` (etc) if your DB credentials differ from root/empty.
5.  Run `register_admin.php` once to create your admin account.
