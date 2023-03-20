<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss | Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <!-- navbar -->
    <?php
      require './partials/_dbconnect.php';
      require './partials/_header.php';
    ?>

    <!-- slides -->
    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://source.unsplash.com/2400x600/?coding,python" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://source.unsplash.com/2400x600/?coding,php" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://source.unsplash.com/2400x600/?coding,logic" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
    </div>


    <!-- categories -->
    <div class="container my-5">
      <h2 class="text-center mb-4">iDiscuss - Category</h2>

      

      <div class="row">

        <?php
          $sql = "SELECT * FROM `category`;";
          $sqlResult = mysqli_query($conn,$sql);
          while($row = mysqli_fetch_assoc($sqlResult)){
            echo '
                    <div class="col-md-4 my-2">
                      <div class="card" style="width: 18rem;">
                        <img src="https://source.unsplash.com/500x400/?'.$row["title"].',coding" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title"><a href="threadlist.php?catid='.$row["slno"].'" style="text-decoration:none">'.$row["title"].'</a></h5>
                          <p class="card-text">'.substr($row["description"],0,55).'...</p>
                          <a href="threadlist.php?catid='.$row["slno"].'" class="btn btn-primary">View Thread</a>
                        </div>
                      </div>
                    </div>
            ';
          }
      ?>

        
      </div>


    </div>



    <!-- footer -->
    <?php
      require './partials/_footer.php';
    ?>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>
