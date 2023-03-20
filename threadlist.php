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
      $catId = $_GET['catid'];
      $sql = "SELECT * FROM `category` WHERE `slno`='$catId';";
      $sqlResult = mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($sqlResult);
      $title = $row['title'];
      $description = $row['description'];
    ?>
    <?php
      $checkQuestion = false;
      $userId = '';
      if($_SERVER['REQUEST_METHOD']=='POST'){
        $thread_title = $_POST['threadTitle'];
        $thread_title = str_replace("<", "&lt;", $thread_title);
        $thread_title = str_replace(">","&gt;", $thread_title);
        $thread_description = $_POST['threadDescription'];
        $thread_description = str_replace("<","&lt;",$thread_description);
        $thread_description = str_replace(">","&gt;",$thread_description);
        $userId = $_SESSION['UserId'];
        $sql = "INSERT INTO `threadlist`(`thread_title`,`thread_description`,`thread_user_id`,`thread_category_id`,`thread_tstamp`) VALUES ('$thread_title','$thread_description','$userId','$catId',current_timestamp());";
        $sqlResult = mysqli_query($conn,$sql);
        if($sqlResult){
          $checkQuestion = true; 
        }
        if($checkQuestion){
            echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                  <strong>Success!</strong> Your problem has been posted.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }else{
                  echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                  <strong>Sorry!</strong> Your problem hasn"t been posted.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
      }
    ?>


    <div class="container my-3">
      <div class=" mt-4 p-5  text-dark rounded" style="background-color:#E4E5E6;">
        <h1>Welcome to <?php echo $title; ?> Forum</h1> 
        <p style="color:#666C72;"><?php echo $description ?></p> 
        <hr class="my-4">
        <p style="color:#666C72;">This is a peer to peer forum for sharing knowledge with each other. Keep it friendly, Be courteous and respectful. Appreciate that others may have an opinion different from yours. Stay on topic and Share your knowledge. Refrain from demeaning, discriminatory, or harassing behaviour and speech.</p>
        <a class="btn btn-success btn-sm" href="#" role="button">Learn more</a>
      </div>
    </div>

    <!-- Adding thread form -->
    <div class="container my-3">
      <h2>Start a discussion</h2>
      <?php
        if(isset($_SESSION['loggedIn']) &&  $_SESSION['loggedIn']==true){

          echo '
            <form action="'.$_SERVER["REQUEST_URI"].'" method="POST">
        <div class="mb-3">
          <label for="threadTitle" class="form-label">Problem Title</label>
          <input type="text" class="form-control" id="threadTitle" name="threadTitle" >
        </div>
        <div class="mb-3">
          <label for="threadDescription" class="form-label">Elaborate the Problem</label>
          <textarea class="form-control" id="threadDescription" name="threadDescription" rows="3"></textarea>
        </div>
        <button class="btn btn-success btn-sm">Submit Thread</button>
      </form>
          ';

        }else{
          echo '
            <div class="alert alert-warning" role="alert">
              Sorry! Log In to Start a Discussion.
            </div>
          ';
        }
      ?>
      
    </div>

    <!-- thread list -->
    <div class="container my-4 for-footer">

      <h1>Browse Questions</h1>

      <!-- threads of users -->
      <?php
        $sql = "SELECT * FROM `threadlist` WHERE `thread_category_id`= '$catId';";
        $sqlResult = mysqli_query($conn,$sql);
        $noThreads=true;
        while($row = mysqli_fetch_assoc($sqlResult)){
          $noThreads =false;
          $thread_user_id = $row['thread_user_id'];
          $sql = "SELECT * FROM `users` WHERE `slno`='$thread_user_id';";
          $sqlResultR = mysqli_query($conn,$sql);
          $rowU = mysqli_fetch_assoc($sqlResultR);
          $userName = $rowU['user_email'];
          echo '

          <div class="container mt-3">
          <div class="d-flex border p-3">
            <img src="https://cdn.pixabay.com/photo/2016/11/18/23/38/child-1837375_960_720.png" alt="John Doe" class="flex-shrink-0 me-3 mt-3 rounded-circle" style="width:60px;height:60px;">
            <div>
                  <h4>'.$userName.' <small>'.$row['thread_tstamp'].'</small></h4>
                  <p><a href="thread.php?threadid='.$row['thread_no'].'" style="text-decoration:none;" >'.$row["thread_title"].'</a></p>
            </div>
          </div>
        </div>

        ';
        }
        if($noThreads){
          echo '
            <div class="container my-3">
              <div class=" mt-4 p-5  text-dark rounded" style="background-color:#E4E5E6;">
                  <h1>Sorry, No threads Available</h1> 
                  
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