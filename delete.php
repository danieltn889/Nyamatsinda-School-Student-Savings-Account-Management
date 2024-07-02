<?php
include 'db.php';
$Sid = $_GET['Sid'];
$sql = "DELETE FROM student_tbl WHERE Sid='$Sid'";
$stts = $db->prepare($sql);
$stts->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        h2 {
            color: #4CAF50;
        }
        p {
            color: #f44336;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    if ($stts->rowCount()) {
        echo "<h2>Successfully Deleted</h2>";
        echo "<script>setTimeout(function() { window.location.href = 'view_students.php'; }, 2000);</script>";
    } else {
        echo "<h2>Failed to Delete</h2>";
        echo "<p>Data is used in another table.</p>";
        echo "<button onclick=\"window.location.href='view_students.php'\">Go Back</button>";
    }
    ?>
</div>

</body>
</html>
