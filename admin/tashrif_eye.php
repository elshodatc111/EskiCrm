<?php
  include("../confige/confige.php");
  $Confige = new Confige;
  if(!isset($_COOKIE['Login'])) {header("location: ./login.php");}

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
    <link href="../https://fonts.gstatic.com" rel="preconnect">
    <link href="../https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" />
    <script>
      <?php
        if(isset($_GET['ssss'])){echo "alert('Guruh o`chirildi')";}
      ?>
    </script>
  </head>
  <body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="./index.php" class="logo d-flex align-items-center">
        <img src="../assets/images/logo.png" alt=""><span class="d-none d-lg-block"><?php echo $logo; ?></span></a><i class="bi bi-list toggle-sidebar-btn"></i>
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
              <h6><?php echo $_COOKIE['fio']; ?></h6>
              <span><?php echo $_COOKIE['Login']; ?></span>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="kobinet.php"><i class="bi bi-person"></i><span>Kobinet</span></a>
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
      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <span>Bosh sahifa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="./tashrif.php">
          <span>Tashriflar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="./guruhlar.php">
          <span>Guruhlar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="./techer.php">
          <span>O'qituvchilar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="./moliya.php">
          <span>Moliya</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="./xonalar.php">
          <span>Xonalar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="./kurslar.php">
          <span>Kurslar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="meneger.php">
          <span>Menegerlar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="./sms.php">
          <span>SMS</span>
        </a>
      </li>
    </ul>
  </aside>

    <main id="main" class="main">
        <?php
            $sqluser = "SELECT * FROM `user_student` WHERE `StudentID`='".$_GET['userid']."'";
            $resuser = $Confige->SelectAll($sqluser);
            $rowUser = $resuser->fetch_assoc();
        ?>
        <section class="section dashboard">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Tashrif</h5>
                    <div class="row">
                        <div class="col-lg-3">
                            <p><b>FIO: </b><?php echo $rowUser['FIO']; ?></p>
                        </div>
                        <div class="col-lg-3">
                            <p><b>Phone: </b><?php echo $rowUser['Phone']; ?></p>
                        </div>
                        <div class="col-lg-3">
                            <p><b>Manzil: </b><?php echo $rowUser['AddresName']; ?></p>
                        </div>
                        <div class="col-lg-3">
                            <p><b>T Kun:</b> <?php echo $rowUser['Tkun']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Guruhlari</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table text-center table-bordered" id="datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Guruh</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Jami tulovlari</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sqlg = "SELECT guruh_users.Data,guruh.GuruhName,guruh.Start,guruh.End,guruh.GuruhID FROM `guruh_users` JOIN `guruh` ON guruh_users.GuruhID=guruh.GuruhID WHERE guruh_users.UserID='".$_GET['userid']."'";
                                    $resg = $Confige->SelectAll($sqlg);
                                    if($resg->num_rows>0){
                                        $i=1;
                                        while ($rowg = $resg->fetch_assoc()) {
                                            $summa = 0;
                                            $GuruhID = $rowg['GuruhID'];
                                            $sqlaaa = "SELECT * FROM `user_student_tulov` WHERE `GuruhID`='".$GuruhID."' AND `UserID`='".$_GET['userid']."'";
                                            $resaaa = $Confige->SelectAll($sqlaaa);
                                            if($resaaa->num_rows>0){
                                              while ($rowss = $resaaa->fetch_assoc()) {
                                                $summa = $summa + $rowss['Summa'];
                                              }
                                            }
                                            echo "<tr>
                                                <td>".$i."</td>
                                                <td>".$rowg['GuruhName']."</td>
                                                <td>".$rowg['Start']."</td>
                                                <td>".$rowg['End']."</td>
                                                <td>".$summa."</td>
                                                <td>";
                                                if($summa===0){
                                                    echo "<a href='php/tashrif.php?tashrifgurdel111=true&GuruhID=".$rowg['GuruhID']."&userid=".$_GET['userid']."' class='px-1'><i class='bi bi-trash-fill'></i></a>";
                                                }
                                                echo "</td>
                                            </tr>";
                                            $i++;
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">To'lovlari</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table text-center table-bordered" id="datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Guruh</th>
                                <th>To'lov summa</th>
                                <th>To'lov vaqti</th>
                                <th>Izoh</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $tsql = "SELECT user_student_tulov.id,user_student_tulov.Summa,user_student_tulov.TulovType,user_student_tulov.Izoh,user_student_tulov.Data,guruh.GuruhName FROM `user_student_tulov` JOIN `guruh` ON user_student_tulov.GuruhID=guruh.GuruhID WHERE user_student_tulov.UserID='".$_GET['userid']."'";
                                    $tres = $Confige->SelectAll($tsql);
                                    if($tres->num_rows>0){
                                      $i=1;
                                      while ($trow=$tres->fetch_assoc()) {
                                        echo "<tr>
                                          <td>".$i."</td>
                                          <td>".$trow['GuruhName']."</td>
                                          <td>".$trow['Summa']."</td>
                                          <td>".$trow['Data']."</td>
                                          <td>".$trow['Izoh']."</td>
                                          <td><a href='php/tashrif.php?tuldel=true&userid=".$_GET['userid']."&id=".$trow['id']."' class='px-1'><i class='bi bi-trash-fill'></i></a></td>
                                        </tr>";
                                        $i++;
                                      }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    </main>


  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/js/main.js"></script>  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#datatable').DataTable();
    });
  </script>
</body>
</html>