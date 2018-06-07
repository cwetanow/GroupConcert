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

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <header class="masthead mb-auto">
        <div class="inner">
          <h3 class="masthead-brand">Group Concert</h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link" href="./Register.php">Register</a>
            <a class="nav-link" href="./Login.php">Login</a>
          </nav>
        </div>
      </header>

      <main role="main" class="inner cover">
        <form class="form-signin" method="post" action="../controllers/Login.php">
      <h1 class="h3 mb-3 font-weight-normal">Login</h1>

      <input type="text" id="username" name="username" class="form-control" placeholder="Username" required > 
      <div class="error">
                                            <?php if(isset($_GET['username']) && $_GET['username'] == 'false'):?>
                                                Username is required and should be unique.
                                            <?php endif?>
                                        </div>
      <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
      <div class="error">
                                            <?php if(isset($_GET['password']) && $_GET['password'] == 'false'):?>
                                                Password is required.
                                            <?php endif?>
                                        </div>
    
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
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