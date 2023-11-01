<?php
  include("../confige/confige.php");
  include("../confige/topHeader2.php");
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Yangi tashriflar</title>
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
  <?php
    include("../confige/headerTwo.php");
  ?>

  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed" href="../index.php">
          <i class="bi bi-grid"></i>
          <span>Bosh sahifa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="../tashrif.php">
          <i class="bi bi-file-person"></i>
          <span>Tashriflar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="../guruh.php">
          <i class="bi bi-text-indent-left"></i>
          <span>Guruhlar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="../techer.php">
          <i class="bi bi-person-badge"></i>
          <span>O'qituvchilar</span>
        </a>
      </li>
      <li class="nav-item" style="display:<?php if($_COOKIE['Status']==='meneger'){echo 'none';} ?>">
        <a class="nav-link collapsed" href="../statistik.php">
          <i class="bi bi-bar-chart"></i>
          <span>Statistika</span>
        </a>
      </li>
      <li class="nav-item" style="display:<?php if($_COOKIE['Status']==='meneger'){echo 'none';} ?>">
        <a class="nav-link collapsed" href="../hisobot.php">
          <i class="bi bi-file-earmark-pdf"></i>
          <span>Hisobotlar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="../moliya.php">
          <i class="bi bi-currency-bitcoin"></i>
          <span>Moliya</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="../setting.php">
          <i class="bi bi-menu-button-wide"></i>
          <span>Sozlamalar</span>
        </a>
      </li>
    </ul>
  </aside>

  <main id="main" class="main">
    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../index.php">Bosh sahifa</a></li>
          <li class="breadcrumb-item active">Yangi tashriflar</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
        <div class="row">

          <div class="col-12">
          <div class="card ">
              <div class="card-body">
                <h5 class="card-title">Yangi <span>| Tashriflar</span></h5>
                <div class="table-responsive text-nowrap">
				              <table class="table table-bordered border-primary table-striped my_table_search">
                        <thead >
                          <tr>
                              <th>#</th>
                              <th>Talaba FIO</th>
                              <th>Telefon raqam</th>
                              <th>Manzil</th>
                              <th>Tug'ilgan kuni</th>
                              <th>Tashrif vaqti</th>
                              <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $dates1 = date('Y-m-d', strtotime('-1 month'))." 00:00:00";
                            $dates2 = date('Y-m-d')." 00:00:00";
                            $sqlt1 = "SELECT * FROM `user_student` WHERE `Data`>='".$dates1."' AND `Data`<='".$dates2."' ORDER BY `id` DESC";
                            $rest1 = $Confige->SelectAll($sqlt1);
                            $tasht = 0;
                            if($rest1->num_rows>0){
                              $i=1;
                              while($rowt1 = $rest1->fetch_assoc()){
                                $sqlgu = "SELECT * FROM `guruh_users` WHERE `UserID`='".$rowt1['StudentID']."'";
                                $resgu = $Confige->SelectAll($sqlgu);
                                if($resgu->num_rows>0){}else{
                                  echo "<tr>
                                    <td class='text-center'>".$i."</td>
                                    <td>".$rowt1['FIO']."</td>
                                    <td>".$rowt1['Phone']."</td>
                                    <td>".$rowt1['AddresName']."</td>
                                    <td>".$rowt1['Tkun']."</td>
                                    <td>".$rowt1['Data']."</td>
                                    <td class='text-center'><a href='./tashrif_eye.php?StudentID=".$rowt1['StudentID']."'><i class='bi bi-arrow-right-circle'></i></a></td>
                                  </tr>";
                                  $i++;
                                }
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
      </section>
  </main>
  
  <!-- Footer -->
  <?php
    include("../confige/footerTwo.php");
  ?>

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