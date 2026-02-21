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

<?php if (!isset($_SESSION['email']) && !isset($_SESSION['github_user'])): ?>

  <!-- GOOGLE OAUTH LOGIN -->
  <a class="btn"
     href="https://accounts.google.com/o/oauth2/v2/auth?client_id=744841037089-81huto05a599sn58dl2psk78cpgls930.apps.googleusercontent.com&redirect_uri=http%3A%2F%2Flocalhost%2FAUTH%2Flab6%2Fcallback.php&response_type=code&scope=email%20profile">
    Login with Google
  </a>

  <!-- GITHUB LOGIN -->
  <a class="btn"
     href="https://github.com/login/oauth/authorize?client_id=Ov23li27yzABMHOyxWWH">
    Login with GitHub
  </a>

<?php endif; ?>

<?php if (isset($_SESSION['email'])): ?>

  <p><strong>Customer Logged In (Google)</strong></p>
  <p>Name: <?php echo $_SESSION['name']; ?></p>
  <p>Email: <?php echo $_SESSION['email']; ?></p>
  <a class="btn" href="logout.php">Logout</a>

<?php endif; ?>

<?php if (isset($_SESSION['github_user'])): ?>

  <p><strong>Customer Logged In (GitHub)</strong></p>
  <p>Username: <?php echo $_SESSION['github_user']; ?></p>
  <a class="btn" href="logout.php">Logout</a>

<?php endif; ?>

<hr>

<p>
  <a href="student.html">Go to Student Support</a>
</p>

</body>
</html>