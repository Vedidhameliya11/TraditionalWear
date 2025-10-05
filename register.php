<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];

    // Save data to a file
    $data = "Name: $fullname | Email: $email | Phone: $phone | Course: $course\n";
    file_put_contents("registrations.txt", $data, FILE_APPEND);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration Confirmation</title>
  <link rel="stylesheet" href="register.css">
</head>
<body>
  <center>
    <h2>Registration Successful!</h2>
    <p><b>Name:</b> <?php echo htmlspecialchars($fullname); ?></p>
    <p><b>Email:</b> <?php echo htmlspecialchars($email); ?></p>
    <p><b>Phone:</b> <?php echo htmlspecialchars($phone); ?></p>
    <p><b>Course Selected:</b> <?php echo htmlspecialchars($course); ?></p>

    <br><a href="register.html">Go Back</a>
  </center>
</body>
</html>
