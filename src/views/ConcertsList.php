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

    <style>
      .card, .card a {
        color: #333;
      }
    </style>

  </head>

  <body class="text-center">

    <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <?php include '../views/Header.php'?>

      <main role="main" class="inner cover">
<ul class="list-group">
 <?php
                                        if(count($active_concerts) <= 0)
                                        {
                                            echo '<li>There are no active concerts.</li>';
                                        }
                                        else 
                                        {
                                            foreach($active_concerts as $concert)
                                            {
                                             echo '<div class="card" style="width: 33rem;"><div class="card-body"><h5 class="card-title"><a href="./GetConcert.php?id='.$concert->getId().'">'.$concert->getTitle().'</a></h5><h6 class="card-subtitle mb-2 text-muted">'.date('l, jS \of F, Y h:i:s A', strtotime($concert->getDate())).'</h6><p class="card-link">'.$concert->getAddress().', '.$concert->getCity().'</p></div></div><br>';
                                            }
                                        }
                                    ?>
</ul>
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