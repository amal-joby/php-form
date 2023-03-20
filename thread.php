<!doctype html> 
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>

    <!-- header -->
    <?php require './partials/_dbconnect.php';?>
    <?php require './partials/_header.php'; ?>
    <?php
      $threadId = $_GET['threadid'];
      $sql = "SELECT * FROM `threadlist` WHERE `thread_no`='$threadId';";
      $sqlResult = mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($sqlResult);
      $thread_user_id = $row['thread_user_id'];
      $sqlP = "SELECT * FROM `users` WHERE `slno`='$thread_user_id';";
      $sqlResultP = mysqli_query($conn,$sqlP);
      $rowP = mysqli_fetch_assoc($sqlResultP);
      $title = $row['thread_title'];
      $description = $row['thread_description'];
      $posted = $rowP['user_email'];
    ?>
    <?php
      $checkComment = false;
      $userId = '';
      if($_SERVER['REQUEST_METHOD']=='POST'){
        $commentDescription = $_POST['commentDescription'];
        $userId = $_SESSION['UserId'];
        $commentDescription = str_replace("<","&lt;",$commentDescription);
        $commentDescription = str_replace(">","&gt;",$commentDescription);
        $sql = "INSERT INTO `comments`(`comment_desc`,`thread_id`,`user_id`,`comment_tstamp`) VALUES('$commentDescription','$threadId','$userId',current_timestamp());";
        $sqlResult = mysqli_query($conn,$sql);
        if($sqlResult){
          $checkComment = true;
        }
        if($checkComment){
            echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                  <strong>Success!</strong> Your comment has been posted.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>'; 
        }else{
                  echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                  <strong>Sorry!</strong> Your comment hasn"t been posted.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
      }
    ?>

    <!-- question -->
    <div class="container my-3">
      <div class=" mt-4 p-5  text-dark rounded" style="background-color:#E4E5E6;">
        <h1><?php echo $title; ?></h1> 
        <p style="color:#666C72;"><?php echo $description; ?></p> 
        <hr class="my-4">
        <p style="color:#666C72;">This is a peer to peer forum for sharing knowledge with each other. Keep it friendly, Be courteous and respectful. Appreciate that others may have an opinion different from yours. Stay on topic and Share your knowledge. Refrain from demeaning, discriminatory, or harassing behaviour and speech.</p>
        <p>Posted By : <b><?php echo $posted; ?></b></p>
      </div>
    </div>


    <!-- write comment form -->
    <div class="container ">
                <h2>Write Comment</h2>
    <?php 
      if(isset($_SESSION['loggedIn']) &&  $_SESSION['loggedIn']==true){
        echo '
                <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
                  <div class="mb-3">
                    <label for="commentDescription" class="form-label">Comment the Problem</label>
                    <textarea class="form-control" id="commentDescription" name="commentDescription" rows="5"></textarea>
                  </div>
                  <button class="btn btn-success btn-sm">Post Comment</button>
                </form>
              ';
      }else{
        echo '
            <div class="alert alert-warning" role="alert">
              Sorry! Log In to Write Comment.
            </div>
        ';
      }
    ?>
    </div>

    <!-- Discussions -->
    <div class="container my-4 for-footer">
      <h1>Browse Questions</h1>

      <!-- threads of users -->
      <?php
        $sqlC = "SELECT * FROM `comments` WHERE `thread_id`= '$threadId';";
        $sqlResultC = mysqli_query($conn,$sqlC);
        $noComments=true;
        while($rowC = mysqli_fetch_assoc($sqlResultC)){
          $noComments =false;
          $comment_user_id = $rowC['user_id'];
          $sqlCU = "SELECT * FROM `users` WHERE `slno`='$comment_user_id';";
          $sqlResultCU = mysqli_query($conn,$sqlCU);
          $rowCU = mysqli_fetch_assoc($sqlResultCU);
          $userName = $rowCU['user_email'];
          echo '

          <div class="container mt-3">
          <div class="d-flex border p-3">
            <img src="https://cdn.pixabay.com/photo/2016/11/18/23/38/child-1837375_960_720.png" alt="John Doe" class="flex-shrink-0 me-3 mt-3 rounded-circle" style="width:60px;height:60px;">
            <div>
                  <h4>'.$userName.' <small>'.$rowC['comment_tstamp'].'</small></h4>
                  <p>'.$rowC["comment_desc"].'</p>
            </div>
          </div>
        </div>

        ';
        }
        if($noComments){
          echo '
            <div class="container my-3">
              <div class=" mt-4 p-5  text-dark rounded" style="background-color:#E4E5E6;">
                  <h1>Sorry, No Comments Available</h1> 
                  
                  <hr class="my-4">
                  <p style="color:#666C72;">Be the first one to start the thread.</p> 
                  
              </div>
            </div>
          ';
        }
      ?>
    </div>



    <!-- footer -->
    <?php require './partials/_footer.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>