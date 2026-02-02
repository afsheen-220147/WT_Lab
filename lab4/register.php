<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password)
            VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql)) {
        $success = "Registration successful. Please login.";
    } else {
        $error = "User already exists";
    }
}
?>

<!DOCTYPE html>
<html>
<body style="font-family:sans-serif">

<h2 style="font-family:lucida; text-align:center; font-size:34px">Register as new user!</h2>

<?php if (!empty($success)) echo "<p style='color:green; text-align:center;'>$success</p>"; ?>
<?php if (!empty($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>

<form method="POST" style="max-width:400px; margin:auto; padding:20px; border:1px solid #ccc; border-radius:10px; box-shadow:0 2px 5px rgba(0,0,0,0.1)">
  <input name="name" placeholder="Name" required style="width:90%; padding:10px; margin:5px 0; border:1px solid #ccc; border-radius:5px;">
  <input name="email" type="email" placeholder="Email" required style="width:90%; padding:10px; margin:5px 0; border:1px solid #ccc; border-radius:5px;">
  <input name="password" type="password" placeholder="Password" required style="width:90%; padding:10px; margin:5px 0; border:1px solid #ccc; border-radius:5px;">
  <button type="submit" style="padding:10px 15px; background-color:green; color:white; border:none; border-radius:5px; box-shadow:0 2px 5px rgba(0,0,0,0.2); text-align:center; margin-left:130px; margin-top:20px; cursor:pointer;">REGISTER</button>
</form>

<p style="text-align:center; margin-top:15px;">
  Already registered?
  <a href="login.php">Login</a>
</p>

</body>
</html>
