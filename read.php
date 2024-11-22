<?php
 include "db_connect.php";

 $sqlread = mysqli_query($conn, "SELECT * FROM `sample`");

  if(mysqli_num_rows($sqlread) > 0) {
    echo "<table>
          <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Age</th>
            <th>Address</th>
            <th>Actions</th>
          </tr>";
    while($row = mysqli_fetch_assoc($sqlread)) {
      echo "<tr>
            <td>{$row["username"]}</td>
            <td>{$row["email"]}</td>
            <td>{$row["age"]}</td>
            <td>{$row["address"]}</td>
            <td>
              <a href='edit.php'>Edit</a>
               <a href='delete.php?id={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
            </td>
          </tr>";
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Read</h1>
  <a href="index.php" class="add">Add Data</a>
  <style>
    .add {
      padding: 10px 5px;
      border: 1px solid #000;
      cursor: pointer;
      font-weight: bold;
      text-underline: none;
    }
     table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
  </style>

  <a href=""></a>
</body>
</html>