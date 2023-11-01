<?php
  include("./confige/confige.php");
  include("./confige/topHeader.php");
  $date = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Bosh sahifa</title>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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
      <h1>Bosh sahifa</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <?php
          $sqlTecher = "SELECT * FROM `user_techer` WHERE 1";
          $resTecher = $Confige->SelectAll($sqlTecher);
          $Techer = 0;
          $TecherActive = 0;
          if($resTecher->num_rows>0){
            while ($rowTecher = $resTecher->fetch_assoc()) {
              $Techer = $Techer+1;
              $sqlTechActiv = "SELECT * FROM `user_techer_guruh` JOIN `guruh` ON user_techer_guruh.GuruhID=guruh.GuruhID WHERE guruh.End>='".$date."' AND user_techer_guruh.TecherID='".$rowTecher['TecherID']."'";
              $resTechActiv = $Confige->SelectAll($sqlTechActiv);
              if($resTechActiv->num_rows>0){
                $TecherActive = $TecherActive + 1;
              }
            }
          }
        ?>
        <div class="col-lg-4">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">O'qituvchilar</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-person"></i>
                </div>
                <div class="ps-3">
                  <h6><?php echo $Techer; ?></h6>
                  <span class="text-success small pt-1 fw-bold"><?php echo $TecherActive; ?></span> <span class="text-muted small pt-2 ps-1">Aktiv o'qituvchilar</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
          $sqlGuruh = "SELECT * FROM `guruh`";
          $resGuruh = $Confige->SelectAll($sqlGuruh);
          $Guruhlar = 0;
          $GuruhlarActive = 0;
          if($resGuruh->num_rows>0){
            while ($rowGuruh=$resGuruh->fetch_assoc()) {
              $Guruhlar = $Guruhlar + 1;
              if($rowGuruh['Start']<=$date AND $rowGuruh['End']>$date){
                $GuruhlarActive = $GuruhlarActive+1;
              }
            }
          }
        ?>
        <div class="col-lg-4">
          <div class="card info-card revenue-card">
            <div class="card-body">
              <h5 class="card-title">Guruhlar</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-recycle"></i>
                </div>
                <div class="ps-3">
                  <h6><?php echo $Guruhlar; ?></h6>
                  <span class="text-success small pt-1 fw-bold">
                    <?php echo $GuruhlarActive;?>
                  </span> <span class="text-muted small pt-2 ps-1">Aktiv guruhlar</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
          $sqlCount = "SELECT * FROM `user_student`";
          $resCount = $Confige->SelectAll($sqlCount);
          $Count = 0;
          if($resCount->num_rows>0){
            while($rowCount = $resCount->fetch_assoc()){
              $Count = $Count + 1;
            }
          }
          $sqlTashrif = "SELECT * FROM `guruh_users` JOIN `guruh` ON guruh_users.GuruhID=guruh.GuruhID;";
          $resTashrif = $Confige->SelectAll($sqlTashrif);
          $Aktif = 0;
          $Yakunlandi = 0;
          $TashrifYakun = 0;
          if($resTashrif->num_rows>0){
            while ($rowTashrif = $resTashrif->fetch_assoc()) {
              
              if($rowTashrif['End']>=$date AND $rowTashrif['Start']<=$date){
                $Aktif = $Aktif + 1;
              }
              if($rowTashrif['End']<$date){
                $Yakunlandi = $Yakunlandi + 1;
              }
            }
          }
        ?>
        <div class="col-lg-4">
          <div class="card info-card customers-card">
            <div class="card-body">
              <h5 class="card-title">Tashriflar</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6><?php echo $Count; ?></h6>
                  <span class="text-danger small pt-1 fw-bold"><?php echo $Yakunlandi; ?></span> <span class="text-muted small pt-2 ps-1">Aktiv tashriflar</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
          $sqlq = "SELECT * FROM `guruh_users`";
          $resq = $Confige->SelectAll($sqlq);
          $qarz = 0;
          if($resq->num_rows>0){
            while($rowq = $resq->fetch_assoc()){
              $GurID = $rowq['GuruhID'];
              $UseID = $rowq['UserID'];
              $sqlq1 = "SELECT * FROM `guruh` WHERE `GuruhID`='".$GurID."'";
              $resq1 = $Confige->SelectAll($sqlq1);
              $rowq1 = $resq1->fetch_assoc();
              $gursum = $rowq1['Summa']*$rowq1['TulovCount'];
              $sqlq3 = "SELECT * FROM `user_student_tulov` WHERE `GuruhID`='".$GurID."' AND `UserID`='".$UseID."'";
              $resq3 = $Confige->SelectAll($sqlq3);
              $qarzsum = 0;
              if($resq3->num_rows>0){
                while ($rowq3=$resq3->fetch_assoc()) {
                  $qarzsum = $qarzsum + $rowq3['Summa'];
                }
              }
              $qarz33 = $gursum-$qarzsum;
              if($qarz33>0){
                $qarz = $qarz+1;
              }
            }
          }
        ?>
        <div class="col-lg-4">
          <div class="card info-card customers-card">
            <div class="card-body">
              <h5 class="card-title">Qarzdorlar</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="ps-3">
                  <h6><?php echo $qarz; ?></h6>
                  <span class="text-danger small pt-1 fw-bold">
                    <a href="./blog/qarz.php" > Batafsil..</a>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
          $dates1 = date('Y-m-d', strtotime('-1 month'))." 00:00:00";
          $dates2 = date('Y-m-d')." 00:00:00";
          $sqlt1 = "SELECT * FROM `user_student` WHERE `Data`>='".$dates1."' AND `Data`<='".$dates2."'";
          $rest1 = $Confige->SelectAll($sqlt1);
          $tasht = 0;
          if($rest1->num_rows>0){
            while($rowt1 = $rest1->fetch_assoc()){
              $sqlgu = "SELECT * FROM `guruh_users` WHERE `UserID`='".$rowt1['StudentID']."'";
              $resgu = $Confige->SelectAll($sqlgu);
              if($resgu->num_rows>0){}else{
                $tasht = $tasht+1;
              }
            }
          }
        ?>
        <div class="col-lg-4">
          <div class="card info-card customers-card">
            <div class="card-body">
              <h5 class="card-title">Yangi tashriflar</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6><?php echo $tasht; ?></h6>
                  <span class="text-danger small pt-1 fw-bold">
                    <a href="./blog/newtshrif.php" > Batafsil..</a>
                  </span> 
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
          $sqles = "SELECT * FROM `user_student_eslatma` WHERE `Date`>='".date("Y-m-d")."'";
          $reses = $Confige->SelectAll($sqles);
          $eslatma = 0;
          if($reses->num_rows>0){
            while ($rowes=$reses->fetch_assoc()) {
              $eslatma  = $eslatma+1;
            }
          }
        ?>
        <div class="col-lg-4">
          <div class="card info-card customers-card">
            <div class="card-body">
              <h5 class="card-title">Faol Eslatmalar</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-messenger"></i>
                </div>
                <div class="ps-3">
                  <h6><?php echo $eslatma; ?></h6>
                  <span class="text-danger small pt-1 fw-bold">
                    <a href="./blog/eslatma.php" > Batafsil..</a>
                  </span> 
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card info-card customers-card">
            <div class="card-body text-center">
            <h5 class="card-title ">Biz haqimizda</h5>
            <?php
              $tel = 0;
              $face = 0;
              $inst = 0;
              $banner = 0;
              $tanish = 0;
              $boshqa = 0;
              $sqlhaq = "SELECT * FROM `user_student`";
              $reshaq = $Confige->SelectAll($sqlhaq);
              if($reshaq->num_rows>0){
                while ($rowhaq = $reshaq->fetch_assoc()) {
                  if($rowhaq['Haqimizda']==='Facebook'){
                    $face = $face + 1;
                  }elseif ($rowhaq['Haqimizda']==='Bannerlar') {
                    $banner = $banner+1;
                  }elseif ($rowhaq['Haqimizda']==='Instagram') {
                    $face = $face + 1;
                  }elseif ($rowhaq['Haqimizda']==='Telegram') {
                    $tel = $tel + 1;
                  }elseif ($rowhaq['Haqimizda']==='Tanishlar') {
                    $tanish = $tanish + 1;
                  }else{
                    $boshqa = $boshqa + 1;
                  }
                }
              }
            ?>
            <canvas id="haqimizda" style="height: 400px;"></canvas>
            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new Chart(document.querySelector('#haqimizda'), {
                  type: 'doughnut',
                  data: {
                    labels: ['Telegram','Instagram','Facebook','Bannerlar','Tanishlar','Boshqa' ],
                    datasets: [{
                      label: 'Soni: ',
                      data: [<?php echo $tel.",".$face.",".$inst.",".$banner.",".$tanish.",".$banner; ?>],
                      backgroundColor: ['#2E9CD6','#CC3C8D','#3F74C4','#F7F701','#AE9482','#539A2B'],
                      hoverOffset: 4
                    }]
                  }
                });
              });
            </script>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card info-card customers-card">
            <div class="card-body text-center">
            <h5 class="card-title ">Guruhlardagi talabalar</h5>
            <?php
              $sqlgur = "SELECT * FROM `guruh_users`";
              $resgur = $Confige->SelectAll($sqlgur);
              $yangi = 0;
              $activ = 0;
              $eski = 0;
              if($resgur->num_rows>0){
                while ($rowgur = $resgur->fetch_assoc()) {
                  $guruhID = $rowgur['GuruhID'];
                  $sqlgue2 = "SELECT * FROM `guruh` WHERE `GuruhID`='".$guruhID."'";
                  $resgur2 = $Confige->SelectAll($sqlgue2);
                  $rowgur2 = $resgur2->fetch_assoc();
                  $start = $rowgur2['Start'];
                  $End = $rowgur2['End'];
                  if($start<=$date AND $End>=$date){
                    $activ = $activ + 1;
                  }elseif($start>=$date){
                    $yangi = $yangi + 1;
                  }else{
                    $eski = $eski + 1;
                  }
                }
              }
            ?>
            <canvas id="guruhtashrif" style="height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#guruhtashrif'), {
                    type: 'doughnut',
                    data: {
                      labels: [
                        'Activ guruhlarda',
                        'Yangi guruhlarda',
                        'Yakunlangan guruhlarda'
                      ],
                      datasets: [{
                        label: 'Talabalar Soni: ',
                        data: [<?php echo $activ.", ".$yangi.", ".$eski; ?>],
                        backgroundColor: [
                          '#63AA31',
                          '#0F2FB3',
                          '#B61A21'
                        ],
                        hoverOffset: 4
                      }]
                    }
                  });
                });
              </script>
            </div>
          </div>
        </div>

        <div class="col-lg-12">
          <div class="card info-card customers-card">
            <div class="card-body text-center">
              <h5 class="card-title ">Tashriflar</h5>
                <?php
                  $tasriflar = array();
                  $guruhPlus = array();
                  $tulovPlus = array();
                  for ($i=-5; $i <= 0; $i++) {
                    $OyBoshi = date('Y-m-d', strtotime($i.' day'))." 00:00:00";
                    $OyOxiri = date('Y-m-d', strtotime($i.' day'))." 23:59:59";
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
              <canvas id="tashrifkun" style="width:100%;height:300px"></canvas>
              <script>
                const xValues = [<?php for ($i=-5; $i < 0; $i++) { echo "'".date('Y-m-d', strtotime($i.' day'))."',";}echo "'".date("Y-m-d")."'"; ?>];
                new Chart("tashrifkun", {
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
                      label:'Guruhga a`zo bo`lganlar',
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
                    <th>Sana</th>
                    <?php for ($i=-5; $i < 0; $i++) { echo "<th>".date('Y-m-d', strtotime($i.' day'))."</th>";}echo "<th>".date("Y-m-d")."</th>"; ?>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Tashriflar</td>
                    <?php foreach ($tasriflar as $value) {echo "<td>".$value."</td>";} ?>
                  </tr>
                  <tr>
                    <td>Guruhga a`zo bo'lganlar</td>
                    <?php foreach ($guruhPlus as $value) {echo "<td>".$value."</td>";} ?>
                  </tr>
                  <tr>
                    <td>To'lov qilganlar</td>
                    <?php foreach ($tulovPlus as $value) {echo "<td>".$value."</td>";} ?>
                  </tr>
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12" style="display:<?php if(isset($_COOKIE['Status'])){if($_COOKIE['Status']==='meneger'){echo 'none';}} ?>">
          <div class="card ">
            <div class="card-body text-center">
              <h5 class="card-title">To'lovlar</h5>
              <?php
                $naqt = array();
                $plastik = array();
                $chegirma = array();
                $qaytarildi = array();
                $jamitulov = array();
                for ($i=-5; $i <= 0; $i++) {
                  $OyBoshi1 = date('Y-m-d', strtotime($i.' day'))." 00:00:00";
                  $OyOxiri1 = date('Y-m-d', strtotime($i.' day'))." 23:59:59";
                  $sumNaqt = 0;
                  $sumPlast = 0;
                  $sumChegir = 0;
                  $sumQayt = 0;
                  $sumJami = 0;
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
                        $sumQayt = $sumQayt + $row4['Summa'];
                      }
                    }
                  }
                  $sumJami = $sumNaqt + $sumPlast - $sumQayt;
                  array_push($naqt,$sumNaqt);
                  array_push($plastik,$sumPlast);
                  array_push($chegirma,$sumChegir);
                  array_push($qaytarildi,$sumQayt);
                  array_push($jamitulov,$sumJami);
                }
              ?>
              <canvas id="lineChart"  style="width:100%;max-width:100%;height:300px"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#lineChart'), {
                    type: 'bar',
                    data: {
                      labels: [<?php for ($i=-5; $i < 0; $i++) { echo "'".date('Y-m-d', strtotime($i.' day'))."',";}echo "'".date("Y-m-d")."'"; ?>],
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
                        label: 'To`lov qaytarildi',
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
                    <th>Sana</th>
                    <?php for ($i=-5; $i < 0; $i++) { 
                        echo "<th><a href='index2.php?data=".date('Y-m-d', strtotime($i.' day'))."'>".date('Y-m-d', strtotime($i.' day'))."</a></th>";
                      }
                        echo "<th><a href='index2.php?data=".date("Y-m-d")."'>".date("Y-m-d")."</a></th>"; 
                    ?>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Naqt tulovlar</td>
                    <?php foreach ($naqt as $value) {echo "<td>".number_format(($value), 0, '.', ' ')."</td>";} ?>
                  </tr>
                  <tr>
                    <td>Plastik tulovlar</td>
                    <?php foreach ($plastik as $value) {echo "<td>".number_format(($value), 0, '.', ' ')."</td>";} ?>
                  </tr>
                  <tr>
                    <td>Qaytarilgan tulovlar</td>
                    <?php foreach ($qaytarildi as $value) {echo "<td>".number_format(($value), 0, '.', ' ')."</td>";} ?>
                  </tr>
                  <tr>
                    <td>Chegirma</td>
                    <?php foreach ($chegirma as $value) {echo "<td>".number_format(($value), 0, '.', ' ')."</td>";} ?>
                  </tr>
                  <tr>
                    <td>Jami tulovlar</td>
                    <?php foreach ($jamitulov as $value) {echo "<th>".number_format(($value), 0, '.', ' ')."</th>";} ?>
                  </tr>
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>



        <div class="col-lg-12">
          <div class="card info-card customers-card">
            <div class="card-body text-center">
            <h5 class="card-title">Hududlardan tashriflar</h5>
            <?php
              $sqlman = "SELECT * FROM `user_student` WHERE 1";
              $resman = $Confige->SelectAll($sqlman);
              $t212 = 0;
              $t207 = 0;
              $t220 = 0;
              $t224 = 0;
              $t229 = 0;
              $t232 = 0;
              $t233 = 0;
              $t234 = 0;
              $t235 = 0;
              $t237 = 0;
              $t240 = 0;
              $t242 = 0;
              $t245 = 0;
              $t246 = 0;
              $t250 = 0;
              $t401 = 0;

              if($resman->num_rows>0){
                while ($rowman = $resman->fetch_assoc()) {
                  if($rowman['AddresCode']==='10212'){
                    $t212 = $t212 + 1;
                  }elseif($rowman['AddresCode']==='10207'){
                    $t207 = $t207 + 1;
                  }elseif($rowman['AddresCode']==='10220'){
                    $t220 = $t220 + 1;
                  }elseif($rowman['AddresCode']==='10224'){
                    $t224 = $t224 + 1;
                  }elseif($rowman['AddresCode']==='10229'){
                    $t229 = $t229 + 1;
                  }elseif($rowman['AddresCode']==='10232'){
                    $t232 = $t232 + 1;
                  }elseif($rowman['AddresCode']==='10233'){
                    $t233 = $t233 + 1;
                  }elseif($rowman['AddresCode']==='10234'){
                    $t234 = $t234 + 1;
                  }elseif($rowman['AddresCode']==='10235'){
                    $t235 = $t235 + 1;
                  }elseif($rowman['AddresCode']==='10237'){
                    $t237 = $t237 + 1;
                  }elseif($rowman['AddresCode']==='10240'){
                    $t240 = $t240 + 1;
                  }elseif($rowman['AddresCode']==='10242'){
                    $t242 = $t242 + 1;
                  }elseif($rowman['AddresCode']==='10245'){
                    $t245 = $t245 + 1;
                  }elseif($rowman['AddresCode']==='10246'){
                    $t246 = $t246 + 1;
                  }elseif($rowman['AddresCode']==='10250'){
                    $t250 = $t250 + 1;
                  }elseif($rowman['AddresCode']==='10401'){
                    $t401 = $t401 + 1;
                  }
                }
              }
            ?>
            <div id="tashriflarni"></div>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#tashriflarni"), {
                    series: [{
                      data: [<?php echo $t212.",".$t207.",".$t220.",".$t224.",".$t229.",".$t232.",".$t233.",".$t234.",".$t235.",".$t237.",".$t240.",".$t242.",".$t245.",".$t246.",".$t250.",".$t401; ?>]
                    }],
                    chart: {type: 'bar',height: 350},
                    plotOptions: {bar: {borderRadius: 4,horizontal: true,}},
                    dataLabels: {enabled: false},
                    xaxis: {
                      categories: ['Dexaqonobod t', 'G`uzor tuman', 'Qamashi tuman', 'Qarshi tuman', 'Koson tuman', 'Kitob tuman', 'Mirishkor tuman',
                        'Muborak tuman', 'Nishon tuman', 'Kasbi tuman', 'Ko`kdala tuman','Chiroqchi tuman', 'Shaxrisabz tuman', 'Shaxrisabz shaxar', 'Yakkabo` tuman', 'Qarshi shaxar'
                      ],
                    }
                  }).render();
                });
              </script>
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