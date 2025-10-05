<?php
// users.php — demo "database"
return [
  // username  => password_hash(...)
  'vedi'  => password_hash('Vedi@123', PASSWORD_DEFAULT),
  'admin' => password_hash('Admin@2025', PASSWORD_DEFAULT),
];
?>