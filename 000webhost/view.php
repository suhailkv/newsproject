<?php
  require'pdo.php';
  session_start();

  if (! isset($_GET['news_id'])) {
    die('Not Accessible');
  }
  if(isset($_GET['news_id'])) {
    $stmt = $pdo ->query('SELECT * FROM news WHERE news_id='.htmlentities($_GET['news_id']));
    $row = $stmt ->fetch(PDO::FETCH_ASSOC);
    $rltd = $pdo-> query('SELECT * FROM news WHERE news_id NOT IN (SELECT news_id FROM news WHERE news_id='.$row['news_id'].')' );
    $rrow = $rltd ->fetch(PDO::FETCH_ASSOC);
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
   <title>KN Admin Pro - Dashboard</title>

   <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   <link href="css/kn-admin.css" rel="stylesheet">
 </head>
 <body id="page-top">
   <div id="wrapper">
     <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion sticky-top h-100" id="accordionSidebar">
       <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
         <div class="sidebar-brand-icon rotate-n-15">
           <i class="fas fa-laugh-wink"></i>
         </div>
         <div class="sidebar-brand-text mx-3">FC Admin Pro</div>
       </a>
       <hr class="sidebar-divider my-0">
       <li class="nav-item">
         <a class="nav-link" href="panel.php">
           <i class="fas fa-fw fa-tachometer-alt"></i>
           <span>Dashboard</span></a>
       </li>
       <hr class="sidebar-divider">
       <div class="sidebar-heading">
         Interface
       </div>
       <li class="nav-item">
         <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="false" aria-controls="collapseUtilities">
           <i class="fas fa-fw fa-wrench"></i>
           <span>News Utilities</span>
         </a>
         <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
           <div class="bg-white py-2 collapse-inner rounded">
             <h6 class="collapse-header">CRUD Utilities:</h6>
             <a class="collapse-item  " href="Indexview.php">News Index | Edit | Delete</a>
             <a class="collapse-item" href="add.php">Add a news</a>
           </div>
         </div>
       </li>
       <hr class="sidebar-divider">
       <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
       </div>
     </ul>
     <div id="content-wrapper" class="d-flex flex-column">
       <div id="content">
         <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
           <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
             <i class="fa fa-bars"></i>
           </button>
           <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
             <div class="input-group">
               <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
               <div class="input-group-append">
                 <button class="btn btn-primary" type="button">
                   <i class="fas fa-search fa-sm"></i>
                 </button>
               </div>
             </div>
           </form>
           <ul class="navbar-nav ml-auto">
             <li class="nav-item dropdown no-arrow d-sm-none">
               <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <i class="fas fa-search fa-fw"></i>
               </a>
               <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                 <form class="form-inline mr-auto w-100 navbar-search">
                   <div class="input-group">
                     <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                     <div class="input-group-append">
                       <button class="btn btn-primary" type="button">
                         <i class="fas fa-search fa-sm"></i>
                       </button>
                     </div>
                   </div>
                 </form>
               </div>
             </li>
             <li class="nav-item dropdown no-arrow mx-1">
               <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <i class="fas fa-envelope fa-fw"></i>
                 <span class="badge badge-danger badge-counter">7</span>
               </a>
               <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                 <h6 class="dropdown-header">
                   Message Center
                 </h6>
                 <a class="dropdown-item d-flex align-items-center" href="#">
                   <div class="font-weight-bold">
                     <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                     <div class="small text-gray-500">Emily Fowler · 58m</div>
                   </div>
                 </a>
                 <a class="dropdown-item d-flex align-items-center" href="#">
                   <div>
                     <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                     <div class="small text-gray-500">Jae Chun · 1d</div>
                   </div>
                 </a>
                 <a class="dropdown-item d-flex align-items-center" href="#">
                   <div>
                     <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                     <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                   </div>
                 </a>
                 <a class="dropdown-item d-flex align-items-center" href="#">
                   <div>
                     <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                     <div class="small text-gray-500">Chicken the Dog · 2w</div>
                   </div>
                 </a>
                 <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
               </div>
             </li>
             <div class="topbar-divider d-none d-sm-block"></div>
             <li class="nav-item dropdown no-arrow">
               <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['admin']?></span>
                 <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
               </a>
               <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                 <a class="dropdown-item" href="profile.php">
                   <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                   Profile
                 </a>
                 <a class="dropdown-item" href="#">
                   <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                   Activity Log
                 </a>
                 <div class="dropdown-divider"></div>
                 <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                   <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                   Logout
                 </a>
               </div>
             </li>
           </ul>
         </nav>
         <div class="container-fluid">
           <div class="d-sm-flex align-items-center justify-content-between mb-4">
             <h1 class="h3 mb-0 text-gray-800"></h1>
           </div>
           <div class="row">
             <div class="col-xl-8 col-lg-7">
               <div class="card shadow mb-4">
                 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                   <a class="btn btn-primary font-weight-bold" href="./Indexview.php">Back</a>
                 </div>
                 <div class="card-body">
                   <article class="">
                     <h4 class="text-dark"><?= $row['Heading']?></h4>
                     <img <?php echo 'src="./news_img/'.$row['imgname'].'"'; ?> class="img-fluid rounded float-left pb-2 pt-2" alt="">
                     <p class="text-dark"><?= $row['Description']?></p>
                   </article>
                 </div>
               </div>
             </div>
             <div class="col-xl-4 col-lg-7 h-100">
               <div class="card shadow mb-4">
                 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                   <h6 class="m-0 font-weight-bold text-primary">Related Article</h6>
                 </div>
                 <div class="card-body">
                     <div class="thumbnail border rounded-bottom mb-2">
                        <a class="text-decoration-none text-dark" href="view.php?news_id=<?=$rrow['news_id']?>">
                          <img <?php echo 'src="./news_img/'.$rrow["imgname"].'"'; ?>class="" alt="" style="width:100%">
                          <div class="caption">
                            <p class="my-0 pt-2 pl-2"><?=$rrow['Heading']?></p>
                          </div>
                        </a>
                      </div>
                      <div class="thumbnail border rounded mb-2">
                         <a class="text-decoration-none text-dark" href="view.php?news_id=<?php $rrow = $rltd->fetch(PDO::FETCH_ASSOC); echo $rrow['news_id'];?>" >
                           <img <?php echo 'src="./news_img/'.$rrow["imgname"].'"'; ?>class="" alt="" style="width:100%">
                           <div class="caption">
                             <p class="my-0 pt-2 pl-2"><?=$rrow['Heading']?></p>
                           </div>
                         </a>
                       </div>
                       <div class="thumbnail border rounded mb-2">
                          <a class="text-decoration-none text-dark" href="view.php?news_id=<?php $rrow = $rltd->fetch(PDO::FETCH_ASSOC); echo $rrow['news_id'];?>">
                            <img <?php echo 'src="./news_img/'.$rrow["imgname"].'"'; ?>class="" alt="" style="width:100%">
                            <div class="caption">
                              <p class="my-0 pt-2 pl-2"><?=$rrow['Heading']?></p>
                            </div>
                          </a>
                        </div>
                 </div>
               </div>
             </div>
           </div>
        </div>

        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="js/sb-admin-2.min.js"></script>

  </body>
</html>
