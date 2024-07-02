<?php
include "db.php";
$sql = "SELECT * FROM student_tbl";
$stm = $db->prepare($sql);
$stm->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students Records</title>
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
            width: 80%;
            max-width: 800px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        a {
            text-decoration: none;
            color: #4CAF50;
        }
        a:hover {
            text-decoration: underline;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .button-container a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            text-align: center;
        }
        .button-container a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>All Students</h1>
        <div class="button-container">
            <a href="student_register.php">Register New Student</a>
            <a href="index.php">Go to Index</a>
            <a href="view_transactions.php">View Transactions</a>
        </div>
        <table>
            <tr>
                <th>Name</th>
                <th>Gender</th>
                <th>Class</th>
                <th>Department</th>
                <th>Savings</th>
                <th colspan="4">Action</th>
            </tr>
            <?php
            if ($stm->rowCount() > 0) {
                foreach ($stm as $row) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['fname'] . " " . $row['lname']); ?></td>
                        <td><?php echo htmlspecialchars($row['gender']); ?></td>
                        <td><?php echo htmlspecialchars($row['class']); ?></td>
                        <td><?php echo htmlspecialchars($row['department']); ?></td>
                        <td><?php echo htmlspecialchars($row['savings']); ?></td>
                        <td><a href="edit_student.php?Sid=<?php echo $row['Sid']; ?>">Edit</a></td>
                        <td><a href="delete.php?Sid=<?php echo $row['Sid']; ?>">Delete</a></td>
                        <td><a href="deposit.php?Sid=<?php echo $row['Sid']; ?>">Deposit</a></td>
                        <td><a href="withdraw.php?Sid=<?php echo $row['Sid']; ?>">Withdraw</a></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='9'>No records found</td></tr>";
            }
            ?>
        </table>
        
    </div>
</body>
</html>
