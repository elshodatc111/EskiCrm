<?php
  include("../confige/confige.php");
  include("../confige/topHeader2.php");
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Qarzdorlar</title>
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
<?php
  $sqlMen = "SELECT * FROM `user_meneger`";
?>
  <main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
          <div class="col-12">
            <div class="card ">
              <div class="card-body">
                <h5 class="card-title">Meneger statistik <span>| Kunlik</span></h5>
                <div class="table-responsive text-nowrap">
				          <table class="table table-bordered border-primary table-striped my_table_search">
                    <thead >
                      <tr>
                        <th>#</th>
                        <th>Meneger</th>
                        <th>Tashriflar</th>
                        <th>Aktiv Tashriflar</th>
                        <th>To'lovlar soni</th>
                        <th>To'lov summasi</th>
                        <th>Chegirma</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $resMen = $Confige->SelectAll($sqlMen);
                        if($resMen->num_rows>0){
                          $i=1;
                          while ($rowMen = $resMen->fetch_assoc()) {
                            $a1 = date("Y-m-d")." 00:00:00";
                            $a2 = date("Y-m-d")." 23:59:59";
                            $sqla1 = "SELECT * FROM `user_student` WHERE `Data`>='".$a1."' AND `Data`<='".$a2."' AND `Operator`='".$rowMen['Username']."'";
                            $resa1 = $Confige->SelectAll($sqla1);
                            $tasha1 = 0;
                            $tahacriva1 = 0;
                            if($resa1->num_rows>0){
                              while ($rowa1 = $resa1->fetch_assoc()) {
                                $tasha1 = $tasha1 + 1;
                                $sqla2 = "SELECT * FROM `guruh_users` WHERE `UserID`='".$rowa1['StudentID']."'";
                                $resa2 = $Confige->SelectAll($sqla2);
                                if($resa2->num_rows>0){
                                  $tahacriva1 = $tahacriva1 + 1;
                                }
                              }
                            }
                            $sqla3 = "SELECT * FROM `user_student_tulov` WHERE `Operator`='".$rowMen['Username']."' AND `Data`>='".$a1."' AND `Data`<='".$a2."'";
                            $tulSona3 = 0;
                            $tulSuma3 = 0;
                            $yulChega3 = 0;
                            $resa3 = $Confige->SelectAll($sqla3);
                            if($resa3->num_rows>0){
                              while ($rowa3 = $resa3->fetch_assoc()) {
                                if($rowa3['TulovType']==='Chegirma'){
                                  $yulChega3 = $yulChega3 + $rowa3['Summa'];
                                }else{
                                  $tulSuma3 = $tulSuma3 + $rowa3['Summa'];
                                  $tulSona3 = $tulSona3 + 1;
                                }
                              }
                            }
                            echo "<tr>
                              <td>".$i."</td>
                              <td>".$rowMen['FIO']."</td>
                              <td class='text-center'>".$tasha1."</td>
                              <td class='text-center'>".$tahacriva1."</td>
                              <td class='text-center'>".$tulSona3."</td>
                              <td class='text-center'>".number_format(($tulSuma3), 0, '.', ' ')."</td>
                              <td class='text-center'>".number_format(($yulChega3), 0, '.', ' ')."</td>
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
          </div>
          <div class="col-12">
            <div class="card ">
              <div class="card-body">
                <h5 class="card-title">Meneger statistik <span>| Hafta boshidan</span></h5>
                <div class="table-responsive text-nowrap">
				          <table class="table table-bordered border-primary table-striped my_table_search">
                    <thead >
                      <tr>
                        <th>#</th>
                        <th>Meneger</th>
                        <th>Tashriflar</th>
                        <th>Aktiv Tashriflar</th>
                        <th>To'lovlar soni</th>
                        <th>To'lov summasi</th>
                        <th>Chegirma</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                          $resMen2 = $Confige->SelectAll($sqlMen);
                          if($resMen2->num_rows>0){
                            $i=1;
                            while ($rowMen = $resMen2->fetch_assoc()) {
                              $b1 = date('Y-m-d', strtotime("this week"))." 00:00:00";
                              $b2 = date("Y-m-d")." 23:59:59";
                              $sqlb1 = "SELECT * FROM `user_student` WHERE `Data`>='".$b1."' AND `Data`<='".$b2."' AND `Operator`='".$rowMen['Username']."'";
                              $resb1 = $Confige->SelectAll($sqlb1);
                              $tashb1 = 0;
                              $tahacrivb1 = 0;
                              if($resb1->num_rows>0){
                                while ($rowb1 = $resb1->fetch_assoc()) {
                                  $tashb1 = $tashb1 + 1;
                                  $sqlb2 = "SELECT * FROM `guruh_users` WHERE `UserID`='".$rowb1['StudentID']."'";
                                  $resb2 = $Confige->SelectAll($sqlb2);
                                  if($resb2->num_rows>0){
                                    $tahacrivb1 = $tahacrivb1 + 1;
                                  }
                                }
                              }
                              $sqlb3 = "SELECT * FROM `user_student_tulov` WHERE `Operator`='".$rowMen['Username']."' AND `Data`>='".$b1."' AND `Data`<='".$b2."'";
                              $tulSonb3 = 0;
                              $tulSumb3 = 0;
                              $yulChegb3 = 0;
                              $resb3 = $Confige->SelectAll($sqlb3);
                              if($resb3->num_rows>0){
                                while ($rowb3 = $resb3->fetch_assoc()) {
                                  if($rowb3['TulovType']==='Chegirma'){
                                    $yulChegb3 = $yulChegb3 + $rowb3['Summa'];
                                  }else{
                                    $tulSumb3 = $tulSumb3 + $rowb3['Summa'];
                                    $tulSonb3 = $tulSonb3 + 1;
                                  }
                                }
                              }
                              echo "<tr>
                                <td>".$i."</td>
                                <td>".$rowMen['FIO']."</td>
                                <td class='text-center'>".$tashb1."</td>
                                <td class='text-center'>".$tahacrivb1."</td>
                                <td class='text-center'>".$tulSonb3."</td>
                                <td class='text-center'>".number_format(($tulSumb3), 0, '.', ' ')."</td>
                                <td class='text-center'>".number_format(($yulChegb3), 0, '.', ' ')."</td>
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
          </div>
          <div class="col-12">
            <div class="card ">
              <div class="card-body">
                <h5 class="card-title">Meneger statistik <span>| Oy boshidan</span></h5>
                <div class="table-responsive text-nowrap">
				          <table class="table table-bordered border-primary table-striped my_table_search">
                  <thead >
                      <tr>
                        <th>#</th>
                        <th>Meneger</th>
                        <th>Tashriflar</th>
                        <th>Aktiv Tashriflar</th>
                        <th>To'lovlar soni</th>
                        <th>To'lov summasi</th>
                        <th>Chegirma</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $resMen = $Confige->SelectAll($sqlMen);
                        if($resMen->num_rows>0){
                          $i=1;
                          while ($rowMen = $resMen->fetch_assoc()) {
                            $c1 = date("Y-m")."-01 00:00:00";
                            $c2 = date("Y-m-d")." 23:59:59";
                            $sqlc1 = "SELECT * FROM `user_student` WHERE `Data`>='".$c1."' AND `Data`<='".$c2."' AND `Operator`='".$rowMen['Username']."'";
                            $resc1 = $Confige->SelectAll($sqlc1);
                            $tashc1 = 0;
                            $tahacrivc1 = 0;
                            if($resc1->num_rows>0){
                              while ($rowc1 = $resc1->fetch_assoc()) {
                                $tashc1 = $tashc1 + 1;
                                $sqlc2 = "SELECT * FROM `guruh_users` WHERE `UserID`='".$rowc1['StudentID']."'";
                                $resc2 = $Confige->SelectAll($sqlc2);
                                if($resc2->num_rows>0){
                                  $tahacrivc1 = $tahacrivc1 + 1;
                                }
                              }
                            }
                            $sqlac = "SELECT * FROM `user_student_tulov` WHERE `Operator`='".$rowMen['Username']."' AND `Data`>='".$c1."' AND `Data`<='".$c2."'";
                            $tulSonac = 0;
                            $tulSumac = 0;
                            $yulChegac = 0;
                            $resac = $Confige->SelectAll($sqlac);
                            if($resac->num_rows>0){
                              while ($rowac = $resac->fetch_assoc()) {
                                if($rowac['TulovType']==='Chegirma'){
                                  $yulChegac = $yulChegac + $rowac['Summa'];
                                }else{
                                  $tulSumac = $tulSumac + $rowac['Summa'];
                                  $tulSonac = $tulSonac + 1;
                                }
                              }
                            }
                            echo "<tr>
                              <td>".$i."</td>
                              <td>".$rowMen['FIO']."</td>
                              <td class='text-center'>".$tashc1."</td>
                              <td class='text-center'>".$tahacrivc1."</td>
                              <td class='text-center'>".$tulSonac."</td>
                              <td class='text-center'>".number_format(($tulSumac), 0, '.', ' ')."</td>
                              <td class='text-center'>".number_format(($yulChegac), 0, '.', ' ')."</td>
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
          </div>
          <div class="col-12">
            <div class="card ">
              <div class="card-body">
                <h5 class="card-title">Meneger statistik <span>| Yil boshidan</span></h5>
                <div class="table-responsive text-nowrap">
				          <table class="table table-bordered border-primary table-striped my_table_search">
                    <thead >
                      <tr>
                        <th>#</th>
                        <th>Meneger</th>
                        <th>Tashriflar</th>
                        <th>Aktiv Tashriflar</th>
                        <th>To'lovlar soni</th>
                        <th>To'lov summasi</th>
                        <th>Chegirma</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        $resMen4 = $Confige->SelectAll($sqlMen);
                        if($resMen4->num_rows>0){
                          $i=1;
                          while ($rowMen = $resMen4->fetch_assoc()) {
                            $q1 = date("Y")."-01-01 00:00:00";
                            $q2 = date("Y-m-d")." 23:59:59";
                            $sqlq1 = "SELECT * FROM `user_student` WHERE `Data`>='".$q1."' AND `Data`<='".$q2."' AND `Operator`='".$rowMen['Username']."'";
                            $resq1 = $Confige->SelectAll($sqlq1);
                            $tashq1 = 0;
                            $tahacrivq1 = 0;
                            if($resq1->num_rows>0){
                              while ($rowq1 = $resq1->fetch_assoc()) {
                                $tashq1 = $tashq1 + 1;
                                $sqlq2 = "SELECT * FROM `guruh_users` WHERE `UserID`='".$rowq1['StudentID']."'";
                                $resq2 = $Confige->SelectAll($sqlq2);
                                if($resq2->num_rows>0){
                                  $tahacrivq1 = $tahacrivq1 + 1;
                                }
                              }
                            }
                            $sqlacq = "SELECT * FROM `user_student_tulov` WHERE `Operator`='".$rowMen['Username']."' AND `Data`>='".$q1."' AND `Data`<='".$q2."'";
                            $tulSonac1 = 0;
                            $tulSumac1 = 0;
                            $yulChegac1 = 0;
                            $resac = $Confige->SelectAll($sqlacq);
                            if($resac->num_rows>0){
                              while ($rowac = $resac->fetch_assoc()) {
                                if($rowac['TulovType']==='Chegirma'){
                                  $yulChegac1 = $yulChegac1 + $rowac['Summa'];
                                }else{
                                  $tulSumac1 = $tulSumac1 + $rowac['Summa'];
                                  $tulSonac1 = $tulSonac1 + 1;
                                }
                              }
                            }
                            echo "<tr>
                              <td>".$i."</td>
                              <td>".$rowMen['FIO']."</td>
                              <td class='text-center'>".$tashq1."</td>
                              <td class='text-center'>".$tahacrivq1."</td>
                              <td class='text-center'>".$tulSonac1."</td>
                              <td class='text-center'>".number_format(($tulSumac1), 0, '.', ' ')."</td>
                              <td class='text-center'>".number_format(($yulChegac1), 0, '.', ' ')."</td>
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