<?php
  include("./confige/confige.php");
  include("./confige/topHeader.php");
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>To'lovlar</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="assets/images/logo.png" rel="icon">
    <link href="assets/images/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style2.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" />
    <script>
      <?php
        if(isset($_GET['telError'])){echo "alert('Telefon raqam oldin kiritilgan.')";}
        if(isset($_GET['tashPlus'])){echo "alert('Yangi tashrif qo`shildi.')";}
      ?>
    </script>
  </head>
  <body>

  <!-- ======= Header ======= -->
  <?php include("./confige/headerOne.php"); ?>

  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Bosh sahifa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="tashrif.php">
          <i class="bi bi-file-person"></i>
          <span>Tashriflar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="guruh.php">
          <i class="bi bi-text-indent-left"></i>
          <span>Guruhlar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="techer.php">
          <i class="bi bi-person-badge"></i>
          <span>O'qituvchilar</span>
        </a>
      </li>
      <li class="nav-item" style="display:<?php if(isset($_COOKIE['Status'])){if($_COOKIE['Status']==='meneger'){echo 'none';}} ?>">
        <a class="nav-link collapsed" href="statistik.php">
          <i class="bi bi-bar-chart"></i>
          <span>Statistika</span>
        </a>
      </li>
      <li class="nav-item" style="display:<?php if(isset($_COOKIE['Status'])){if($_COOKIE['Status']==='meneger'){echo 'none';}} ?>">
        <a class="nav-link collapsed" href="hisobot.php">
          <i class="bi bi-file-earmark-pdf"></i>
          <span>Hisobotlar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="moliya.php">
          <i class="bi bi-currency-bitcoin"></i>
          <span>Moliya</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="setting.php">
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
          <li class="breadcrumb-item"><a href="index.php">Bosh sahifa</a></li>
          <li class="breadcrumb-item active">To'lovlar</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
        <div class="card info-card revenue-card">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <h5 class="card-title w-100 text-center">To'lovlar (<?php echo $_GET['data']; ?>)</h5>
                    <table class="table text-center table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Guruh</th>
                                <th>FIO</th>
                                <th>To'lov turi</th>
                                <th>To'lov summasi</th>
                                <th>To'lov vaqti</th>
                                <th>Operator</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT guruh.GuruhName,user_student.FIO,user_student_tulov.TulovType,user_student_tulov.Summa,user_student_tulov.Operator,user_student_tulov.Data FROM `user_student_tulov` JOIN `guruh` ON user_student_tulov.GuruhID=guruh.GuruhID JOIN `user_student` ON user_student_tulov.UserID=user_student.StudentID WHERE user_student_tulov.Data>='".$_GET['data']." 00:00:00' AND user_student_tulov.Data<='".$_GET['data']." 23:59:59'";
                                $res = $Confige->SelectAll($sql);
                                if($res->num_rows>0){
                                    $i=1;
                                    $naqt = 0;
                                    $plastik = 0;
                                    $chegirma = 0;
                                    $qaytarildi = 0;
                                    while ($row = $res->fetch_assoc()) {
                                        echo "<tr>
                                            <td>".$i."</td>
                                            <td>".$row['GuruhName']."</td>
                                            <td>".$row['FIO']."</td>
                                            <td>".$row['TulovType']."</td>
                                            <td>".number_format(($row['Summa']), 0, '.', ' ')."</td>
                                            <td>".$row['Data']."</td>
                                            <td>".$row['Operator']."</td>
                                        </tr>";
                                        $i++;
                                        if($row['TulovType']==='Naqt'){
                                            $naqt = $naqt + $row['Summa'];
                                        }elseif($row['TulovType']==='Plastik'){
                                            $plastik = $plastik + $row['Summa'];
                                        }elseif($row['TulovType']==='Chegirma'){
                                            $chegirma = $chegirma + $row['Summa'];
                                        }elseif($row['TulovType']==='qaytarildi'){
                                            $qaytarildi = $qaytarildi + $row['Summa'];
                                        }
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>Naqt To'lovlar</th>
                                <th>Plastik To'lovlar</th>
                                <th>Chegirmalar</th>
                                <th>Qaytarilganlar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo number_format(($naqt), 0, '.', ' '); ?></td>
                                <td><?php echo number_format(($plastik), 0, '.', ' '); ?></td>
                                <td><?php echo number_format(($chegirma), 0, '.', ' '); ?></td>
                                <td><?php echo number_format(($qaytarildi), 0, '.', ' '); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
  </main>
  
  <!--Footer -->
  <?php include("./confige/footerOne.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#datatable').DataTable();
    });
  </script>
  <script src="./assets/js/jquery.inputmask.min.js"></script>
  <script>
      $(document).ready(function(){
          $('.phone').inputmask('999 99 999 9999');
          $('.pasport').inputmask('AA 9999999');
          $('.pnfl').inputmask('99999999999999');
      });
  </script>
</body>
</html>