<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

$servername = "localhost";
$db_username = "root";   
$db_password = "";       
$dbname = "auth_demo";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$message = "";
$prefillUser = $_COOKIE['remember_user'] ?? "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && $password === $user['password']) {  
        $_SESSION['username'] = $user['username'];

        setcookie("remember_user", $user['username'], time() + (86400 * 30), "/");

        header("Location: dashboard.php");
        exit();
    } else {
        $message = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | TraditionWear</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>

  <table width="100%" border="0" cellpadding="10">
    <tr>
      <td align="left">
        <img src="logo1.jpeg" alt="TraditionWear Logo" width="80" height="80">
      </td>
      <td align="center">
        <h1>TraditionWear</h1>
      </td>
      <td align="right">
        <a href="index.html">Home</a> |
        <a href="register.html">Sign Up</a>
      </td>
    </tr>
  </table>
  <hr>
  <br><br><br>

  <center>
    <h2>Login</h2>

    <?php if (!empty($message)): ?>
      <p style="color:red;font-weight:bold;"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="post" action="">
      <table border="0" cellpadding="10">
        <tr>
          <td>Username:</td>
          <td><input type="text" name="username" value="<?php echo htmlspecialchars($prefillUser); ?>" required></td>
        </tr>
        <tr>
          <td>Password:</td>
          <td>
            <input type="password" name="password"
              required
              minlength="4"
              maxlength="20">
          </td>
        </tr>
        <tr>
          <td colspan="2" align="center">
            <button type="submit">Login</button>
          </td>
        </tr>
      </table>
    </form>
  </center>

</body>
</html>
