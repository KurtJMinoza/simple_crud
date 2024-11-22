  <?php
    include "db_connect.php";
    $erru = $errp = $erre = $erra = $errd = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = mysqli_real_escape_string($conn, $_POST["username"]);
      $password = mysqli_real_escape_string($conn, $_POST["password"]);
      $email = mysqli_real_escape_string($conn, $_POST["email"]);
      $age = mysqli_real_escape_string($conn, $_POST["age"]);
      $address = mysqli_real_escape_string($conn, $_POST["address"]);
      
      //FORM VALIDATION
      if(empty($username) || strlen($username) < 5) {
        $erru = "Please Enter Valid Username";
      }
      if(empty($password) || strlen($password) < 8) {
        $errp = "Password Must Be 8 Characters And Above";
      }
      if( empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erre = "Invalid Email";
      }
      if(empty($age) || $age < 5) {
        $erra = "Age Must Be 5 And Above";
      }
      if(empty($address)) {
        $errd = "Address Must Not Be Blank";
      }

      if(empty($erru) && empty($errp) && empty($erre) && empty($erra) && empty($errd)) {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        $sqlinsert = mysqli_prepare($conn, "INSERT INTO `sample`( `username`, `password`, `email`, `address`, `age`) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($sqlinsert, "ssssi", $username, $password_hashed, $email, $address, $age);
        $sqlexecute = mysqli_stmt_execute($sqlinsert);
        if($sqlexecute) {
          echo "Record Added Successfully!";
          header("Location: read.php");
          exit();
        }
        else {
          echo "Error!" . mysqli_error($conn);
        }

      }
    }
  ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Basic Forms</title>
</head>
<body>

<style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      margin: 0;
      padding: 0;
    }
    form {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      flex-direction: column;
      background-color: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 300px;
      margin: 0 auto;
    }
    input, textarea {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      font-size: 14px;
    }
    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #45a049;
    }
    span {
      color: red;
      font-size: 12px;
    }
    textarea {
      resize: vertical;
      min-height: 100px;
    }
    h2 {
      color: #333;
      font-size: 24px;
      margin-bottom: 20px;
    }
  </style>
  <form method="post">
    <input type="text" name="username" placeholder="Enter Username">
    <span style="color: red;"><?php echo $erru ?></span>
    <br>
    <input type="password" name="password" placeholder="Enter Password">
    <span style="color: red;"><?php echo $errp?></span>
    <br>
    <input type="text" name="email" placeholder="Enter Email">
    <span style="color: red;"><?php echo $erre ?></span>
    <br>
    <input type="number" name="age" placeholder="Enter Age">
    <span style="color: red;"><?php echo $erra ?></span>
    <br>
    <textarea name="address" id="" cols="30" rows="10" placeholder="Enter Address"></textarea>
    <span style="color: red;"><?php echo $errd ?></span>
    <br>
    <input type="submit" value="Submit">
  </form>
  
</body>
</html>