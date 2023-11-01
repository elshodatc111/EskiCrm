<?php
  include("./confige/confige.php");
  include("./confige/topHeader.php");
// Yangi meneger qo'shish
  if(isset($_POST['addmeneger'])){
    $password = md5($_POST['password']);
    $username = str_replace("'","`",$_POST['username']);
    $status = $_POST['status'];
    $tkun = $_POST['tkun'];
    $phone = $_POST['phone'];
    $UserID = time();
    $manzil = str_replace("'","`",$_POST['manzil']);
    $fio = str_replace("'","`",$_POST['fio']);
    $sqlAddMeneger = "INSERT INTO `user_meneger`(`id`, `UserID`, `FIO`, `Phone`, `Addres`, `TDay`, `Status`, `Username`, `Password`, `Data`)
    VALUES (NULL,'".$UserID."','".$fio."','".$phone."','".$manzil."','".$tkun."','".$status."','".$username."','".$password."',CURRENT_TIMESTAMP)";
    $sqlMenegerHistory = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) VALUES (NULL,'".$_COOKIE['Username']."','".$username." yangi operator qo`shdi','".time()."')";
    $sqltyping = "SELECT * FROM `user_meneger` WHERE `Username`='".$username."'";
    $resaddmen = $Confige->SelectAll($sqltyping);
    if($resaddmen->num_rows>0){
      echo "<script>alert('Login band. Boshqa login kiriting');</script>";
    }else{
      if($Confige->InsertInto($sqlAddMeneger)){
        $Confige->InsertInto2($sqlMenegerHistory,'./setting.php','addmenengerTrue=true');
      }
    }
  }
// Yangi kurs qo'shish
  if(isset($_POST['coursPlus'])){
    $CoursName = str_replace("'","`",$_POST['CoursName']);
    $darsCount = $_POST['darsCount'];
    $sqlCours = "INSERT INTO `cours`(`id`, `CoursID`, `CoursName`, `CounLessn`, `UserID`, `Data`) 
    VALUES (NULL,'".time()."','".$CoursName."','".$darsCount."','".$_COOKIE['Username']."',CURRENT_TIMESTAMP)";
    $sqlMenegerHistory2 = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) 
    VALUES (NULL,'".$_COOKIE['Username']."','".$CoursName." yangi kurs qo`shdi','".time()."')";
    if($Confige->InsertInto($sqlCours)){
      $Confige->InsertInto2($sqlMenegerHistory2,'./setting.php','coursplus=true');
    }
  }
