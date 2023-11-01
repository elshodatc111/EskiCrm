<?php
  include("../confige/confige.php");
  include("../confige/topHeader2.php");
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Tug'ilgan kunlar</title>
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
      <li class="nav-item" style="display:<?php if(isset($_COOKIE['Status'])){if($_COOKIE['Status']==='meneger'){echo 'none';}} ?>">
        <a class="nav-link collapsed" href="../statistik.php">
          <i class="bi bi-bar-chart"></i>
          <span>Statistika</span>
        </a>
      </li>
      <li class="nav-item" style="display:<?php if(isset($_COOKIE['Status'])){if($_COOKIE['Status']==='meneger'){echo 'none';}} ?>">
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
          <li class="breadcrumb-item active">Tug'ilgan kunlar</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
        <div class="row">

          <div class="col-12">
            <div class="card ">
              <div class="card-body text-center pt-2 pb-1">
                <h5 class="modal-title">Bugun tug'ilgan kuni</h5>
              </div>
            </div>
            
            <div class="row">
              <?php
                $sqlTkun11 = "SELECT * FROM  user_student WHERE  DATE_ADD(Tkun, INTERVAL YEAR(CURDATE())-YEAR(Tkun) + IF(DAYOFYEAR(CURDATE()) > (Tkun),1,0) YEAR) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 2 DAY);";
                $ResTkun11 = $Confige->SelectAll($sqlTkun11);
                $TKun = 0;
                if($ResTkun11->num_rows>0){
                  while ($rowTkun=$ResTkun11->fetch_assoc()) {
                    echo "
                    <div class='col-lg-4'>
                      <div class='card p-2'>
                        <div class='d-flex align-items-center'>
                          <div class='card-icon rounded-circle d-flex align-items-center justify-content-center'>
                            <i class='bi bi-flower1'></i>
                          </div>
                          <div class='ps-3'>
                            <h6><a href='./tashrif_eye.php?StudentID=".$rowTkun['StudentID']."'>".$rowTkun['FIO']."</a></h6>
                            <span class='text-danger small pt-1 fw-bold'>".$rowTkun['Tkun']."</span> 
                            <span class='text-muted small pt-2 ps-1'>Talaba <br> tug'ilgan kuni yaqinlashmoqda</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    ";
                  }
                }
                $sqlTkun22 = "SELECT * FROM  user_meneger WHERE  DATE_ADD(TDay, INTERVAL YEAR(CURDATE())-YEAR(TDay) + IF(DAYOFYEAR(CURDATE()) > (TDay),1,0) YEAR) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 2 DAY);";
                $ResTkun22 = $Confige->SelectAll($sqlTkun22);
                if($ResTkun22->num_rows>0){
                  while ($rowTkun=$ResTkun22->fetch_assoc()) {
                    echo "
                    <div class='col-lg-4'>
                      <div class='card p-2'>
                        <div class='d-flex align-items-center'>
                          <div class='card-icon rounded-circle d-flex align-items-center justify-content-center'>
                            <i class='bi bi-flower1'></i>
                          </div>
                          <div class='ps-3'>
                            <h6><a href='./hodimlar.php?UserID=".$rowTkun['UserID']."'>".$rowTkun['FIO']."</a></h6>
                            <span class='text-danger small pt-1 fw-bold'>".$rowTkun['TDay']."</span> 
                            <span class='text-muted small pt-2 ps-1'>Hodimni<br> tug`ilgan kuni yaqinlashmoqda</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    ";
                  }
                }
                $sqlTkun33 = "SELECT * FROM  user_techer WHERE  DATE_ADD(TDate, INTERVAL YEAR(CURDATE())-YEAR(TDate) + IF(DAYOFYEAR(CURDATE()) > (TDate),1,0) YEAR) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 2 DAY);";
                $ResTkun33 = $Confige->SelectAll($sqlTkun33);
                if($ResTkun33->num_rows>0){
                  while ($rowTkun=$ResTkun33->fetch_assoc()) {
                    echo "
                    <div class='col-lg-4'>
                      <div class='card p-2'>
                        <div class='d-flex align-items-center'>
                          <div class='card-icon rounded-circle d-flex align-items-center justify-content-center'>
                            <i class='bi bi-flower1'></i>
                          </div>
                          <div class='ps-3'>
                            <h6><a href='./techer_eye.php?TechID=".$rowTkun['TecherID']."'>".$rowTkun['TecherName']."</a></h6>
                            <span class='text-danger small pt-1 fw-bold'>".$rowTkun['TDate']."</span> 
                            <span class='text-muted small pt-2 ps-1'>O`qituvchi<br> tug`ilgan kuni yaqinlashmoqda</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    ";
                  }
                }
              ?>
              
            </div>
          </div>

          
          <div class="modal fade  modal_form" id="qarztashrif" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Qarzdor talabalar</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="" method="POST">
                    <div class="row">
                      <div class="col-lg-12">
                        <label for="" class="input-label">Qarzdorlik maksimal summasi</label>
                        <input type="text" class="form-control input_form" placeholder="Qarzdorlik maksimal summasi" required>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" class="Filter_btn btn">Qarzdorlarni qidirish</button>
                      </div>
                    </div>
                  </form>
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