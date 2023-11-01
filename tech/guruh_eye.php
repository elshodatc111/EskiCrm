<?php
  session_start();
  include("../confige/confige.php");
  $Confige = new Confige;
  if(!isset($_SESSION['FIO'])){header("location: login.php");}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Tashriflar</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="../assets/images/logo.png" rel="icon">
    <link href="../assets/images/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style2.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" />
  </head>
  <body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="../assets/images/logo.png" alt=""><span class="d-none d-lg-block">ATKO</span></a><i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="../assets/images/user_icon.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $_SESSION['FIO']; ?></h6>
              <span><?php echo $_SESSION['Username']; ?></span>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="login.php"><i class="bi bi-box-arrow-right"></i><span>Chiqish</span></a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>

  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item collapsed">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Bosh sahifa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="./guruh.php">
          <i class="bi bi-file-person"></i>
          <span>Guruhlar</span>
        </a>
      </li>
    </ul>
  </aside>

  <main id="main" class="main">
    <section class="section dashboard">
        <div class="row">

          <div class="col-12">
            <div class="card ">
              <div class="card-body text-center p-0">
                <button class="btn btn-primary button_btn" data-bs-toggle="modal" data-bs-target="#tolov">Davomad olish</button>
               </div>
            </div>
          </div>
          
          <div class="modal fade  modal_form" id="tolov" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Davomad</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="editing.php?GuruhID=<?php echo $_GET['GuruhID']; ?>" method="POST">
                    <div class="row">
                      <div class="col-lg-12">
                        <table class="table">
                          <tr>
                            <th>#</th>
                            <th>FIO</th>
                            <th class='text-center'><?php echo date("Y-m-d"); ?></th>
                          </tr>
                          <?php
                            $sql1 = "SELECT * FROM `guruh_users` JOIN `user_student` ON guruh_users.UserID=user_student.StudentID WHERE `GuruhID`='".$_GET['GuruhID']."'";
                            $res1 = $Confige->SelectAll($sql1);
                            $a = 0;
                            if($res1->num_rows>0){
                              $i=1;
                              while ($row1 = $res1->fetch_assoc()) {
                                echo "<tr>
                                  <td>".$i."</td>
                                  <td>".$row1['FIO']."</td>
                                  <td class='text-center'>
                                    <input type='checkbox' name=".$row1['StudentID']." class='m-0'>
                                  </td>
                                </tr>";
                                $i++;
                              }
                            }else{
                              $a++;
                            }
                          ?>
                          
                        </table>
                      </div>
                      <div class="col-lg-12" style="display:<?php if($a===1){echo 'none';} ?>">
                        <button type="submit" name="davomatplus" class="Filter_btn btn">Davomad olish</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

            <div class="col-lg-12">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Talabalar davomadi</h5>
                        <div class="table-responsive text-nowrap">
                          <div class="table-responsive text-nowrap">
                            <table class="table table-bordered border-primary table-striped my_table_search">
                              <?php
                                $dates = array();
                                $sqldata = "SELECT DISTINCT `Date` FROM `guruh_davomat` WHERE `GuruhID`='".$_GET['GuruhID']."' ORDER BY `Date` ASC";
                                $resdata = $Confige->SelectAll($sqldata);
                                if($resdata->num_rows>0){
                                  while ($rowdata = $resdata->fetch_assoc()) {
                                    array_push($dates,$rowdata['Date']);
                                  }
                                }
                              ?>
                                <thead >
                                    <tr>
                                        <th>#</th>
                                        <th>FIO</th>
                                        <?php
                                          foreach ($dates as $data) {
                                            echo "<th>".$data."</th>";
                                          }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                      $sqldav = "SELECT user_student.FIO,user_student.StudentID FROM `guruh_users` JOIN `user_student` ON guruh_users.UserID=user_student.StudentID WHERE guruh_users.GuruhID='".$_GET['GuruhID']."'";
                                      $resdav = $Confige->SelectAll($sqldav);
                                      if($resdav->num_rows>0){
                                        $i=1;
                                        while ($rowdav = $resdav->fetch_assoc()) {
                                          echo "<tr><td class='text-center'>".$i."</td><td>".$rowdav['FIO']."</td>";
                                              foreach ($dates as $data) {
                                                $sqld = "SELECT * FROM `guruh_davomat` WHERE `UserID`='".$rowdav['StudentID']."' AND `GuruhID`='".$_GET['GuruhID']."' AND `Date`='".$data."'";
                                                $resd = $Confige->SelectAll($sqld);
                                                if($resd->num_rows>0){
                                                  echo "<td class='text-center'><span class='badge bg-primary'>+</span></td>";
                                                }else{
                                                  echo "<td class='text-center'><span class='badge bg-danger'>-</span></td>";
                                                }
                                              }
                                          echo "</tr>";
                                          $i++;
                                        }
                                      }
                                    ?>
                                    
                                </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </section>
  </main>
  
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>ATKO TEAMS</span></strong>. All Rights Reserved
    </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#datatable').DataTable();
    });
  </script>
</body>
</html>