// Yangi hona qo'shish
  if(isset($_POST['AddName'])){
    $roomName = str_replace("'","`",$_POST['roomName']);
    $roomCount = str_replace("'","`",$_POST['roomCount']);
    $sqlXonaPlus = "INSERT INTO `xonalar`(`id`, `XonaNomi`, `XonaSigimi`, `Data`) VALUES (NULL,'".$roomName."','".$roomCount."',CURRENT_TIMESTAMP)";
    $sqlMenegerHistory3 = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) 
    VALUES (NULL,'".$_COOKIE['Username']."','".$roomName." yangi xona qo`shdi','".time()."')";
    if($Confige->InsertInto($sqlXonaPlus)){
      $Confige->InsertInto2($sqlMenegerHistory3,'./setting.php','xonaplus=true');
    }
  }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Setting</title>
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
    <script>
      <?php
        if(isset($_GET['addmenengerTrue'])){echo "alert('Yangi opertaor qo`shildi')";}
        if(isset($_GET['coursplus'])){echo "alert('Yangi kurs qo`shildi')";}
        if(isset($_GET['xonaplus'])){echo "alert('Yangi xona qo`shildi')";}
      ?>
    </script>
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
        <a class="nav-link " href="setting.php">
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
          <li class="breadcrumb-item active">Sozlamalar</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
          <div class="col-12">
            <div class="card ">
              <div class="card-body row pt-3">
                <div class="col-lg-4 py-1"><button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#newCours"><i class="bi bi-book"></i> Yangi Kurs</button></div>
                <div class="col-lg-4 py-1"><button class="btn btn-outline-warning w-100" data-bs-toggle="modal" data-bs-target="#addmeneger" style="display:<?php if($_COOKIE['Status']!='admin'){echo 'none';}else ?>"><i class="bi bi-person"></i> Yangi Meneger</button></div>
                <div class="col-lg-4 py-1"><button class="btn btn-outline-info w-100" data-bs-toggle="modal" data-bs-target="#addxona"><i class="bi bi-bank2"></i> Yangi Xona</button></div>
              </div>
            </div>
          </div>
          <!-- Yangi kurs -->
          <div class="modal fade" id="newCours" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Yangi kurs</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="setting.php" method="POST">
                    <div class="row">
                      <div class="col-lg-12">
                        <label for="" class="input-label">Yangi kurs nomi</label>
                        <input type="text" class="form-control input_form" name="CoursName" placeholder="Kurs nomi" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Darslar soni</label>
                        <input type="number" class="form-control input_form" name="darsCount" placeholder="Darslar soni" required>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" name="coursPlus" class="Filter_btn btn">Kursni qo'shish</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Yangi operator Plus -->
          <div class="modal fade" id="addmeneger" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Yangi meneger</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="setting.php" method="POST">
                    <div class="row">
                      <div class="col-lg-12">
                        <label for="" class="input-label">Meneger FIO</label>
                        <input type="text" class="form-control input_form" name="fio" placeholder="Meneger FIO" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Telefon raqami</label>
                        <input type="text" class="form-control input_form phone" name='phone' value="998" placeholder="Telefon raqami" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Yashash Manzili</label>
                        <input type="text" class="form-control input_form" name='manzil' placeholder="Yashash Manzili" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Tug'ilgan kuni</label>
                        <input type="date" class="form-control input_form" name='tkun' placeholder="Tug'ilgan kuni" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Operator turi</label>
                        <select name="status" class="form-control">
                          <option value="meneger">Meneger</option>
                          <option value="xisobchi">Xisobchi</option>
                          <option value="admin">Admin</option>
                        </select>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Login</label>
                        <input type="text" class="form-control input_form" name="username" placeholder="Login" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Parol</label>
                        <input type="password" class="form-control input_form" name="password" placeholder="Parol" required>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" name="addmeneger" class="Filter_btn btn">Meneger qo'shish</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Yangi xona qo'shish-->
          <div class="modal fade" id="addxona" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Yangi xona</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="" method="POST">
                    <div class="row">
                      <div class="col-lg-12">
                        <label for="" class="input-label">Xona raqami</label>
                        <input type="text" class="form-control input_form" name="roomName" placeholder="Xona raqami" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Xona sig'imi</label>
                        <input type="text" class="form-control input_form" name="roomCount" placeholder="Xona sig'imi" required>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" name="AddName" class="Filter_btn btn">Xona qo'shish</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Xonalar -->
          <div class="col-12">
            <div class="card ">
              <div class="card-body">
                <h5 class="card-title">Xonalar <span>| Tarixi</span></h5>
									<div class="accordion accordion-flush" id="accordionFlushExample">
                    <?php
                      $xonaSql = "SELECT * FROM `xonalar`";
                      $resxona = $Confige->SelectAll($xonaSql);
                      if($resxona->num_rows>0){
                        $i=1;
                        while($rowxq = $resxona->fetch_assoc()){
                          ?>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne<?php echo $i; ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                                  <?php echo $rowxq['XonaNomi']; ?> (Xona sig'imi: <?php echo $rowxq['XonaSigimi']; ?>)
                                </button>
                              </h2>
                              <div id="flush-collapseOne<?php echo $i; ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="table-responsive text-nowrap">
                                  <table class="table text-center table-bordered my_table_search">
                                    <thead class="top_header">
                                      <tr>
                                        <th>Vaqt\Hafta kuni</th>
                                        <th>Dushanba</th>
                                        <th>Seshanba</th>
                                        <th>Chorshanba</th>
                                        <th>Payshanba</th>
                                        <th>Juma</th>
                                        <th>Shanba</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $date = array("Dushanba","Seshanba","Chorshanba","Payshanba","Juma","Shanba");
                                        $time_start = array("08:00-09:30","09:30-11:00","11:00-12:30","12:30-14:00","14:00-15:30","15:30-17:00","17:00-18:30","18:30-20:00","20:00-21:30");
                                        foreach ($time_start as $soat) {
                                          ?>
                                          <tr class="text-center">
                                            <th><?php echo $soat; ?></th>
                                            <?php
                                              foreach ($date as $hafta) {
                                                $sqlSel = "SELECT * FROM `xona_vaqt` WHERE `Xona`='".$rowxq['XonaNomi']."' AND `Xafta`='".$hafta."' AND `Soat`='".$soat."'";
                                                $resSel = $Confige->SelectAll($sqlSel);
                                                if($resSel->num_rows>0){
                                                  $rowSel = $resSel->fetch_assoc();
                                                  $vaqt = date("Y-m-d");
                                                  $Start = $rowSel['Start'];
                                                  $End = $rowSel['End'];
                                                  if($End>=$vaqt AND $Start<=$vaqt){
                                                    echo "<td><div style='background-color:red;color:#fff;font-size:14px;padding:5px;font-weight:700'>Band</div></td>";
                                                  }elseif($End>=$vaqt){
                                                    echo "<td><div style='background-color:red;color:#fff;font-size:14px;padding:5px;font-weight:700'>Band</div></td>";
                                                  }else{
                                                    echo "<td><div style='background-color:green;color:#fff;font-size:14px;padding:5px;font-weight:700'>Bo`sh</div></td>";
                                                  }
                                                }else{
                                                  echo "<td><div style='background-color:green;color:#fff;font-size:14px;padding:5px;font-weight:700'>Bo`sh</div></td>";
                                                }
                                                  
                                                
                                              }
                                            ?>
                                          </tr>
                                          <?php
                                        }
                                      ?>
                                      
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          <?php
                          $i++;
                        }
                      }
                    ?>
                    

                   
                  </div>
              </div>
            </div>
          </div>
          <!-- Kurslar -->
          <div class="col-lg-12">
            <div class="card ">
              <div class="card-body">
                <h5 class="card-title">Kurslar <span>| Tarixi</span></h5>
                <div class="table-responsive text-nowrap">
									<table class="table table-bordered border-primary table-striped my_table_search">
                    <thead >
                      <tr>
                        <th>#</th>
                        <th>Kurs nomi</th>
                        <th>Darslar soni</th>
                        <th>Meneger</th>
                        <th>Guruh ochildi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sqlKurslar = "SELECT * FROM `cours`";
                        $resKurs = $Confige->SelectAll($sqlKurslar);
                        if($resKurs->num_rows>0){
                          $i=1;
                          while ($rowK = $resKurs->fetch_assoc()) {
                            echo "<tr class='text-center'>
                                    <td>".$i."</td>
                                    <td>".$rowK['CoursName']."</td>
                                    <td>".$rowK['CounLessn']."</td>
                                    <td>".$rowK['UserID']."</td>
                                    <td>".$rowK['Data']."</td>
                                  </tr>";
                                  $i++;
                          }
                        }else{
                          echo "<tr class='text-center'><td colspan='5'>Kurslar mavjud emas</td></tr>";
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- Operatorlar -->
          <div class="col-lg-12" style="display:<?php if($_COOKIE['Status']==='meneger'){echo 'none';}else{echo 'block';} ?>">
            <div class="card ">
              <div class="card-body">
                <h5 class="card-title">Menegerlar <span>| Tarixi</span></h5>
                <div class="table-responsive text-nowrap">
									<table class="table table-bordered border-primary table-striped my_table_search">
                    <thead >
                      <tr>
                        <th>#</th>
                        <th>FIO</th>
                        <th>Telefon raqam</th>
                        <th>Yashash manzil</th>
                        <th>Status</th>
                        <th>Login</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $users = "SELECT * FROM `user_meneger`";
                        $result = $Confige->SelectAll($users);
                        if($result->num_rows>0){
                          $i=1;
                          while ($rows = $result->fetch_assoc()) {
                            echo "
                            <tr>
                              <td class='text-center'>".$i."</td>
                              <td>".$rows['FIO']."</td>
                              <td>".$rows['Phone']."</td>
                              <td>".$rows['Addres']."</td>
                              <td class='text-center'>".$rows['Status']."</td>
                              <td class='text-center'>".$rows['Username']."</td>
                              <td class='text-center'><a href='./blog/hodimlar.php?UserID=".$rows['UserID']."'><i class='bi bi-arrow-right-circle'></i></a></td>
                            </tr>";
                            $i++;
                          }
                        }else{
                          
                        }
                      ?>
                      
                    </tbody>
                  </table>
                  <div class="w-100 text-center">
                    <a href="./blog/userStatistic.php" class="btn btn-outline-primary" style="border-radius:0;">Meneger Statistikasi</a>
                  </div>
                </div>
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
  
  <script src="./assets/js/jquery-3.5.1.js"></script>
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