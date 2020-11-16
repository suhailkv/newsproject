<?php
  session_start();
  if (! isset($_SESSION['admin'])) {
    die();
    header("Location:main.php");
    return;
  }
  require "pdo.php";

  $stmt = $pdo->query('SELECT * FROM news');
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
       <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./panel.php">
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
         <div id="collapseUtilities" class="collapse md-show" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
           <div class="bg-white py-2 collapse-inner rounded">
             <h6 class="collapse-header">CRUD Utilities:</h6>
             <a class="collapse-item bg-primary text-light " href="Indexview.php">News Index | Edit | Delete</a>
             <a class="collapse-item" href="add.php">Add a news </a>
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
             <h1 class="h3 mb-0 text-gray-800">News Index</h1>
           </div>
           <div class="row">
             <div class="col-xl-12 col-lg-12">
               <div class="card shadow mb-4">
                 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                   <h6 class="m-0 font-weight-bold text-primary">List of News</h6>
                 </div>
                 <?php
                   if (isset($_SESSION['success'])) {
                     echo '<div class="col-12 col-md-6 offset-md-3 bg-success border rounded border-success"><p class="text-light pl-2 pr-2 pt-2 mt-2 text-center font-weight-bold ">'.$_SESSION['success'].'</p></div>';
                     unset($_SESSION['success']);
                   }
                   if (isset($_SESSION['error'])) {
                     echo '<div class="col-12 col-md-6 offset-md-3 bg-danger border rounded border-danger"><p class="text-light pl-2 pr-2 pt-2 mt-2 text-center font-weight-bold ">'.$_SESSION['error'].'</p></div>';
                     unset($_SESSION['error']);
                   }
                 ?>
                 <div class="card-body">
                   <?php
                   $row = $stmt ->fetch(PDO::FETCH_ASSOC);
                   if (is_null($row)) {
                     echo "There is no News content";
                   }
                   else {
                     echo '<table class="table table-hover table-responsive ">
                             <thead>
                               <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Heading</th>
                                 <th scope="col">Category</th>
                                 <th scope="col" class="d-none d-lg-table-cell" >Show Date</th>
                                 <th scope="col" class="d-none d-lg-table-cell" >Actual DateTime</th>
                                 <th scope="col">Action</th>
                               </tr>
                             </thead>';
                      $count=1;
                      $stmt = $pdo->query('SELECT * FROM news');
                      while ($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
                        $datesplit = explode(' ',$row['stamp']);
                        echo '  <tbody>
                                  <tr>
                                    <th scope="row">'.$count.'</th>
                                    <td><a class="text-decoration-none text-dark" href="view.php?news_id='.$row['news_id'].'"><strong>'.$row['Heading'].'</strong></a></td>
                                    <td>'.$row['Category'].'</td>
                                    <td class="d-none d-lg-table-cell">'.$row['createdDate'].'</td>
                                    <td class="d-none d-lg-table-cell">'.$datesplit[0]." | ".$datesplit[1].'</td>
                                    <td> <a class="btn btn-success" href="#" data-toggle="modal" data-target="#editModal'.$count.'" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">Edit</a> </td>

                                    <div class="modal fade" id="editModal'.$count.'" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit the News</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">

                                            <form class="was-validated" method="post" action=./edit.php enctype="multipart/form-data" >
                                              <div class="form-group">
                                                <input type="hidden" name="id" value="'.$row['news_id'].'">
                                                <label for="headline">Headline</label>
                                                <input type="text" class="form-control" id="headline" name="headline" value="'.$row['Heading'].'" required>
                                              </div>
                                              <div class="form-row">
                                                <div class="col-12 col-sm my-1 form-group">
                                                 <label class="mr-sm-2" for="category">Category</label>
                                                 <select class="custom-select mr-sm-2"  name="category"required>

                                                   <option value="General" selected>General </option>
                                                   <option value="Stock">Stock </option>
                                                   <option value="Sports">Sports</option>
                                                   <option value="Movies">Movies</option>
                                                   <input id="category'.$count.'" type="hidden" value="'.$row['Category'].'">
                                                 </select>
                                               </div>
                                               <div class="col-12 col-sm my-1 form-group">
                                                 <label for="date">Date</label>
                                                 <input type="date" class="form-control" id="date" value="'.$row['createdDate'].'" name="date" required>
                                               </div>
                                              </div>
                                              <div class="mt-3 custom-file">
                                                 <input type="file" class="custom-file-input col-10" name="img" id="customFile" >
                                                 <span class="text-success"> File&nbsp;:&nbsp;'.$row['imgname'].'</span>
                                                 <input type="hidden" name="image" value="'.$row['imgname'].'">
                                                 <label class="custom-file-label" for="customFile">Choose an image</label>
                                                 <div class="invalid-feedback">
                                                    No image selected.
                                                 </div>
                                               </div>

                                             <div class="form-group mt-3">
                                               <label for="content">Content</label>
                                               <textarea class="form-control" id="content" name="content" placeholder="Content here..." rows="8" required>'.$row['Description'].'</textarea>
                                             </div>
                                             <div class="d-flex justify-content-end">
                                             <button type="button" class="btn btn-danger my-1" data-dismiss="modal"> <strong>Cancel</strong> </button>
                                             <button type="submit" class="btn btn-primary ml-2 my-1" name="edit"> <strong>Save</strong> </button>
                                             </div>

                                            </form>
                                        </div>
                                      </div>
                                    </div>

                                    <td> <a class="btn btn-danger" data-toggle="modal" data-target="#deleteModal'.$count.'" href="#">Delete</a> </td>

                                     <div class="modal fade" id="deleteModal'.$count.'" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                       <div class="modal-dialog" role="document">
                                         <div class="modal-content">
                                           <div class="modal-header">
                                             <h5 class="modal-title" id="deleteModalLabel">Are you sure?</h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                               <span aria-hidden="true">&times;</span>
                                             </button>
                                           </div>
                                           <div class="modal-body">
                                             This will results permenent data removal from database
                                           </div>
                                           <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                                             <a class="btn btn-danger" href="delete.php?news_id='.$row['news_id'].'">Delete</a>
                                           </div>
                                         </div>
                                       </div>
                                     </div>
                                  </tr>';
                        $count +=1;
                      }
                      echo '  </tbody>
                      </table>';
                   }
                    ?>
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
