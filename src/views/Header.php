<header class="masthead mb-auto">
        <div class="inner">
          <h3 class="masthead-brand">Group Concert</h3>
          <nav class="nav nav-masthead justify-content-center">
          <?php
            if($_SESSION['current_user_id']){
            } else{
              echo '<a class="nav-link" href="./Register.php">Register</a>';
              echo '<a class="nav-link" href="./Login.php">Login</a>';
            }
          ?>
          </nav>
        </div>
      </header>