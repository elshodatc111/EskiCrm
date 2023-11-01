<?php
  include("../confige/confige.php");
  include("../confige/topHeader2.php");

  $sqlTech = "SELECT * FROM `user_techer` WHERE `TecherID`='".$_GET['TechID']."'";
  $resTech = $Confige->SelectAll($sqlTech);
  $rowTech = $resTech->fetch_assoc();
  $otgan_oy = date('Y-m-d', strtotime('-1 month'));
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>O'qituvchi haqida</title>
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
        if(isset($_GET['tulovPlus'])){echo "alert('O`qituvchi ish haqi to`landi')";}
        if(isset($_GET['techedit'])){echo "alert('O`qituvchi malumotlari yangilandi')";}
        if(isset($_GET['sendmes'])){echo "alert('SMS habar yuborildi')";}
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
        <a class="nav-link collapsed" href="../guruh.php">
          <i class="bi bi-text-indent-left"></i>
          <span>Guruhlar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="../techer.php">
          <i class="bi bi-person-badge"></i>
          <span>O'qituvchilar</span>
        </a>
      </li>
      <li class="nav-item"  style="display:<?php if(isset($_COOKIE['Status'])){if($_COOKIE['Status']==='meneger'){echo 'none';}} ?>">
        <a class="nav-link collapsed" href="../statistik.php">
          <i class="bi bi-bar-chart"></i>
          <span>Statistika</span>
        </a>
      </li>
      <li class="nav-item"  style="display:<?php if(isset($_COOKIE['Status'])){if($_COOKIE['Status']==='meneger'){echo 'none';}} ?>">
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
          <li class="breadcrumb-item"><a href="../techer.php">O'qituvchilar</a></li>
          <li class="breadcrumb-item active">O'qitivchi haqida</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
        <div class="row">

          <div class="col-12">
            <div class="card ">
              <div class="card-body text-center row pt-3">
                <div class="col-lg-4 py-2"><button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#addguruh" style="display:<?php if($_COOKIE['Status']==='xisobchi'){echo 'none';} ?>"><i class="bi bi-ui-checks"></i> Guruhga qo'shish</button></div>
                <div class="col-lg-4 py-2"><button class="btn btn-outline-success w-100" data-bs-toggle="modal" data-bs-target="#ishhaqi" style="display:<?php if($_COOKIE['Status']!='admin'){echo 'none';}else ?>"><i class="bi bi-card-checklist"></i> Ish haqqi</button></div>
                <div class="col-lg-4 py-2"><button class="btn btn-outline-info w-100" data-bs-toggle="modal" data-bs-target="#sendSMS"><i class="bi bi-upload"></i> SMS yuborish</button></div>
              </div>
            </div>
          </div>
          
          <div class="modal fade  modal_form" id="addguruh" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Guruhga qo'shish</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="../conUsers/techerEdit.php?TechID=<?php echo $_GET['TechID']; ?>" method="POST">
                    <div class="row">
                      <div class="col-lg-12">
                        <label for="" class="input-label">Guruhni tanlang</label>
                        <select name="GuruhID" class="form-control" required>
                            <?php
                              $sqlg = "SELECT * FROM `guruh` WHERE `End`>='".date("Y-m-d")."'";
                              $resg = $Confige->SelectAll($sqlg);
                              if($resg->num_rows>0){
                                echo "<option value=''>Tanlang</option>";
                                while($rowg = $resg->fetch_assoc()){
                                  $GuruID = $rowg['GuruhID'];
                                  $TecherID = $_GET['TechID'];
                                  $sqla = "SELECT * FROM `user_techer_guruh` WHERE `GuruhID`='".$GuruID."' AND `TecherID`='".$TecherID."'";
                                  $resa = $Confige->SelectAll($sqla);
                                  if($resa->num_rows>0){}else{
                                    echo "<option value=".$rowg['GuruhID'].">".$rowg['GuruhName']."</option>";
                                  }
                                }
                              }
                            ?>
                        </select>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Izoh</label>
                        <input type="text" name="Izoh" class="form-control input_form" placeholder="Izoh" required>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" name="TechPlusGuruh" class="Filter_btn btn">Guruhga qo'shish</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade  modal_form" id="ishhaqi" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Ish haqi to'lash</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="../conUsers/techerEdit.php?TechID=<?php echo $_GET['TechID']; ?>" id="form" method="POST">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="" class="input-label"> Guruhni tanlang</label>
                            <select name="Monch" class="form-control" required>
                                <option value=''>Tanlang</option>
                                <?php
                                  $sqlgur = "SELECT * FROM `user_techer_guruh` JOIN `guruh` ON user_techer_guruh.GuruhID=guruh.GuruhID WHERE guruh.End>='".$otgan_oy."' AND user_techer_guruh.TecherID='".$_GET['TechID']."'";
                                  $resgur = $Confige->SelectAll($sqlgur);
                                  if($resgur->num_rows>0){
                                    while ($rowgur = $resgur->fetch_assoc()) {
                                      echo "<option value=".$rowgur['GuruhID'].">".$rowgur['GuruhName']."</option>";
                                    }
                                  }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label for="" class="input-label">To'lov summasi</label>
                            <input type="text" name="summa" id='numbers' class="form-control input_form" placeholder="To'lov summasi" required>
                        </div>
                        <div class="col-lg-12">
                            <label for="" class="input-label">Izoh</label>
                            <input type="text" name="Izoh" class="form-control input_form" placeholder="Izoh" required>
                        </div>
                      <div class="col-lg-12">
                        <button type="submit" name="tulovPlus" class="Filter_btn btn">To'lov qilish</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade  modal_form" id="sendSMS" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">SMS yuborish</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="../conUsers/sendSMSStudent.php?TechID=<?php echo $_GET['TechID']; ?>" method="POST">
                    <div class="row">
                      <div class="col-lg-12" style="display:none">
                        <label for="" class="input-label">phone number</label>
                        <input type="text" class="form-control input_form" name="Phone" value="" placeholder="SMS habar matni" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">SMS matni</label>
                        <input type="text" class="form-control input_form" name="Matn" placeholder="SMS matni" required>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" name="SendMessegeTecher" class="Filter_btn btn">SMS yuborish</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Guruhlari</h5>
                <div class="table-responsive text-nowrap">
				          <table class="table table-bordered border-primary table-striped my_table_search">
                    <thead style='font-size:14px'>
                      <tr>
                        <th># </th>
                        <th>Guruh</th>
                        <th>Boshlangan</th>
                        <th>Yakunlangan</th>
                        <th>Jami to'lovlar</th>
                        <th>Talabalar soni</th>
                        <th>To'lov qilgan talabalar (Naqt,Plastik,Chegirma)</th>
                        <th>Yangi guruhdagi talabalar</th>
                        <th>O'qituvchi ish haqi</th>
                        <th>O'qituvchiga to'langan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sql = "SELECT guruh_bonus.Tulov,guruh_bonus.Bonus,guruh.GuruhID,guruh.GuruhName,guruh.Start,guruh.End FROM `guruh` JOIN `guruh_bonus` ON guruh.GuruhID=guruh_bonus.GuruhID JOIN `user_techer_guruh` ON guruh.GuruhID=user_techer_guruh.GuruhID WHERE  user_techer_guruh.TecherID='".$_GET['TechID']."' AND guruh.End>='".$otgan_oy."' ORDER BY guruh.id DESC";
                        $res = $Confige->SelectAll($sql);
                        if($res->num_rows>0){
                          $i=1;
                          while ($row=$res->fetch_assoc()) {
                            $talabaID = array();
                            $GuruhID = $row['GuruhID'];
                            $start = $row['Start'];
                            $bonus = $row['Bonus'];
                            $tulov = $row['Tulov'];
                            $sql1 = "SELECT * FROM `guruh_users` WHERE `GuruhID`='".$GuruhID."'";
                            $res1 = $Confige->SelectAll($sql1);
                            $talabalar = 0;
                            if($res1->num_rows>0){
                              while ($row1=$res1->fetch_assoc()) {
                                $talabalar = $talabalar+1;
                                array_push($talabaID,$row1['UserID']);
                              }
                            }
                            $sql2 = "SELECT * FROM `user_student_tulov` WHERE `GuruhID`='".$GuruhID."'";
                            $res2 = $Confige->SelectAll($sql2);
                            $jami_summa = 0;
                            if($res2->num_rows>0){
                              while ($row2 = $res2->fetch_assoc()) {
                                if($row2['TulovType']==='Naqt'){
                                  $jami_summa = $jami_summa + $row2['Summa'];
                                }elseif($row2['TulovType']==='Plastik'){
                                  $jami_summa = $jami_summa + $row2['Summa'];
                                }
                              }
                            }
                            $tulCount = 0;
                            $activstudent = 0;
                            foreach ($talabaID as $UserID) {
                              $sql3 = "SELECT * FROM `user_student_tulov` WHERE `GuruhID`='".$GuruhID."' AND `UserID`='".$UserID."' AND `TulovType`='Naqt'";
                              $res3 = $Confige->SelectAll($sql3);
                              $sql4 = "SELECT * FROM `user_student_tulov` WHERE `GuruhID`='".$GuruhID."' AND `UserID`='".$UserID."' AND `TulovType`='Plastik'";
                              $res4 = $Confige->SelectAll($sql4);
                              $sql5 = "SELECT * FROM `user_student_tulov` WHERE `GuruhID`='".$GuruhID."' AND `UserID`='".$UserID."' AND `TulovType`='Chegirma'";
                              $res5 = $Confige->SelectAll($sql5);
                              if($res3->num_rows>0){
                                $tulCount = $tulCount + 1;
                              }elseif($res4->num_rows>0){
                                $tulCount = $tulCount + 1;
                              }elseif($res5->num_rows>0){
                                $tulCount = $tulCount + 1;
                              }
                              $sql5 = "SELECT * FROM `guruh_users` JOIN `guruh` ON guruh_users.GuruhID=guruh.GuruhID WHERE guruh.Start>'".$start."' AND guruh_users.UserID='".$UserID."'";
                              $res5 = $Confige->SelectAll($sql5);
                              if($res5->num_rows>0){
                                  $activstudent = $activstudent + 1;
                              }
                            }
                            $ishhaqi = $tulCount*$tulov+$bonus*$activstudent;
                            $sqlTechtul = "SELECT * FROM `user_techer_ish_haqi` WHERE `TechID`='".$_GET['TechID']."' AND `Monch`='".$GuruhID."'";
                            $resTechTul = $Confige->SelectAll($sqlTechtul);
                            $techTulov = 0;
                            if($resTechTul->num_rows>0){
                              while ($rowTechTul = $resTechTul->fetch_assoc()) {
                                $techTulov = $techTulov + $rowTechTul['Summa'];
                              }
                            }
                            echo "<tr style='font-size:12px;'>
                              <td>".$i."</td>
                              <td>".$row['GuruhName']."</td>
                              <td style='font-size:12px;'class='text-center'>".$row['Start']."</td>
                              <td style='font-size:12px;'class='text-center'>".$row['End']."</td>
                              <td class='text-center'>".number_format(($jami_summa), 0, '.', ' ')."</td>
                              <td class='text-center'>".$talabalar."</td>
                              <td class='text-center'>".$tulCount."</td>
                              <td class='text-center'>".$activstudent."</td>
                              <td class='text-center'>".number_format(($ishhaqi), 0, '.', ' ')."</td>
                              <td class='text-center'>".number_format(($techTulov), 0, '.', ' ')."</td>
                            </tr>";
                            $i++;
                          }
                        }else{
                          echo "<tr><td colspan=10 class='text-center'>O'qituvchi guruhlari mavjud emas</td></tr>";
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8"> 
              <div class="card info-card revenue-card" style="display:<?php if($_COOKIE['Status']==='meneger'){echo 'none';} ?>">
                <div class="card-body">
                  <h5 class="card-title">To'lovlar</h5>
                  <div class="table-responsive text-nowrap">
                  <table class="table table-bordered border-primary table-striped my_table_search">
                      <thead >
                        <tr>
                          <th>#</th>
                          <th>To'langan summa</th>
                          <th>Izoh</th>
                          <th>To'lov vaqti</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $sqlTulov = "SELECT * FROM `user_techer_ish_haqi` WHERE `TechID`='".$_GET['TechID']."'";
                          $restulov = $Confige->SelectAll($sqlTulov);
                          if($restulov->num_rows>0){
                            $i=1;
                            while ($rowtulov=$restulov->fetch_assoc()) {
                              echo "<tr>
                                  <td class='text-center'>".$i."</td>
                                  <td class='text-center'>".$rowtulov['Summa']."</td>
                                  <td>".$rowtulov['Izoh']."</td>
                                  <td>".$rowtulov['Data']."</td>
                                </tr>";
                                $i++;
                            }
                          }else{
                            echo "<tr><td class='text-center' colspan='5'>Ish haqi to`lovlari mavjud emas</td></tr>";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="card info-card revenue-card" style="display:<?php if($_COOKIE['Status']==='meneger'){echo 'none';} ?>">
                <div class="card-body">
                  <?php
                    $logSql = "SELECT * FROM `user_tech_pass` WHERE `UserID`='".$_GET['TechID']."'";
                    $loqres = $Confige->SelectAll($logSql);
                    $username = "";
                    if($loqres->num_rows>0){
                      $login1 = 'none';
                      $login2 = 'block';
                      $logres = $loqres->fetch_assoc();
                      $username = $logres['Username'];
                    }else{
                      $login1 = 'block';
                      $login2 = 'none';
                    }
                  ?>
                  <div style="display:<?php echo $login1; ?>">
                    <h5 class="card-title">O'qituvchiga login parol qo'shish</h5>                  
                    <form action="../conUsers/techerEdit.php?TechID=<?php echo $_GET['TechID']; ?>" method="post" class="row">
                      <div class="col-lg-4 my-2">
                        <label class="mb-2">Login</label>
                        <input type="text" name="username" class="form-control" required>
                      </div>
                      <div class="col-lg-4 my-2">
                        <label class="mb-2">Parol</label>
                        <input type="password" name='password' class="form-control" required>
                      </div>
                      <div class="col-lg-4 my-2">
                        <label class="mb-2">.</label>
                        <button class="btn btn-primary w-100" name="passPlus">Saqlash</button>
                      </div>
                    </form>
                  </div>
                  <div style="display:<?php echo $login2; ?>">
                    <h5 class="card-title">Parolni yangilash (<b>Login: </b><?php echo $username; ?>)</h5>
                    <form action="../conUsers/techerEdit.php?TechID=<?php echo $_GET['TechID']; ?>" method="post" class="row">
                      <div class="col-lg-6 my-2">
                        <label class="mb-2">Yangi parol</label>
                        <input type="password" name="password" class="form-control" required>
                      </div>
                      <div class="col-lg-6 my-2">
                        <label class="mb-2">.</label>
                        <button class="btn btn-primary w-100" name="edetPassword">Saqlash</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
          </div>
          <div class="col-lg-4">
            <div class="card ">
              <div class="card-body">
                <h5 class="card-title">O'qituvchi haqida</h5>
                <form action="../conUsers/techerEdit.php?TechID=<?php echo $_GET['TechID']; ?>" method="POST" class="form_student_about">
                  <div class="row text-center">
                    <div class="col-lg-12">
                      <label for="" class="input-label">FIO</label>
                      <input type="text" class="form-control input_form" name="techname" value="<?php echo $rowTech['TecherName']; ?>" placeholder="FIO" required>
                    </div>
                    <div class="col-lg-12">
                      <label for="" class="input-label">Telefon raqam</label>
                      <input type="text" class="form-control input_form phone" name="phone" value="<?php echo $rowTech['Phone']; ?>" required>
                    </div>
                    <div class="col-lg-12">
                      <label for="" class="input-label">Yashash joyi</label>
                      <input type="text" class="form-control input_form" name="addres" value="<?php echo $rowTech['Addres']; ?>" required>
                    </div>
                    <div class="col-lg-12">
                      <label for="" class="input-label">Tug'ilgan kuni</label>
                      <input type="text" class="form-control input_form" value="<?php echo $rowTech['TDate']; ?>" disabled required>
                    </div>
                    <div class="col-lg-12">
                      <label for="" class="input-label">Mutahasislihi</label>
                      <input type="text" class="form-control input_form" name="mutahasis" value="<?php echo $rowTech['Mutahasis']; ?>" required>
                    </div>
                    <div class="col-lg-12">
                      <label for="" class="input-label">O'qituvchi haqida</label>
                      <input type="text" name="About" class="form-control input_form" value="<?php echo $rowTech['About']; ?>" required>
                    </div>
                    <div class="col-lg-12">
                      <button type="submit" name="TechEdit" class="Filter_btn btn">Malumotlarini yangilash</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="card ">
              <div class="card-body">
                <h5 class="card-title">SMS tarixi</h5>
                <div class="activity">                  
                  
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
  <script src="../assets/js/jquery-3.5.1.js"></script>
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
          
        });
      })(jQuery);
  </script>
</body>
</html>