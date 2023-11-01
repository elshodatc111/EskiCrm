<?php
  include("../confige/confige.php");
  include("../confige/topHeader2.php");
  $date = date("Y-m-d");
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Student haqida</title>
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
    <script>
      <?php
        if(isset($_GET['ruyhatdabor'])){echo "alert('Siz tanlagan guruhga oldin ro`yhatga olingan.')";}
        if(isset($_GET['stugurolus'])){echo "alert('Yangi guruhga qo`shildi.')";}
        if(isset($_GET['tulovplus'])){echo "alert('Guruhga to`lov qilindi')";}
        if(isset($_GET['update'])){echo "alert('Student malumotlari yangilandi')";}
        if(isset($_GET['delgur'])){echo "alert('Student guruhni yakunladi')";}
        if(isset($_GET['eslatmaqoldi'])){echo "alert('Eslatma qoldirildi')";}
        if(isset($_GET['sendmes'])){echo "alert('SMS habar yuborildi')";}
        if(isset($_GET['qaytdi'])){echo "alert('To`lov qaytarildi')";}
        if(isset($_GET['chegirmamuddat'])){echo "alert('Chegirma muddati o`tgan. Chegirma qabul qilinmaydi!')";}
        if(isset($_GET['tulovpluschegirmaerror'])){echo "alert('To`lov qabul qilindi. Chegirma qabul qilinmadi. Chegirma muddati o`tgan!')";}
        if(isset($_GET['summaerror'])){echo "alert('To`lov summalarini kiriting!')";}
      ?>
      
      <?php
        $sqlStudent = "SELECT * FROM `user_student` WHERE `StudentID`='".$_GET['StudentID']."'";
        $resStudent = $Confige->SelectAll($sqlStudent);
        $rowStudent = $resStudent->fetch_assoc();
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
        <a class="nav-link " href="../tashrif.php">
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
          <li class="breadcrumb-item"><a href="../tashrif.php">Tashriflar</a></li>
          <li class="breadcrumb-item active">Talaba haqida</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
          <div class="col-12">
            <div class="card ">
              <div class="card-body text-center p-0">
                <div class="row py-2 px-1">
                  <div class="col-lg-2 py-2"><button class="btn btn-outline-success w-100" data-bs-toggle="modal" data-bs-target="#tulov"><i class="bi bi-credit-card-fill"></i> To'lov qilish</button></div>
                  <div class="col-lg-3 py-2" style="display:<?php if($_COOKIE['Status']==='meneger'){echo 'none';} ?>"><button class="btn btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#delgroups"><i class="bi bi-credit-card-2-front"></i> To'lov qaytarish</button></div>
                  <div class="col-lg-3 py-2"><button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#addgroups"><i class="bi bi-diagram-3-fill"></i> Guruhga qo'shish</button></div>
                  <div class="col-lg-2 py-2"><button class="btn btn-outline-warning w-100" data-bs-toggle="modal" data-bs-target="#eslatma"><i class="bi bi-messenger"></i> Eslatmalar</button></div>
                  <div class="col-lg-2 py-2"><button class="btn btn-outline-info w-100" data-bs-toggle="modal" data-bs-target="#smssend"><i class="bi bi-twitch"></i> SMS yuborish</button></div>
                </div>
              </div>
            </div>
          </div>
          <!-- Guruhga to'lov qilish -->
          <div class="modal fade  modal_form" id="tulov" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Talaba hisobini to'ldirish</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form id="form" action="../conUsers/studentEdir.php?StudentID=<?php echo $_GET['StudentID']; ?>" method="POST">
                    <div class="row">
                      <div class="col-lg-12">
                        <label for="" class="input-label">Guruhni tanlang</label>
                        <select name="guruhid" class="form-control" required>
                          <option value=>Tanlang</option>
                          <?php 
                            $sqlg3 = "SELECT * FROM `guruh_users` JOIN `guruh` ON guruh_users.GuruhID=guruh.GuruhID WHERE guruh_users.UserID='".$_GET['StudentID']."'";
                            $resg3 = $Confige->SelectAll($sqlg3);
                            if($resg3->num_rows>0){
                              while ($rowg3 = $resg3->fetch_assoc()) {
                                echo "<option value=".$rowg3['GuruhID'].">".$rowg3['GuruhName']."</option>";
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
                        <input id='numbers' type="text" name="Summa" value='0' class="form-control input_form" placeholder="To'lov summasi" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Chegirma summasi</label>
                        <input id='numbers2' type="text" name="Chegirma" class="form-control input_form" value='0' placeholder="Chegirma summasi" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">To'lov haqida</label>
                        <input type="text" name="Izoh" class="form-control input_form" placeholder="To'lov haqida" required>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" name="tulovPlus" class="Filter_btn btn">To'lovni tasdiqlash</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Eslatma  Qoldirish -->
          <div class="modal fade  modal_form" id="eslatma" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Eslatma habarini qoldirish</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="../conUsers/studentEdir.php?StudentID=<?php echo $_GET['StudentID']; ?>" method="POST">
                    <div class="row">
                      <div class="col-lg-12">
                        <label for="" class="input-label">Habar berish vaqti</label>
                        <input type="date" name="elstmavaqt" class="form-control input_form" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Habar matni</label>
                        <input type="text" name="eslatma_matni" class="form-control input_form" placeholder="Habar matni" required>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" name="Eslatma_qoldirish" class="Filter_btn btn">Eslatmani qoldirish</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Guruhga qo'shish -->                 
          <div class="modal fade  modal_form" id="addgroups" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Guruhga qo'shish</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="../conUsers/studentEdir.php?StudentID=<?php echo $_GET['StudentID']; ?>" method="POST">
                    <div class="row">
                      <div class="col-lg-12">
                        <label for="" class="input-label">Guruhni tanlang <br><i>(Guruhda darslar boshlangandan so`ng guruhdan chiqazib bo`lmaydi)</i></label>
                        <select name="GuruhID" class="form-control" required>
                          <option value="">Tanlang</option>
                          <?php
                            $date = date("Y-m-d");
                            $sqlg = "SELECT * FROM `guruh` WHERE `End`>='".$date."' ORDER BY `GuruhName` ASC";
                            $resg = $Confige->SelectAll($sqlg);
                            if($resg->num_rows>0){
                              while ($rowg=$resg->fetch_assoc()) {
                                echo "<option value=".$rowg['GuruhID'].">".$rowg['GuruhName']."</option>";
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
                        <button type="submit" name="GuruhPlus" class="Filter_btn btn">Guruhga qo'shish</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Tolovni qaytarish -->
          <div class="modal fade  modal_form" id="delgroups" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">To'lovni qaytarish</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form id="form2" action="../conUsers/studentEdir.php?StudentID=<?php echo $_GET['StudentID']; ?>" method="POST">
                    <div class="row">
                      <div class="col-lg-12">
                        <label for="" class="input-label">Guruhni tanlang</label>
                        <select name="guruhid" class="form-control" required>
                          <option value=>Tanlang</option>
                          <?php 
                            $sqlg30 = "SELECT * FROM `guruh_users` JOIN `guruh` ON guruh_users.GuruhID=guruh.GuruhID WHERE guruh_users.UserID='".$_GET['StudentID']."'";
                            $resg30 = $Confige->SelectAll($sqlg30);
                            if($resg30->num_rows>0){
                              while ($rowg3 = $resg30->fetch_assoc()) {
                                echo "<option value=".$rowg3['GuruhID'].">".$rowg3['GuruhName']."</option>";
                              }
                            }
                          ?>
                        </select>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Qaytarish turini tanlang</label>
                        <select name="tulovType" class="form-control" required>
                          <option value="">Tanlang</option>
                          <option value="Naqt">Naqt</option>
                          <option value="Plastik">Plastik</option>
                        </select>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Qaytarish summasi</label>
                        <input id='qaytarish' type="text" name="Summa" class="form-control input_form" placeholder="To'lov summasi" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Qaytarish haqida</label>
                        <input type="text" name="Izoh" class="form-control input_form" placeholder="To'lov haqida" required>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" name="DeleteGuruh" class="Filter_btn btn">To'lovni tasdiqlash</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- SMS yuborish -->
          <div class="modal fade  modal_form" id="smssend" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">SMS yuborish (SMS Cenetr Ulanmagan)</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="../conUsers/sendSMSStudent.php?StudentID=<?php echo $_GET['StudentID']; ?>" method="POST">
                    <div class="row">
                      <div class="col-lg-12" style="display:none">
                        <label for="" class="input-label">phone number</label>
                        <input type="text" class="form-control input_form" name="Phone" value="<?php echo str_replace(" ","",$rowStudent['Phone']); ?>" placeholder="SMS habar matni" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">SMS habar matni</label>
                        <input type="text" class="form-control input_form" name="Messege" placeholder="SMS habar matni" required>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" name="SendMessegeStudent" class="Filter_btn btn">SMS yuborish</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <?php
              $usertulov = "SELECT * FROM `user_student_tulov` WHERE `UserID`='".$_GET['StudentID']."'";
              $restulov = $Confige->SelectAll($usertulov);
              $JammiNaqtPlastik = 0;
              $JamiChegirma = 0;
              $JamiQaytdi = 0;
              if($restulov->num_rows>0){
                while ($rowRes = $restulov->fetch_assoc()) {
                  if($rowRes['TulovType']==='Plastik'){
                    $JammiNaqtPlastik = $JammiNaqtPlastik + $rowRes['Summa'];
                  }elseif($rowRes['TulovType']==='Naqt'){
                    $JammiNaqtPlastik = $JammiNaqtPlastik + $rowRes['Summa'];
                  }elseif($rowRes['TulovType']==='Chegirma'){
                    $JamiChegirma = $JamiChegirma + $rowRes['Summa'];
                  }elseif($rowRes['TulovType']==='qaytarildi'){
                    $JamiQaytdi = $JamiQaytdi + $rowRes['Summa'];
                  }
                }
              }
              $sqlgur11 = "SELECT guruh.Summa FROM `guruh_users` JOIN `guruh` ON guruh_users.GuruhID=guruh.GuruhID WHERE guruh_users.UserID='".$_GET['StudentID']."'";
              $resgur11 = $Confige->SelectAll($sqlgur11);
              $GuruhTolov = 0;
              if($resgur11->num_rows>0){
                while ($rowgur11 = $resgur11->fetch_assoc()) {
                  $GuruhTolov = $rowgur11['Summa']+$GuruhTolov;
                }
              }
              $Balans = $JammiNaqtPlastik+$JamiChegirma-$JamiQaytdi-$GuruhTolov;
            ?>
            <div class="card ">
              <div class="card-body">
                <div class="row mt-3 text-center">
                  <div class="col-lg-3 col-6">
                    <h5 class="card-title"><span>Jami to'lov:  </span><?php echo "<p>".number_format(($JammiNaqtPlastik), 0, '.', ' '); ?> so'm</p></h5>
                  </div>
                  <div class="col-lg-3 col-6">
                    <h5 class="card-title"><span>Chegirma:  </span><?php echo "<p>".number_format(($JamiChegirma), 0, '.', ' '); ?> so'm</p></h5>
                  </div>
                  <div class="col-lg-3 col-6">
                    <h5 class="card-title"><span>Qaytarildi:  </span><?php echo "<p>".number_format(($JamiQaytdi), 0, '.', ' '); ?> so'm</p></h5>
                  </div>
                  <div class="col-lg-3 col-6">
                    <h5 class="card-title"><span>Balans:  </span><?php  if($Balans>0){echo "<p style='color:green;'>".number_format(($Balans), 0, '.', ' ')." so'm</p>";}else{echo "<p style='color:red;'>".number_format(($Balans), 0, '.', ' ')." so'm</p>";} ?> </h5>
                  </div>
                </div>
              </div>
            </div>

            <div class="card ">
              <div class="card-body">
                <h5 class="card-title">Talaba <span>| Guruhlari</span></h5>
                <div class="table-responsive text-nowrap p-3">
									<table class="table table-bordered border-primary table-striped my_table_search">
                    <thead >
                      <tr>
                        <th>#</th>
                        <th>Guruh nomi</th>
                        <th>Boshlanish vaqti</th>
                        <th>Yakunlanish</th>
                        <th>To'lov summasi</th>
                        <th>Guruhga to'lovlar</th>
                        <th>Qarzdorlik</th>
                        <th>Ortiqcha to'lov</th>
                        <th>Guruh holati</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $JamiSumma = 0;
                        $TalabaSumma = 0;
                        $sqlg2 = "SELECT * FROM `guruh_users` JOIN `guruh` ON guruh_users.GuruhID=guruh.GuruhID WHERE guruh_users.UserID='".$_GET['StudentID']."'";
                        $resg2 = $Confige->SelectAll($sqlg2);
                        if($resg2->num_rows>0){
                          $i=1;
                          while ($rowg2 = $resg2->fetch_assoc()) {
                            $GuruhTulov = $rowg2['Summa'];
                            $JamiSumma = $JamiSumma+$GuruhTulov;
                            $sqlgtul = "SELECT * FROM `user_student_tulov` WHERE `GuruhID`='".$rowg2['GuruhID']."' AND `UserID`='".$_GET['StudentID']."'";
                            $resgt = $Confige->SelectAll($sqlgtul);
                            $jtulov = 0;
                            if($resgt->num_rows>0){
                              while ($rowjt = $resgt->fetch_assoc()) {
                                if($rowjt['TulovType']==='qaytarildi'){
                                  $jtulov = $jtulov - $rowjt['Summa'];
                                }else{
                                  $jtulov = $jtulov + $rowjt['Summa'];
                                }
                              }
                            }
                            $TalabaSumma = $TalabaSumma + $jtulov;
                            $sqlGuruh = "SELECT * FROM `guruh` WHERE `GuruhID`='".$rowg2['GuruhID']."'";
                            $resGuruh = $Confige->SelectAll($sqlGuruh);
                            $RowGuruh = $resGuruh->fetch_assoc();
                            $TulovSoni = $RowGuruh['TulovCount'];
                            $TulovSumma = $RowGuruh['Summa'];
                            $JamiTulov = $TulovSoni*$TulovSumma;
                            $Qarzdorlik = $JamiTulov-$jtulov;
                            if($Qarzdorlik===0){
                              $qarz = 0;
                              $oldindantulov = 0;
                            }elseif($Qarzdorlik>0){
                              $qarz = $Qarzdorlik;
                              $oldindantulov = 0;
                            }else{
                              $qarz = 0;
                              $oldindantulov = $Qarzdorlik*(-1);
                            }
                            echo "
                            <tr>
                              <td class='text-center'>".$i."</td>
                              <td>".$rowg2['GuruhName']."</td>
                              <td class='text-center'>".$rowg2['Start']."</td>
                              <td class='text-center'>".$rowg2['End']."</td>
                              <td class='text-center'>".number_format(($GuruhTulov), 0, '.', ' ')."</td>
                              <td class='text-center'>".number_format(($jtulov), 0, '.', ' ')."</td>
                              <td class='text-center'>".number_format(($qarz), 0, '.', ' ')."</td>
                              <td class='text-center'>".number_format(($oldindantulov), 0, '.', ' ')."</td>
                              <td class='text-center'>";
                                $Startg2 = $rowg2['Start'];
                                $Endg2 = $rowg2['End'];
                                if($Startg2<=$date AND $Endg2>=$date){
                                  echo "<span class='badge rounded-pill bg-success'>Active</span>";
                                }elseif($date>$Endg2){
                                  echo "<span class='badge rounded-pill bg-danger'>Yakunlandi</span>";
                                }else{
                                  echo "<span class='badge rounded-pill bg-primary'>Yangi</span>";
                                }
                              echo "</td>
                              <td class='text-center'><a href=../blog/guruh_eye.php?GuruhID=".$rowg2['GuruhID']."><i class='bi bi-arrow-right-circle'></i></a></td>
                            </tr>
                            ";
                            $i++;
                          }
                        }else{
                          echo "<tr><td colspan='8' class='text-center'>Guruhlar mavjus emas</td></tr>";
                        }
                        $JamiQarz = $JamiSumma - $TalabaSumma;
                        $oldin = 0;
                        if($JamiQarz<=0){
                          $oldin = $JamiQarz*(-1);
                          $JamiQarz = 0;
                        }
                      ?>
                      <tr>
                        <th colspan=4 class='text-center'>To'lov holati:</th>
                        <th class='text-center'><?php echo number_format(($JamiSumma), 0, '.', ' '); ?></th>
                        <th class='text-center'><?php echo number_format(($TalabaSumma), 0, '.', ' '); ?></th>
                        <th class='text-center'><?php echo number_format(($JamiQarz), 0, '.', ' '); ?></th>
                        <th class='text-center'><?php echo number_format(($oldin), 0, '.', ' '); ?></th>
                        <th colspan=2></th>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-8">
            



            <div class="card ">
              <div class="card-body">
                <h5 class="card-title">To'lovlar <span>| Tarixi</span></h5>
                <div class="table-responsive text-nowrap p-3">
									<table class="table table-bordered border-primary table-striped my_table_search">
                    <thead >
                      <tr>
                        <th>#</th>
                        <th>Guruh nomi</th>
                        <th>To'lov summasi</th>
                        <th>Izoh</th>
                        <th>To'lov vaqti</th>
                        <th>Kvitansiya</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sqltt = "SELECT user_student_tulov.id,guruh.GuruhName, user_student_tulov.Summa, user_student_tulov.Data, user_student_tulov.TulovType FROM `user_student_tulov` JOIN `guruh` ON user_student_tulov.GuruhID=guruh.GuruhID WHERE user_student_tulov.UserID='".$_GET['StudentID']."'";
                        $restt =$Confige->SelectAll($sqltt);
                        if($restt->num_rows>0){
                          $i=1;
                          while ($rowtt = $restt->fetch_assoc()) {
                            echo "
                            <tr>
                              <td class='text-center'>".$i."</td>
                              <td>".$rowtt['GuruhName']."</td>
                              <td class='text-center'>".number_format(($rowtt['Summa']), 0, '.', ' ')."</td>
                              <td class='text-center'>".$rowtt['TulovType']."</td>
                              <td class='text-center'>".$rowtt['Data']."</td>
                              <td class='text-center'>
                                <a href='./chek.php?checkID=".$rowtt['id']."'  target='_blank'>
                                    <i class='bi bi-bookmark'></i>
                                </a>
                              </td>
                            </tr>
                            ";
                            $i++;
                          }
                        }else{
                          echo "<tr><td colspan='6' class='text-center'>To`lovlar mavjud emas</td></tr>";
                        }
                      ?>
                      <tr>                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="card ">
              <div class="card-body">
                <h5 class="card-title">Eslatma <span>| Tarixi</span></h5>
                <div class="table-responsive text-nowrap p-3">
									<table class="table table-bordered border-primary table-striped my_table_search">
                    <thead >
                      <tr>
                        <th>#</th>
                        <th>Eslatma</th>
                        <th>Eslatma vaqti</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sqlEslat = "SELECT * FROM `user_student_eslatma` WHERE `UserID`='".$_GET['StudentID']."' ORDER BY `id` DESC LIMIT 15";
                        $resEs = $Confige->SelectAll($sqlEslat);
                        if($resEs->num_rows>0){
                          $i=1;
                          while ($rowEs=$resEs->fetch_assoc()) {
                            echo "
                            <tr>
                              <td class='text-center'>".$i."</td>
                              <td>".$rowEs['Matn']."</td>
                              <td class='text-center'>".$rowEs['Date']."</td>
                              <td class='text-center'>";
                              if($date===$rowEs['Date']){
                                echo "<span class='badge rounded-pill bg-success'>Aktive</span>";
                              }elseif($date>$rowEs['Date']){
                                echo "<span class='badge rounded-pill bg-danger'>Yakunlangan</span>";
                              }else{
                                echo "<span class='badge rounded-pill bg-primary'>Yangi</span>";
                              }
                              echo "</td>
                            </tr>
                            ";
                            $i++;
                          }
                        }
                        
                      ?>
                      
                      
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="card ">
              <div class="card-body">
                <h5 class="card-title">SMS tarixi(SMS Cenetr Ulanmagan)</h5>
                <div class="activity">      
        
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card ">
              <div class="card-body">
                <h5 class="card-title">Talaba haqida</h5>
                <form action="../conUsers/studentEdir.php?StudentID=<?php echo $_GET['StudentID']; ?>" method="POST" class="form_student_about">
                  <div class="row text-center">
                    <div class="col-lg-12">
                      <label for="" class="input-label">FIO</label>
                      <input type="text" name="FIO" class="form-control input_form" value="<?php echo $rowStudent['FIO']; ?>" required>
                    </div>
                    <div class="col-lg-12">
                      <label for="" class="input-label">Telefon raqam</label>
                      <input type="text" name="Phone" class="form-control input_form phone"  value="<?php echo $rowStudent['Phone']; ?>" required>
                    </div>
                    <div class="col-lg-12">
                      <label for="" class="input-label">Yaqin tanishi</label>
                      <input type="text" name="Tanish" class="form-control input_form"  value="<?php echo $rowStudent['Tanish']; ?>" placeholder="Yaqin tanishi" required>
                    </div>
                    <div class="col-lg-12">
                      <label for="" class="input-label">Tanish telefon raqami</label>
                      <input type="text" name="tphone" class="form-control input_form phone" value="<?php echo $rowStudent['TPhone']; ?>" required>
                    </div>
                    <div class="col-lg-12">
                      <label for="" class="input-label">Tug'ilgan kuni</label>
                      <input type="date" class="form-control input_form" value="<?php echo $rowStudent['Tkun']; ?>" disabled required>
                    </div>
                    <div class="col-lg-12">
                      <label for="" class="input-label">Yashash joyi</label>
                      <input type="text" class="form-control input_form" value="<?php echo $rowStudent['AddresName']; ?>" disabled required>
                    </div>
                    <div class="col-lg-12">
                      <label for="" class="input-label">Biz haqimzda</label>
                      <input type="text" class="form-control input_form" value="<?php echo $rowStudent['Haqimizda']; ?>" disabled required>
                    </div>
                    <div class="col-lg-12">
                      <label for="" class="input-label">Izoh</label>
                      <input type="text" class="form-control input_form" name="Izoh" value="<?php echo $rowStudent['About']; ?>" placeholder="Izoh"  required>
                    </div>
                    <div class="col-lg-12">
                      <button type="submit" name="studentEdit" class="Filter_btn btn">Malumotlarini yangilash</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
  </main>
  
  
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
  <script src="../assets/js/jquery.inputmask.min.js"></script>
  <script>
      $(document).ready(function(){
          $('.phone').inputmask('999 99 999 9999');
          $('.pasport').inputmask('AA 9999999');
          $('.pnfl').inputmask('99999999999999');
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
          var $input22 = $form.find( "#numbers2" );
          $input22.on( "keyup", function( event ) {
            var selection = window.getSelection().toString();
            if ( selection !== '' ) {
              return;
            }
            if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
              return;
            }
            var $this = $( this );
            var input22 = $this.val();
            var input22 = input22.replace(/[\D\s\._\-]+/g, "");
                input22 = input22 ? parseInt( input22, 10 ) : 0;
                $this.val( function() {
                  return ( input22 === 0 ) ? "" : input22.toLocaleString( "en-US" );
            } );
          } );


          var $form2 = $( "#form2" );
          var $qaytarish = $form2.find( "#qaytarish" );
          $qaytarish.on( "keyup", function( event ) {
            var selection = window.getSelection().toString();
            if ( selection !== '' ) {
              return;
            }
            if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
              return;
            }
            var $this = $( this );
            var qaytarish = $this.val();
            var qaytarish = qaytarish.replace(/[\D\s\._\-]+/g, "");
              qaytarish = qaytarish ? parseInt( qaytarish, 10 ) : 0;
                $this.val( function() {
                  return ( qaytarish === 0 ) ? "" : qaytarish.toLocaleString( "en-US" );
            } );
          } );
        });
      })(jQuery);
  </script>
</body>
</html>