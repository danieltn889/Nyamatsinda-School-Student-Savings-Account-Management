Nyamatsinda School Student Savings Account Management System
Introduction
This system is designed to manage student savings accounts at Nyamatsinda School. It allows administrators to perform CRUD operations (Create, Read, Update, Delete) on student records and manage transactions such as deposits and withdrawals.

Features
View Students: See a list of all registered students along with their savings balances.
Register New Student: Add a new student to the system with details like name, gender, class, and department.
Edit Student Details: Modify student information such as name, gender, class, and department.
Delete Student: Remove a student from the system.
Deposit Money: Add funds to a student's savings account and record the transaction.
Withdraw Money: Deduct funds from a student's savings account and record the transaction.
View Transactions: Access a history of all transactions (deposits and withdrawals) made by students.
Technologies Used
PHP
PDO (PHP Data Objects) for database operations
MySQL (or your preferred database system)
Setup Instructions
Database Setup:

Ensure you have MySQL installed.
Import the provided database.sql script to create the necessary database and tables (student_tbl, added_money_tbl, took_money_tbl).
Configuration:

Update db.php with your MySQL database credentials ($db_host, $db_name, $db_user, $db_pass).
Run the Application:

Deploy the application on a PHP-enabled web server.
Access the application through the web browser.
How to Use
Managing Students:

Navigate to "View Students" to see all students.
Use "Register New Student", "Edit", or "Delete" links to manage student records.
Managing Transactions:

Use the "Deposit" or "Withdraw" links on the student list to manage savings transactions.
View transaction history via "View Transactions".
Contributions
Contributions are welcome! If you'd like to improve this system, fork the repository and submit a pull request with your changes.
