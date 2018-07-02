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
    <?php
include '../views/Header.php';
?>

      <main role="main" class="inner cover">
                                <?php
if (isset($current_user) && $current_user !== $concert->getHostId()) {
    if ($concert->hasEmptySlots() && !$isUserParticipant) {
        if (isset($hasSentRequest) && !$hasSentRequest) {
            echo '<form class="custom-form float-right" method="post" action="../controllers/JoinConcert.php?id=' . $concert->getId() . '"><button class="btn btn-lg btn-block" type="submit">Join</button></form>';
        }
    } else if ($isUserParticipant) {
        echo '<p>You have joined this concert.</p>';
    } else {
        echo '<p>This concert is full.</p>';
    }
}
?>

<div class="float-right">
                                <?php
if (isset($current_user) && $current_user === $concert->getHostId()) {
    // echo '<a class="btn btn-lg" href="../controllers/GetEditConcert.php?id=' . $concert->getId() . '"><button class="btn btn-lg" type="submit">Edit</button></a>';
            echo '<form method="post" action="../controllers/DeleteConcert.php?id=' . $concert->getId() . '"><button class="btn btn-danger btn-lg" type="submit">Delete</button></form>';
}
?></div>

                                <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
        <div class="col-md-6 px-0">
          <h1 class="display-4 font-italic"><?= $concert->getTitle() ?></h1>
          <p class="lead my-3"> <?php
if ($concert->getIsActive()) {
    echo '<p>' . date('l, jS \of F, Y h:i:s A', strtotime($concert->getDate())) . '</p>';
    echo '<p>' . $concert->getJoinedSpots() . "/" . $concert->getSpots() . '</p>';
} else {
    echo '<p>This concert has finished.</p>';
}
?></p>
          <p class="lead mb-0">  <?php
echo '<h3>' . $concert->getAddress() . ', ' . $concert->getCity() . '</h3>';
echo '<h3>By ' . $concert->getHost() . '</h3>';
?></p>

                               <p class="lead mb-0">  <?php
if ($concert->getPerformerId()) {
    echo '<p>' . $concert->getPerformer() . ' is performing</p>';
} else {
    echo '<p>Performer not selected</p>';
}
?></p>
        </div>
      </div>
                                    <?php
if (!$concert->getPerformerId() && isset($hasSentRequest) && !$hasSentRequest && !$isUserParticipant) {
    echo '<form class="custom-form float-right" method="post" action="../controllers/PostPerformRequest.php?id=' . $concert->getId() . '"><button class="btn btn-lg btn-block" type="submit">Perform</button></form>';
} else if ($current_user === $concert->getPerformerId()) {
    echo '<p>You are performing at this concert.</p>';
} else if (isset($hasSentRequest) && $hasSentRequest){
    echo '<p>You have sent a request to perform at this concert.</p>';
}
?>

                    <?php
if (!$concert->getPerformerId() && isset($current_user) && $current_user === $concert->getHostId()):
?>  <table class="table">
                      <thead>
                  <tr>
                    <th>Perform requests</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                          <tbody>
                          <?php
    if (!$concert->getPerformerId() && isset($perform_requests)) {
        foreach ($perform_requests as $perform_request) {
            echo '<tr><td>' . $perform_request->getUsername() . '</td><td><form method="post" action="../controllers/ApproveRequest.php?id=' . $concert->getId() . '&userId=' . $perform_request->getId() . '"><button class="btn btn-sm btn-block" type="submit">Approve</button></form></td>';
            echo '<td><form method="post" action="../controllers/RejectRequest.php?id=' . $concert->getId() . '&userId=' . $perform_request->getId() . '"><button class="btn btn-sm btn-block" type="submit">Reject</button></form></td></tr>';
        }
    }
?>
                         </tbody>
                      </table><?php
endif;
?>

 <?php
if (isset($current_user) && ($current_user === $concert->getHostId() || $isUserParticipant)):
?>
<div id="comments">
    <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
            <?php
  echo ' <form method="post" action="../controllers/PostComment.php?id='.$concert->getId().'"><div class="form-group"><textarea class="form-control" id="comment_text" name="comment_text" required rows="3"></textarea></div><button type="submit" class="btn ">Submit</button></form>';
?>
             
            </div>
          </div>

                <?php
    if (isset($comments)) {
        foreach ($comments as $comment) {
         echo '<div class="media mb-4"><div class="media-body"><h5 class="mt-0">'.$comment->getUser().'</h5>'.$comment->getCommentText().'</div></div>';  
        }
    }
?></div><?php
endif;
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