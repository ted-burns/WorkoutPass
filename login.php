<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["user"]);
?>
<html>
<head>
  <script src="js/jquery.min.js"></script>
  <style>
  #login {
    height: 500px;
    width: 500px;
    background-color: lightblue;
  }
  .err {
    color: red;
  }
  </style>
</head>
<body>
  <?php if(isset($_SESSION["ERR"])) {
    echo "<p class=\"err\">".$_SESSION["ERR"]."</p>";
  }
  ?>
  <form action="login_action.php" method="post">
    Username: <input type="text" name="username" /> <br />
    Password: <input type="text" name="password" /> <br />
    <input type="submit" name="action" value="register" />
    <input type="submit" id="login" name="action" value="login" />
  </form>
</body>
</html>
