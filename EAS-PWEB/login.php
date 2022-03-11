<?php 
 
include 'config.php';
 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

session_start();

if($_SERVER['REQUEST_METHOD'] != 'POST'){
  die(json_encode([
      "error" => 1,
      "msg" => "Method not allowed",
      "details" => strval(var_dump($_SESSION))
  ]));
}

$id = mysqli_escape_string($db, $_POST['id']);
$password = md5(mysqli_escape_string($db, $_POST['password']));

$result = mysqli_query($db, "SELECT * FROM users WHERE id='$id' AND password='$password'");

if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['user'] = $row;

    if($row['role'] == 'admin'){
      die(json_encode([
        "error" => 0,
        "role" => "admin",
        "status" => "Login Success"
      ]));
    } else if($row['role'] == 'siswa'){
      die(json_encode([
        "error" => 0,
        "role" => "siswa",
        "status" => "Login Success"
      ]));
    } else {
      die(json_encode([
        "error" => 500,
        "role" => "-",
        "status" => "Undefined User Role"
      ]));
    }
} else {
  die(json_encode([
    "error" => 404,
    "role" => "-",
    "status" => "User Not Found"
  ]));
}
 
?>
