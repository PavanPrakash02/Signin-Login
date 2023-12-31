
<?php
require_once "config.php";

require_once "session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) { 

 $fullname = trim($_POST['name']);


$email = trim($_POST['email']); 
$password = trim($_POST['password']);

$confirm_password = trim($_POST["confirm_password"]); 
$password_hash = password_hash($password, PASSWORD_BCRYPT);

if($query = $db->prepare("SELECT * FROM users WHERE email = ?")) {

$error = '';

// Bind parameters (s = string, i int, b = blob, etc), in our case the username is a string so we use "s"

$query->bind_param('s', $email); 
$query->execute();

// Store the result so we can check if the account exists in the database. 
$query->store_result();

if ($query->num_rows > 0) { 
    $error. '<p class="error">The email address is already registered!</p>';

}
else {
    

if (strlen($password) < 6) {



$error .= '<p class="error">Password must have atleast 6 characters.</p>';
}
if (empty($confirm_password)) {

    $error .= '<p class="error">Please enter confirm password.</p>';
 

}


 else {
    

if (empty($error) && ($password != $confirm_password)) {
    $error .= '<p class="error">Password did not match.</p>'; }
}
if (empty($error)) {

$insertQuery = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ? , ?);")

$insertQuery->bind_param("sss", $fullname, $email, $password_hash);

$result = $insertQuery->execute(); 
if ($result) {

$error .= '<p class="success">Your registration was successful!</p>';
} else {
    $error.= '<p class="error">Something went wrong!</p>';
}
}
}
}
$query->close();

$insertQuery->close();

// Close DB connection

mysqli_close($db);
}
?>
   