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

    <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <?php include '../views/Header.php'?>

      <main role="main" class="inner cover">
      <h1><?=$_GET['message']?></h1>
		<section class="error-container">
			<span><?=$_GET['status_code']?></span>
    </section>
    <hr>
		<div class="link-container">
			<button class="btn btn-primary" id="go-back" class="back-link">Go Back</button>
		</div>
      </main>

      <footer class="mastfoot mt-auto">
        <div class="inner">
        <p class="copyright">&copy; WWW 10th ed, Group Concert by I.Mladenov (61950). All rights reserved.</p>
        </div>
      </footer>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/error.js"></script>
  </body>
</html>