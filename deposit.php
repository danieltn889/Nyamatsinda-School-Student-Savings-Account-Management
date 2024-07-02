<?php
include 'db.php';

session_start();

$Sid = $_GET['Sid'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_SESSION["fname"];
    $lname = $_SESSION["lname"];
    $balance = $_SESSION['balance'];
    $Sid2 = $_SESSION["Sid"];
    $savings = $_POST["savings"];
    $newBalance = $balance + $savings;

    // Update student's savings balance
    $sql = "UPDATE student_tbl SET savings='$newBalance' WHERE Sid='$Sid2'";
    $up = $db->prepare($sql);

    if ($up->execute()) {
        // Insert transaction record into added_money_tbl
        $tdate = date("Y-m-d");
        $insert = $db->prepare("INSERT INTO added_money_tbl (Sid, fname, lname, added_amount, tdate) VALUES ('$Sid2', '$fname', '$lname', '$savings', '$tdate')");
        
        if ($insert->execute()) {
            echo "<script>window.alert('Successfully Deposited Money')</script>";
            echo "<script>window.location.href='view_students.php'</script>";
            exit();
        } else {
            echo "<script>window.alert('Failed To Deposit Money')</script>";
            echo "<script>window.history.back()</script>";
        }
    } else {
        echo "<script>window.alert('Error in Updating Record')</script>";
        echo "<script>window.history.back()</script>";
    }
}

// Retrieve student's details for display and initial balance
$sql = "SELECT * FROM student_tbl WHERE Sid='$Sid'";
$stm = $db->prepare($sql);
$stm->execute();

if ($stm->rowCount() > 0) {
    $row = $stm->fetch(PDO::FETCH_ASSOC); // Fetch single row since Sid is unique
    
    // Store necessary values in session
    $_SESSION["fname"] = $row['fname'];
    $_SESSION["lname"] = $row['lname'];
    $_SESSION["Sid"] = $row['Sid'];
    $_SESSION["balance"] = $row['savings'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Deposit Form</title>
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
        input[type="number"] {
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
        .balance {
            font-weight: bold;
            margin-bottom: 10px;
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
    <h2>Deposit Form</h2>
    <div>
        <p><strong>Name:</strong> <?php echo $row['fname'] . ' ' . $row['lname']; ?></p>
        <p><strong>Class:</strong> <?php echo $row['class']; ?></p>
        <p><strong>Gender:</strong> <?php echo $row['gender']; ?></p>
        <p><strong>Current Balance:</strong> $<?php echo number_format($row['savings'], 2); ?></p>
    </div>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?Sid=' . $Sid; ?>">
        <input type="hidden" value="<?php echo $row['Sid'] ?>" name="Sid" readonly>
        <input type="hidden" value="<?php echo $row['savings'] ?>" name="balance" readonly>
        <input type="hidden" value="<?php echo $row['fname'] ?>" name="fname" readonly>
        <input type="hidden" value="<?php echo $row['lname'] ?>" name="lname" readonly>
        
        Amount Deposit: <input type="number" step="0.01" name="savings" required><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <div class="back-button">
        <a href="view_students.php">Back to Students</a>
    </div>
</div>

</body>
</html>
<?php
}
?>
