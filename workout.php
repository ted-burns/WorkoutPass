<?php
if(!isset($_SESSION["user"]) || !isset($_SESSION["id"])) {
  $_POST["action"] = "logout";
  header("Location: login_action.php");
}

?>
