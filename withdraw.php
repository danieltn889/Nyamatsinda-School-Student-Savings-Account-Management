<?php
include 'db.php';

session_start();

$Sid = $_GET['Sid'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_SESSION["fname"];
    $lname = $_SESSION["lname"];
    $Sid2 = $_SESSION["Sid"];
    $balance = $_SESSION['balance'];
    $savings = $_POST["savings"];
   
    $oldbal = $balance;
    
    if ($savings < 0) {
        echo "<script>window.alert('You can\'t withdraw a negative amount')</script>";
    } else if ($savings > $oldbal) {
        echo "<script>window.alert('You don\'t have enough money')</script>";
    } else if ($savings <= $oldbal) {
        $newbal = $balance - $savings;
        $sql = "UPDATE student_tbl SET savings='$newbal' WHERE Sid='$Sid2'";
        $up = $db->prepare($sql);
        if ($up->execute()) {
            $tdate = date("Y-m-d");
            $insert = $db->prepare("INSERT INTO took_money_tbl (Sid, fname, lname, amount_taken, tdate) VALUES ('$Sid2', '$fname', '$lname', '$savings', '$tdate')");
            $insert->execute();
            
           if ($insert->rowCount()) {
                echo "<script>window.alert('Successfully Withdrawn Money')</script>";
                echo "<script>window.location.href='view_students.php'</script>";
           } else {
               echo "<script>window.alert('Failed To Withdraw Money')</script>";
               echo "<script>window.history.back()</script>";
           }
        } else {
            echo "<script>window.alert('Error in Updating Record')</script>";
            echo "<script>window.history.back()</script>";
        }
    } else {
        echo "<script>window.alert('Invalid input')</script>";
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
    <title>Withdraw Form</title>
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
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        .input-group {
            margin-bottom: 15px;
        }
        .input-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .input-group span {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 10px;
        }
        .input-group input[type="number"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }
        .input-group input[type="submit"] {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            width: 50%;
            margin-left: auto;
            margin-right: auto;
        }
        .input-group input[type="submit"]:hover {
            background-color: #45a049;
        }
        .balance {
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
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
    <h2>Withdraw Form</h2>
    <div class="balance">
        Current Balance: $<?php echo number_format($row['savings'], 2); ?>
    </div>
    <div class="input-group">
        <label>Student Name:</label>
        <span><?php echo $row['fname'] . ' ' . $row['lname']; ?></span>
    </div>
    <div class="input-group">
        <label>Class:</label>
        <span><?php echo $row['class']; ?></span>
    </div>
    <div class="input-group">
        <label>Department:</label>
        <span><?php echo $row['department']; ?></span>
    </div>
    <div class="input-group">
        <label>Gender:</label>
        <span><?php echo $row['gender']; ?></span>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?Sid=' . $Sid; ?>">
        <div class="input-group">
            <input type="hidden" value="<?php echo $row['Sid'] ?>" name="Sid">
            <input type="hidden" value="<?php echo $row['savings'] ?>" name="balance">
            <input type="hidden" value="<?php echo $row['fname'] ?>" name="fname">
            <input type="hidden" value="<?php echo $row['lname'] ?>" name="lname">
        </div>
        <div class="input-group">
            <label>Amount Taken:</label>
            <input type="number" step="0.01" name="savings" required>
        </div>
        <div class="input-group">
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>

    <div class="back-button">
        <a href="view_students.php">Back to Students</a>
    </div>
</div>

</body>
</html>
<?php
}
else {
    echo "<script>window.alert('No student found with this ID')</script>";
    echo "<script>window.location.href='view_students.php'</script>";
}
?>
