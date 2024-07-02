<?php
//IT_FINAL_EXAM_2024
$dns="mysql:host=localhost;dbname=it_final_exam_2024";
$username="root";
$password="";
$db=new PDO($dns,$username,$password);
?>
<!-- CREATE TABLE Student_tbl (
    Sid INT PRIMARY KEY AUTOINCREMENT,
    fname VARCHAR(50),
    lname VARCHAR(50),
    gender CHAR(1),
    class VARCHAR(10),
    department VARCHAR(50),
    savings DECIMAL(10,2)
);

CREATE TABLE Took_money_tbl (
    Sid INT,
    fname VARCHAR(50),
    lname VARCHAR(50),
    amount_taken DECIMAL(10,2),
    tdate DATE,
    FOREIGN KEY (Sid) REFERENCES Student_tbl(Sid)
);

CREATE TABLE Added_money_tbl (
    Sid INT,
    fname VARCHAR(50),
    lname VARCHAR(50),
    added_amount DECIMAL(10,2),
    tdate DATE,
    FOREIGN KEY (Sid) REFERENCES Student_tbl(Sid)
); -->
