<?php

session_start();
include("dbconn.php");


if(isset($_POST["action"])) {
  unset($_SESSION["ERR"]);
  switch($_POST["action"]) {
    case "login": login(); break;
    case "register": register(); break;
    case "logout": logout(); break;
    default: logout(); break;
  }
}
else {
  header("Location: login.php");
}


function register() {
  $dbc = connect_to_db("workoutapp");
  $username = $_POST["username"];
  $password = sha1($_POST["password"]);
  $sql = "select * from users where user_name=\"$username\"";
  $result = perform_query($dbc, $sql);
  if(mysqli_num_rows($result) > 0)
  {
    $_SESSION["ERR"] = "User is already registered";
    disconnect_from_db($dbc,$result);
    header("Location: login.php");
    die();
  }
  mysqli_free_result($result);
  $sql = "insert into users (user_name,password) values (\"$username\",\"$password\");";
  $result = perform_query($dbc, $sql);
  if($result == FALSE) {
    echo "<h1>Insert Failed</h1>";
  }
  else {
    $_SESSION["user"] = $username;
    set_cookie($dbc);
    header("Location: index.php");
  }
}

//Still needs to be tested
function login() {

  $dbc = connect_to_db("workoutapp");
  if(isset($_COOKIE["key"]) && !empty($_COOKIE["key"])) {
    $key = $_COOKIE["key"];
    $sql = "select * from cached_logins where id=\"$key\""; //Check and see if cookie exists
    $result = perform_query($dbc, $sql);
    if(mysqli_num_rows($result) > 0) { //Cookie is already set
      disconnect_from_db($dbc,$result);
      header("Location: index.php");
    }
    else {
      disconnect_from_db($dbc,$result);
      $_SESSION["ERR"] = "Hashed cookie id not found";
      header("Location: login.php");
    }
  }
  else { //Checks username and password
    if(isset($_POST["username"])) {
      $username = $_POST["username"];
      $password = sha1($_POST["password"]);
      $sql = "select * from users where user_name=\"$username\" and password=\"$password\";";
      $result = perform_query($dbc, $sql);
      if(mysqli_num_rows($result) > 0) {
        $_SESSION["user"] = $username;
        set_cookie($dbc);
      }
      else {
        $_SESSION["ERR"] = "Username/pw not found";
        header("Location: login.php");
      }
    }
    else {
      $_SESSION["ERR"] = "Username not set";
      header("Location: login.php");
    }
  }
}

function logout() {
  setcookie("key");
  setcookie (session_id());
  header("Location: login.php");
}

function set_cookie($dbc) {
  include("hashid.php");
  $user = $_SESSION["user"];
  $sql = "select id from users where user_name=\"$user\";";
  $result = perform_query($dbc, $sql);
  $row = mysqli_fetch_row($result);
  $id = $row[0];
  $_SESSION["id"] = $id;
  mysqli_free_result($result);
  $key = generate_hash();
  $_COOKIE["key"] = $key;
  $sql = "insert into cached_logins (id, user) values (\"$key\", \"$id\");";
  $result = perform_query($dbc, $sql);
  if(!$result) {
    echo "<h1>Insert failed</h1>";
  }
  else {
    header("Location: index.php");
  }
}
?>
