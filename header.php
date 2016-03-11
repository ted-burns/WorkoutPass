<?php
session_start();


  function load_header() {
    ?>
    <div class="header">
      <div id="content">
        <h1 class="header-hidden">You did not include the stylesheet for the header in this webpage</h1>
        <h1>Workout Coach (Working Title)</h1>
      </div>
      <div id="user_tab">
        <form action="user.php" method="post">
          <div>
          <?php
          if(is_logged_in()) {
            echo "<div id=\"user\" class=\"full\">Logged in as ".$_SESSION["user"]."</div>";
            echo "<div class=\"clickable half user_page\">Account</div>";
            echo "<div class=\"clickable half sign-out\">Sign Out</div>";
          }
          ?>
        </div>
        </form>
      </div>
    </div>
  </div>
    <?php
  }

  function header_style() {
    ?>
    <link href="css/header.css" rel="stylesheet" />
    <script src="js/jquery.min.js"></script>
    <script src="js/header.js"></script>
    <?php
  }

  function is_logged_in() {
    return isset($_SESSION["user"]);
  }
?>
