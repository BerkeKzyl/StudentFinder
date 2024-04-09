<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Screen</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>

<div class="login-container">
  <h2>Login Screen</h2>
  <form action="#" method="post">
    <div class="input-group">
      <label for="username">Username:</label>
      <input type="text" id="username" name="Account" required>
    </div>
    <div class="input-group">
      <label for="password">Password:</label>
      <input type="password" id="password" name="Password" required>
    </div>
    <button type="submit" class="login-btn">Login</button>
  </form>
</div>

</body>
</html>


<?php
include("Connectionlgn.php");

// When form sent
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["Account"];
    $password = $_POST["Password"];

    $sql = "SELECT * FROM accounts WHERE Account = ? AND Password = ?";
    
    $stmt = $baglan->prepare($sql);
    
    // connect parameters
    $stmt->bind_param("ss", $username, $password);
    
    // Start
    $stmt->execute();
    
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: welcome.php");
        exit();
    } else {
        echo "<script>alert('Your account could not be found!')</script>";
    }

    $stmt->close();
    $baglan->close();
}

?>



