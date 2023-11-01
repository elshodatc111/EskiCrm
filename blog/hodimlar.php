<?php
  include("../confige/confige.php");
  include("../confige/topHeader2.php");
?>

<?php
  $selectUser = "SELECT * FROM `user_meneger` WHERE `UserID`='".$_GET['UserID']."'";
  $resUser = $Confige->SelectAll($selectUser);
  $rowsUser = $resUser->fetch_assoc();
  $Username = $rowsUser['Username'];





?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Hodim haqida</title>
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
        if(isset($_GET['texrir'])){echo "alert('Hodim malumoti yangilandi')";}
        if(isset($_GET['passEdit'])){echo "alert('Hodim paroli yangilandi')";}
        if(isset($_GET['tulovplus'])){echo "alert('Hodim ish haqi to`landi')";}
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
        <a class="nav-link " href="../setting.php">
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
          <li class="breadcrumb-item"><a href="../setting.php">Sozlamalar</a></li>
          <li class="breadcrumb-item active">Hodimlar</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
        <div class="row">

          <div class="col-12">
            <div class="card ">
              <div class="card-body text-center p-0">
                <button class="btn btn-primary button_btn" data-bs-toggle="modal" data-bs-target="#addpay" style="display:<?php if($_COOKIE['Status']!='admin'){echo 'none';} ?>"><i class="bi bi-person-plus"></i> Ish haqi to'lash</button>
                <button class="btn btn-primary button_btn" data-bs-toggle="modal" data-bs-target="#edetpassword" style="display:<?php if($_COOKIE['Status']!='admin'){echo 'none';} ?>"><i class="bi bi-person-plus"></i> Parolni almashtirish</button>
              </div>
            </div>
          </div>

          
          <div class="modal fade  modal_form" id="addpay" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Ish haqi to'lash</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="../conUsers/hodimEdit.php?UserID=<?php echo $_GET['UserID']; ?>" method="POST">
                    <div class="row">
                      <div class="col-lg-12">
                        <label for="" class="input-label">Ish haqi to'lov summasi</label>
                        <input type="number" name="summa" class="form-control input_form" placeholder="Ish haqi to'lov summasi" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Izoh</label>
                        <input type="text" name="izoh" class="form-control input_form" placeholder="Izoh" required>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" name="ishHaqTulov" class="Filter_btn btn">Ish haqi to'lash</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade  modal_form" id="edetpassword" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Parolni yangilash</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="../conUsers/hodimEdit.php?UserID=<?php echo $_GET['UserID']; ?>" method="POST">
                    <div class="row">
                      <div class="col-lg-12">
                        <label for="" class="input-label">Yangi parolni kiriting</label>
                        <input type="password" name="Pass" class="form-control input_form" placeholder="Parol" required>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" name="editpassword" class="Filter_btn btn">Parolni yangilash</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          
          <div class="col-lg-8">
            <div class="card ">
              <div class="card-body">
                <h5 class="card-title">Hodim <span>| Guruhlarga to'lov qabul qildi</span></h5>
                <div class="table-responsive text-nowrap">
									<table class="table table-bordered border-primary table-striped" id="datatable">
                    <thead >
                      <tr>
                        <th>#</th>
                        <th>FIO</th>
                        <th>Guruh</th>
                        <th>To'lov Turi</th>
                        <th>To'lov summasi</th>
                        <th>To'lov vaqti</th>
                        <th>Izoh</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $start = date("Y-m-d")." 00:00:00";
                        $end = date("Y-m-d")." 23:59:59";
                        $sql = "SELECT * FROM `user_meneger` WHERE `UserID`='".$_GET['UserID']."'";
                        $res = $Confige->SelectAll($sql);
                        $row = $res->fetch_assoc();
                        $User = $row['Username'];
                        $sql1 = "SELECT user_student.FIO,user_student_tulov.Summa,user_student_tulov.TulovType,guruh.GuruhName,user_student_tulov.Izoh,user_student_tulov.Data FROM `user_student_tulov` JOIN `user_student` ON user_student_tulov.UserID=user_student.StudentID JOIN `guruh` ON user_student_tulov.GuruhID=guruh.GuruhID WHERE user_student_tulov.Operator='".$User."' AND user_student_tulov.Data>='".$start."' AND user_student_tulov.Data<='".$end."' ORDER BY user_student_tulov.id ASC";
                        $res1 = $Confige->SelectAll($sql1);
                        if($res1->num_rows>0){
                          $i=1;
                          while ($row1 = $res1->fetch_assoc()) {
                            echo "<tr>
                              <td>".$i."</td>
                              <td>".$row1['FIO']."</td>
                              <td>".$row1['GuruhName']."</td>
                              <td>".$row1['TulovType']."</td>
                              <td>".number_format(($row1['Summa']), 0, '.', ' ')."</td>
                              <td>".$row1['Data']."</td>
                              <td>".$row1['Izoh']."</td>
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
            <div class="card ">
              <div class="card-body">
                <h5 class="card-title">Hodim <span>| Ish haqi to'lovlari</span></h5>
                <div class="table-responsive text-nowrap">
									<table class="table table-bordered border-primary table-striped my_table_search">
                    <thead >
                      <tr>
                        <th>#</th>
                        <th>To'lov summasi</th>
                        <th>To'lov vaqti</th>
                        <th>Izoh</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sqlSel = "SELECT * FROM `user_meneger_ish_haqi` WHERE `UserID`='".$_GET['UserID']."'";
                        $resSel = $Confige->SelectAll($sqlSel);
                        if($resSel->num_rows>0){
                          $i=1;
                          while ($rowSel = $resSel->fetch_assoc()) {
                            echo "
                            <tr class='text-center'>
                              <td>".$i."</td>
                              <td>".$rowSel['Summa']."</td>
                              <td>".$rowSel['Data']."</td>
                              <td>".$rowSel['Izoh']."</td>
                            </tr>
                            ";
                            $i++;
                          }
                        }else{
                          echo "<tr><td colspan='4' class='text-center'>Hodimga ish haqi to`lanmagan</td></tr>";
                        }
                      ?>
                      
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card " style="display:<?php if($_COOKIE['Status']!='admin'){echo 'none';} ?>">
              <div class="card-body">
                <h5 class="card-title">Talaba haqida</h5>
                <form action="../conUsers/hodimEdit.php?UserID=<?php echo $_GET['UserID']; ?>" method="POST" class="form_student_about">
                  <div class="row text-center">
                    <div class="col-lg-12">
                      <label for="" class="input-label">FIO</label>
                      <input type="text" class="form-control input_form" name="FIO" value="<?php echo $rowsUser['FIO']; ?>" placeholder="FIO" required>
                    </div>
                    <div class="col-lg-12">
                      <label for="" class="input-label">Telefon raqam</label>
                      <input type="text" class="form-control input_form phone" name="Phone" value="<?php echo $rowsUser['Phone']; ?>" placeholder="Telefon raqam" required>
                    </div>
                    <div class="col-lg-12">
                      <label for="" class="input-label">Yashash manzil</label>
                      <input type="text" class="form-control input_form" name="Addres" value="<?php echo $rowsUser['Addres']; ?>" placeholder="Yaqin tanishi" required>
                    </div>
                    <div class="col-lg-12">
                      <label for="" class="input-label">Tug'ilgan kuni</label>
                      <input type="text" class="form-control input_form" value="<?php echo $rowsUser['TDay']; ?>" placeholder="Tug'ilgan kuni" disabled required>
                    </div>
                    <div class="col-lg-12">
                      <label for="" class="input-label">Operator turi</label>
                      <input type="text" class="form-control input_form" value="<?php echo $rowsUser['Status']; ?>" placeholder="Biz haqimzda" disabled required>
                    </div>
                    <div class="col-lg-12">
                      <label for="" class="input-label">Login</label>
                      <input type="text" class="form-control input_form" value="<?php echo $rowsUser['Username']; ?>" placeholder="Login" disabled required>
                    </div>
                    <div class="col-lg-12">
                      <button type="submit" name="EdetOperator" class="Filter_btn btn">Malumotlarni yangilash</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            
           <!-- Hodim tarixi -->
            <div class="card ">
              <div class="card-body">
                <h5 class="card-title">Hodim tarixi</h5>
                <div class="activity">  
                  <?php
                    $dates = time()-3600*8;
                    $sqlHis = "SELECT * FROM `user_meneger_history` WHERE `UserID`='".$Username."' AND `date`>='".$dates."' ORDER BY `id` DESC";
                    $resHis = $Confige->SelectAll($sqlHis);
                    if($resHis->num_rows>0){
                      while($rowHis = $resHis->fetch_assoc()){
                        $vaqt = round((time()-$rowHis['date'])/60);
                        echo "<div class='activity-item d-flex'>
                              <div class='activite-label'>".$vaqt." min</div>
                              <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                              <div class='activity-content'>".$rowHis['Izoh']."</div>
                            </div>";
                      }
                    }
                  ?>    
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
  <script src="../assets/js/jquery.inputmask.min.js"></script>
  <script>
      $(document).ready(function(){
          $('.phone').inputmask('999 99 999 9999');
          $('.pasport').inputmask('AA 9999999');
          $('.pnfl').inputmask('99999999999999');
      });
  </script>
</body>
</html>