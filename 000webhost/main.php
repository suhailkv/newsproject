<?php
  require 'pdo.php';
  require 'visitors.php';

  $stmt = $pdo->query('SELECT * FROM news ORDER BY stamp DESC LIMIT 5');

  function pub($stamp) {

    date_default_timezone_set("Asia/Kolkata");
    $datetime1 = new DateTime();
    $datetime2 = new DateTime($stamp);
    $interval = $datetime1->diff($datetime2);
    $elapsed_d = $interval->format('%d');
    $elapsed_h = $interval ->format('%h');
    $elapsed_m = $interval ->format('%i');

    if ($elapsed_d>=1) {$pub = "Published on ".date_format($datetime2,"D F Y, h:i a");}elseif ($elapsed_h >0) {
      echo "Published ".$elapsed_h." hours ago";
    }elseif ($elapsed_m >0) {
      echo "Published".$elapsed_m." minutes ago";
    }else {
      echo "Published now";
    }
  }
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>K News-Home</title>

    <link rel="icon" type="image/png" href="img/favicon.png"/>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Manjari:wght@400;700&family=Mukta:wght@800&display=swap" rel="stylesheet">
    <link href="css/mainstyles.css" rel="stylesheet">
  </head>

  <body id="page-top" style="font-family:'Mukta',sans-serif,'Manjari'">
    <!--header-->
    <header class="jumbotron pt-0 pb-0 mt-0 mb-0  rounded-0 " style="background-color: #ee002d;height:21vh">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="d-flex justify-content-center ">
              <div>
                <a  href="./main.php"> <img style="max-height:9rem" class="img-fluid"  src="img/mylogo.png" alt=""> </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow mb-5 mt-0 pt-0"   id= "navbar_top">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
        aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="main.php"> <img id="nav_logo" class="ml-5 mt-2 mr-n5 d-none" src="img/mylogo.png" height=35px; alt=""> </a>
      <div class="collapse navbar-collapse" id="basicExampleNav">
        <!-- Links -->
        <ul class="navbar-nav mx-auto pt-2">
          <li class="nav-item active pr-5">
            <a class="nav-link" href="main.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item pr-5">
            <a class="nav-link" href="catView.php?cat=Politics">Politics</a>
          </li>
          <li class="nav-item pr-5">
            <a class="nav-link" href="catView.php?cat=Movies">Movies</a>
          </li>
          <li class="nav-item pr-5">
            <a class="nav-link" href="catView.php?cat=Sports">Sports</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="catView.php?cat=Finance">Finance</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid mx-lg-3" style="width:98vw;">
      <div class="row">
        <div class="col-xl-8 col-lg-7">
          <div class="card shadow mb-4" style="height:49rem;overflow:hidden;">
            <div class="card-header py-3">
              <h5 class="m-0 font-weight-bold text-dark">Latest </h5>
            </div>
            <div class="card-body mx-auto my-auto">
              <article>
                <a class="text-decoration-none" href="mainview.php?kn=<?php $row= $stmt ->fetch(PDO::FETCH_ASSOC);if ($row['Category'] == 'General') {
                  $category = 'Politics';
                }
                elseif ($row['Category'] == 'Stock') {
                  $category = 'Finance';
                }
                else {
                  $category = $row['Category'];
                } echo $row['news_id'];?>"> <div><img class="img-fluid pb-4 pt-2" src="<?php  echo "news_img/".$row['imgname']; ?>" alt="">
                </div>
                <div class="bg-danger text-light text-justify" style= "width:100px">
                  <p class="pl-3 font-weight-bold"><?= strtoupper($category)?></p>
                </div>
                <div class="text-dark">
                  <h4 class="pt-4"><?= $row['Heading']?></h4>
                </div>
                <div class="text-dark">
                  <p class="pt-4"><?php $desc = substr($row['Description'],0,1000); $n = strrpos($desc,'.');echo $n; $desc = substr($desc,0,$n);  echo $desc; ?> ...&nbsp;&nbsp;&nbsp;<span class="text-primary">View more</span> </p>
                </div>
              </a>
              </article>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-5">
          <div class="row">
            <div class="card shadow mb-4 mx-0 mx-sm-3 mx-lg-0" style="height:49rem;overflow:hidden;position:relative;" >
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-dark">More Articles  </h5>
              </div>
              <?php
                $count = 1;
                while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                  if ($row['Category'] == 'General') {
                    $category = 'Politics';
                  }
                  elseif ($row['Category'] == 'Stock') {
                    $category = 'Finance';
                  }
                  else {
                    $category = $row['Category'];
                  }
                  echo '<div class="card-body mb-0 pb-0" style="height:.25rem;overflow:hidden;">
                          <article >
                            <div class="row mr-0 pr-0">
                              <div class="col-5">
                                <a href="mainview.php?kn='.$row['news_id'].'">
                                  <div class="mx-auto">
                                    <img class="img-fluid ml-0 mb-0" style="height:8rem;" src="news_img/'.$row['imgname'].'"  alt="News related image">
                                  </div>
                                </a>
                              </div>
                              <div class="col-7 pr-0 mr-0" >
                                <a class="text-decoration-none" href="mainview.php?kn='.$row['news_id'].'">
                                  <div class="bg-danger text-light ml-2" style="width:100px" >
                                    <p class="pl-3  font-weight-bold">'.strtoupper($category).'</p>
                                  </div>
                                  <div class="text-dark" style="overflow:hidden;">
                                    <p class="ml-2">'.$row['Heading'].'</p>
                                  </div>
                                </a>
                              </div>
                            </div>
                          </article>
                        </div>';
                  if ($count == 4) {
                    break;
                  }
                  echo '<hr>';
                  $count++;
                }
               ?>
             </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h5 class="m-0 font-weight-bold text-dark">Politics</h5>
            </div>
              <?php
                 $count = 0;
                 $stmt = $pdo->query("SELECT * FROM `news` WHERE Category = 'General' ORDER BY stamp DESC lIMIT 6");
                 while ($row= $stmt ->fetch(PDO::FETCH_ASSOC)) {
                   if ($count === 0 || !is_int($count/3) === false) {
                     echo '<div class="card-body">
                           <div class="row">';
                   }
              ?>
                   <div class="col-12 col-md">
                     <a class="text-decoration-none" href="mainview.php?kn=<?=$row['news_id']?>">
                       <div class=""><img class="img-fluid  pb-2 pt-2" src="news_img/<?=$row['imgname']?>" alt=""></div>
                       <div class="my-2 text-secondary " style="font-size:1rem;" ><?=pub($row['stamp'])?></div>
                       <div class="text-dark"><?=$row['Heading']?></div>
                     </a>
                   </div>
              <?php
                   if (! ($count === 2 || $count === 5) ) {
                     echo '<span class="border-right"></span>';
                   }
                   if ($count === 2 || $count === 5) {
                     echo '</div>
                           </div>';
                     if ($count == 2) {echo '<hr>';}
                   }
                   if ($count === 5) {break;}
                   $count++;
                 }
              ?>
               <div class="card-footer d-flex justify-content-end">
                 <a class="font-weight-bold text-decoration-none text-dark" href="catView.php?cat=Politics">View more</a>
               </div>
          </div>
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h5 class="m-0 font-weight-bold text-dark">Movies</h5>
            </div>
              <?php
                 $count = 0;
                 $stmt = $pdo->query("SELECT * FROM `news` WHERE Category = 'Movies' ORDER BY stamp DESC lIMIT 6");
                 while ($row= $stmt ->fetch(PDO::FETCH_ASSOC)) {
                   if ($count === 0 || !is_int($count/3) === false) {
                     echo '<div class="card-body">
                            <div class="row">';
                   }
                ?>
                    <div class="col-12 col-md">
                       <a class="text-decoration-none" href="mainview.php?kn=<?=$row['news_id']?>">
                         <div class=""><img class="img-fluid  pb-2 pt-2" src="news_img/<?=$row['imgname']?>" height="100" alt="">
                         </div>
                         <div class="my-2 text-secondary " style="font-size:1rem;" ><?=pub($row['stamp'])?>
                         </div>
                         <div class="text-dark"><?=$row['Heading']?></div>
                       </a>
                     </div>
                <?php
                   if (! ($count === 2 || $count === 5) ) {
                     echo '<span class="border-right"></span>';
                   }
                   if ($count === 2 || $count === 5) {
                     echo '</div>
                           </div>';
                     if ($count == 2) {echo '<hr>';}
                   }
                   if ($count === 5) {break;}
                   $count++;
                 }
               ?>
               <div class="card-footer d-flex justify-content-end">
                 <a class="font-weight-bold text-decoration-none text-dark" href="catView.php?cat=Movies">View more</a>
               </div>
          </div>
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h5 class="m-0 font-weight-bold text-dark">Sports</h5>
            </div>
              <?php
                 $count = 0;
                 $stmt = $pdo->query("SELECT * FROM `news` WHERE Category = 'Sports' ORDER BY stamp DESC lIMIT 6");
                 while ($row= $stmt ->fetch(PDO::FETCH_ASSOC)) {
                   if ($count === 0 || !is_int($count/3) === false) {
                     echo '<div class="card-body">
                            <div class="row">';
                   }
              ?>
                    <div class="col-12 col-md">
                       <a class="text-decoration-none" href="mainview.php?kn=<?=$row['news_id']?>">
                         <div class=""><img class="img-fluid  pb-2 pt-2" src="news_img/<?=$row['imgname']?>" height="100" alt="">
                         </div>
                         <div class="my-2 text-secondary " style="font-size:1rem;" ><?=pub($row['stamp'])?>
                         </div>
                         <div class="text-dark"><?=$row['Heading']?></div>
                       </a>
                     </div>
                <?php
                    if (! ($count === 2 || $count === 5) ) {
                      echo '<span class="border-right"></span>';
                    }
                    if ($count === 2 || $count === 5) {
                      echo '</div>
                            </div>';
                      if ($count == 2) {echo '<hr>';}
                    }
                    if ($count === 5) {break;}
                    $count++;
                  }
               ?>
               <div class="card-footer d-flex justify-content-end">
                 <a class="font-weight-bold text-decoration-none text-dark" href="catView.php?cat=Sports">View more</a>
               </div>
          </div>
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h5 class="m-0 font-weight-bold text-dark">Finance</h5>
            </div>
              <?php
                 $count = 0;
                 $stmt = $pdo->query("SELECT * FROM `news` WHERE Category = 'Stock' ORDER BY stamp DESC lIMIT 6");
                 while ($row= $stmt ->fetch(PDO::FETCH_ASSOC)) {
                   if ($count === 0 || !is_int($count/3) === false) {
                     echo '<div class="card-body">
                           <div class="row">';
                   }
              ?>
                    <div class="col-12 col-md">
                       <a class="text-decoration-none" href="mainview.php?kn=<?=$row['news_id']?>">
                         <div class=""><img class="img-fluid  pb-2 pt-2" src="news_img/<?=$row['imgname']?>" height="100" alt="">
                         </div>
                         <div class="my-2 text-secondary " style="font-size:1rem;" ><?=pub($row['stamp'])?>
                         </div>
                         <div class="text-dark"><?=$row['Heading']?></div>
                       </a>
                     </div>
                <?php
                   if (! ($count === 2 || $count === 5) ) {
                     echo '<span class="border-right"></span>';
                   }
                   if ($count === 2 || $count === 5) {
                     echo '</div>
                           </div>';
                     if ($count === 2) {echo '<hr>';}
                   }
                   if ($count === 5) {break;}
                   $count++;
                 }
               ?>
               <div class="card-footer d-flex justify-content-end">
                 <a class="font-weight-bold text-decoration-none text-dark" href="catView.php?cat=Finance">View more</a>
               </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <footer class="page-footer font-small pt-4" style="background-color:#02031c;font-family:'Mukta',sans-serif">
      <div class="container text-center text-md-left">
        <div class="row">
          <div class="col-md-4 col-lg-3 mr-auto my-md-4 my-0 mt-4 mb-1">
            <a href="#"> <img class="img-fluid" src="img/mylogo.png" alt=""> </a>
          </div>
          <hr class="w-100 d-md-none">
          <div class="col-md-2 col-lg-2 mx-auto my-md-4 my-0 mt-4 mb-1">
            <h5 class="font-weight-bold text-uppercase mb-4">Our Pages</h5>
            <ul class="list-unstyled">
              <li><p><a href="catView.php?cat=Politics">POLITICS</a></p></li>
              <li><p><a href="catView.php?cat=Sports">SPORTS</a></p></li>
              <li><p><a href="catView.php?cat=Movies">MOVIES</a></p></li>
              <li><p><a href="catView.php?cat=Finance">FINANCE</a></p></li>
            </ul>
          </div>
          <hr class="w-100 d-md-none">
          <div class="col-md-2 col-lg-2 text-center mx-auto my-4">
            <h5 class="font-weight-bold text-uppercase mb-4">Follow Us</h5>
            <div>
              <a type="button" class="btn-floating btn-fb"><i class="fab fa-facebook-f"></i></a>
            </div>
            <div>
              <a type="button" class="btn-floating btn-tw"><i class="fab fa-twitter"></i></a>
            </div>
            <div>
              <a type="button" class="btn-floating btn-gplus"><i class="fab fa-google-plus-g"></i></a>
            </div>
            <div><a type="button" class="btn-floating btn-dribbble"><i class="fab fa-dribbble"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-copyright text-center py-3">K News © 2020</div>
    </footer>


    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>

  </body>
</html>
