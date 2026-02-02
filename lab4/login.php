<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $result = $conn->query(
        "SELECT id, name, password FROM users WHERE email='$email'"
    );

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
        } else {
            $error = "Wrong password";
        }
    } else {
        $error = "User not found";
    }
}
?>

<!DOCTYPE html>
<html>
<body>

<h2 style="font-family:lucida; text-align:center; font-size:34px">Login</h2>

<?php if (!empty($error)) echo "<p style='color:red; text-align:center'>$error</p>"; ?>

<?php if (isset($_SESSION["user_id"])): ?>

  <h3 style="font-family:lucida; text-align:center">Welcome <?php echo $_SESSION["user_name"]; ?> 🎉</h3>
  <p style="text-align:center"><strong>Your ID:</strong> <?php echo $_SESSION["user_id"]; ?></p>
  <button style="padding:10px 15px; background-color:red; color:white; border:none; border-radius:5px; box-shadow:0 2px 5px rgba(0,0,0,0.2); cursor:pointer; margin-left:545px;"><a href="logout.php" style="color:white; text-decoration:none;">Logout</a></button>

<?php else: ?>

<form method="POST" style="max-width:400px; margin:auto; padding:20px; border:1px solid #ccc; border-radius:10px; box-shadow:0 2px 5px rgba(0,0,0,0.1)">
  <input name="email" type="email" placeholder="Email" required style="width:90%; padding:10px; margin:5px 0; border:1px solid #ccc; border-radius:5px;">
  <input name="password" type="password" placeholder="Password" required style="width:90%; padding:10px; margin:5px 0; border:1px solid #ccc; border-radius:5px;">
  <button type="submit" style="padding:10px 45px; background-color:green; color:white; border-radius:10px; cursor:pointer; border:1px solid green; box-shadow:0 2px 5px rgba(0,0,0,0.2); align-text:center; margin-left:130px; margin-top:20px;">Login</button>
</form>

<p style="text-align:center; margin-top:15px;">
  New user?
  <a href="register.php">Register</a>
</p>

<?php endif; ?>

</body>
</html>
