<?php
include 'db.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $gender = $_POST["gender"];
    $class = $_POST["class"];
    $department = $_POST["department"];
    $savings = $_POST["savings"];

    $sql = "INSERT INTO Student_tbl (fname, lname, gender, class, department, savings)
    VALUES (:fname, :lname, :gender, :class, :department, :savings)";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':class', $class);
    $stmt->bindParam(':department', $department);
    $stmt->bindParam(':savings', $savings);

    if ($stmt->execute()) {
        echo "<script>alert('New record created successfully');</script>";
        echo "<script>window.location.href='view_students.php'</script>";
    } else {
        echo "<script>alert('Error: Unable to create record');</script>";
        echo "<script>window.history.back()</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Student Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label, input, select {
            margin-bottom: 10px;
        }
        input[type="text"], input[type="number"], select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="radio"] {
            margin-right: 10px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .back-button {
            text-align: center;
            margin-top: 20px;
        }
        .back-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }
        .back-button a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Student Registration Form</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" required>

        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" required>

        <label>Gender:</label>
        <label><input type="radio" name="gender" value="M" required> Male</label>
        <label><input type="radio" name="gender" value="F" required> Female</label>

        <label for="class">Class:</label>
        <input type="text" id="class" name="class" required>

        <label for="department">Department:</label>
        <select id="department" name="department" required>
            <option value="NET">NET</option>
            <option value="SOD">SOD</option>
            <option value="TOUR">TOUR</option>
            <option value="HOTL">HOTL</option>
            <option value="ACC">ACC</option>
        </select>

        <label for="savings">Savings:</label>
        <input type="number" id="savings" name="savings" step="0.01" required>

        <input type="submit" name="submit" value="Submit">
    </form>
    <div class="back-button">
        <a href="view_students.php">Back to Students</a>
    </div>
</div>

</body>
</html>
