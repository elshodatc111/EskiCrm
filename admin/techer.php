<?php
  include("../confige/confige.php");
  $Confige = new Confige;
  if(!isset($_COOKIE['Login'])) {header("location: ./login.php");}

?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>O'qituvchilar</title>
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
        <a class="nav-link collapsed" href="./tashrif.php">
          <span>Tashriflar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="./guruhlar.php">
          <span>Guruhlar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="./techer.php">
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

        <section class="section dashboard">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">O'qituvchilar</h5>
                    <div class="table-responsive text-nowrap">
                      <table class="table text-center table-bordered" id="datatable">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>FIO</th>
                            <th>Telefon raqam</th>
                            <th>Manzil</th>
                            <th>Guruhlar soni</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $sql="SELECT * FROM `user_techer`";
                            $res=$Confige->SelectAll($sql);
                            if($res->num_rows>0){
                              $i=1;
                              while ($row=$res->fetch_assoc()) {
                                $count=0;
                                $sql1 = "SELECT * FROM `user_techer_guruh` WHERE `TecherID`='".$row['TecherID']."'";
                                $res1 = $Confige->SelectAll($sql1);
                                if($res1->num_rows>0){
                                  while ($row1=$res1->fetch_assoc()) {
                                    $count = $count + 1;
                                  }
                                }
                                echo "<tr>
                                  <td>".$i."</td>
                                  <td>".$row['TecherName']."</td>
                                  <td>".$row['Phone']."</td>
                                  <td>".$row['Addres']."</td>
                                  <td>".$count."</td>
                                  <td>";
                                    if($count===0){
                                      echo "<a href='php/techer.php?techdel=true&TecherID=".$row['TecherID']."' class='px-1'><i class='bi bi-trash'></i></a>";
                                    }
                                    echo "<a href='techer_eye.php?TecherID=".$row['TecherID']."' class='px-1'><i class='bi bi-eye'></i></a>";
                                  echo"</td>
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