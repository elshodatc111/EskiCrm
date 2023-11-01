<?php
  include("../confige/confige.php");
  include("../confige/topHeader2.php");
  if(isset($_GET['GuruhID'])){
    $sqlGuruh = "SELECT * FROM `guruh` WHERE `GuruhID`='".$_GET['GuruhID']."'";
    $resGuruh = $Confige->SelectAll($sqlGuruh);
    $rowTulov = $resGuruh->fetch_assoc();
    $tulovlarSoni = $rowTulov['TulovCount'];
    $TulovSum = $rowTulov['Summa'];
    $End = $rowTulov['End'];
  }

  
  $sqlAbout = "SELECT * FROM `guruh` WHERE `GuruhID`='".$_GET['GuruhID']."'";
  $resAbout = $Confige->SelectAll($sqlAbout);
  $rowSel = $resAbout->fetch_assoc();
  $start = $rowSel['Start'];
  $end = $rowSel['End'];
  $data = date("Y-m-d");
  $chegirmaDay = date('Y-m-d', strtotime('-5 day'));
  if($start>=$chegirmaDay){
    $display='block';
  }else{
    $display='none';
  }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Guruh haqida</title>
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
    <script>
      <?php
        if(isset($_GET['guruhdamavjud'])){echo "alert('Siz tanlagan talaba oldin guruhdan ro`yhatdan o`tgan')";}
        if(isset($_GET['guruhstudentplus'])){echo "alert('Guruhga yangi talaba qo`shildi')";}
        if(isset($_GET['techGurPlus'])){echo "alert('Guruhga yangi o`qituvchi qo`shildi')";}
        if(isset($_GET['techGurPlusError'])){echo "alert('Siz tanlagan o`qituvchi oldun guruhga qo`shilgan.')";}
        if(isset($_GET['tulovplus'])){echo "alert('Guruhga to`lov qilindi.')";}
      ?>
    </script>
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
        <a class="nav-link " href="../guruh.php">
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
      <li class="nav-item" style="display:<?php if(isset($_COOKIE['Status'])){ if($_COOKIE['Status']==='meneger'){echo 'none';}} ?>">
        <a class="nav-link collapsed" href="../statistik.php">
          <i class="bi bi-bar-chart"></i>
          <span>Statistika</span>
        </a>
      </li>
      <li class="nav-item" style="display:<?php if(isset($_COOKIE['Status'])){ if($_COOKIE['Status']==='meneger'){echo 'none';}} ?>">
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
          <li class="breadcrumb-item"><a href="../guruh.php">Guruhlar</a></li>
          <li class="breadcrumb-item active">Guruh</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
          <div class="col-12">
            <div class="card ">
              <div class="card-body text-center p-1 row">
                <div class="col-lg-4"><button class="btn btn-outline-success w-100 my-2" data-bs-toggle="modal" data-bs-target="#tolov"><i class="bi bi-cash-coin"></i> To'lov qilish</button></div>
                <div class="col-lg-4"><button class="btn btn-outline-info w-100 my-2" data-bs-toggle="modal" data-bs-target="#addstudent" style="display:<?php if($End<date("Y-m-d")){echo 'none';} ?>"><i class="bi bi-person-plus"></i> Talaba qo'shish</button></div>
                <div class="col-lg-4"><button class="btn btn-outline-primary w-100 my-2" data-bs-toggle="modal" data-bs-target="#addtecher"  style="display:<?php if($End<date("Y-m-d")){echo 'none';} ?>"><i class="bi bi-person-plus"></i> O'qituvchi qo'shish</button></div>
                <div class="col-lg-6"><button class="btn btn-outline-warning w-100 my-2" data-bs-toggle="modal" data-bs-target="#sendMesseg"><i class="bi bi-messenger"></i> SMS yuborish</button></div>
                <div class="col-lg-6"><button class="btn btn-outline-danger w-100 my-2" data-bs-toggle="modal" data-bs-target="#davomad"><i class="bi bi-person-check"></i> Davomad</button></div>
              </div>
            </div>
          </div>
          <!-- Guruhda davomad jadvali -->
          <div class="modal fade" id="davomad" tabindex="-1">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Guruh talabalar davomadi</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered border-primary table-striped my_table_search">
                      <?php
                        $dates = array();
                        $sqldata = "SELECT DISTINCT `Date` FROM `guruh_davomat` WHERE `GuruhID`='".$_GET['GuruhID']."' ORDER BY `Date` ASC";
                        $resdata = $Confige->SelectAll($sqldata);
                        if($resdata->num_rows>0){
                          while ($rowdata = $resdata->fetch_assoc()) {
                            array_push($dates,$rowdata['Date']);
                          }
                        }
                      ?>
                      <thead >
                          <tr>
                              <th>#</th>
                              <th>FIO</th>
                              <?php
                                foreach ($dates as $data) {
                                  echo "<th>".$data."</th>";
                                }
                              ?>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                            $sqldav = "SELECT user_student.FIO,user_student.StudentID FROM `guruh_users` JOIN `user_student` ON guruh_users.UserID=user_student.StudentID WHERE guruh_users.GuruhID='".$_GET['GuruhID']."'";
                            $resdav = $Confige->SelectAll($sqldav);
                            if($resdav->num_rows>0){
                              $i=1;
                              while ($rowdav = $resdav->fetch_assoc()) {
                                echo "<tr><td class='text-center'>".$i."</td><td>".$rowdav['FIO']."</td>";
                                    foreach ($dates as $data) {
                                      $sqld = "SELECT * FROM `guruh_davomat` WHERE `UserID`='".$rowdav['StudentID']."' AND `GuruhID`='".$_GET['GuruhID']."' AND `Date`='".$data."'";
                                      $resd = $Confige->SelectAll($sqld);
                                      if($resd->num_rows>0){
                                        echo "<td class='text-center'><span class='badge bg-primary'>+</span></td>";
                                      }else{
                                        echo "<td class='text-center'><span class='badge bg-danger'>-</span></td>";
                                      }
                                    }
                                echo "</tr>";
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
          <!-- Guruh talabasiga to'lov qilish -->
          <div class="modal fade  modal_form" id="tolov" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">To'lov qilish</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form id='form' action="../conUsers/myguruh.php?GuruhID=<?php echo $_GET['GuruhID'] ?>" method="POST">
                    <div class="row">
                      <div class="col-lg-12">
                        <label for="" class="input-label">Talabani tanlang</label>
                        <select name="User_ID" class="form-control" required>
                            <?php
                              $selTalaba = "SELECT * FROM `guruh_users` JOIN `user_student` ON guruh_users.UserID=user_student.StudentID WHERE guruh_users.GuruhID='".$_GET['GuruhID']."'";
                              $restulov = $Confige->SelectAll($selTalaba);
                              echo "<option value=>Tanlang</option>";
                              if($restulov->num_rows>0){
                                while ($rowss = $restulov->fetch_assoc()) {
                                  echo "<option value=".$rowss['UserID'].">".$rowss['FIO']."</option>";
                                }
                              }
                            ?>
                        </select>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">To'lov turini tanlang</label>
                        <select name="tulovType" class="form-control" required>
                          <option value="">Tanlang</option>
                          <option value="Naqt">Naqt</option>
                          <option value="Plastik">Plastik</option>
                        </select>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">To'lov summasi</label>
                        <input type="text" id='numbers' value='0' name="summa" class="form-control input_form" placeholder="To'lov summasi" required>
                      </div>
                      <div class="col-lg-12" style="display:<?php echo $display; ?>">
                        <label for="" class="input-label">Chegirma summasi</label>
                        <input type="text" id='numbers2' value='0' name="chegirma" class="form-control input_form" placeholder="Chegirma" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">To'lov haqida</label>
                        <input type="text" name="Izoh" class="form-control input_form" placeholder="To'lov haqida" required>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" name="guruhstudenttulovplus" class="Filter_btn btn">To'lov qilish</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Guruhga o'quvchi biriktirish -->
          <div class="modal fade  modal_form" id="addstudent" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Guruhga talaba qo'shish</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form id="form2" action="../conUsers/myguruh.php?GuruhID=<?php echo $_GET['GuruhID']; ?>" method="POST">
                    <div class="row">
                      <div class="col-lg-12">
                        <label for="" class="input-label">Talabani tanlang<br><i>Darslar boshlangandan so'ng talabani guruhdan o'chirib bo'lmaydi</i></label>
                        <select name="StudentID" class="form-select" id="select_box" required>
                            <option value=>Tanlang</option>
                            <?php
                              $sqltal = "SELECT * FROM `user_student` WHERE 1";
                              $restal = $Confige->SelectAll($sqltal);
                              if($restal->num_rows>0){
                                while ($rowtal = $restal->fetch_assoc()) {
                                  $sqla11 = "SELECT * FROM `guruh_users` WHERE `GuruhID`='".$_GET['GuruhID']."' AND `UserID`='".$rowtal['StudentID']."'";
                                  $resa11 = $Confige->SelectAll($sqla11);
                                  if($resa11->num_rows>0){}else{
                                    echo "<option value=".$rowtal['StudentID'].">".$rowtal['FIO']."</option>";
                                  }
                                }
                              }
                            ?>
                        </select>
                      </div>
                      <div class="col-lg-12 pt-2">
                        <label for="" class="input-label">To'lov turini tanlang</label>
                        <select name="tulovType" class="form-control" required>
                          <option value="">Tanlang</option>
                          <option value="Naqt">Naqt</option>
                          <option value="Plastik">Plastik</option>
                        </select>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">To'lov summasi</label>
                        <input type="text" id="numbers3" name="summa" value="0" class="form-control input_form" placeholder="To'lov summasi" required>
                      </div>
                      <div class="col-lg-12"  style="display:<?php echo $display; ?>">
                        <label for="" class="input-label">Chegirma summasi</label>
                        <input type="text" id="numbers4" name="chegirma" value="0" class="form-control input_form" placeholder="Chegirma" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Guruhga qo'shish sababi</label>
                        <input type="text" name="Izoh" class="form-control input_form" placeholder="Guruhga qo'shish sababi" required>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" name="GuruhStudentPlus" class="Filter_btn btn">Guruhga qo'shish</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Guruhga o'qituvchi biriktirish -->
          <div class="modal fade  modal_form" id="addtecher" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Guruhga o'qituvchi qo'shish</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="../conUsers/myguruh.php?GuruhID=<?php echo $_GET['GuruhID'] ?>" method="POST">
                    <div class="row">
                      <div class="col-lg-12">
                        <label for="" class="input-label">O'qituvchini tanlang</label>
                        <select name="TecherID" class="form-control" required>
                          <option value=''>Tanlang</option>
                          <?php
                            $sqltech = "SELECT * FROM `user_techer` WHERE 1";
                            $restech = $Confige->SelectAll($sqltech);
                            if($restech->num_rows>0){
                              while($rowtech = $restech->fetch_assoc()){
                                echo "<option value=".$rowtech['TecherID'].">".$rowtech['TecherName']."</option>";
                              }
                            }
                          ?>
                        </select>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Guruhga qo'shish sababi</label>
                        <input type="text" name="Izoh" class="form-control input_form" placeholder="Guruhga qo'shish sababi" required>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" name="guruhTechOlus" class="Filter_btn btn">Guruhga qo'shish</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- SMS Yuborish -->
          <div class="modal fade  modal_form" id="sendMesseg" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">SMS yuborish(SMS center ulanmagan)</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="" method="POST">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered my_table_search">
                                <thead>
                                    <tr>
                                        <th scope="col">Tanlang</th>
                                        <th scope="col">FIO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $sqlSms = "SELECT * FROM `guruh_users` JOIN `user_student` ON guruh_users.UserID=user_student.StudentID WHERE guruh_users.GuruhID='".$_GET['GuruhID']."'";
                                    $resSms = $Confige->SelectAll($sqlSms);
                                    if($resSms->num_rows>0){
                                      while ($rowSms = $resSms->fetch_assoc()) {
                                        echo "<tr>
                                                <td class='text-center'>
                                                    <input type='checkbox' name='".$rowSms['UserID']."'>
                                                </td>
                                                <td>".$rowSms['FIO']."</td>
                                            </tr>";
                                      }
                                    }
                                  ?>
                                </tbody>
                            </table>
                        </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">SMS matni</label>
                        <textarea type="text" class="form-control input_form" placeholder="SMS matni" required></textarea>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" class="Filter_btn btn">SMS yuborish</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-8">
                <!-- O'qituvchilar -->
                <div class="card info-card revenue-card">
                  <div class="card-body">
                      <h5 class="card-title">O'qituvchilar</h5>
                      <div class="table-responsive text-nowrap">
                          <table class="table table-bordered border-primary table-striped my_table_search">
                              <thead >
                                  <tr>
                                      <th>#</th>
                                      <th>FIO</th>
                                      <th>Izoh</th>
                                      <th>Status</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  $sqlTech = "SELECT * FROM `user_techer_guruh` JOIN `user_techer` ON user_techer_guruh.TecherID=user_techer.TecherID WHERE user_techer_guruh.GuruhID='".$_GET['GuruhID']."'";
                                  $resTech = $Confige->SelectAll($sqlTech);
                                  if($resTech->num_rows>0){
                                    $i=1;
                                    while($rowTech = $resTech->fetch_assoc()){
                                      echo "
                                      <tr>
                                        <td class='text-center'>$i</td>
                                        <td>".$rowTech['TecherName']."</td>
                                        <td>".$rowTech['Izoh']."</td>
                                        <td class='text-center'><a href='./techer_eye.php?TechID=".$rowTech['TecherID']."'><i class='bi bi-arrow-right-circle'></i></a></td>
                                    </tr>
                                      ";$i++;
                                    }
                                  }else{
                                    echo "<tr><td colspan='4' class='text-center'>O`qituvchi mavjud emas</td></tr>";
                                  }
                                ?>
                              </tbody>
                          </table>
                      </div>
                  </div>
                </div>
                <!-- Talabalar -->
                <div class="card info-card revenue-card">
                  <div class="card-body">
                      <h5 class="card-title">Talabalar</h5>
                      <div class="table-responsive text-nowrap">
                          <table class="table table-bordered border-primary table-striped my_table_search" style="font-size:12px;">
                              <thead>
                                  <tr>
                                      <th rowspan=2>#</th>
                                      <th rowspan=2>FIO</th>
                                      <th colspan=2>Guruhlar</th>
                                      <th colspan=3>Talaba to'lovlari</th>
                                      <th rowspan=2>Status</th>
                                  </tr>
                                  <tr>
                                      <th>Soni</th>
                                      <th>Summasi</th>
                                      <th>Jami<hr style='width:50px;margin:0;padding:0'></th>
                                      <th>Qarzdorlik</th>
                                      <th>Ortiqcha</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $otganOy = date('Y-m-d', strtotime('-1 month'));
                                  $otganOy2 = date('Y-m-d', strtotime('-1 month'))." 00:00:00";
                                  $sqlTalaba = "SELECT * FROM `guruh_users` JOIN `user_student` ON guruh_users.UserID=user_student.StudentID WHERE guruh_users.GuruhID='".$_GET['GuruhID']."'";
                                  $resTalaba = $Confige->SelectAll($sqlTalaba);
                                  if($resTalaba->num_rows>0){
                                    $i=1;
                                    while ($rowTalaba = $resTalaba->fetch_assoc()) {
                                      $UserID = $rowTalaba['UserID'];
                                      // Guruhlar soni va to'lanishi kerak bo'lgan summa
                                      $SqlG = "SELECT * FROM `guruh_users` JOIN `guruh` ON guruh_users.GuruhID=guruh.GuruhID WHERE guruh_users.UserID='".$UserID."'";
                                      $resG = $Confige->SelectAll($SqlG);
                                      $GuruhSoni = 0; // Bir oylik guruhlar soni
                                      $GuruhSumma = 0; // Bir oylik To'lanishi lozim bo'lgan to'lovlar
                                      $GuruhSoniAll = 0; // Barcha guruhlar soni
                                      $GuruhSummaAll = 0; // Barcha to'lanishi kerak bo'lgan guruhlar soni
                                      if($resG->num_rows>0){
                                        while ($rowG = $resG->fetch_assoc()) {
                                          if($rowG['End']>=$otganOy){
                                            $GuruhSumma = $GuruhSumma + $rowG['Summa'];
                                            $GuruhSoni = $GuruhSoni + 1;
                                          }
                                          $GuruhSummaAll = $GuruhSummaAll + $rowG['Summa'];
                                          $GuruhSoniAll = $GuruhSoniAll + 1;
                                        }
                                      }
                                      // Talaba to'lovlari
                                      $sqlT = "SELECT * FROM `user_student_tulov` WHERE `UserID`='".$UserID."'";
                                      $resT=$Confige->SelectAll($sqlT);
                                      $JamiTulov = 0;
                                      if($resT->num_rows>0){
                                        while ($rowT=$resT->fetch_assoc()) {
                                          $JamiTulov = $JamiTulov + $rowT['Summa'];
                                        }
                                      }
                                      // Talaba to'lovlari
                                      $Tulov = $JamiTulov-($GuruhSummaAll-$GuruhSumma);
                                      $Qarz = $GuruhSummaAll - $JamiTulov;
                                      $OTulov = 0;
                                      if($Qarz<0){$OTulov = 0-$Qarz;} // Oldindan to'lovni hisoblash
                                      if($Qarz>0){$Qarz = $Qarz;}else{$Qarz = 0;} // Qarzdorlikni hisoblash
                                      echo "<tr>
                                        <td class='text-center'>".$i."</td>
                                        <td>".$rowTalaba['FIO']."</td>
                                        <td class='text-center'>".$GuruhSoni."</td>
                                        <td class='text-center'>".number_format(($GuruhSumma), 0, '.', ' ')."</td>
                                        <td class='text-center'>".number_format(($Tulov), 0, '.', ' ')."</td>
                                        <td class='text-center'>".number_format(($Qarz), 0, '.', ' ')."</td>
                                        <td class='text-center'>".number_format(($OTulov), 0, '.', ' ')."</td>
                                        <td class='text-center'><a href='./tashrif_eye.php?StudentID=".$UserID."'><i class='bi bi-arrow-right-circle'></i></a></td>
                                      </tr>";
                                      $i++;
                                    }
                                  }else{
                                    echo "<tr><td colspan='7' class='text-center'>Guruhda talabalar mavjud emas</td></tr>";
                                  }
                                ?>
                                  
                              </tbody>
                          </table>
                      </div>
                  </div>
                </div>
                <!-- Talaba tulovlari -->
                <div class="card info-card revenue-card">
                  <div class="card-body">
                      <h5 class="card-title">Talaba To'lovlar</h5>
                      <div class="table-responsive text-nowrap">
                          <table class="table border-primary table-striped my_table_search datatable"  style="font-size:12px;">
                              <thead >
                                  <tr>
                                      <th>#</th>
                                      <th>FIO</th>
                                      <th>Summasi</th>
                                      <th>Turi</th>
                                      <th>To'lov vaqti</th>
                                      <th>Izoh</th>
                                      <th>Kvitansiya</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $sql1 = "SELECT * FROM `guruh_users` WHERE `GuruhID`='".$_GET['GuruhID']."'";
                                  $res1 = $Confige->SelectAll($sql1);
                                  if($res1->num_rows>0){
                                    $i=1;
                                    while ($row1=$res1->fetch_assoc()) {
                                      $UserID = $row1['UserID'];
                                      $sql2 = "SELECT user_student_tulov.Summa,user_student_tulov.TulovType,user_student_tulov.Izoh,user_student_tulov.id,user_student_tulov.Data,user_student.FIO FROM `user_student_tulov` JOIN `user_student` ON user_student_tulov.UserID=user_student.StudentID WHERE user_student_tulov.UserID='".$UserID."'";
                                      $res2 = $Confige->SelectAll($sql2);
                                      if($res2->num_rows>0){
                                        while ($row2=$res2->fetch_assoc()) {
                                          echo "<tr>
                                            <td class='text-center'>".$i."</td>
                                            <td>".$row2['FIO']."</td>
                                            <td class='text-center'>".number_format(($row2['Summa']), 0, '.', ' ')."</td>
                                            <td class='text-center'>".$row2['TulovType']."</td>
                                            <td>".$row2['Data']."</td>
                                            <td>".$row2['Izoh']."</td>
                                            <td class='text-center'>
                                              <a href='./chek.php?checkID=".$row2['id']."'  target='_blank'><i class='bi bi-arrow-right-circle'></i></a>
                                            </td>
                                          </tr>";
                                          $i++;
                                        }
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
          <div class="col-lg-4">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                      <?php
                        if($start<=$data AND $end>=$data){
                          $style = "background-color:green;color:#fff";
                          $status = "Active";
                        }elseif ($end>$data) {
                          $style = "background-color:blue;color:#fff";
                          $status = "Yangi";
                        }else {
                          $style = "background-color:red;color:#fff;border-radius:0;";
                          $status = "Yakunlangan";
                        }
                        
                      ?>
                        <form action="../conUsers/myguruh.php?GuruhID=<?php echo $_GET['GuruhID']; ?>" id='form_a' method="POST" class="form_student_about">
                          <div class="row text-center">
                            <div class="col-lg-12 mt-3">
                              <label for="" class="input-label">Guruh</label>
                              <input type="text" class="form-control input_form" name='guruhnames' value="<?php echo $rowSel['GuruhName']; ?>" required>
                            </div>
                            <div class="col-lg-6">
                              <label for="" class="input-label">To'lovlar Summasi</label>
                              <div class="form-control input_form my-1" style="border-radius:0;font-size:14px;border:1px solid #0000FF;background-color:#E9ECEF;"><?php echo number_format(($rowSel['Summa']), 0, '.', ' '); ?></div>
                            </div>
                            <div class="col-lg-6">
                              <label for="" class="input-label">Guruh holati</label>
                              <p type="number" class="form-control input_form" style="<?php echo $style; ?>" value="" disabled required><?php echo $status; ?></p>
                            </div>
                            <?php
                              $sqlbonus = "SELECT * FROM `guruh_bonus` WHERE `GuruhID`='".$_GET['GuruhID']."'";
                              $resbonus = $Confige->SelectAll($sqlbonus);
                              $rowbonus = $resbonus->fetch_assoc();
                            ?>
                            <div class="col-lg-6">
                              <label for="" class="input-label">O'qituvchiga to'lov</label>
                              <div class="form-control input_form my-1" style="border-radius:0;font-size:14px;border:1px solid #0000FF;background-color:#E9ECEF;"><?php echo number_format(($rowbonus['Tulov']), 0, '.', ' '); ?></div>
                            </div>
                            <div class="col-lg-6">
                              <label for="" class="input-label">O'qituvchiga bonus</label>
                              <div class="form-control input_form my-1" style="border-radius:0;font-size:14px;border:1px solid #0000FF;background-color:#E9ECEF;"><?php echo number_format(($rowbonus['Bonus']), 0, '.', ' '); ?></div>
                            </div>
                            <div class="col-lg-6">
                              <label for="" class="input-label">Jami to'lovlar</label>
                              <div class="form-control input_form my-1" style="border-radius:0;font-size:14px;border:1px solid #0000FF;background-color:#E9ECEF;"><?php echo number_format(($rowSel['Summa']), 0, '.', ' '); ?></div>
                            </div>
                            <div class="col-lg-6">
                              <label for="" class="input-label">Boshlanish vaqti</label>
                              <input type="text" class="form-control input_form" value="<?php echo $rowSel['Start']; ?>" disabled required>
                            </div>
                            <div class="col-lg-6">
                              <label for="" class="input-label">Yakunlash vaqti</label>
                              <input type="text" class="form-control input_form" value="<?php echo $rowSel['End']; ?>" disabled required>
                            </div>
                            <div class="col-lg-6">
                              <label for="" class="input-label">Operator</label>
                              <input type="text" class="form-control input_form" value="<?php echo $rowSel['Operator']; ?>" disabled required>
                            </div>
                            <div class="col-lg-6">
                              <label for="" class="input-label">Xona</label>
                              <input type="text" class="form-control input_form" value="<?php echo $rowSel['Xona']; ?>" disabled required>
                            </div>
                            <div class="col-lg-6" style="display:<?php if($_COOKIE['Status']==='meneger'){echo 'none';} ?>">
                              <label for="" class="input-label">.</label>
                              <button type="submit" name='editgroups' class="btn btn-primary text-danger w-100">Yangilash</button>
                            </div>

                            <h6>Dars Jadvali</h6>
                            <?php
                              $sqlJadval = "SELECT * FROM `xona_vaqt` WHERE `GuruhID`='".$_GET['GuruhID']."'";
                              $resjad = $Confige->SelectAll($sqlJadval);
                              if($resjad->num_rows>0){
                                while ($rowj = $resjad->fetch_assoc()) {
                                  echo "<div class='col-12'>
                                          <label class='input-label'>".$rowj['Xafta']."</label>
                                          <input type='text' class='form-control input_form' value=".$rowj['Soat']." placeholder='Izoh' disabled required>
                                        </div>";
                                }
                              }
                            ?>
                            
                          </div>
                        </form>
                    </div>
                </div>
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Yuborilgan SMSlar (SMS Senter ulanmagan)</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered border-primary table-striped my_table_search" style="font-size: 10px;">
                                <thead >
                                    <tr>
                                        <th>#</th>
                                        <th>FIO</th>
                                        <th>SMS matni</th>
                                        <th>Yuborildi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class='text-center'>1</td>
                                        <td>----</td>
                                        <td>++++</td>
                                        <td>++++</td>
                                    </tr>
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
  <script src="../library/dselect.js"></script>
  <script>
    $(document).ready(function () {
      $('#datatable').DataTable();
    });
  </script>
  <script>
    var select_box_element = document.querySelector('#select_box');
    dselect(select_box_element, {
        search: true
    });
    
(function($, undefined) {
    "use strict";
    $(function() {
      var $form = $( "#form" );
      var $input = $form.find( "#numbers" );
      $input.on( "keyup", function( event ) {
        var selection = window.getSelection().toString();
        if ( selection !== '' ) {
          return;
        }
        if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
          return;
        }
        var $this = $( this );
        var input = $this.val();
        var input = input.replace(/[\D\s\._\-]+/g, "");
            input = input ? parseInt( input, 10 ) : 0;
            $this.val( function() {
              return ( input === 0 ) ? "" : input.toLocaleString( "en-US" );
            } );
      } );
      var $input2 = $form.find( "#numbers2" );
      $input2.on( "keyup", function( event ) {
        var selection = window.getSelection().toString();
        if ( selection !== '' ) {
          return;
        }
        if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
          return;
        }
        var $this = $( this );
        var input2 = $this.val();
        var input2 = input2.replace(/[\D\s\._\-]+/g, "");
            input2 = input2 ? parseInt( input2, 10 ) : 0;
            $this.val( function() {
              return ( input2 === 0 ) ? "" : input2.toLocaleString( "en-US" );
            } );
      } );


      var $form2 = $( "#form2" );
      var $input3 = $form2.find( "#numbers3" );
      $input3.on( "keyup", function( event ) {
        var selection = window.getSelection().toString();
        if ( selection !== '' ) {
          return;
        }
        if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
          return;
        }
        var $this = $( this );
        var input3 = $this.val();
        var input3 = input3.replace(/[\D\s\._\-]+/g, "");
            input3 = input3 ? parseInt( input3, 10 ) : 0;
            $this.val( function() {
              return ( input3 === 0 ) ? "" : input3.toLocaleString( "en-US" );
            } );
      } );
      var $input4 = $form2.find( "#numbers4" );
      $input4.on( "keyup", function( event ) {
        var selection = window.getSelection().toString();
        if ( selection !== '' ) {
          return;
        }
        if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
          return;
        }
        var $this = $( this );
        var input4 = $this.val();
        var input4 = input4.replace(/[\D\s\._\-]+/g, "");
            input4 = input4 ? parseInt( input4, 10 ) : 0;
            $this.val( function() {
              return ( input4 === 0 ) ? "" : input4.toLocaleString( "en-US" );
            } );
      } );

      var $form_a = $( "#form_a" );
      var $inputa1 = $form_a.find( "#a1" );
      $inputa1.on( "onload", function( event ) {
        var selection = window.getSelection().toString();
        if ( selection !== '' ) {return;}
        if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {return;}
        var $this = $( this );
        var inputa1 = $this.val();
        var inputa1 = inputa1.replace(/[\D\s\._\-]+/g, "");
        inputa1 = inputa1 ? parseInt( inputa1, 10 ) : 0;
        $this.val( function() {return ( inputa1 === 0 ) ? "" : inputa1.toLocaleString( "en-US" );} );
      });

    });
  })(jQuery);
</script>
  
</body>
</html>