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
    <?php session_start();
include './Header.php'?>

      <main role="main" class="inner cover">
      <form class="custom-form" method="post" action="../controllers/Host.php">
      <h1 class="h3 mb-3 font-weight-normal">Host</h1>

      <input type="text" id="title" name="title" class="form-control" placeholder="Title" required >
      <div class="error">
                <?php if (isset($_GET['title']) && $_GET['title'] == 'false'): ?>
                    Title is required
                                            <?php endif?>
                                        </div>

                                         <input type="text" id="city" name="city" class="form-control" placeholder="City" required >
      <div class="error">
                                            <?php if (isset($_GET['city']) && $_GET['city'] == 'false'): ?>
                                                City is required
                                            <?php endif?>
                                        </div>

                                         <input type="text" id="address" name="address" class="form-control" placeholder="Address" required >
      <div class="error">
                                            <?php if (isset($_GET['address']) && $_GET['address'] == 'false'): ?>
                                                Address is required
                                            <?php endif?>
                                        </div>

<input type="datetime-local" step=1 id="date" name="date" class="form-control" placeholder="Date" required >
      <div class="error">
                                            <?php if (isset($_GET['date']) && $_GET['date'] == 'false'): ?>
                                                Date is required
                                            <?php endif?>
                                        </div>

                                         <input type="number" id="spots" name="spots" class="form-control" placeholder="Spots"  >


      <button class="btn btn-lg btn-primary btn-block" type="submit">Host</button>
    </form>
      </main>

      <footer class="mastfoot mt-auto">
        <div class="inner">
        <p class="copyright">&copy; WWW 10th ed, Group Concert by I.Mladenov (61950). All rights reserved.</p>
        </div>
      </footer>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
  </body>
</html>