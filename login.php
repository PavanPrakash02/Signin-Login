<?php
require_once "config.php";
require_once "session.php";
error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {



$email = trim($_POST['email']);
$password = trim($_POST['password']);i
if (empty($email)) {

$error .= '<p class="error">Please enter email.</p>';
}
// validate if password is empty

if (empty($password)) {
$error .= '<p class="error">Please enter your password.</p>';
}

if (empty($error)) {
if($query = $db->prepare("SELECT * FROM users WHERE email = ?")) { 
    $query->bind_param('s', $email);

$query->execute();

$row = $query->fetch();

if ($row) {
if (password_verify($password, $row['password'])) {
     $_SESSION["userid"] = $row['id'];

$_SESSION["user"] = $row;

// Redirect the user to welcome page 
header("location: session.php");

exit;

} else {

$error .= '<p class="error">The password is not valid.</p>'; }
} else {
$error .= '<p class="error">No User exist with that email address.</p>';
}
} $query->close();
}
// Close connection

mysqli_close($db);
}
?>