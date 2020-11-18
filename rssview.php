<?php
function Rss($n){
  global $xml;
    $count=1;
    foreach ($xml -> channel -> item  as $item) {
      $title = $item ->title;
      $desc = $item  ->description;
      $img = $item ->enclosure['url'];
      $pub_date = $item ->pubDate;
      if ($count >=$n) {
        break;
      }
      $count++;
    }
    return array('heading' =>$title ,'description' =>$desc,'image' =>$img,'date' =>$pub_date);
  }

  if ($_GET['cat'] == 'top5') {
    $xml = simplexml_load_file("https://www.deshabhimani.com/rss/mainnews");
  }
  elseif ($_GET['cat'] == 'kerala') {
    $xml = simplexml_load_file("https://www.deshabhimani.com/rss/kerala");
  }
  elseif ($_GET['cat'] == 'national') {
    $xml = simplexml_load_file("https://www.deshabhimani.com/rss/national");
  }
  elseif ($_GET['cat'] == 'world') {
    $xml = simplexml_load_file("https://www.deshabhimani.com/rss/world");
  }
  elseif ($_GET['cat'] == 'technology') {
    $xml = simplexml_load_file("https://www.deshabhimani.com/rss/technology");
  }
  else {
    die();
  }
  if (isset($_GET['kn']) ) {
    $db = Rss(htmlentities($_GET['kn']));
  }
  else {
    die();
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
     <link rel="icon" type="image/png" href="img/favicon.png"/>
     <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Manjari:wght@400;700&family=Mukta:wght@800&display=swap" rel="stylesheet">
     <link href="css/mainstyles.css" rel="stylesheet">
     <title>K News-News reading - <?=$row['Heading']?> </title>
   </head>
  <body id="page-top" style="font-family: 'Mukta',sans-serif,'Manjari';">
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
    <nav class="navbar navbar-expand-md navbar-light bg-light shadow mb-5 mt-0 pt-0"   id= "navbar_top">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
        aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="main.php"> <img id="nav_logo" class="ml-5 mt-2 mr-n5 d-none" src="img/mylogo.png" height=35px; alt=""> </a>
      <div class="collapse navbar-collapse" id="basicExampleNav">
        <ul class="navbar-nav mx-auto pt-2">
          <li class="nav-item pr-5">
            <a class="nav-link" href="main.php">Home</a>
          </li>
          <li class="nav-item pr-5">
            <a class="nav-link" href="rsslatest.php">Latest</a>
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

    <div class="container-fluid mx-lg-3">
      <div class="row">
        <div class="col-xl-8 col-lg-7 px-0 px-md-3">
          <div class="card shadow mb-4">
            <div class="card-body pb-5 pt-0 mt-0 ml-md-4 d-flex align-content-center flex-wrap position-relative">
              <article>
                <div class="text-dark mb-3">
                  <h4 style="font-size:1.8rem;" class="pt-4 font-weight-bold"><?= $db['heading']?></h4>
                </div>
                <div><img class="img-fluid pb-4 pt-2 mx-0 px-0" src="<?php if (isset($db['image'])) {echo $db['image'];}else {
                  echo "news_img/mylogo.png";
                } ?>" alt=""></div>
                <div >
                  <img src="img/mylogo.png" style="height:4em;" alt="">
                </div>
                <div class="mt-3" >
                 <p>Published <?=substr($db['date'],0,-5)?></p>

                </div>
                <div class="text-dark" id="desc" >
                 <?=$db['description']?>
                </div>
              </article>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-5">
          <div class="row">
            <div class="card shadow mb-4 mx-0 mx-sm-3 mx-lg-0" style="height:49rem;overflow:hidden;position:relative;" >
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-dark">Latest Articles  </h5>
              </div>
              <?php
                $count = 1;
                while ($count<6) {
                  $db = Rss($count);
                  if ($count == htmlentities($_GET['kn'])) {
                    $count++;
                    continue;
                  }
                  echo '<div class="card-body mb-0 pb-0" style="height:.25rem;overflow:hidden;">
                          <article >
                            <div class="row mr-0 pr-0">
                              <div class="col-5">
                                <a href="rssview.php?cat='.htmlentities($_GET['cat']).'&kn='.$count.'">
                                  <div class="mx-auto">
                                    <img class="img-fluid ml-0 mb-0" style="height:8rem;" src="'.$db['image'].'"  alt="News related image">
                                  </div>
                                </a>
                              </div>
                              <div class="col-7 pr-0 mr-0" >
                                <a class="text-decoration-none" href="rssview.php?cat='.htmlentities($_GET['cat']).'&kn='.$count.'">
                                  <div class="bg-danger text-light ml-2" style="width:100px" >
                                    <p class="pl-3  font-weight-bold">'.strtoupper(htmlentities($_GET['cat'])).'</p>
                                  </div>
                                  <div class="text-dark" style="overflow:hidden;">
                                    <p class="ml-2">'.$db['heading'].'</p>
                                  </div>
                                </a>
                              </div>
                            </div>
                          </article>
                        </div>';
                        if ($count==5) {
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
    </div>

  </body>
</html>
