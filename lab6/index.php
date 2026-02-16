<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Customer Support</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="logo">Afs220147</div>

<h2>Customer Support Portal</h2>

<?php if (!isset($_SESSION['email'])): ?>

  <a href="https://accounts.google.com/o/oauth2/v2/auth?client_id=744841037089-81huto05a599sn58dl2psk78cpgls930.apps.googleusercontent.com&redirect_uri=http%3A%2F%2Flocalhost%2FAUTH%2Flab6%2Fcallback.php&response_type=code&scope=email%20profile">
    Login with Google
  </a>

<?php else: ?>

  <p><strong>Welcome,</strong> <?php echo $_SESSION['name']; ?></p>
  <p><?php echo $_SESSION['email']; ?></p>
  <a href="logout.php">Logout</a>

<?php endif; ?>

</body>
</html>