<?php
  include("./confige/confige.php");
  include("./confige/topHeader.php");
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Statistika</title>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  </head>
  <body>

  <!-- ======= Header ======= -->
  <?php include("./confige/headerOne.php"); ?>

  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
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
        <a class="nav-link " href="statistik.php">
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
          <li class="breadcrumb-item active">Statistika</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
          <div class="col-12">
            <div class="card ">
              <div class="card-body text-center">
                <h5 class="card-title">Tashriflar</h5>
                <?php
                  $tasriflar = array();
                  $guruhPlus = array();
                  $tulovPlus = array();
                  for ($i=-5; $i <= 0; $i++) {
                    $OyBoshi = date('Y-m', strtotime($i.' month'))."-01 00:00:00";
                    $OyOxiri = date('Y-m', strtotime($i.' month'))."-31 23:59:59";
                    $sql1 = "SELECT * FROM `user_student` WHERE `Data`>='".$OyBoshi."' AND `Data`<='".$OyOxiri."'";
                    $res1 = $Confige->SelectAll($sql1);
                    $count = 0;
                    $count2 = 0;
                    $count3 = 0;
                    if($res1->num_rows>0){
                      while($row1=$res1->fetch_assoc()){
                        $count = $count + 1;
                        $StudentID = $row1['StudentID'];
                        $sql2 = "SELECT * FROM `guruh_users` WHERE `UserID`='".$StudentID."'";
                        $res2 = $Confige->SelectAll($sql2);
                        if($res2->num_rows>0){
                          $count2 = $count2 + 1;
                        }
                        $sql3 = "SELECT * FROM `user_student_tulov` WHERE `UserID`='".$StudentID."'";
                        $res3 = $Confige->SelectAll($sql3);
                        if($res3 -> num_rows>0){
                          $count3 = $count3 + 1;
                        }
                      }
                    }
                    array_push($tasriflar,$count);
                    array_push($guruhPlus,$count2);
                    array_push($tulovPlus,$count3);
                  }
                ?>
                <canvas id="tashrifOy" style="width:100%;max-width:100%;max-height:300px"></canvas>
                <script>
                  const xValues = [ <?php for ($i=-5; $i < 0; $i++) { echo "'".date('M', strtotime($i.' month'))."',";}echo "'".date("M")."'"; ?>];
                  new Chart("tashrifOy", {
                    type: "line",
                    data: {
                      labels: xValues,
                      datasets: [{ 
                        data: [<?php foreach ($tasriflar as $value) {echo $value.",";} ?>],
                        borderColor: "red",
                        label:'Tashriflar',
                        fill: false
                      }, { 
                        data: [<?php foreach ($guruhPlus as $value) {echo $value.",";} ?>],
                        borderColor: "green",
                        label:'Guruhga A`zo bo`lganlar',
                        fill: false
                      }, { 
                        data: [<?php foreach ($tulovPlus as $value) {echo $value.",";} ?>],
                        borderColor: "blue",
                        label:'To`lov qilganlar',
                        fill: false
                      }]
                    },
                    options: {
                      legend: {display: false}
                    }
                  });
                </script>
                <hr>
                <div class="table-responsive text-nowrap">
                  <table class="table table-bordered border-primary table-striped my_table_search mt-4">
                    <thead>
                      <tr>
                        <th>Oy</th>
                        <?php for ($i=-5; $i < 0; $i++) { echo "<th>".date('M', strtotime($i.' month'))."</th>";}echo "<th>".date("M")."</th>"; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Tashriflar</td>
                        <?php foreach ($tasriflar as $value) {echo "<td>".$value."</td>";} ?>
                      </tr>
                      <tr>
                        <td>Guruhga a'zo bo'lganlar</td>
                        <?php foreach ($guruhPlus as $value) {echo "<td>".$value."</td>";} ?>
                      </tr>
                      <tr>
                        <td>To'lovlar</td>
                        <?php foreach ($tulovPlus as $value) {echo "<td>".$value."</td>";} ?>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card ">
              <div class="card-body text-center">
                <h5 class="card-title">To'lovlar</h5>
                <?php
                  $naqt = array();
                  $plastik = array();
                  $chegirma = array();
                  $qaytarildi = array();
                  $jammmi = array();
                  for ($i=-5; $i <= 0; $i++) {
                    $OyBoshi1 = date('Y-m', strtotime($i.' month'))."-01 00:00:00";
                    $OyOxiri1 = date('Y-m', strtotime($i.' month'))."-31 23:59:59";
                    $sumNaqt = 0;
                    $sumPlast = 0;
                    $sumChegir = 0;
                    $sumQaytdi = 0;
                    $jamiTulov = 0;
                    $sql4 = "SELECT * FROM `user_student_tulov` WHERE `Data`>='".$OyBoshi1."' AND `Data`<='".$OyOxiri1."'";
                    $res4 = $Confige->SelectAll($sql4);
                    if($res4->num_rows>0){
                      while ($row4 = $res4->fetch_assoc()) {
                        if($row4['TulovType']==='Naqt'){
                          $sumNaqt = $sumNaqt + $row4['Summa'];
                        }elseif ($row4['TulovType']==='Plastik') {
                          $sumPlast = $sumPlast + $row4['Summa'];
                        }elseif ($row4['TulovType']==='Chegirma') {
                          $sumChegir = $sumChegir + $row4['Summa'];
                        }elseif ($row4['TulovType']==='qaytarildi') {
                          $sumQaytdi = $sumQaytdi + $row4['Summa'];
                        }
                      }
                    }
                    $jamiTulov = $sumNaqt + $sumPlast + $sumQaytdi;
                    array_push($jammmi,$jamiTulov);
                    array_push($qaytarildi,$sumQaytdi);
                    array_push($naqt,$sumNaqt);
                    array_push($plastik,$sumPlast);
                    array_push($chegirma,$sumChegir);
                  }
                ?>
                <canvas id="lineChart"  style="width:100%;max-width:100%;height:300px"></canvas>
                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    new Chart(document.querySelector('#lineChart'), {
                      type: 'bar',
                      data: {
                        labels: [<?php for ($i=-5; $i < 0; $i++) { echo "'".date('M', strtotime($i.' month'))."',";}echo "'".date("M")."'"; ?>],
                        datasets: [{
                          label: 'Naqt to`lovlar',
                          data: [<?php foreach ($naqt as $val) {echo $val.",";} ?>],
                          fill: false,
                          backgroundColor: "blue",
                          tension: 0.1
                        },{
                          label: 'Plastik to`lovlar',
                          data: [<?php foreach ($plastik as $val) {echo $val.",";} ?>],
                          fill: false,
                          backgroundColor: "green",
                          tension: 0.1
                        },{
                          label: 'Qaytarilgan tulov',
                          data: [<?php foreach ($qaytarildi as $val) {echo $val.",";} ?>],
                          fill: false,
                          backgroundColor: "aqua",
                          tension: 0.1
                        },{
                          label: 'Chegirmalar',
                          data: [<?php foreach ($chegirma as $val) {echo $val.",";} ?>],
                          fill: false,
                          backgroundColor: "orange",
                          tension: 0.1
                        }]
                      },
                      options: {
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                      }
                    });
                  });
                </script>
                
                <hr>
                <div class="table-responsive text-nowrap">
                  <table class="table table-bordered border-primary table-striped my_table_search mt-4">
                    <thead>
                      <tr>
                        <th>Oy</th>
                        <?php for ($i=-5; $i < 0; $i++) { echo "<th>".date('M', strtotime($i.' month'))."</th>";}echo "<th>".date("M")."</th>"; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Naqt tulovlar</td>
                        <?php foreach ($naqt as $val) {echo "<td>".number_format(($val), 0, '.', ' ')."</td>";} ?>
                      </tr>
                      <tr>
                        <td>Plastik tulovlar</td>
                        <?php foreach ($plastik as $val) {echo "<td>".number_format(($val), 0, '.', ' ')."</td>";} ?>
                      </tr>
                      <tr>
                        <td>Qaytarilgan tulovlar</td>
                        <?php foreach ($qaytarildi as $val) {echo "<td>".number_format(($val), 0, '.', ' ')."</td>";} ?>
                      </tr>
                      <tr>
                        <td>Chegirma tulovlar</td>
                        <?php foreach ($chegirma as $val) {echo "<td>".number_format(($val), 0, '.', ' ')."</td>";} ?>
                      </tr>
                      <tr>
                        <th>Jami to'lovlar</th>
                        <?php foreach ($jammmi as $val) {echo "<th>".number_format(($val), 0, '.', ' ')."</th>";} ?>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card ">
              <div class="card-body text-center">
                <h5 class="card-title">Oylik daromad</h5>
                <?php
                  $alltulov = array();
                  $allxarajat = array();
                  $allishhaqi = array();
                  $alldaromad = array();
                  $Qaytarildi = array();
                  for ($i=-5; $i <= 0; $i++) {
                    $OyBoshi2 = date('Y-m', strtotime($i.' month'))."-01 00:00:00";
                    $OyOxiri2 = date('Y-m', strtotime($i.' month'))."-31 23:59:59";
                    $tulovlar = 0;
                    $xarajat = 0;
                    $ishhaqi = 0;
                    $qaytdi = 0;
                    // Barcha to'lovlar
                    $sql5 = "SELECT * FROM `user_student_tulov` WHERE `Data`>='".$OyBoshi2."' AND `Data`<='".$OyOxiri2."'";
                    $res5 = $Confige->SelectAll($sql5);
                    if($res5->num_rows>0){
                      while ($row5 = $res5->fetch_assoc()) {
                        if($row5['TulovType']==='Naqt'){
                          $tulovlar = $tulovlar + $row5['Summa'];
                        }elseif ($row5['TulovType']==='Plastik') {
                          $tulovlar = $tulovlar + $row5['Summa'];
                        }elseif ($row5['TulovType']==='qaytarildi') {
                          $qaytdi = $qaytdi + $row5['Summa'];
                        }
                      }
                    }
                    // Xarajatlar
                    $sql6="SELECT * FROM `moliya` WHERE `Xisobchi`!='NULL' AND `Tasdiqlandi`>='".$OyBoshi2."' AND `Tasdiqlandi`<='".$OyOxiri2."'";
                    #$sql6 = "SELECT * FROM `moliya` WHERE `Tasdiqlandi`>='".$OyBoshi2."' AND `Tasdiqlandi`<='".$OyOxiri2."' AND `Type`='true'";
                    $res6 = $Confige->SelectAll($sql6);
                    if($res6->num_rows>0){
                      while ($row6 = $res6->fetch_assoc()) {
                          if($row6['TypeTulov']==='NaqtXarajat'){
                            $xarajat = $xarajat+$row6['TulovSumma'];
                          }
                          elseif($row6['TypeTulov']==='PlastikXara'){
                            $xarajat = $xarajat+$row6['TulovSumma'];
                          }
                        
                      }
                    }
                    // Ish haqi to'lovlari
                    $sql7 = "SELECT * FROM `user_techer_ish_haqi` WHERE `Data`>='".$OyBoshi2."' AND `Data`<='".$OyOxiri2."'";
                    $res7 = $Confige->SelectAll($sql7);
                    if($res7->num_rows>0){
                      while ($row7=$res7->fetch_assoc()) {
                        $ishhaqi = $ishhaqi+$row7['Summa'];
                      }
                    }
                    $sql8 = "SELECT * FROM `user_meneger_ish_haqi` WHERE `Data`>='".$OyBoshi2."' AND `Data`<='".$OyOxiri2."'";
                    $res8 = $Confige->SelectAll($sql8);
                    if($res8->num_rows>0){
                      while ($row8 = $res8->fetch_assoc()) {
                        $ishhaqi = $ishhaqi+$row8['Summa'];
                      }
                    }
                    $daromad = $tulovlar-$xarajat-$ishhaqi-$qaytdi;
                    array_push($Qaytarildi,$qaytdi);
                    array_push($alltulov,$tulovlar);
                    array_push($allxarajat,$xarajat);
                    array_push($allishhaqi,$ishhaqi);
                    array_push($alldaromad,$daromad);
                  }                  
                ?>
                <canvas id="barChart" style="max-height: 400px;"></canvas>
                <script>
                  var tolovlar = ["#FFFF66","#FFCC00","#FF9900","#FFCC00","#FF8200","#FF5200"];
                  var xarajatColor = ["#400001","#AC0000","#AA0202","#871105","#900A22","#FE0000"];
                  var ishhaqcolor = ["#0197F6","#1034A6","#73C2FB","#1560BD","#26619C","#002366"];
                  var daromadcolor = ["#3CB043","#B0FC38","#5DBB63","#028A0F","#03C04A","#74B72E"];
                  document.addEventListener("DOMContentLoaded", () => {
                    new Chart(document.querySelector('#barChart'), {
                      type: 'bar',
                      data: {
                        labels: [<?php for ($i=-5; $i < 0; $i++) { echo "'".date('M', strtotime($i.' month'))."',";}echo "'".date("M")."'"; ?>],
                        datasets: [{
                          label: 'To`lovlar',
                          data: [<?php foreach ($alltulov as $val) {echo $val.",";} ?>],
                          backgroundColor: tolovlar,
                          borderWidth: 1,
                          fill: false
                        },{
                          label: 'Xarajatlar',
                          data: [<?php foreach ($allxarajat as $val) {echo $val.",";} ?>],
                          backgroundColor: xarajatColor,
                          borderWidth: 1,
                          fill: false
                        },{
                          label: 'Tulov qaytarildi',
                          data: [<?php foreach ($Qaytarildi as $val) {echo $val.",";} ?>],
                          backgroundColor: xarajatColor,
                          borderWidth: 1,
                          fill: false
                        },{
                          label: 'Ish haqi to`lovlari',
                          data: [<?php foreach ($allishhaqi as $val) {echo $val.",";} ?>],
                          backgroundColor: ishhaqcolor,
                          borderWidth: 1,
                          fill: false
                        },{
                          label: 'Darmomad',
                          data: [<?php foreach ($alldaromad as $val) {echo $val.",";} ?>],
                          backgroundColor: daromadcolor,
                          borderWidth: 1,
                          fill: false
                        }]
                      },
                      options: {
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                      }
                    });
                  });
                </script>
                <hr>
                <div class="table-responsive text-nowrap">
                  <table class="table table-bordered border-primary table-striped my_table_search mt-4">
                    <thead>
                      <tr>
                        <th>Oy</th>
                        <?php for ($i=-5; $i < 0; $i++) { echo "<th>".date('M', strtotime($i.' month'))."</th>";}echo "<th>".date("M")."</th>"; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>To'lovlar</td>
                        <?php foreach ($alltulov as $val) {
                          echo "<td>".number_format(($val), 0, '.', ' ')."</td>";
                          } 
                        ?>
                      </tr>
                      <tr>
                        <td>Xarajatlar</td>
                        <?php foreach ($allxarajat as $val) {echo "<td>".number_format(($val), 0, '.', ' ')."</td>";} ?>
                      </tr>
                      <tr>
                        <td>To'lov qaytarildi</td>
                        <?php foreach ($Qaytarildi as $val) {echo "<td>".number_format(($val), 0, '.', ' ')."</td>";} ?>
                      </tr>
                      <tr>
                        <td>Ish haqi to'lovlari</td>
                        <?php foreach ($allishhaqi as $val) {echo "<td>".number_format(($val), 0, '.', ' ')."</td>";} ?>
                      </tr>
                      <tr>
                        <td>Daromad</td>
                        <?php foreach ($alldaromad as $val) {echo "<td>".number_format(($val), 0, '.', ' ')."</td>";} ?>
                      </tr>
                    </tbody>
                  </table>
                </div>
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
</body>
</html>