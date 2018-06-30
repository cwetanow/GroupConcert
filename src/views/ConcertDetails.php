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
                                <?php 
                                if(isset($current_user) && $current_user !== $concert->getHostId() && !$isUserParticipant)
                                    {if($concert->hasEmptySlots())
                                    {
                                        if(isset($hasSentRequest) && !$hasSentRequest){
                                        echo '<form class="custom-form float-right" method="post" action="../controllers/JoinConcert.php?id='.$concert->getId().'"><button class="btn btn-lg btn-primary btn-block" type="submit">Join</button></form>';
                                    } else {
                                        echo '<p>You have sent a request to perform to this concert.</p>';
                                        
                                    }}
                                    else
                                    {
                                        echo '<p>This concert is full.</p>';
                                    }
                                }
                                ?>

                                <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
        <div class="col-md-6 px-0">
          <h1 class="display-4 font-italic"><?=$concert->getTitle()?></h1>
          <p class="lead my-3"> <?php 
                                    if($concert->getIsActive())
                                    {
                                        echo '<p>'.date('l, jS \of F, Y h:i:s A', strtotime($concert->getDate())).'</p>';
                                        echo '<p>'.$concert->getJoinedSpots()."/".$concert->getSpots().'</p>';
                                    }
                                    else
                                    {
                                        echo '<p>This concert has finished.</p>';
                                    }
                                ?></p>
          <p class="lead mb-0">  <?php 
                              echo '<h3>'.$concert->getAddress().', '.$concert->getCity().'</h3>';
                              echo '<h3>By '.$concert->getHost().'</h3>';
                             ?></p>
        </div>
      </div>
                          <header>
                                <h1></h1>
                               
                            </header>

                           

                              <?php 
                                   if($concert->getPerformerId())
                                    {
                                        echo '<p>'.$concert->getPerformer().'</p>';
                                    }
                                    else if(isset($perform_requests))
                                    {
                                        echo 'Perform requests';
                                        foreach($perform_requests as $perform_request)
                                            {
                                             echo '<form class="custom-form" method="post" action="../controllers/ApproveRequest.php?id='.$concert->getId().'&userId='.$perform_request->getId().'"><button class="btn btn-lg btn-primary btn-block" type="submit">Approve</button></form>';
                                                      echo '<br><form class="custom-form" method="post" action="../controllers/RejectRequest.php?id='.$concert->getId().'&userId='.$perform_request->getId().'"><button class="btn btn-lg btn-primary btn-block" type="submit">Reject</button></form>';
                                            }
                                    } else if(isset($hasSentRequest) && !$hasSentRequest && !$isUserParticipant){
                                        echo '<form class="custom-form float-right" method="post" action="../controllers/PostPerformRequest.php?id='.$concert->getId().'"><button class="btn btn-lg btn-primary btn-block" type="submit">Perform</button></form>';
                                      }
                                ?>
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