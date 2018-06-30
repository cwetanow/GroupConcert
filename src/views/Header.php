<header class="masthead">
        <div class="inner">
          <h3 class="masthead-brand">Group Concert</h3>
          <nav class="nav nav-masthead justify-content-center">
          <?php
            if(isset($_SESSION['current_user_id'])){
              echo '<a class="nav-link" href="../views/Host.php">Host</a>';
              echo '<a class="nav-link" href="../controllers/GetAllConcerts.php">Concerts</a>';
              echo '<a class="nav-link" href="../controllers/Logout.php">Logout</a>';
             } else{
              echo '<a class="nav-link" href="../views/Register.php">Register</a>';
              echo '<a class="nav-link" href="../views/Login.php">Login</a>';
            }
          ?>
          </nav>
        </div>
      </header>