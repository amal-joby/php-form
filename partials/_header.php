<?php
session_start();

  echo '<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/login-dir/php-forum/">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <!--
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Top Categories
          </a>
          <ul class="dropdown-menu">
          ';
            $sqlCategory = "SELECT `title`,`slno`  FROM `category` LIMIT 3;";
            $sqlCategoryResult = mysqli_query($conn,$sqlCategory);
            while($row=mysqli_fetch_assoc($sqlCategoryResult)){
              echo '<li><a class="dropdown-item" href="threadlist.php?catid='.$row['slno'].'">'.$row['title'].'</a></li>';
            }

          echo '</ul>
        </li>
        <!--
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
        -->
      </ul>
      ';

      if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
        echo '
        <form class="d-flex mx-2" role="search" method="GET" action="search.php">
          <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form>
        <p class=" m-2 text-light ">Welcome '.$_SESSION['email'].'</p>
        <a href="./partials/_logout.php" class="btn btn-outline-success mx-2">Log Out</a>';
      }else{
        echo ' <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Log In</button>
        <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</button>';
      }
      
     echo ' 
       
    </div>
  </div>
</nav>';
include './partials/_loginModal.php';
include './partials/_signupModal.php';

if(isset($_GET['signUp']) && $_GET['signUp']== 'true'){
  echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
  <strong>Success!</strong> You have been successfully signed in.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}else if(isset($_GET['signUp']) && $_GET['signUp'] == 'false' ){
  echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
  <strong>Sorry!</strong> '.$_GET["error"].'.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if(isset($_GET['login']) && $_GET['login']== 'true'){
  echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
  <strong>Success!</strong> You have been successfully Logged In.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}else if(isset($_GET['login']) && $_GET['login'] == 'false' ){
  echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
  <strong>Sorry!</strong> '.$_GET["error"].'.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if(isset($_GET['logout']) && $_GET['logout']== 'true'){
  echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
  <strong>Success!</strong> You have been Logged Out, Log In to continue.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>