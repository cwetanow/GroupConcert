<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Group Concert</title>

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="../assets/css/main.css" rel="stylesheet">
  </head>

  <body class="text-center">
  <?php
    session_start();

    if(isset($_SESSION['current_user_id'])){
  echo 12;
  header('Location: ./Home.php');
    }
  ?>
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <?php
include('./Header.php')?>

      <main role="main" class="inner cover">
        <form class="form-signin" method="post" action="../controllers/Register.php">
      <h1 class="h3 mb-3 font-weight-normal">Register</h1>
    
      <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
      <div class="error">
      <?php if(isset($_GET['email']) && $_GET['email'] == 'false'):?>
                                                Email is required and should be valid.
                                            <?php endif?>
                                        </div>
      <input type="text" id="username" name="username" class="form-control" placeholder="Username" required > 
      <div class="error">
                                            <?php if(isset($_GET['username']) && $_GET['username'] == 'false'):?>
                                                Username is required and should be unique.
                                            <?php endif?>
                                        </div>
      <input type="text" id="fullName" name="fullName" class="form-control" placeholder="Full name" required >
      <div class="error">

      <?php if(isset($_GET['full_name']) && $_GET['full_name'] == 'false'):?>
                                                Full name is required.
                                            <?php endif?></div>
      <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
      <div class="error">
                                            <?php if(isset($_GET['password']) && $_GET['password'] == 'false'):?>
                                                Password is required.
                                            <?php endif?>
                                        </div>
      <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm password" required>
      <div class="error">
                                            <?php if(isset($_GET['confirmPassword']) && $_GET['confirmPassword'] == 'false'):?>
                                                Passwords does not match.
                                            <?php endif?>
                                        </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
    </form>
      </main>

      <footer class="mastfoot mt-auto">
        <div class="inner">
        <p class="copyright">&copy; Group Concert. All rights reserved.</p> 
        </div>
      </footer>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
  </body>
</html>