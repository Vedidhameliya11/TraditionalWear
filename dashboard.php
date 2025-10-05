<?php
session_start();
if (!isset($_SESSION['username']) && isset($_COOKIE['username'])) {
  $_SESSION['username'] = $_COOKIE['username'];
}

if (!isset($_SESSION['username'])){
  header('Location: login.php');
  exit();
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard | TraditionWear</title>
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
        Welcome, <strong><?php echo htmlspecialchars($username); ?></strong> |
        <a href="logout.php">Logout</a>
      </td>
    </tr>
  </table>
  <hr>

  <center>
    <h2>Welcome back, <?php echo htmlspecialchars($username); ?> 🎉</h2>
    <p>This is your protected dashboard.</p>
  </center>

</body>
</html>
