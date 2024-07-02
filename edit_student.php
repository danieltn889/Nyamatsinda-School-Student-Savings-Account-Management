<?php
include 'db.php';

if (!isset($_GET['Sid'])) {
    header('location: view_students.php');
    exit(); // Ensure script stops execution after redirection
} else {
    $Sid = $_GET['Sid'];
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $gender = $_POST["gender"];
    $Sid2 = $_POST["Sid"];
    $class = $_POST["class"];
    $department = $_POST["department"];
    $savings = $_POST["savings"];
    
    $sql2 = "SELECT * FROM student_tbl WHERE Sid='$Sid'";
    $stm2 = $db->prepare($sql2);
    $stm2->execute();
    if ($stm2->rowCount() > 0) {
        foreach ($stm2->fetchAll() as $row2) {
            $balance = $row2['savings'];
            $newBalance = $balance + $savings;
            $sql3 = "UPDATE student_tbl SET savings='$newBalance' WHERE Sid='$Sid2'";
        }
        echo "<script>window.alert('Sid already exists')</script>";
        header('location: view_students.php');
        exit();
    }

    $sql = "UPDATE student_tbl SET fname='$fname', lname='$lname', gender='$gender', class='$class', department='$department', savings='$savings' WHERE Sid='$Sid2'";

    $stmt = $db->prepare($sql);

    if ($stmt->execute()) {
        echo "<script>alert('Record updated successfully');</script>";
        echo "<script>window.location.href='view_students.php'</script>";
    } else {
        echo "<script>alert('Error: Unable to update record');</script>";
        echo "<script>window.history.back()</script>";
    }
}

$sql = "SELECT * FROM student_tbl WHERE Sid='$Sid'";
$stm = $db->prepare($sql);
$stm->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Student</title>
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
        }
        h2 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"],
        input[type="number"],
        select {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .gender-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .back-button {
            text-align: center;
            margin-top: 10px;
        }
        .back-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ccc;
            color: black;
            border-radius: 5px;
            text-decoration: none;
        }
        .back-button a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Student</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?Sid=' . $Sid; ?>">
        <?php
        foreach ($stm->fetchAll() as $row) {
        ?>
        <input type="hidden" value="<?php echo $row['Sid'] ?>" name="Sid">
        First Name: <input type="text" name="fname" value="<?php echo $row['fname'] ?>"><br>
        Last Name: <input type="text" name="lname" value="<?php echo $row['lname'] ?>"><br>
        <div class="gender-group">
            Gender: 
            <input type="radio" name="gender" value="M" <?php if ($row['gender'] == 'M') echo 'checked'; ?>>Male
            <input type="radio" name="gender" value="F" <?php if ($row['gender'] == 'F') echo 'checked'; ?>>Female
        </div>
        Class: <input type="text" name="class" value="<?php echo $row['class'] ?>"><br>
        Department:
        <select name="department">
            <option value="<?php echo $row['department'] ?>" selected><?php echo $row['department'] ?></option>
            <option value="NET">NET</option>
            <option value="SOD">SOD</option>
            <option value="TOUR">TOUR</option>
            <option value="HOTL">HOTL</option>
            <option value="ACC">ACC</option>
        </select><br>
        Savings: <input type="number" step="0.01" name="savings" value="<?php echo $row['savings'] ?>"><br>
        <?php
        }
        ?>
        <input type="submit" name="submit" value="Submit">
    </form>

    <div class="back-button">
        <a href="view_students.php">Back to Students</a>
    </div>
</div>

</body>
</html>
