<?php
  include("../confige/confige.php");
  include("../confige/topHeader2.php");
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Eslatmalar</title>
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
          <li class="breadcrumb-item active">Eslatmalar</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
        <div class="row">

          <div class="col-12">
          <div class="card ">
              <div class="card-body">
                <h5 class="card-title">Talaba <span>| Eslatma habarlar</span></h5>
                <div class="table-responsive text-nowrap">
									<table class="table table-bordered border-primary table-striped my_table_search">
                    <thead >
                      <tr>
                        <th>#</th>
                        <th>Talaba FIO</th>
                        <th>Habar matni</th>
                        <th>Habar vaqti</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sql111 = "SELECT * FROM  user_student_eslatma JOIN user_student ON user_student_eslatma.UserID=user_student.StudentID WHERE  DATE_ADD(Date, INTERVAL YEAR(CURDATE())-YEAR(Date) + IF(DAYOFYEAR(CURDATE()) > (Date),1,0) YEAR) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 0 DAY);";
                        $res111 = $Confige->SelectAll($sql111);
                        if($res111->num_rows>0){
                          $i=1;
                          while ($row111 = $res111->fetch_assoc()) {
                            echo "<tr>
                                    <td class='text-center'>".$i."</td>
                                    <td>".$row111['FIO']."</td>
                                    <td>".$row111['Matn']."</td>
                                    <td class='text-center'>".$row111['Date']."</td>
                                    <td class='text-center'>
                                      <a href='./tashrif_eye.php?StudentID=".$row111['UserID']."'><i class='bi bi-arrow-right-circle'></i></a>
                                    </td>
                                  </tr>";
                                  $i++;
                          }
                        }else{
                          echo "<tr><td colspan='5' class='text-center'>Aktiv Eslatmalat mavhud emas</td></tr>";
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