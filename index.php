<?php
  include("header.php");
?>
<!Doctype HTML>
<html>
<head>
  <meta charset="utf-8" />
  <title>Home</title>
  <?php header_style(); ?>
</head>
<body>
  <?php
    load_header();
   ?>
   <br />
   <form action="login_action.php" method="post">
     <input type="submit" name="cookies" value="clear cookies" />
   </form>
</body>
</html>
